#!/bin/bash

WIZARD_DIR="/usr/local/nagiosxi/html/includes/configwizards/open_port_scan"

mkdir -p $WIZARD_DIR
cp -r * $WIZARD_DIR/

echo "Open Port Scan Wizard installed successfully."
