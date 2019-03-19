/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strjoin.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/19 15:19:08 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 22:03:10 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strjoin(char const *s1, char const *s2)
{
	int		len_aux;
	int		len_aux2;
	int		i;
	int		aux;
	char	*str;

	if (!s1 || !s2)
		return (NULL);
	len_aux = ft_strlen(s1);
	len_aux2 = ft_strlen(s2);
	str = (char*)malloc((len_aux + len_aux2) * sizeof(char) + 1);
	i = 0;
	if (!str)
		return (NULL);
	aux = len_aux + len_aux2;
	while (s1[i] || s2[i])
	{
		if (i < len_aux)
			str[i] = s1[i];
		if (i < len_aux2)
			str[len_aux + i] = s2[i];
		i++;
	}
	str[len_aux + len_aux2] = '\0';
	return (str);
}
