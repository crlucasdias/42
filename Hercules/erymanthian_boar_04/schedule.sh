#!/bin/bash
SCH="8:42 AM 12/21/2019"

at -f lucky_game.sh + 2 minutes ##testing program..
at -f lucky_game.sh $SCH

