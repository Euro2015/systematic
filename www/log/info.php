<?php 
$command = 'ffmpeg -version';
$path = '/tmp';

exec($command, $path, $returncode);
if ($returncode == 127)
{
	echo 'ffmpeg is NOT available';
	die();
}
else
{
	echo 'ffmpeg is available';
}
?>