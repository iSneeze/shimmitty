# Shimmie Repo for Mitty :3

this includes the needed configurations and themes to start a customized shimmie installation for Mitty which contains:

- a preconfigured set of features
- preconfigured moderator role, with some modifications to normal users
- a custom "Mitty" theme
- custom "LuckyCharm" counters

The goal of this repo is to make it as easy as possible to setup.

## Overall project status 

- [x] Did an overview of the possible installations and chose a booru (Shimmie)
- [x] Configured the Booru to include moderation tools and sane defaults
- [ ] Add a custom theme for Mitty's color scheme (might need refinement for now)
- [x] Add custom counters and maybe a logo for the site
- [x] Put the booru behind a webserver (Caddy) so its reachable from a domain
- [x] Add Redis for caching, increasing performance
- [x] Choose a server host to deploy the booru to
- [ ] Test the finished config on the server host
- [ ] Write a set of instructions for Mitty to be able set up the booru by herself (Needs a domain, a server host, and once you have access to the server, the required steps to perform so it's running the booru)

## Getting Started

### Prerequisites

Make sure you have [git](https://git-scm.com/) and a relatively up-to-date version of [Docker](https://www.docker.com/products/docker-desktop/) installed (needs [docker-compose](https://docs.docker.com/compose/install/))


### Setup
To clone this repository, execute `git clone https://github.com/iSneeze/shimmitty` in your terminal of choice

First, copy shimmitty.env.example to shimmity.env and change the domain to match yours, for production use just the domain name. E.g. `example.com` or if using a subdomain e.g. `megaawesomebooru.mittydot.com`. For local testing, you can instead use "http://127.0.0.1".

After that, change into the newly downloaded folder by using `cd shimmitty` and execute `docker-compose up` from your terminal of choice to start shimmie with caddy. in this mode you will get logs in the terminal and see if something is failing. (to exit, press Ctrl + C)

By exiting the Stack will still be running so if you want to shut it down, use `docker-compose down`

You can start it without attaching yourself to the process by using `docker-compose up -d`

if you dont own a domain, feel free to edit the `compose.yaml` file to include a port mapping, like this:

```yaml
...

shimmie:
    image: shish2k/shimmie2:latest
    volumes:
      - ./data:/app/data
      - ./themes/mitty:/app/themes/Mitty
      - ./themes/mitty/counters:/app/ext/home/counters/LuckyCharms
    # the next two lines map host port 8000 to container port 8000
    # you will be able to connect to it with http://localhost:8000
    ports:
      - 8000:8000
    networks:
      - caddy

...
```

Our modifications to Shimmie's default config are stored in data/config/custom.conf.php and automatically mounted into the Docker container.
To ensure they are actually loaded, add the following line to data/config/shimmie.conf.php
```php
@include_once "data/config/custom.conf.php";
```

Happy testing!


## Special Thanks to the contributors and Luckycharms that helped with testing and ideas!

- Neon
- Xiazee
- WCTB
- ArchiveAnon
- Matze
- MiiMoo

- shish2k for creating shimmie: https://github.com/shish/shimmie2

👏👏👏👏👏
