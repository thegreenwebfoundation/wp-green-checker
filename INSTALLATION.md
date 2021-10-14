# Getting started with 


## Setting up with a local environment

Using MAMP, or localwp, or your preferred tool, download the this repo a wordpress install. Develop as usual.

## Setting up with gitpod

If you have an account with hosted gitpod service, or self-hosted version, you set up an development environment in browser.

The notes below outline the steps taken before your workspace is ready.


## What the dockerfile does:

### Clone the gitpod wordpress repo

this also copies the `.bashrc` which contains a few bash handy functions: `wp-setup`, `wp-setup-plugin`, `wp-setup-theme`, and `browse-url`. We'll cover them in more detail below.

### Install a LTS node

### Install mailhog for previewing and checking emails

### Install Apache Webserver

### Installs PHP

It currently install php version 7.4.

### Set up PHP to work with Apache

### Install WP-CLI

## What the "wp-setup" functions do when you start the dev environment

You call `wp-setup-plugin`, or `wp-setup-theme`, the `wp-setup` does the following things:

1. creates the mysql user and database
1. downloads wordpress
1. performs a `wp-core` install with wp-cli
1. moves the gitpod workspace into the correct place in `wp-content`, so your workspace is in either the `plugins`, or the `themes` directory
1. install any npm dependencies for front end work
1. install any php dependencies defined in composer
1. execute an `.init.sh` file if it exists, to do any other arbitrary tasks.


