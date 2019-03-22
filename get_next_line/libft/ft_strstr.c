/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strstr.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/13 15:56:01 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/13 17:24:19 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strstr(const char *hay, const char *needle)
{
	int i;
	int j;
	int aux;

	i = 0;
	j = 0;
	aux = ft_strlen(needle) - 1;
	while (hay[i])
	{
		if (hay[i] == needle[j])
		{
			while (hay[i] == needle[j])
			{
				if (j == aux)
					return ((char *)hay + (i - j));
				j++;
				i++;
			}
			i = i - j;
			j = 0;
		}
		i++;
	}
	return (needle[0] != '\0' ? 0 : (char *)hay);
}
