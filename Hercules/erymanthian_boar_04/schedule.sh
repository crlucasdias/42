#!/bin/bash
SCH="8:42 AM 12/21/2019"

echo bash lucky_game.sh | at now + 1 minutes
echo bash lucy_game.sh | at $SCH

