# Shimmie Repo for Mitty :3

this includes the needed configurations and themes to start a customized shimmie installation for Mitty which contains:

- a preconfigured set of features
- preconfigured moderator role, with some modifications to normal users
- a custom "Mitty" theme
- custom "LuckyCharm" counters

The goal of this repo is to make it as easy as possible to setup.

## Getting Started

### Prerequisites

Make sure you have [git](https://git-scm.com/) and a relatively up-to-date version of [Docker](https://www.docker.com/products/docker-desktop/) installed (needs [docker-compose](https://docs.docker.com/compose/install/))


### Setup
To clone this repository, execute `git clone https://github.com/iSneeze/shimmitty` in your terminal of choice

First you probably want to edit the `caddy/Caddyfile`, change the domain to match yours.

After that, change into the newly downloaded folder by using `cd shimmitty` and execute `docker-compose up` from your terminal of choice to start shimmie with caddy. in this mode you will get logs in the terminal and see if something is failing. (to exit, press Ctrl + C)

By exiting the Stack will still be running so if you want to shut it down, use `docker-compose down`

You can start it without attaching yourself to the process by using `docker-compose up -d`

if you dont own a domain, feel free to edit the docker-compose file to include a port mapping, like this:

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

Happy testing!