/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strtrim.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/19 15:23:11 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 22:01:31 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strtrim(char const *s)
{
	char	*s2;
	int		i;
	int		j;
	int		aux;

	if (!s)
		return (NULL);
	i = -1;
	aux = ft_strlen(s);
	j = aux;
	while (s[++i] == ' ' || s[i] == '\t' || s[i] == '\n')
		aux--;
	while (s[--j] == ' ' || s[j] == '\t' || s[j] == '\n')
		aux--;
	if (aux < 0)
		aux = 0;
	s2 = ft_memalloc(aux + 1);
	if (!s2)
		return (NULL);
	if (j == -1)
		return (s2);
	s2 = ft_assign_value(s, s2, i, j + 1);
	return (s2);
}
