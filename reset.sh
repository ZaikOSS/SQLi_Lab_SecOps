#!/usr/bin/env bash
docker-compose down -v
docker-compose up -d --build
echo "Lab has been reset!"
