/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strrev.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/27 15:11:46 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 22:02:26 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strrev(char *str1)
{
	char	*str2;
	int		size;
	int		i;

	size = ft_strlen(str1);
	str2 = ft_memalloc(size + 1);
	i = 0;
	while (size--)
	{
		str2[i] = str1[size];
		i++;
	}
	return (str2);
}
