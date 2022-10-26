#!/bin/bash

if [ $# -eq 3 ]

then

targetstr=$1

newstr=$2

catalog=$3

findcatalog=$(find ./ -type d -name  $catalog 2>/dev/null)

if [ $findcatalog ]

then

for file in $catalog/*

do

sed -i "s/$targetstr/$newstr/" $file

done

else

echo 'Could not find catalog'

fi

else

echo 'Please, write correct args!'

fi

