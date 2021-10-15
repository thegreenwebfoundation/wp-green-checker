#!/bin/bash


function init() {
    # this function is called as part of the gitpod pre-build step
    # it download an install of wordpress, fetches a sample config file
    # to use in development, as well as a corresponding wp-cli file
    # it also creates a symlink so the the plugin you are working on 'appears'
    # to be in the correct wp-content plugin directory

    mkdir -p /workspace/wordpress/
    wp core download --path=/workspace/wordpress/
    wget -q https://raw.githubusercontent.com/thegreenwebfoundation/gitpod-wordpress/main/conf/wp-config.php -O /workspace/wordpress/wp-config.php
    wget -q https://raw.githubusercontent.com/thegreenwebfoundation/gitpod-wordpress/main/conf/wp-cli.yml -O wp-cli.yml
    ln -s /workspace/wp-green-checker /workspace/wordpress/wp-content/plugins/wp-green-checker
    
}

function command() {
    # this function as part of the spinning up process for working 
    # on the plugin.
    # We:
    # 1. create a sample database  and set it up with simple defaults
    # 2. activate this plugin in the database
    # 3. set up the corresponding pages and url structure to see the plugin working
    

    mysqladmin create wordpress
    wp core install  \
        --url="$(gp url 8080 | sed -e s/https:\\/\\/// | sed -e s/\\///)" \
        --title="WordPress"  \
        --admin_user="admin"  \
        --admin_password="password"  \
        --admin_email="admin@gitpod.test"  \
        --path="/workspace/wordpress/" \

        wp plugin activate wp-green-checker
        wp rewrite structure '/%year%/%monthnum%/%postname%'
        wp post create --post_type=page --post_title=green-web-check --post_status=public
        wp post create --post_type=page --post_title=directory --post_status=public
}

function help()  {
    echo "USAGE: run this script with the following arguments"
    echo ""
    echo "init      - run the gitpod pre-build/init steps"
    echo "command   - run the gitpod startup/command steps"
    echo ""
}


# check if we have our argument
INVOCATION=${1:-help}

# and now try calling the corresponding function
$INVOCATION


