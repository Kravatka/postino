FROM nginx:latest

COPY postino.loc /etc/nginx/conf.d/default.conf

ENV TZ=Europe/Kiev
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
