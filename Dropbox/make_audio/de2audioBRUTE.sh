#!/bin/bash
# use this command to run
# ./check.sh < input.txt

# requires wget program to be install. wget is a default program for linux, but not windows
#turns list of words 'input.txt' into audio files in ../audio folder

#makes sure that the file exsist and is not empty.
doesExist (){
  _file="$1"
[ $# -eq 0 ] && { echo "Usage: $1 filename"; return 1; }
[ ! -f "$_file" ] && { echo "$1 file not found."; return 1; }

if [ -s "$_file" ]
then
    echo "$_file has some data."
        return 0;
else./
    echo "$_file is empty." # make sure the file isn't empty.
        return 1;
fi

}

#call google to make the audio file.
makeMp3 (){
   echo -n $1 > word.txt;
   word=$(echo $1 | sed -e 's/\r//g')
   echo $word

   ./espeak -f word.txt --stdout > $word.wav

}


# loop to actually do everything
cd ..
cd audio-de/
while read word;
do
  makeMp3 $word | xargs

done
