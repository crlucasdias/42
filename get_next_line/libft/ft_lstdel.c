/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_lstdel.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/27 15:20:00 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 15:36:15 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

void	ft_lstdel(t_list **alst, void (*del)(void *, size_t))
{
	t_list *aux;

	while (*alst)
	{
		aux = (*alst)->next;
		del((*alst)->content, (*alst)->content_size);
		free(*alst);
		*alst = aux;
	}
	*alst = NULL;
}
