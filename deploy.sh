#!/bin/bash
# hospital-project 배포 스크립트
# 주의: app/Config/Database.php 및 .env 는 서버에 크레덴셜이 있으므로 배포 제외

SERVER="root@203.245.28.201"
REMOTE_PATH="/var/www/hospitalhub.co.kr/public_html/"
LOCAL_PATH="$(dirname "$0")/"

sshpass -p 'Alcls1475' rsync -avz --progress \
  --exclude-from="$(dirname "$0")/.deployignore" \
  -e "ssh -o StrictHostKeyChecking=no" \
  "$LOCAL_PATH" "$SERVER:$REMOTE_PATH"
