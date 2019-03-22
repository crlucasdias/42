/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strlcat.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/27 15:24:04 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 15:28:29 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

size_t	ft_strlcat(char *restrict dst, const char *restrict src, size_t dstsize)
{
	size_t	i;
	size_t	k;
	size_t	dst_str_size;
	size_t	src_str_size;

	i = 0;
	dst_str_size = ft_strlen(dst);
	src_str_size = ft_strlen(src);
	if (dstsize < dst_str_size)
		return (src_str_size + dstsize);
	while (dst[i])
		i++;
	k = 0;
	while (src[k] && i < dstsize - 1)
	{
		dst[i] = src[k];
		i++;
		k++;
	}
	dst[i] = '\0';
	return (dst_str_size + src_str_size);
}
