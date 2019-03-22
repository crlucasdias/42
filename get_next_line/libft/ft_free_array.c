/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_free_array.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/27 17:32:01 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 17:34:07 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

void	ft_free_array(char **arr, size_t size)
{
	size_t n;

	n = 0;
	while (n < size)
	{
		free(arr[n]);
		arr[n] = NULL;
		n++;
	}
	free(arr);
	arr = NULL;
}
