SELECT COUNT(id_sub) as "nb_susc", FLOOR(SUM(PRICE) / COUNT(id_sub)) as "av_susc", SUM(duration_sub) % 42 as "ft" FROM subscription;
