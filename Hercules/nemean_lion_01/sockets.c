#include "socket.h"
//bind: associa endereco e porta ao socket

static	int creating_socket()
{
    int my_socket;

    my_socket = socket(AF_INET,SOCK_STREAM,0);
    if (my_socket == -1)
    {
        printf("Error creating socket");
        exit(1);
    }
    return (my_socket);
}

static	int start_server(int my_socket,struct sockaddr_in sv_addr)
{ //assign socket addr to a descriptor
	sv_addr.sin_family = AF_INET;
	sv_addr.sin_addr.s_addr = htonl(INADDR_ANY);
	sv_addr.sin_port = htons(PORT);
    
	if(bind(my_socket, (struct sockaddr *) &sv_addr, sizeof(sv_addr)) == 0)
	{
		if (listen(my_socket, 5) < 0)
			exit(1);
		printf("Server started. \n");
		return (1);
	}
	printf("Error when tried to create connection");
	exit(1);
}


static int accept_c_connection(int my_socket)
{
	int client; 
	unsigned int len;

	len = sizeof(c_addr);
	client = accept(my_socket, (struct sockaddr *) &c_addr, &len);
	if (!client)
	{
		printf("Error to accept connections");
		exit(1);
	}
	return client;
}

static	void	receive_msg()
{
	char buffer[BUFFER_SIZE]; 
	int received_value;
	int compare;

	while(1)
	{
		received_value = recv(client,buffer, sizeof(buffer),0);
		compare = strncmp(buffer, "ping",4);
		if (compare == 0)
		{
			printf("pong\npong\n");
			bzero(buffer,BUFFER_SIZE);
		}
		else
			printf("Thats not a ping.\n");
		if (received_value == -1 || !received_value)
		{	
			printf("error occuer. \n");
			exit(1);
		}
	}
}


int main(int argc, char **argv)
{
    server = creating_socket();
	if(server && start_server(server, sv_addr))
	{
		return (0);
		client = accept_c_connection(server);
		receive_msg();
	}
}
