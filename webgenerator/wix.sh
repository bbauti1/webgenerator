#!/bin/bash	
mkdir $1
cd $1
directorio_principal=$(pwd)
echo "" | cat > index.php
mkdir css
cd css
mkdir user
cd user
cat /dev/null > estilo.css
cd .. 
mkdir admin
cd admin
cat /dev/null > estilo.css
cd "$directorio_principal"
mkdir img
cd img
mkdir avatars
mkdir buttons
mkdir products 
mkdir pets
cd "$directorio_principal"
mkdir js
cd js 
mkdir validations
mkdir effects
cd effects
cat /dev/null > panels.js
cd ..
cd validations 
cat /dev/null > login.js
cat /dev/null > register.js 
cd "$directorio_principal"
mkdir tpl
mkdir php
cd tpl
cat /dev/null > main.tpl
cat /dev/null > login.tpl
cat /dev/null > register.tpl
cat /dev/null > profile.tpl
cat /dev/null > crud.tpl
cd .. 
cd php 
cat /dev/null > create.php
cat /dev/null > read.php 
cat /dev/null > update.php
cat /dev/null > delete.php 
cat /dev/null > dbconnect.php