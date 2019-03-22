/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strncpy.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/11 17:53:27 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 15:58:40 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strncpy(char *dest, const char *from, size_t max_size)
{
	size_t i;

	i = 0;
	while (from[i] && i < max_size)
	{
		dest[i] = from[i];
		i++;
	}
	while (i < max_size)
	{
		dest[i] = '\0';
		i++;
	}
	return (dest);
}
