<?php
// YouTube Downloader PHP
// based on youtube-dl in Python http://rg3.github.com/youtube-dl/
// by Ricardo Garcia Gonzalez and others (details at url above)
//
// Takes a VideoID and outputs a list of formats in which the video can be
// downloaded

include_once('config.php');
include_once "PDOImplement.php";
include_once "download.php";
ob_start();// if not, some servers will show this php warning: header is already set in line 46...

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'); 
    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . '' . $units[$pow]; 
} 
function is_chrome(){
	$agent=$_SERVER['HTTP_USER_AGENT'];
	if( preg_match("/like\sGecko\)\sChrome\//", $agent) ){	// if user agent is google chrome
		if(!strstr($agent, 'Iron')) // but not Iron
			return true;
	}
	return false;	// if isn't chrome return false
}

function downloadfile()
{
    $pdo=new PDOImplement();
    $result=$pdo->ExecuteQuery("select top 3 youtube_id,title,type,link from youtube");

    foreach($result as $key=>$value)
    {
        $video_id=$value["youtube_id"];
        $videotype=$value["type"];
        $link=$value["link"];
        $videotitle=$value["title"];
        if($videotype==0)
        {
            downloadvideo("",$videotitle,$video_id,$videotype,$link);
        }else
        {

            if(isset($video_id)) {
                $my_id = $video_id;
                if(strlen($my_id)>11){
                    $url   = parse_url($my_id);
                    $my_id = NULL;
                    if( is_array($url) && count($url)>0 && isset($url['query']) && !empty($url['query']) ){
                        $parts = explode('&',$url['query']);
                        if( is_array($parts) && count($parts) > 0 ){
                            foreach( $parts as $p ){
                                $pattern = '/^v\=/';
                                if( preg_match($pattern, $p) ){
                                    $my_id = preg_replace($pattern,'',$p);
                                    break;
                                }
                            }
                        }
                        if( !$my_id ){
                            echo '<p>No video id passed in</p>';
                            exit;
                        }
                    }else{
                        echo '<p>Invalid url</p>';
                        exit;
                    }
                }
            } else {
                echo '<p>No video id passed in</p>';
                exit;
            }

                $my_video_info = 'http://www.youtube.com/get_video_info?&video_id='. $my_id.'&asv=3&el=detailpage&hl=en_US'; //video details fix *1
                $my_video_info = curlGet($my_video_info);

                /* TODO: Check return from curl for status code */

                $thumbnail_url = $title = $url_encoded_fmt_stream_map = $type = $url = '';

                parse_str($my_video_info);


                $my_title = $title;
                $cleanedtitle = clean($title);

                if(isset($url_encoded_fmt_stream_map)) {
                    /* Now get the url_encoded_fmt_stream_map, and explode on comma */
                    $my_formats_array = explode(',',$url_encoded_fmt_stream_map);

                } else {
                    echo '<p>No encoded format stream found.</p>';
                    echo '<p>Here is what we got from YouTube:</p>';
                    echo $my_video_info;
                }
                if (count($my_formats_array) == 0) {
                    echo '<p>No format stream map found - was the video id correct?</p>';
                    exit;
                }

                /* create an array of available download formats */
                $avail_formats[] = '';
                $i = 0;
                $ipbits = $ip = $itag = $sig = $quality = '';
                $expire = time();

                foreach($my_formats_array as $format) {
                    parse_str($format);
                    $type = explode(';',$type);
                    if($type[0]=="video/mp4")
                    {
                        $avail_formats[0]['itag'] = $itag;
                        $avail_formats[0]['quality'] = $quality;
                        $avail_formats[0]['type'] = $type[0];
                        $avail_formats[0]['url'] = urldecode($url) . '&signature=' . $sig;
                        parse_str(urldecode($url));
                        $avail_formats[0]['expires'] = date("G:i:s T", $expire);
                        $avail_formats[0]['ipbits'] = $ipbits;
                        $avail_formats[0]['ip'] = $ip;
                    }
                    $i++;
                }

                //$redirect_url="download.php?mime=". $avail_formats[0]['type'] ."&title=". urlencode($my_title) ."&token=".base64_encode($avail_formats[0]['url']);

                //$mime=$avail_formats[0]['type'];
                if($videotype==1)
                {
                    $videotitle=urlencode($my_title);
                }
                $token=base64_encode($avail_formats[0]['url']);
                var_dump($my_title);
                downloadvideo($token,$videotitle,$video_id,$videotype,$link);
        }
        //header("Location: $redirect_url");
    }
}
downloadfile();
?>

