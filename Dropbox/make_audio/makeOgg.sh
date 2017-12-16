#how does this work?

find (){
  _file="$1"  
[ $# -eq 0 ] && { echo "Usage: $1 filename"; return 1; }
[ ! -f "$_file" ] && { echo "$1 file not found."; return 1; }

if [ -s "$_file" ]  
then  
    echo "$_file has some data."
        return 0;
else  
    echo "$_file is empty."
         echo "--------- $1 is empty";
        return 1;
fi 
   
}

makeOgg (){
   if find ${1/ogg/mp3}
      then mpg321 $1 -w - | oggenc -q7 -o ${1/mp3/ogg} -; 
            echo "$1 ------------"
      else
         echo "xxx $1 can't find mp3 version"
   fi
}

makeMp3 (){
   wget -q -U Mozilla -O $1.mp3 "http://translate.google.com/translate_tts?ie=UTF-8&tl=de&q=$1"
}

cd ..
cd audio
for i in *.mp3;
   do 
       if  find ${i/mp3/ogg}
        then
          echo "    ${i/mp3/ogg} - found";
        else
         makeOgg $i
         if  find ${i/mp3/ogg}
         then
            echo "✓   ${i/mp3/ogg} - made";
         else
            echo " ✗ ${i/mp3/ogg} - missing "
         fi
      fi   
   done
cd ..
