#!/usr/bin/env bash
<<<<<<< HEAD
git checkout master;git merge backend;git push;ssh mupisiri@luatsu.tech 'cd /var/www/html/luatsu;git pull';git checkout backend
=======
git checkout master;
git merge backend;
git add *;
git add ./.update_server.sh
git commit -m "merging the backend branch"
git push;
ssh mupisiri@luatsu.tech 'cd /var/www/html/luatsu;git pull';
git checkout backend;
>>>>>>> backend
