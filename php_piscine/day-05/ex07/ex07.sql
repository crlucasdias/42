SELECT title, summary FROM film WHERE film.summary LIKE "%42%" OR film.title LIKE "%42%" ORDER BY duration ASC;
