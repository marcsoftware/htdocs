# de2audio.sh sometime makes empty files.
# this file makes a list of those empty files to resend to google fomr de2audio.sh

cd ..
cd audio
find $dir -size 0 -print > zero.txt

mv zero.txt ..
cd ..
mv zero.txt manager
cd manager
sed -i 's/\.\///g' zero.txt
sed -i 's/\.mp3//g' zero.txt
sed -i 's/\.ogg//g' zero.txt
