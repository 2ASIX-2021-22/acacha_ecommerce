#!/usr/bin/env sh

git checkout production
git merge main --no-edit
git push origin production
git checkout main

# Copiat de https://forge.laravel.com/servers/512103/sites/1487951#/application
wget https://forge.laravel.com/servers/512103/sites/1492979/deploy/http?token=2ZnE93lCtwL7DpqJNwsftKHzPcVLzb2k848SxkSM -O /dev/null
