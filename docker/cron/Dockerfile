FROM php:8.3.6-cli

RUN apt-get update && apt-get install -y cron
RUN docker-php-ext-install pdo_mysql

COPY ./docker/cron/script.sh /usr/local/bin/script.sh
COPY ./docker/cron/crontab /etc/cron.d/crontab

RUN chmod +x /usr/local/bin/script.sh
RUN chmod 0644 /etc/cron.d/crontab
RUN crontab /etc/cron.d/crontab

CMD ["cron", "-f"]