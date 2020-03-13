SELECT SUBSTR(REVERSE(phone_number),1,CHAR_LENGTH(phone_number) -1) as "rebmunenohp" FROM distrib WHERE phone_number LIKE "05%";
