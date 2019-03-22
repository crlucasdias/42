/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_memmove.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/15 14:34:46 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 15:32:53 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

void	*ft_memmove(void *dst, const void *src, size_t len)
{
	unsigned char *destination;
	unsigned char *source;

	destination = (unsigned char *)dst;
	source = (unsigned char *)src;
	if (destination == source)
		return (dst);
	if (source <= destination)
	{
		while (len--)
			destination[len] = source[len];
	}
	else
	{
		while (len--)
		{
			*destination = *source;
			destination++;
			source++;
		}
	}
	return (dst);
}
