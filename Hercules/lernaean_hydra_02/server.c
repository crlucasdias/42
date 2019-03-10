/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   server.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/09 18:47:12 by lbeserra          #+#    #+#             */
/*   Updated: 2019/03/09 19:40:09 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#		include "libft.h"

#		define PORT 3114

static	int	bind_server(int server)
{
	sv_addr.sin_family = AF_INET;
	sv_addr.sin_addr.s_addr = htonl(INADDR_ANY);
	sv_addr.sin_port = htons(PORT);
	if (bind(server, (struct sockaddr *)&sv_addr, sizeof(sv_addr)) == 0)
	{
		if (listen(server, 5) < 0)
			return (0);
		return (1);
	}
	return (0);
}

static	int	start_accept_client(int server)
{
	unsigned int	len;
	int				client;

	len = sizeof(c_addr);
	client = accept(server, (struct sockaddr *)&c_addr, &len);
	if (!client)
	{
		printf("Error to accept client");
		exit(1);
	}
	return (client);
}

void		send_reply(int client)
{
	char			buffer[BUFFER_SIZE];
	int				received_value;
	int				compare;

	while (1)
	{
		received_value = recv(client, buffer, sizeof(buffer), 0);
		compare = ft_strncmp(buffer, "ping", 4);
		if (compare == 0)
		{
			dprintf(client, "Response: pong pong\n");
			printf("Response: pong pong\n");
			ft_bzero(buffer, BUFFER_SIZE);
		}
		else if (received_value == -1 || !received_value)
		{
			dprintf(client, "Exiting...");
			printf("Exiting...");
			exit(1);
		}
	}
}

int			main(void)
{
	int				server;
	int				client;

	server = creating_socket();
	if (server && bind_server(server))
	{
		client = start_accept_client(server);
		if (client)
		{
			printf("\033[5;36;40m [Welcome] Connection started \n");
			send_reply(client);
		}
	}
	else
		printf("Error occur when tried to start server");
}
