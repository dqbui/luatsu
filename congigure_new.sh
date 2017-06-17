#!/usr/bin/env bash
#This is file is aimed at configuring a new server to suit my
# general development environment
#Created By Bazil Mupisiri on 4/13/17

adduser mupisiri #add a user called mupisiri
usermod -aG mupisiri #make mupisiri user an admin
apt-get install software-properties-common python-software-properties #install software package with the 'add-apt-repository' program
add-apt-repository ppa:ondrej/php #add the repository with the php7.1
apt-get update #update the repositories
apt-get install php7.1 #install php 7.1
apt-get install mysql-server #install mysql
service apache2 start #restart the web server
apt-get install phpmyadmin #install the database administration tool
apt-get install git #install git
mkdir /var/www/html
chown -R mupisiri:mupisiri /var/www/html #change the html directory to be owned by mupisiri
cd /var/www/html #move to the html directory
git clone https://github.com/linhpha/Lawyer-App-Reupload.git #clone the git repository
ssh-keygen #generate an ssh key which you will copy to your Github for passwordless pulling
#after setting the origin, copy the contents of the public rsa key to the server
cd clouzine/ #get into the clouzine repository
git remote set-url origin git+ssh://git@github.com/bazilm16/clouzine.git #change the url to ssh
vi /etc/apache2/sites-available/000-default.conf #the configuration file to change the webroot to clouzine
service apache2 restart #restarts the webserver to recognize the change
echo "Create the millennial21 database to contain the information"
mysql -u root -p #login to mysql and create a database
mysql -u root -p lawyers < dump.sql