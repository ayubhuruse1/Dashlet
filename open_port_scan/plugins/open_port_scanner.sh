#!/bin/bash

if [ -z "$1" ]; then
    echo "UNKNOWN: No IP address provided."
    exit 3
fi

HOST=$1
OPEN_PORTS=$(nc -zv $HOST 1-65535 2>&1 | grep 'succeeded' | awk '{print $4}')

if [ -z "$OPEN_PORTS" ]; then
    echo "No open ports detected on $HOST"
    exit 0  # OK state in Nagios
else
    for PORT in $OPEN_PORTS; do
        echo "CRITICAL: Port $PORT is open on $HOST"
    done
    exit 2  # CRITICAL state in Nagios
fi
