/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strmapi.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/19 20:43:14 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 22:04:54 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strmapi(char const *s, char (*f)(unsigned int, char))
{
	int		i;
	int		size_s;
	char	*str2;

	if (!s || !f)
		return (NULL);
	i = 0;
	size_s = ft_strlen(s);
	str2 = ft_memalloc(size_s + 1);
	if (!str2)
		return (NULL);
	while (*s)
	{
		str2[i] = f(i, *s);
		s++;
		i++;
	}
	return (str2);
}
