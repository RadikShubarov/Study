#!/bin/bash
while true
do
echo "enter your name:"
read name
if [[ -z $name ]]
then
echo "bye"
break
fi
echo "enter your age:"
read age
if [[ $age -eq 0 ]]
then
echo "bye"
break
fi
if [[ $age -lt 17 ]]
then group="child"
elif [[ ( $age -ge 17 ) && ( $age -le 25 ) ]]
then
group="youth"
elif [[ $age -gt 25 ]]
then
group="adult"
fi
echo "$name, your group is $group"
done