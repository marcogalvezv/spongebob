#!/bin/bash

if [ $# -ne 2 ]
then
    echo "Error in $0 - Invalid Argument Count"
    echo "Syntax: $0 <MM.DD.YYYY> <MYSQL_PASSWORD>"
    exit
fi

cat solicitaxi_drop_all_DEV.sql | mysql -u root -p$2 solicitaxi
cat solicitaxi_$1_DEV.sql | mysql -u root -p$2 solicitaxi
cat solicitaxi_views_DEV.sql | mysql -u root -p$2 solicitaxi
cat solicitaxi_datas_DEV.sql | mysql -u root -p$2 solicitaxi

echo "" > solicitaxi_ALLINONE.sql
cat solicitaxi_drop_all_DEV.sql >> solicitaxi_ALLINONE.sql
cat solicitaxi_$1_DEV.sql >> solicitaxi_ALLINONE.sql
cat solicitaxi_views_DEV.sql >> solicitaxi_ALLINONE.sql
cat solicitaxi_datas_DEV.sql >> solicitaxi_ALLINONE.sql
