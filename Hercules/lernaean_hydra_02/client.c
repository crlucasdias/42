/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   client.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/09 18:45:32 by lbeserra          #+#    #+#             */
/*   Updated: 2019/03/09 19:53:23 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#	include "libft.h"

#	define CON_IP "127.0.0.1"
#	define PORT   3114

static	void	send_msg(int c_socket)
{
	char buffer[BUFFER_SIZE];

	ft_bzero(buffer, sizeof(buffer));
	fgets(buffer, sizeof(buffer), stdin);
	if (ft_strncmp(buffer, "ping", 4) == 0)
	{
		if (write(c_socket, buffer, sizeof(buffer)) < 0)
		{
			printf("error when tried to send a message");
			close(c_socket);
			exit(1);
		}
		if (read(c_socket, buffer, sizeof(buffer)) < 0)
		{
			printf("error to receive server message");
			close(c_socket);
			exit(1);
		}
		fputs(buffer, stdout);
	}
	close(c_socket);
}

static	int		connect_to_server(int c_socket)
{
	c_addr.sin_family = AF_INET;
	c_addr.sin_addr.s_addr = inet_addr(CON_IP);
	c_addr.sin_port = htons(PORT);
	if (connect(c_socket, (struct sockaddr *)&c_addr, sizeof(c_addr)) == 0)
		return (1);
	printf("Error when tried to connect");
	exit(1);
}

int				main(void)
{
	int client;

	client = creating_socket();
	if (connect_to_server(client))
		send_msg(client);
}
