<?php
/**
 * Created by PhpStorm.
 * User: vanhung
 * Date: 6/20/15
 * Time: 5:08 PM
 */

$youtubeID="";
if(array_key_exists("YoutubeID",$_POST))
{
   $youtubeID=$_POST["YoutubeID"];
}

if(empty($youtubeID))
{
    die("You must enter Youtube ID");
}
?>
