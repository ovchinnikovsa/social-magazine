# Simple E-commerce Website

This repository contains a basic demo e-commerce website built with simplicity and ease of use in mind.

###  Requirements:
* linux or win, under wsl
* installed docker
* installed make app

### Steps to build

Run make instructions:

1. `make pbuild`
2. `make build`
3. `make run`
4. `make pchown`
5. `make db_restore`

To stop - `make stop`

> Also u can change db access in /docker/conf/db.ini file. And conf.ini from /src with salt.