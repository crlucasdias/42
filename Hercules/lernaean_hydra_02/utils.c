/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   utils.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/09 18:46:20 by lbeserra          #+#    #+#             */
/*   Updated: 2019/03/09 19:41:21 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#			include "libft.h"

int			creating_socket(void)
{
	int s_socket;

	s_socket = socket(AF_INET, SOCK_STREAM, 0);
	if (s_socket == -1)
	{
		printf("Error creating socket");
		exit(1);
	}
	return (s_socket);
}

void		ft_bzero(void *s, size_t n)
{
	unsigned char	*tmp;
	size_t			i;

	tmp = (unsigned char *)s;
	i = 0;
	while (i < n)
	{
		tmp[i] = 0;
		i++;
	}
}

int			ft_strncmp(const char *s1, const char *s2, size_t num)
{
	if (num == 0)
		return (0);
	while (--num && (*s1 == *s2) && (*s1 != '\0' || *s2 != '\0'))
	{
		s1++;
		s2++;
	}
	return ((unsigned char)*s1 - (unsigned char)*s2);
}
