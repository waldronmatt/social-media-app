<?php
    // import api library
    require 'vendor/autoload.php';
    include 'functions.php';
    // start the session
    session_start();
    // Set token for authentication
    $spotifyToken = $_SESSION['spotifyToken'];
    
    // Set session for number of items displayed
    if ( !isset( $_SESSION['spotifySession'] ) ) 
    $_SESSION['spotifySession'] = 0; else $_SESSION['spotifySession'] = $_SESSION['spotifySession']+3;
    $counter = $_SESSION['spotifySession'];
    
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
    
    function getTrack($tracks) {
        return $tracks->items[0]->preview_url;
    }
    
    function getTrackName($tracks) {
        return $tracks->items[0]->name;
    }
    
    // print recent artist albums
    function getAlbumInfo($api, $counter) {
        $widthValue = $_POST['dataKey'];
        $picture = picture($widthValue);
        $albums = $api->getArtistAlbums('0JyCM9EwjQZZzQPGTSM1qc');
        $i = 0;
        $line = '';
        foreach (array_slice($albums->items, $counter) as $album) {
            //if ($album->album_type === "album") {
                if ($i === 3) break;
                $albumId = $album->id;
                $name = $album->name;
                $tracks = $api->getAlbumTracks($albumId);
                $preview_url = getTrack($tracks);
                $trackName = getTrackName($tracks);
                $link = $album->external_urls->spotify;
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
    getAlbumInfo($api, $counter);
?>
