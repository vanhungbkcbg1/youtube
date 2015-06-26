<?php
include_once "PDOImplement.php";
$pdo=new PDOImplement();
$result=$pdo->ExecuteQuery("select link_channel,catagory from channel");
if(!is_null($result))
{
    foreach($result as $key=>$value)
    {
       $channel_link=$value["link_channel"];
       $catagory=$value["catagory"];
       process_channel($channel_link,$catagory,$pdo);
    }
}
function process_channel($channel_link,$catagory,$pdo)
{
    $url = $channel_link;


    $html = file_get_contents($url);
//var_dump($html);
    $doc = new DOMDocument();
    $doc->loadHTML($html);

    $xpath = new DOMXpath($doc);

    $links = $xpath->query('//a[starts-with(@href, "/watch")]');

    $entries = [];

    if (!is_null($links)) {
        foreach ($links as $link) {
            $href = $link->getAttribute('href');
            $title = $link->getAttribute('title');
            if ($title === '')
                $title = trim($link->nodeValue);

            if (!isset($entries[$href]) || strlen($entries[$href]) < strlen($title))
                $entries[$href] = $title;
        }
    }

    $row=0;
//get three row newest of channel and save to database for download and upload
    foreach($entries as $key=>$value)
    {
        if($row==3)
        {
            break;
        }
        $tag=$title=$des= utf8_decode($value);
        $length=strlen($key);
        $position=strpos($key,'=');
        $youtube_id=substr($key,$position+1,$length-$position-1);
        $chanel=$catagory;
        $type=1;
        $link_video="";
        $query_check_exists="select 1 from youtube where youtube_id='$youtube_id'";
        $record=$pdo->ExecuteQuery($query_check_exists);
        if(!is_null($record)&&count($record)==0)
        {
            $query="insert into youtube(youtube_id,title,description,catagory,type,link,tag)values('$youtube_id','$title','$des','$chanel',$type,'$link_video','$tag')";
            $pdo->ExecuteQuery($query);
        }
        $row+=1;
    }
}
