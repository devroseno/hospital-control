#!/bin/bash
echo "Updating SSL Certificates for nginx"
echo "Copying SSL from Azure"
cp /var/ssl/private/*.p12 /etc/nginx/ssl/ssl.p12

echo "Converrting SSL from .pem"
openssl pkcs12 -in /etc/nginx/ssl/ssl.p12 -out /etc/nginx/ssl/ssl.crt.pem -clcerts -nokeys -passin pass:
openssl pkcs12 -in /etc/nginx/ssl/ssl.p12 -out /etc/nginx/ssl/ssl.key.pem -clcerts -nodes -passin pass:
chmod 777 -R /etc/nginx/ssl
