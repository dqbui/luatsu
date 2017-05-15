#!/usr/bin/env bash
git checkpout master;git merge backend;git push;ssh mupisiri@luatsu.tech 'cd /var/www/html/luatsu;git pull'