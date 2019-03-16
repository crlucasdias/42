# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    consulting_users.rb                                :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2019/03/15 20:35:44 by lbeserra          #+#    #+#              #
#    Updated: 2019/03/15 20:35:45 by lbeserra         ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

require 'oauth2'

def get_users(file_name)
    begin
        file = File.read(file_name)
        if file and File.extname(file_name) == ".txt"
            return file.split("\n")
        end
    rescue
        return nil
    end
end

def get_token_access()
    begin
        site_path = 'https://api.intra.42.fr/'
            client = OAuth2::Client.new(
                ENV["API_UID"],
                ENV["API_SKEY"],
                :site => site_path
            )
            token = client.client_credentials.get_token
    rescue
        puts "No token. Check Enviroment variables"
        exit
    end

    return token
end

def get_user_info(token,login)
    begin
        response = token.get("/v2/users/#{login}")
        loop do
            if response.status == 200
                user_location_feedback(response.parsed)
                break
            elsif response.status != 200
                puts "No response... trying again"
                sleep(2)
                response = token.get("/v2/users/#{login}")
            end
        end
    rescue
        puts "Invalid user"
    end
end

def user_location_feedback(user_info)
        if user_info['location']
            color = get_zone_color(user_info['location'])
            puts "\e[#{color}m Location of #{user_info['login']}: #{user_info['location']} \e[0m"
        elsif user_info['location'] == nil
            color = get_zone_color("-1")
            puts "\e[#{color}m #{user_info['login']} unavaliable \e[0m"
        end
end

def get_zone_color(location)
    zone = location[2..3]
    case zone
    when "z1"
        return (34)
    when "z2"
        return (32)
    when "z3"
        return (33)
    when "z4"
        return (35)
    else
        return (31)
    end
end

if ARGV[0] and ARGV.length == 1
    users = get_users(ARGV[0])
    if users
        token = get_token_access()
        for i in 0..users.length - 1
            get_user_info(token, users[i])
        end
    else
        puts "Check your filename"
    end
else   
    puts "Usage: ruby {filename.rb} {filename.txt}"
end
