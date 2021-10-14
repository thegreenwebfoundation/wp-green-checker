# Gitpod docker image for WordPress | https://github.com/luizbills/gitpod-wordpress
# License: MIT (c) 2020 Luiz Paulo "Bills"
# Version: 0.9
FROM gitpod/workspace-mysql

### General Settings ###
ENV PHP_VERSION="7.4"
ENV APACHE_DOCROOT="public_html"

### Setups, Node, NPM ###
# USER gitpod
# ADD https://api.wordpress.org/secret-key/1.1/salt?rnd=1659198 /dev/null
# RUN git clone https://github.com/luizbills/gitpod-wordpress $HOME/gitpod-wordpress && \
#     cat $HOME/gitpod-wordpress/conf/.bashrc.sh >> $HOME/.bashrc && \
#     . $HOME/.bashrc && \
#     bash -c ". .nvm/nvm.sh && nvm install --lts"

### MailHog ###
USER root
ARG DEBIAN_FRONTEND=noninteractive
RUN go install github.com/mailhog/MailHog@latest && \
    go get github.com/mailhog/mhsendmail@latest && \
    cp $GOPATH/bin/MailHog /usr/local/bin/mailhog && \
    cp $GOPATH/bin/mhsendmail /usr/local/bin/mhsendmail && \
    ln $GOPATH/bin/mhsendmail /usr/sbin/sendmail && \
    ln $GOPATH/bin/mhsendmail /usr/bin/mail &&\

### WP-CLI ###
USER root
ARG DEBIAN_FRONTEND=noninteractive
RUN wget -q https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -O $HOME/wp-cli.phar && \
    wget -q https://raw.githubusercontent.com/wp-cli/wp-cli/v2.3.0/utils/wp-completion.bash -O $HOME/wp-cli-completion.bash && \
    chmod +x $HOME/wp-cli.phar && \
    mv $HOME/wp-cli.phar /usr/local/bin/wp && \
    chown gitpod:gitpod /usr/local/bin/wp

USER gitpod
