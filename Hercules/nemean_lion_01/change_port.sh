#!/bin/bash
sudo apt-get install openssh-client
sudo apt-get install openssh-server
find /etc/ssh/ -name 'ssh_config' -exec sed -i -e 's/Port 22/Port 31415/g' {} \;
sudo service ssh restart
