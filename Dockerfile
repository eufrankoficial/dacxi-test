FROM php:8.0.1-apache-buster
RUN docker-php-ext-install pdo pdo_mysql bcmath opcache

RUN apt-get update -y               \
    && apt-get install -y           \
    composer \
    bash-completion                 \
    build-essential                 \
    bzip2                           \
    ca-certificates                 \
    curl                            \
    git                             \
    gzip                            \
    htop                            \
    imagemagick                     \
    iputils-ping                    \
    libfontconfig1                  \
    libjpeg-dev                     \
    libpng-dev                      \
    libpq-dev                       \
    locales                         \
    nano                            \
    netcat                          \
    openconnect                     \
    software-properties-common      \
    rsync                           \
    sudo                            \
    ssh                             \
    tig                             \
    unzip                           \
    vim                             \
    wget                            \
    xz-utils                        \
    zip                             \
    --no-install-recommends         \
    && apt-get clean                \
    && rm -rf /var/lib/apt/lists/*  \
    && rm -rf /tmp/*                \
    && rm -rf /var/tmp/*


ARG APP_NAME=laravel
ARG GROUP_ID=1000
ARG USER_ID=1000


# Configure environment.
# ----------------------

ENV APP_NAME=${APP_NAME}
ENV GROUP_ID=${GROUP_ID}
ENV GROUP_NAME=${APP_NAME} USER_ID=${USER_ID} USER_NAME=${APP_NAME}

COPY ./entrypoint.sh /etc/entrypoint.sh
RUN sudo chmod +x /etc/entrypoint.sh
CMD ["/bin/bash"]
ENTRYPOINT ["/etc/entrypoint.sh"]
