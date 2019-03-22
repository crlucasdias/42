/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.h                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lbeserra <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/21 16:15:13 by lbeserra          #+#    #+#             */
/*   Updated: 2019/03/21 16:20:40 by lbeserra         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef GET_NEXT_LINE_H
# define GET_NEXT_LINE_H

# include "libft/libft.h"
# define BUFF_SIZE 4096
# define COMPARE(a,b) ((a) == (b)) ? 1 : 0

int			get_next_line (const int fd, char **line);
t_list		*get_last_file (t_list **l_files, int fd);
char		*join_and_free (char *curr, char *data, int aux);
int			ft_swap_until (char **feedback_line, char *curr, char c);
int			refresh_static_value (char **line, t_list **l_files);

#endif
