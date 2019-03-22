/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_atoi.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/15 14:12:58 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/28 00:32:15 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

static int	ft_checklimit(unsigned long long nb)
{
	if (nb > 9223372036854775807)
		return (-1);
	return (1);
}

int			ft_atoi(const char *str)
{
	int					neg;
	unsigned long long	number;

	neg = 1;
	number = 0;
	while (*str == '\n' || *str == '\f' || *str == '\r' ||
			*str == '\v' || *str == '\t' || *str == '\0' || *str == ' ')
		str++;
	if (*str == '-')
		neg = -1;
	if (*str == '+' || *str == '-')
		++str;
	while (*str >= '0' && *str <= '9' && number <= 9223372036854775807)
	{
		number = number * 10 + *str - '0';
		str++;
	}
	if (ft_checklimit(number) == 1)
		return (number * neg);
	return (-1);
}
