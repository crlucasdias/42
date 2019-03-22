/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_isalnum.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/13 18:50:23 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/13 19:03:20 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

int	ft_isalnum(int c)
{
	int alpha;
	int num;

	alpha = ft_isalpha(c);
	num = ft_isdigit(c);
	if (alpha || num)
		return (1);
	return (0);
}
