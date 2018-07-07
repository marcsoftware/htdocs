#!/bin/bash
# use this command to run
# ./check.sh < input.txt

# returns 1 if the file not there or is empty
doesExist (){
    _file="$1.wav"
    [ $# -eq 0 ] && { echo "Usage: $1 filename"; return 1; }
    [ ! -f "$_file" ] && { echo "$1 file not found."; return 1; }

    if [ -s "$_file" ]
    then
        echo "$_file file has some data."
            return 1;
    else
        echo "$_file file is empty."
            return 0;
    fi

}

makeEspeak (){
  echo -n $1 > word.txt;
  word=$(echo $1 | sed -e 's/\r//g') 
  echo $word

  ./espeak -f word.txt --stdout > $word.wav
}


makeWAV (){
  PowerShell -NoProfile -ExecutionPolicy unrestricted -Command "./makeWAV.ps1 '$1'"

}

#
#cd ..
#cd audio-de
while read word;
do
  word=$(echo $word | sed -e 's/\r//g'); #delete carrriage return
  word=$(echo $word | sed -e 's/\ /./g'); #replace spaces with a dot, so we can make the filename
  if   doesExist "$word.wav"
   then
      echo "    $word  - wav already exsists";
   else
      makeWAV $word

      if  doesExist "$word.wav"
         then
            
            echo "\n  $word -made the wav"
         else
            echo "\n---------------$word - didn't work.";
      fi
   fi
done
