/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_assign_value.c                                  :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/27 15:07:52 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 15:09:04 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_assign_value(const char *s, char *s2, int i, int j)
{
	int aux;

	aux = i;
	while (i < j)
	{
		*s2 = s[i];
		s2++;
		i++;
	}
	*s2 = '\0';
	return (&*(s2 - (j - aux)));
}
