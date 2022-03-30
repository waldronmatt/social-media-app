<?php 
    include 'functions.php';
    // Set session for number of items displayed
    session_start();
    if ( !isset( $_SESSION['youtubeSession'] ) ) 
    $_SESSION['youtubeSession'] = 0; else $_SESSION['youtubeSession'] = $_SESSION['youtubeSession']+3;
    $counters = $_SESSION['youtubeSession'];

    // get current and file modified date
    $fileModified = date('Y-m-d H:i:s', filemtime('json/youtube-data.json'));
    $currentDate = date('Y-m-d H:i:s'); 
    // get date and time diff
    $timediff = strtotime($currentDate) - strtotime($fileModified);

    // query google API if greater than 24 hours
    // implemented to reduce quota footprint and google rate limitations
    if ($timediff >= 43200) { 
        //echo "more than 24 hours";
        $youtubeToken = $_SESSION['youtubeToken'];
        
        $channelID = 'UCoxcjq-8xIDTYp3uz647V5A';
        // get profile data
        $profileURL = 'https://www.googleapis.com/youtube/v3/search?key=' . $youtubeToken . '&channelId=' . $channelID . '&part=snippet,id&type=video&order=date&maxResults=8';
        // reads entire file into string and decode
        $info = file_get_contents($profileURL);
        file_put_contents('json/youtube-data.json', $info);
    }
    //read the entire string
    $data = file_get_contents('json/youtube-data.json');
    $youtubeJSON = json_decode($data);

    // get lower pixel images for mobile
    function picture($widthValue, $i, $videoID, $youtubeJSON) {
        if ($widthValue == "small") {
            $pictureSize = $youtubeJSON->items[$i]->snippet->thumbnails->medium->url;
        } else if ($widthValue == "medium") {
            $pictureSize = $youtubeJSON->items[$i]->snippet->thumbnails->high->url;
        } else {
            $pictureSize = "https://i.ytimg.com/vi/" . $videoID . "/maxresdefault.jpg";
        }
        return $pictureSize;
    }

    // print recent instagram posts
    function youtube($youtubeJSON, $counters) {
        $widthValue = $_POST['dataKey'];
        for ($i = $counters; $i < $counters+3; $i++) {
            $playlistBool = $youtubeJSON->items[$i]->id->kind;
            $liveStreamBool = $youtubeJSON->items[$i]->snippet->liveBroadcastContent;
            // skip playlists
            if ($playlistBool === "youtube#playlist" || $liveStreamBool === "upcoming" ) {continue;}
            $videoID = $youtubeJSON->items[$i]->id->videoId;
            $videoTitle = $youtubeJSON->items[$i]->snippet->title;
            $videoURL = 'https://www.youtube.com/watch?v=' . $videoID;
            $picture = picture($widthValue, $i, $videoID, $youtubeJSON);
        
            // display youtube pictures/data
            $line .= "<div class='video'><h2>". caption($videoTitle, 4) ."</h3>";
            $line .= "<div class='youtube-player' data-id='" . $videoID ."' data-title='". caption($videoTitle, 'full') ."'><img class='change' src='" . $picture . "'>";
            $line .= "<div class='play'></div></div></div>";
        }
        echo $line;
    }
    // call function
    youtube($youtubeJSON, $counters);
?>
