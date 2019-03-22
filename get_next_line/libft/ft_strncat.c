/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strncat.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/15 14:19:29 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 22:02:55 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strncat(char *destination, const char *source, size_t num)
{
	unsigned int	i;
	int				len;

	i = 0;
	len = ft_strlen(destination);
	while (i < num && source[i] != '\0')
	{
		destination[len + i] = source[i];
		i++;
	}
	destination[len + i] = '\0';
	return (destination);
}
