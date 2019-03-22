/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strnstr.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/19 20:56:21 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 15:11:40 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strnstr(const char *big, const char *little, size_t len)
{
	size_t i;
	size_t j;
	size_t aux_length;

	i = 0;
	j = 0;
	aux_length = ft_strlen(little) - 1;
	while (i < len && big[i])
	{
		if (big[i] == little[j])
		{
			while (big[i] == little[j] && i < len)
			{
				if (j == aux_length)
					return ((char *)big + (i - j));
				j++;
				i++;
			}
			i = i - j;
			j = 0;
		}
		i++;
	}
	return (*little != '\0' ? 0 : (char *)big);
}
