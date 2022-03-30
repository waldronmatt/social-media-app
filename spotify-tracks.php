<?php
    // import api library
    require 'vendor/autoload.php';
    include 'functions.php';
    // start the session
    session_start();
    // Set token for authentication
    $spotifyToken = $_SESSION['spotifyToken'];
    
    // Set session for number of items displayed
    if ( !isset( $_SESSION['spotifyTracksSession'] ) ) 
    $_SESSION['spotifyTracksSession'] = 0; else $_SESSION['spotifyTracksSession'] = $_SESSION['spotifyTracksSession']+3;
    $counter = $_SESSION['spotifyTracksSession'];
    
    // initalize spotify api object
    $api = new SpotifyWebAPI\SpotifyWebAPI();
    $api->setAccessToken($spotifyToken);
    
    // get lower pixel images for mobile
    function picture($widthValue) {
        if ($widthValue == "small") {
            $pictureSize = "pictureSM";
        } else {
            $pictureSize = "pictureLG";
        }
        return $pictureSize;
    }

    // print recent artist albums
    function getTrackInfo($api, $counter) {
        $widthValue = $_POST['dataKey'];
        $picture = picture($widthValue);
        $tracks = $api->getAlbumTracks('2cq60Wx5cTICqqlezQpwlA');
        $i = 0;
        $line = '';
        foreach (array_slice($tracks->items, $counter) as $track) {
            //if ($album->album_type === "album") {
                if ($i === 3) break;
                $album = $api->getAlbum('2cq60Wx5cTICqqlezQpwlA');
                $name = $track->name;
                $preview_url =  $track->preview_url;
                $link = $track->external_urls->spotify;
                $album->images = array(
                    'pictureLG' => $album->images[0]->url,
                    'pictureSM' => $album->images[1]->url,
                );
                // display instagram pictures/data
                $line .= "<div class='grid_item spotify-span' style='background-image:url(".  $album->images[$picture] .");'>";
                $line .= "<div class='grid_link'><div class='audio-player__title'><p>". caption($name, 4) ."</p></div>";
                $line .= "<div class='audio-player js-audio-player'><button class='audio-player__control js-control'><div class='audio-player__control-icon'></div></button>";
                $line .= "<audio preload='auto'><source src=". $preview_url ."/></audio></div></div><div class='social-link'><div class='list'>";
                $line .= "<a href=". $link ." target='_blank' onclick='getOutboundLink(`". 'Spotify' ."` , `". caption($name, 'full') ."`);'>Stream</a></div></div></div>";
                $i++;
            //}
        }
        echo $line;
    }
    // call function
    getTrackInfo($api, $counter);
?>
