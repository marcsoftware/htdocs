<?php
$contents = file_get_contents('testing.sh');
echo shell_exec($contents);
?>