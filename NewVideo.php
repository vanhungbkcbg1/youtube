<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Youtube Creator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Video downloader, download youtube, video download, youtube video, youtube downloader, download youtube FLV, download youtube MP4, download youtube 3GP, php video downloader" />
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
<?php
 include_once "PDOImplement.php";
 $youtube_id=array_key_exists("youtube_id",$_POST)?$_POST["youtube_id"]:"";
 $title=array_key_exists("title",$_POST)?$_POST["title"]:"";
 $des=array_key_exists("des",$_POST)?$_POST["des"]:"";
 $chanel=array_key_exists("channel",$_POST)?$_POST["channel"]:"music";
 $link_video=array_key_exists("link_video",$_POST)?$_POST["link_video"]:"";
 $channel_link=array_key_exists("channel_link",$_POST)?$_POST["channel_link"]:"";

     if(array_key_exists("link_video",$_POST))
     {
         $link_active=2;
     }else if(array_key_exists("channel_link",$_POST))
     {
         $link_active=3;
     }else
     {
         $link_active=1;
     }

var_dump($link_active);
var_dump($_POST);
?>
<div class="container">
    <div class="row">
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="<?=($link_active==1?'active':'')?>"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Youtube Video</a></li>
                <li role="presentation" class="<?=($link_active==2?'active':'')?>"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-th-list"></span>Link video</a></li>
                <li role="presentation" class="<?=($link_active==3?'active':'')?>"><a href="#channel" aria-controls="profile" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-th-list"></span>Chanel</a></li>
            </ul>


            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <form role="form" method="post" action="<?=$_SERVER["PHP_SELF"]?>">
                        <div class="form-group">
                            <label for="Youtube ID">Youtube Video ID:</label>
                            <input type="Text" class="form-control" value="<?=$youtube_id?>" id="youtubeid" name="youtube_id">
                        </div>
                        <div class="form-group">
                            <label for="Youtube ID">Title: </label>
                            <input type="Text" class="form-control" value="<?=$title?>" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="Youtube ID">Description:</label>
                            <input type="Text" class="form-control" value="<?=$des?>" id="des" name="des">
                        </div>
                        <div class="form-group">
                            <label for="Youtube ID">Dailymotion channel:</label>
                            <select name="channel" id="publish_to" class="form-control">

                                <option value="music" <?=($chanel=="music"?"selected":"") ?>>Âm nhạc</option>


                                <option value="fun" <?=($chanel=="fun"?"selected":"") ?>>Hài kịch &amp; Giải trí</option>


                                <option value="shortfilms" <?=($chanel=="shortfilms"?"selected":"") ?>>Phim</option>


                                <option value="news" <?=($chanel=="news"?"selected":"") ?> >Tin tức</option>


                                <option value="sport" <?=($chanel=="sport"?"selected":"") ?>>Thể thao</option>


                                <option value="auto" <?=($chanel=="auto"?"selected":"") ?>>Mô tô Tự động</option>


                                <option value="people" <?=($chanel=="people"?"selected":"") ?>>Con người &amp; Gia đình</option>


                                <option value="webcam" <?=($chanel=="webcam"?"selected":"") ?>>Cộng đồng &amp; Blog</option>


                                <option value="tech" <?=($chanel=="tech"?"selected":"") ?>>Công nghệ</option>


                                <option value="travel" <?=($chanel=="travel"?"selected":"") ?>>Du lịch</option>


                                <option value="videogames" <?=($chanel=="videogames"?"selected":"") ?>>Video Game</option>


                                <option value="animals" <?=($chanel=="animals"?"selected":"") ?>>Động vật</option>


                                <option value="school" <?=($chanel=="school"?"selected":"") ?>>Giáo dục</option>


                                <option value="lifestyle" <?=($chanel=="lifestyle"?"selected":"") ?>>Lối sống &amp; Hướng dẫn</option>


                                <option value="creation" <?=($chanel=="creation"?"selected":"") ?>>Sáng tạo</option>


                                <option value="tv" <?=($chanel=="tv"?"selected":"") ?>>Tivi</option>


                                <option value="kids" <?=($chanel=="kids"?"selected":"") ?>>Trẻ em</option>

                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <form role="form" method="post" action="<?=$_SERVER["PHP_SELF"]?>">
                        <div class="form-group">
                            <label for="Youtube ID">Link video:</label>
                            <input type="Text" value="<?=$link_video?>" class="form-control" id="YoutubeID" name="link_video">
                        </div>
                        <div class="form-group">
                            <label for="Youtube ID">Title: </label>
                            <input type="Text" value="<?=$title?>" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="Youtube ID">Description:</label>
                            <input type="Text" value="<?=$des?>" class="form-control" id="des" name="des">
                        </div>
                        <div class="form-group">
                            <label for="Youtube ID">Dailymotion channel:</label>
                            <select name="channel" id="publish_to" class="form-control">

                                <option value="music" <?=($chanel=="music"?"selected":"") ?>>Âm nhạc</option>


                                <option value="fun" <?=($chanel=="fun"?"selected":"") ?>>Hài kịch &amp; Giải trí</option>


                                <option value="shortfilms" <?=($chanel=="shortfilms"?"selected":"") ?>>Phim</option>


                                <option value="news" <?=($chanel=="news"?"selected":"") ?> >Tin tức</option>


                                <option value="sport" <?=($chanel=="sport"?"selected":"") ?>>Thể thao</option>


                                <option value="auto" <?=($chanel=="auto"?"selected":"") ?>>Mô tô Tự động</option>


                                <option value="people" <?=($chanel=="people"?"selected":"") ?>>Con người &amp; Gia đình</option>


                                <option value="webcam" <?=($chanel=="webcam"?"selected":"") ?>>Cộng đồng &amp; Blog</option>


                                <option value="tech" <?=($chanel=="tech"?"selected":"") ?>>Công nghệ</option>


                                <option value="travel" <?=($chanel=="travel"?"selected":"") ?>>Du lịch</option>


                                <option value="videogames" <?=($chanel=="videogames"?"selected":"") ?>>Video Game</option>


                                <option value="animals" <?=($chanel=="animals"?"selected":"") ?>>Động vật</option>


                                <option value="school" <?=($chanel=="school"?"selected":"") ?>>Giáo dục</option>


                                <option value="lifestyle" <?=($chanel=="lifestyle"?"selected":"") ?>>Lối sống &amp; Hướng dẫn</option>


                                <option value="creation" <?=($chanel=="creation"?"selected":"") ?>>Sáng tạo</option>


                                <option value="tv" <?=($chanel=="tv"?"selected":"") ?>>Tivi</option>


                                <option value="kids" <?=($chanel=="kids"?"selected":"") ?>>Trẻ em</option>

                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane" id="channel">
                    <form role="form" method="post" action="<?=$_SERVER["PHP_SELF"]?>">
                    <div class="form-group">
                        <label for="Youtube ID">Youtube channel link:</label>
                        <input type="Text" class="form-control" value="<?=$channel_link?>" id="des" name="channel_link">
                    </div>
                    <div class="form-group">
                        <label for="Youtube ID">Dailymotion channel:</label>
                        <select name="channel" id="publish_to" class="form-control">

                            <option value="music" <?=($chanel=="music"?"selected":"") ?>>Âm nhạc</option>


                            <option value="fun" <?=($chanel=="fun"?"selected":"") ?>>Hài kịch &amp; Giải trí</option>


                            <option value="shortfilms" <?=($chanel=="shortfilms"?"selected":"") ?>>Phim</option>


                            <option value="news" <?=($chanel=="news"?"selected":"") ?> >Tin tức</option>


                            <option value="sport" <?=($chanel=="sport"?"selected":"") ?>>Thể thao</option>


                            <option value="auto" <?=($chanel=="auto"?"selected":"") ?>>Mô tô Tự động</option>


                            <option value="people" <?=($chanel=="people"?"selected":"") ?>>Con người &amp; Gia đình</option>


                            <option value="webcam" <?=($chanel=="webcam"?"selected":"") ?>>Cộng đồng &amp; Blog</option>


                            <option value="tech" <?=($chanel=="tech"?"selected":"") ?>>Công nghệ</option>


                            <option value="travel" <?=($chanel=="travel"?"selected":"") ?>>Du lịch</option>


                            <option value="videogames" <?=($chanel=="videogames"?"selected":"") ?>>Video Game</option>


                            <option value="animals" <?=($chanel=="animals"?"selected":"") ?>>Động vật</option>


                            <option value="school" <?=($chanel=="school"?"selected":"") ?>>Giáo dục</option>


                            <option value="lifestyle" <?=($chanel=="lifestyle"?"selected":"") ?>>Lối sống &amp; Hướng dẫn</option>


                            <option value="creation" <?=($chanel=="creation"?"selected":"") ?>>Sáng tạo</option>


                            <option value="tv" <?=($chanel=="tv"?"selected":"") ?>>Tivi</option>


                            <option value="kids" <?=($chanel=="kids"?"selected":"") ?>>Trẻ em</option>

                        </select>


                    </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>

            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">


            <?php
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {


                  if(array_key_exists("youtube_id",$_POST))
                  {
                      //youtube insert

                      if(empty($youtube_id))
                      {
                          die("bạn chưa nhập Youtube ID");
                      }

                      $type=1;

                  }else if(array_key_exists("link_video",$_POST))
                  {
                      //link insert
                      if(empty($link_video))
                      {
                          die("bạn chưa nhập link video");
                      }

                      $type=0;
                  }else
                  {
                      if(empty($channel_link))
                      {
                          die("Bạn chưa nhập Youtube channel link");
                      }
                      $type=2;
                  }
                  if($type!=2)
                  {
                      if(empty($title))
                      {
                          die("Bạn chưa nhập title cho video");
                      }
                      if(empty($des))
                      {
                          die("Bạn chưa nhập description");
                      }
                      if(empty($tag))
                      {
                          die("Bạn chưa nhập tag cho video");
                      }
                  }
                    if(empty($chanel))
                    {
                        die("Bạn chưa nhập channel");
                    }



                $pdo=new PDOImplement();
                switch($type)
                {
                    case 0:
                    case 1:
                        {
                            $query="insert into youtube(youtube_id,title,description,catagory,type,link,tag)values('$youtube_id','$title','$des','$chanel',$type,'$link_video','$tag')";
                            var_dump($query);
                            $pdo->ExecuteQuery($query);
                        }break;
                    case 2:
                    {
                        $query="insert into channel(link_channel,catagory)values('$channel_link','$chanel') ";
                        $pdo->ExecuteQuery($query);
                    }break;
                }

            }
            ?>
        </div>
    </div>


</div>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script type="text/javascript">


</script>
</body>
</html>