/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_lstmap.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/27 15:19:14 by lbeserra          #+#    #+#             */
/*   Updated: 2019/02/27 17:33:13 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

t_list	*ft_lstmap(t_list *lst, t_list *(*f)(t_list *elem))
{
	t_list *tmp;

	if (!lst)
		return (NULL);
	tmp = f(lst);
	if (tmp)
	{
		if (lst->next)
			tmp->next = ft_lstmap(lst->next, f);
		return (tmp);
	}
	free(lst);
	return (NULL);
}
