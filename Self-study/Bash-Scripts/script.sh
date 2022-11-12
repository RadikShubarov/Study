#!/bin/bash
if [ $# == 1 ] #check argurments amount
then
json_objects=$(curl -s "$1") #parse json, currently I could do it with jq, but needs dependency
IFS=$'{' # overdrive separator 
counter=0 # counter for two json objects
for object in $json_objects 
do
title=$(echo $object | grep 'title')
titles="$titles $title"
counter=$[ $counter + 1 ]
if [ $counter -eq 3 ]
then
break
fi
done
unset IFS
clean_words=$(echo $titles | sed -e 's/"title"://g' -e 's/"//g' -e 's/,//g') # save only keys from title
echo $clean_words | tr " " "\n" | sort #result
else
echo 'Wrong number of arguments!'
fi
