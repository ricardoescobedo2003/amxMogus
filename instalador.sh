#!/bin/bash
sudo apt update 
sudo apt install mysql-server -y
sudo apt install apache2 -y
sudo apt install git -y
sudo apt-get install php mysql-server php-mysql -y
sudo chown -R escobedo:escobedo /var/www/html 
sudo chmod 755 -R /var/www/html
sudo apt install figlet toilet -y
figlet WELCOME DOBLENET