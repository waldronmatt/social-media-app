<?php 
    include 'functions.php';
    // Set session for number of items displayed
    session_start();
    if ( !isset( $_SESSION['etsySession'] ) ) 
    $_SESSION['etsySession'] = 0; else $_SESSION['etsySession'] = $_SESSION['etsySession']+3;
    $counters = $_SESSION['etsySession'];
    
    // get current and file modified date
    $fileModified = date('Y-m-d H:i:s', filemtime('json/etsy-data.json'));
    $currentDate = date('Y-m-d H:i:s'); 
    // get date and time diff
    $timediff = strtotime($currentDate) - strtotime($fileModified);

    // query google API if greater than 24 hours
    // implemented to reduce quota footprint and google rate limitations
    if ($timediff >= 43200) { 
        //echo "more than 24 hours";
        $etsyToken = $_SESSION['etsyToken'];

        // get profile data
        $profileURL = 'https://openapi.etsy.com/v2/shops/20044346/listings/active?method=GET&api_key=' . $etsyToken . '&fields=title,url&limit=6&includes=MainImage';
        // reads entire file into string and decode
        $info = file_get_contents($profileURL);
        file_put_contents('json/etsy-data.json', $info);
    }
    
    $data = file_get_contents('json/etsy-data.json');
    $etsyJSON = json_decode($data);
        // store etsy json path in variable and count post length
    $path = $etsyJSON->results;
    
    // get lower pixel images for mobile
    function picture($widthValue) {
        if ($widthValue == "small") {
            $pictureSize = "pictureSM";
        } else {
            $pictureSize = "pictureLG";
        }
        return $pictureSize;
    }
   
    // print recent instagram posts
    function etsy($path, $counters) {
        $listings = $path;
        $widthValue = $_POST['dataKey'];
        $picture = picture($widthValue);
        $i = 0;
        $line = '';
        // loop to iterate over number of posts
        foreach (array_slice($listings, $counters) as $list) {
            if ($i === 3) break;
            // object to hold paths of Instagram data
            $shop = array(
                "title" => $list->title,
                "url" => $list->url,
                "pictureSM" => $list->MainImage->url_570xN,
                "pictureLG" => $list->MainImage->url_fullxfull
            );
            // display instagram pictures/data
            $line .= "<div class='grid_item etsy-span' style='background-image:url(".  $shop[$picture] .");'>";
            $line .= "<a href='". $shop['url'] ."' target='_blank' class='etsy-link' onclick='getOutboundLink(`". 'Etsy' ."` , `". caption($shop['title'], 'full') ."`);'>";
            $line .= "<div class='etsy-title'><p>". caption($shop['title'], 4) ."</p></div></a></div>";
            $i++;
        }
        echo $line;
    }
    // call function 
    etsy($path, $counters);
?>
