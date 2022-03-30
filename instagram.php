<?php
    include 'functions.php';
    // Set session for number of items displayed
    session_start();
    if ( !isset( $_SESSION['instagramSession'] ) ) 
    $_SESSION['instagramSession'] = 0; else $_SESSION['instagramSession'] = $_SESSION['instagramSession']+3;
    $counters = $_SESSION['instagramSession'];
    
    $data = $_POST['instaKey'];
    // convert array to object
    $dataObj = json_decode(json_encode($data));
    
    // store instagram json path in variable and count post length
    $path = $dataObj->graphql->user->edge_owner_to_timeline_media->edges;
    $size = count($dataObj->graphql->user->edge_owner_to_timeline_media->edges);

    // return complete URL of post
    function url($urlPath) {
        return $url = 'https://www.instagram.com/p/' . $urlPath . '/';
    }
    
    // return number of likes
    function like($likePath) {
        return $likes = number_format($likePath);
    }
    
    // return number of comments
    function comment($commentPath) {
        return $comments = number_format($commentPath);
    }

    // get lower pixel images for mobile
    function picture($widthValue) {
        if ($widthValue == "small") {
            $pictureSize = "pictureSM";
        } else if ($widthValue == "medium") {
            $pictureSize = "pictureMD";
        } else if ($widthValue == "large") {
            $pictureSize = "pictureLG";
        } else {
            $pictureSize = "pictureXL";
        }
        return $pictureSize;
    }

    // print recent instagram posts
    function instagram($path, $counters) {
        $widthValue = $_POST['dataKey'];
        $picture = picture($widthValue);
        $edges = $path;
        $i = 0;
        // loop to iterate over number of posts
        foreach (array_slice($edges, $counters)as $edge) {
            if ($i === 3) break;
            // object to hold paths of Instagram data
            $instaPost = array(
                "pictureSM" => $edge->node->thumbnail_resources[2]->src,
                "pictureMD" => $edge->node->thumbnail_resources[3]->src,
                "pictureLG" => $edge->node->thumbnail_resources[4]->src,
                "pictureXL" => $edge->node->display_url,
                "urlPath" => $edge->node->shortcode,
                "likePath" => $edge->node->edge_liked_by->count,
                "commentPath" => $edge->node->edge_media_to_comment->count,
                "captionPath" => $edge->node->edge_media_to_caption->edges[0]->node->text
            );
            // display instagram pictures/data
            $line .= "<div class='grid_item span' style='background-image:url(". $instaPost[$picture] .");'>";
            $line .= "<a href=". $instaPost["pictureXL"] ." class='grid_link' data-lightbox='portfolio' data-title='". caption($instaPost['captionPath'], 'full') ."'>";
            $line .= "<div class='insta-tile'><p>". caption($instaPost['captionPath'], 4) ."</p>";
            $line .= "<div class='insta-cont'><i class='fa fa-heart' aria-hidden='true'></i><p>". like($instaPost['likePath']) ."</p></div>";
            $line .= "<div class='insta-cont'><i class='fa fa-comment' aria-hidden='true'></i><p>". comment($instaPost['commentPath']) ."</p></div></div></a>";
            $line .= "<div class='social-link'><div class='list'>";
            $line .= "<a href=". url($instaPost['urlPath']) ." target='_blank' onclick='getOutboundLink(`". 'Instagram' ."` , `". caption($instaPost['captionPath'], 8) ."`);'>";
            $line .= "View Post</a></div></div></div>";
            $i++;
        }
        echo $line;
    }
    // call function 
    instagram($path, $counters);
?>
