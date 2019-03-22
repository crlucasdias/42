/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/19 22:12:11 by lbeserra          #+#    #+#             */
/*   Updated: 2019/03/21 00:35:34 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"

int			refresh_static_value(char **line, t_list **l_curr)
{
	int				size_line;
	int				size_curr;
	int				i;
	char			*cpy;

	size_line = ft_strlen(*line);
	size_curr = ft_strlen((*l_curr)->content);
	i = 0;
	cpy = ft_strnew(size_curr);
	cpy = ft_strcpy(cpy, (*l_curr)->content);
	if ((*l_curr)->content)
		free((*l_curr)->content);
	size_line += 1;
	(*l_curr)->content = ft_strnew(size_curr - size_line);
	(*l_curr)->content = ft_assign_value(cpy, (*l_curr)->content,
			size_line, size_curr);
	free(cpy);
	return (i);
}

int			ft_swap_until(char **feedback_line, char *curr, char c)
{
	int				i;
	int				aux;

	i = 0;
	aux = 0;
	if (!curr)
		return (0);
	while (curr[i])
	{
		if (curr[i] == c)
		{
			aux = 1;
			break ;
		}
		i++;
	}
	*(feedback_line) = ft_strnew(i);
	*(feedback_line) = ft_assign_value(curr, *feedback_line, 0, i);
	return (aux);
}

char		*join_and_free(char *curr, char *data, int aux)
{
	char *helper;

	data[aux] = '\0';
	helper = curr;
	curr = ft_strjoin(curr, data);
	if (helper)
	{
		free(helper);
		helper = NULL;
	}
	return (curr);
}

t_list		*get_last_file(t_list **l_files, int fd)
{
	t_list			*aux;

	aux = *l_files;
	while (1)
	{
		if (!aux)
		{
			aux = ft_lstnew("\0", fd);
			ft_lstadd(l_files, aux);
		}
		if (aux->content_size == (size_t)fd)
			break ;
		aux = aux->next;
	}
	return (aux);
}

int			get_next_line(const int fd, char **line)
{
	char			data[BUFF_SIZE + 1];
	static	t_list	*l_files;
	int				aux;
	t_list			*l_curr;

	if ((fd < 0) || !line || (read(fd, data, 0) == -1))
		return (-1);
	l_curr = get_last_file(&l_files, fd);
	while ((aux = read(fd, data, BUFF_SIZE)) > 0)
	{
		l_curr->content = join_and_free(l_curr->content, data, aux);
		if (ft_strchr(data, '\n'))
			break ;
	}
	if (ft_swap_until(line, l_curr->content, '\n') == 1)
	{
		refresh_static_value(line, &l_curr);
		return (1);
	}
	else if (l_curr->content != NULL && ft_strlen(l_curr->content) > 0)
	{
		ft_memdel(&l_curr->content);
		return (1);
	}
	return (0);
}
