<?php
    // import api library
    require 'vendor/autoload.php';

    // start session 
    session_start();
    
    // *** Spotify Access Token *** 
    // set session for spotify access token auth
    $session = new SpotifyWebAPI\Session(
        //
        //
    );
    $session->requestCredentialsToken();
    $_SESSION['spotifyToken'] = $session->getAccessToken();

    // *** Twitter Access Token *** 
    $settings = array(
        'oauth_access_token' => //,
        'oauth_access_token_secret' => //,
        'consumer_key' => //,
        'consumer_secret' => //
    );
    $twitter_settings = serialize($settings);
    $_SESSION['twitterToken'] = $twitter_settings;
    
    $youtube_accessCode = //;
    $_SESSION['youtubeToken'] = $youtube_accessCode;
    
    $etsy_accessCode = //;
    $_SESSION['etsyToken'] = $etsy_accessCode;

    // remove counter session on page load
    unset($_SESSION["spotifySession"]);
    unset($_SESSION["spotifyTracksSession"]);
    unset($_SESSION["twitterSession"]);
    unset($_SESSION["youtubeSession"]);
    unset($_SESSION["instagramSession"]);
    unset($_SESSION["etsySession"]);
?>
