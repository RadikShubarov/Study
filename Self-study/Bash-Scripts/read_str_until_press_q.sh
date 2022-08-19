#!/bin/bash
curr_str=""
res=""
while [ "${curr_str}" != "q" ]; do
res="${res}${curr_str}"
read curr_str
done
echo "${res}"
  
