/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strcat.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/15 14:21:59 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/15 14:24:48 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strcat(char *destination, const char *source)
{
	int i;
	int dest_aux;

	i = 0;
	dest_aux = ft_strlen(destination);
	while (source[i])
	{
		destination[dest_aux + i] = source[i];
		i++;
	}
	destination[dest_aux + i] = '\0';
	return (destination);
}
