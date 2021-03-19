#!/bin/bash

source config.sh

if [ -d "./template" ]; then
  rm -rf "./template"
fi

mkdir "./template"

git clone git@github.com:OnePlc/PLC_APK_WEOS.git "./template"