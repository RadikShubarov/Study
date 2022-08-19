#!/bin/bash
curr_numb=""
res=""
read curr_numb
while ((${curr_numb} % 2 != 0)); do
read curr_numb
done
echo "even number!"
