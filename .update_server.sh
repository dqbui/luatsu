#!/usr/bin/env bash
<<<<<<< HEAD
git checkout master;
git merge backend;
ssh mupisiri@luatsu.tech 'cd /var/www/html/luatsu;git pull';
git checkout backend
=======
git checkout master;git merge backend;git push;ssh mupisiri@luatsu.tech 'cd /var/www/html/luatsu;git pull'
>>>>>>> backend
