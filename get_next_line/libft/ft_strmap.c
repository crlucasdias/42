/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strmap.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/19 20:41:26 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 22:05:52 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strmap(char const *s, char (*f)(char))
{
	int		i;
	int		str_size;
	char	*str2;

	if (!s || !f)
		return (NULL);
	str_size = ft_strlen(s);
	str2 = ft_memalloc(str_size + 1);
	i = 0;
	if (!str2)
		return (NULL);
	while (*s)
	{
		str2[i] = f(*s);
		i++;
		s++;
	}
	return (str2);
}
