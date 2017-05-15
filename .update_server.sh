#!/usr/bin/env bash
git checkout master;
git merge backend;
ssh mupisiri@luatsu.tech 'cd /var/www/html/luatsu;git pull';
git checkout backend