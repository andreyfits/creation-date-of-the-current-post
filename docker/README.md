Docker and WordPress
====================
You can use Docker Compose to easily run Wordpress in an isolated environment built with Docker containers.
This guide demonstrates how to use Compose to set up and run the project.
Before starting, make sure you have [Docker](https://docs.docker.com/get-docker/) and [Docker Compose installed](https://docs.docker.com/compose/install/).

Installation
============
Clone the repository to your local machine. Rename `.env.example` with `.env`. Add the dump file into the `docker/mysql/dump` and upload all images into the `wp-content/uploads`.

Important
---------
You should check the current USER ID on your local machine:

```bash
$ echo ${UID}
```

Output example:
```bash
$ 1000
```
Next step you should insert this USER ID into `.env` file:

```dotenv
USER_ID=1000
```

Run the project
---------------
The start images and containers using:

```bash
$ docker-compose up -d
```

**Note:** if you need rebuild all containers use the special param `--build`:
```bash
$ docker-compose up -d --build
```

Changing the site URL
---------------------
```bash 
$ docker-compose run --rm wordpress wp search-replace 'old-site-url' 'http://site.localhost:8000' --skip-columns=guid
```
More detail is [here](https://wordpress.org/support/article/changing-the-site-url).

Bring up WordPress in a web browser
-----------------------------------
At this point, WordPress should be running on port 8000 of your [site.localhost:8000](http://site.localhost:8000).

Stop the project
----------------
The stop all containers using:

```bash
$ docker-compose stop
```

Shutdown and cleanup
--------------------
The command `docker-compose down` removes the containers and default network, but preserves your WordPress database.
Remove database data:

```bash
$ sudo rm -rf ./docker/mysql/data
```

**Note:** if you want remove all container, run command bellow:

```bash
$ docker system prune --all
```

Xdebug
------
One of the most useful tools in software development is a proper debugger.
It allows you to trace the execution of your code and monitor the contents of the stack.
Xdebug, PHP’s debugger, can be utilized by various IDEs to provide Breakpoints and stack inspection.

if you are using the JetBrain's PhpStorm, the xdebug has already completed for using.
See full documentation [here](https://xdebug.org/docs/).

WP-CLI
======

You can update WP-CLI with:

```bash
$ docker-compose run --rm wordpress wp cli update --allow-root
```

Using
-----
WP-CLI provides a command-line interface for many actions you might perform in the WordPress admin. This command below
lets you install and activate a WordPress plugin.

```bash
$ docker-compose run wordpress wp plugin install user-switching --activate --allow-root
```
See the [documentation](https://wp-cli.org/)

Docker Logs
===========
The `docker logs` command batch-retrieves logs present at the time of execution.
However first you should the check which containers are running:

```bash
$ docker ps
```
The output will be something like this:
```bash
CONTAINER ID   IMAGE                          COMMAND                  CREATED      STATUS        PORTS                                                  NAMES
4a86cf1ab8f1   traefik:latest                 "/entrypoint.sh --ap…"   5 days ago   Up 26 hours   0.0.0.0:8091->80/tcp, :::8091->80/tcp                  current-date-traefik
9125a091e11d   nginx:1.23.0-alpine            "/docker-entrypoint.…"   5 days ago   Up 26 hours   80/tcp                                                 current-date-nginx
e0d5d170497f   phpmyadmin/phpmyadmin:latest   "/docker-entrypoint.…"   5 days ago   Up 26 hours   0.0.0.0:8092->80/tcp, :::8092->80/tcp                  current-date-phpmyadmin
11c9ffaa066a   mysql:latest                   "docker-entrypoint.s…"   5 days ago   Up 26 hours   33060/tcp, 0.0.0.0:3361->3306/tcp, :::3361->3306/tcp   current-date-mysql
a2249ffa45c2   wordpress:latest               "docker-entrypoint.s…"   5 days ago   Up 26 hours   9000/tcp                                               current-date-wordpress
```
Then you can check logs the command below:

```bash
$ docker logs -f a2249ffa45c2 #CONTAINER ID
```