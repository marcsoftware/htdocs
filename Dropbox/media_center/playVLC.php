<?php
//$dir = "/var/www/html/Dropbox/pure_code/material";
$path = $_GET["path"];

exec("C:\Program^ Files^ ^(x86)\VideoLAN\VLC\VLC.exe --fullscreen $path --no-qt-error-dialogs");
echo "C:\Program^ Files^ ^(x86)\VideoLAN\VLC\VLC.exe --fullscreen $path --no-qt-error-dialogs";


?>