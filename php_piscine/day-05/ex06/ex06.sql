SELECT title, summary FROM film WHERE LOWER(film.summary)  LIKE LOWER("%vincent%") ORDER BY id_film ASC;
