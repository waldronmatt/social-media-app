 <?php
    require 'vendor/autoload.php';
    include 'functions.php';
    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
    
    // Set session for number of items displayed
    session_start();
    if ( !isset( $_SESSION['twitterSession'] ) ) 
    $_SESSION['twitterSession'] = 0; else $_SESSION['twitterSession'] = $_SESSION['twitterSession']+3;
    $counters = $_SESSION['twitterSession'];

    // get current and file modified date
    $fileModified = date('Y-m-d H:i:s', filemtime('json/twitter-data.json'));
    $currentDate = date('Y-m-d H:i:s'); 
    // get date and time diff
    $timediff = strtotime($currentDate) - strtotime($fileModified);

    // query API if greater than 24 hours
    // implemented to reduce quota footprint
    if ($timediff >= 43200) { 
        $get_settings = $_SESSION['twitterToken'];
        $twitterToken = unserialize($get_settings);
        
        /** Perform a GET request **/
        /** Note: Set the GET field BEFORE calling buildOauth(); **/
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=NPR&count=12';
        $requestMethod = 'GET';
        
        $twitterExchange = new TwitterAPIExchange($twitterToken);
        $twitter = $twitterExchange->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();

        file_put_contents('json/twitter-data.json', $twitter);
    }

    //read the entire string
    $data = file_get_contents('json/twitter-data.json');
    $twitterJSON = json_decode($data);
    
    // store instagram json path in variable and count post length
    $path = $twitterJSON;
    
    // remove https and strip special characters
    function cleanText($created) {
        $created = substr($created, 0, strpos($created, "https"));
        return str_replace('/[^A-Za-z0-9\-]/', '', $created);
    }

    // print recent instagram posts
    function twitter($path, $counters) {
        $tweets = $path;
        $i = 0;
        // loop to iterate over number of posts
        foreach (array_slice($tweets, $counters)as $tweet) {
            if ($i === 3) break;
            if ($tweet->retweeted_status) {continue;}
            // object to hold paths of Instagram data
            $created = $tweet->text;
            $retweet = $tweet->retweet_count;
            $favorite = $tweet->favorite_count;
            $urls = $tweet->entities->urls;
            $urls = array(
                    'url' => $urls[0]->url,
            );
            
            // display instagram pictures/data
            $line .= "<div class='grid_item span'><div class='twitter-text'><p>". cleanText($created) ."</p></div>";
            $line .= "<div class='twitter-tile'><div class='twitter-cont'><i class='fa fa-retweet' aria-hidden='false'></i><p>". $retweet ."</p></div>";
            $line .= "<div class='twitter-cont'><i class='fa fa-heart' aria-hidden='false'></i><p>". $favorite ."</p></div></div><div class='social-link'><div class='list'>";
            $line .= "<a href=". $urls['url'] ." target='_blank' onclick='getOutboundLink(`". 'Twitter' ."` , `". caption(cleanText($created), 8) ."`);');'>";
            $line .= "View Tweet</a></div></div></div>";
            $i++;
        }
        echo $line;
    }
    // call function 
    twitter($path, $counters);

?>
