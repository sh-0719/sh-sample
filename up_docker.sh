#!/bin/sh

cd `dirname $0`/laradock
docker-compose up -d workspace nginx mysql