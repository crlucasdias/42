SELECT film.title as "Title", film.summary as "Summary", film.prod_year FROM film INNER JOIN genre USING(id_genre) WHERE genre.name = "erotic" ORDER BY prod_year DESC;
