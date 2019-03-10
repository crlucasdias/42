/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   socket.h                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/09 18:48:42 by lbeserra          #+#    #+#             */
/*   Updated: 2019/03/09 19:52:22 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef LIBFT_H
# define LIBFT_H

# include <sys/socket.h>
# include <netinet/in.h>
# include <stdio.h>
# include <stdlib.h>
# include <string.h>
# include <arpa/inet.h>
# include <unistd.h>

# define BUFFER_SIZE 256

struct sockaddr_in sv_addr;
struct sockaddr_in c_addr;

void		ft_bzero(void *s, size_t n);
int			ft_strncmp(const char *s1, const char *s2, size_t num);
int			creating_socket();
static	int	bind_server();
static	int	start_accept_client ();
void		send_reply();
void		receive_msg();

#endif
