/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strnequ.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/19 15:11:37 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 15:13:15 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

int	ft_strnequ(char const *s1, char const *s2, size_t n)
{
	size_t i;

	i = 0;
	if (s1 && s2 && n)
	{
		while (i < n)
		{
			if (*s1 != *s2)
				return (0);
			s1++;
			s2++;
			i++;
		}
		return (1);
	}
	if (!n)
		return (1);
	return ((!s1 && !s2) ? 1 : 0);
}
