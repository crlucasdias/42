/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_itoa.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/23 18:01:45 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 22:37:54 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

static	int	ft_itoa_count(int nb)
{
	int i;

	i = 0;
	if (nb <= 0)
		i = 1;
	while (nb)
	{
		nb = nb / 10;
		i++;
	}
	return (i);
}

char		*ft_itoa(int n)
{
	char	*str;
	int		length;
	int		is_neg;

	if (n == -2147483648)
		return (ft_strdup("-2147483648"));
	is_neg = 0;
	length = ft_itoa_count(n);
	str = ft_memalloc(length + 1);
	if (!str)
		return (NULL);
	if (n < 0)
	{
		is_neg = 1;
		n = n * -1;
	}
	while (length--)
	{
		str[length] = n % 10 + '0';
		n = n / 10;
	}
	if (is_neg == 1)
		str[0] = '-';
	return (str);
}
