<?php
/**
 * Created by PhpStorm.
 * User: vanhung
 * Date: 6/7/15
 * Time: 10:52 PM
 */

include_once "Dailymotion.php";
include_once "PDOImplement.php";
header('Content-Type: text/html; charset=UTF-8');
set_time_limit(0);

//require_once 'sdk/Dailymotion.php';
try{

    $apiKey = '0c201474be2087aa73fa';
    $apiSecret = '1a461e78a3747381ab735fca88421bd70380084e';
    $testUser = 'vanhungbkcbg1@gmail.com';
    $testPassword = '@.com.vn';
    $api = new Dailymotion();
    $pdo=new PDOImplement();
    $result=$pdo->ExecuteQuery("select type,tag, youtube_id,title,description,catagory,id from youtube");

    foreach($result as $item=>$value)
    {
    $youtube_id=$value["youtube_id"];
    $id=$value["id"];
    $type=$value["type"];
    $title=$value["title"];
    $tag=explode(" ",$value["tag"]);

    $title=$value["title"];
    $description=$value["description"];

    $catagory=$value["catagory"];
    if($type==1)
    {
        $videoFile=__DIR__."/files_download/".$youtube_id.".mp4";
    }else
    {
        $videoFile=__DIR__."/files_download/".$title.".mp4";
    }
    $api->setGrantType(Dailymotion::GRANT_TYPE_AUTHORIZATION, $apiKey, $apiSecret, 
                       array('manage_videos', 'write','delete'),
                       array('username' => $testUser, 'password' => $testPassword));
    $url = $api->uploadFile($videoFile);

    $result = $api->call('video.create', array('url'     => $url, 
                                               'title'   => $title ,
                                               'tag'     => $tag, 
                                               'channel' => $catagory , 
                                               'published' => true,
                                               'description'=>$description
                                               )
                        );
    $videourl = 'http://www.dailymotion.com/video/'.$result['id'];
    if($result)
    {
         if($type==1)
         {
         unlink(__DIR__."/files_download/".$youtube_id.".mp4");
         }else
         {
             unlink(__DIR__."/files_download/".$title.".mp4");
         }
        $pdo->ExecuteQuery("update youtube set upload=1 where youtube.id=$id;");
        echo "Upload success ";

    }


    }
}catch(Exception $e)
{

}
?>
