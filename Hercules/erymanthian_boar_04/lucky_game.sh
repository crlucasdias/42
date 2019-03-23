#!/bin/bash

FT=42
NR=$(( RANDOM % 100 + 1))
COUNT=0

echo "### Lucky game ###" 
echo "\nRolling the dice until u get $FT between 1~100..\n"

for (( ; ; ))
do	
	if [ "$NR" -eq "$FT" ]
	then		
			echo Congrats! "### $NR ###"
			break
	else
			COUNT=$(($COUNT + 1))	
			echo Not yet. Number = $NR ..   Trying again! 
	fi
	NR=$(( RANDOM % 100 + 1))
done

echo You tried $COUNT times.. can u be faster?

echo $(date) >> logs.txt
