<?php

include_once('config.php');

// Check download token
function downloadvideo($token,$title,$id_video,$type,$link)
{

// Set operation params

    if($type==1)
    {
        $url  = base64_decode(filter_var($token));
        if ($url)
        {
          file_put_contents(__DIR__."/files_download/".$id_video.".mp4", fopen($url, 'r'));
            echo "download done";
        }
    }else
    {
        file_put_contents(__DIR__."/files_download/".$title.".mp4", fopen($link, 'r'));
        echo "download done";
    }
}

