#1 -> lucas (usr) and localhost(ip)
#2 -> ssh-keygen -t rsa //generate rsa key
#3 -> cpy key to vm
#4 -> create dir && git_init
#port -> vm -> settings -> port forwading. Default 2500

if [ "$#" -ne 2 ]; then
	echo "usage: $0 SSH_USERNAME SSH_IP"
	exit
fi

SSH_USR=$1
SSH_IP=$2

echo "~~~ Generating RSA key ~~~"
ssh-keygen -t rsa

echo "~~~ Copy key ~~~"
ssh-copy-id $SSH_USR@$SSH_IP -p 2500

echo "~~~ Connect and do the bonus part ~~~"
ssh $SSH_USR@$SSH_IP -p 2500 git init bonus_hercules
