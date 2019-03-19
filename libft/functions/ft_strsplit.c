/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strsplit.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/19 15:27:33 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 22:37:20 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

static	char	*assign_value(const char *s1, int i, int j)
{
	int		aux;
	char	*s2;

	aux = 0;
	s2 = ft_memalloc(i - j + 1);
	if (!s2)
		return (NULL);
	while (j < i)
	{
		s2[aux] = s1[j];
		aux++;
		j++;
	}
	return (s2);
}

static	int		get_total_len(char const *s, char c)
{
	int i;
	int total;

	i = 0;
	total = 1;
	while (s[i])
	{
		while (s[i] == c)
			i++;
		if (s[i] == '\0')
			break ;
		if (s[i + 1] == c || s[i + 1] == '\0')
			total++;
		i++;
	}
	return (total);
}

char			**ft_strsplit(char const *s, char c)
{
	char	**s2;
	int		i;
	int		j;
	int		k;

	i = 0;
	k = 0;
	if ((!s || !c) ||
			!(s2 = (char **)malloc(get_total_len(s, c) * sizeof(char*))))
		return (NULL);
	while (s[i])
	{
		j = i;
		while (s[j] == c)
			j++;
		i = j;
		while (s[i] != c && s[i] != '\0')
			i++;
		if (s[i] == '\0' && s[i - 1] == c)
			break ;
		s2[k++] = assign_value(s, i, j);
	}
	s2[k] = NULL;
	return (s2);
}
