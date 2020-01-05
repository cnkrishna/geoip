#FROM docker-registry.zuludesk.com/docker/httpclient:master
FROM ubuntu
RUN sudo apt-get install wget
# Download the database and unpack it
RUN wget -O /root/GeoLite2-City.mmdb.gz http://geolite.maxmind.com/download/geoip/database/GeoLite2-City.mmdb.gz && gunzip /root/GeoLite2-City.mmdb.gz
