/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strrchr.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/15 14:15:41 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 15:36:49 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strrchr(const char *str, int c)
{
	int size;
	int found;

	found = 0;
	size = ft_strlen((char *)str);
	while (size >= 0)
	{
		if (str[size] == c)
		{
			found = 1;
			break ;
		}
		size--;
	}
	if (found == 1)
		return (char *)str + size;
	return (0);
}
