#!/bin/sh
# This script is executed from a crontab entry every day.

#############  DIRECTORY  ###################
#LOCAL DEVELOPMENT SERVER
#DIR=/data/www/flysocial.synapse.com.bo/trunk/htdocs/cron

#DEV SERVER
DIR=/var/www/vhosts/flysocial.com/dev/cron

#PRODUCTION SERVER
#DIR=/var/www/flysocial.com/public_html/cron

#############  wget output file ###################
FILE=mailinginfo.`date +"%Y.%m.%d"`

#############  wget log file ######################
LOGFILE=wget.log

#############  wget download url ###################
#developer local site
#URL=http://flysocial.synapse.com.bo/mailing/send

#DEV SERVER
URL=http://dev.flysocial.com/mailing/send

#PRODUCTION SERVER
#URL=http://www.flysocial.com/mailing/send

cd $DIR
wget $URL -O $FILE -o $LOGFILE
