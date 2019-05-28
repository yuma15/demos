<?php

setcookie ("downloaded","yes",0,"/");

rename("samplefile1.txt", "moved/samplefile1.txt");

$file = 'moved/samplefile1.txt';
$download_filename = 'samplefile1.txt';
$mime_name=mime_content_type($file);
$file_length=filesize($file);
header("Content-Disposition: attachment; filename=$download_filename");
header("Content-Length:$file_length");
header("Content-Type:$mime_name");
readfile($file);

?>
