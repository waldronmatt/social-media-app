<?php    
    // return caption
    function caption($captionPath, $iterate) {
        // strip special characters
        $captionPath = str_replace('/[^A-Za-z0-9\-]/', '', $captionPath);
        // // escape apostrophe
        // if (strpos($captionPath, '\'') == true) {
        //     $captionPath = str_replace("'", "\\'", $captionPath);
        // }
        // break string into array
        $message = explode(' ',trim($captionPath));
        $size = count($message);

        $cap = '';
        // print out full message
        if ($iterate === 'full') {
            for ($x = 0; $x < $size; $x++) {
                if ($x == $size - 1) {
                    $cap .= $message[$x];
                } else {
                    $cap .= $message[$x] . ' ';
                }
            }
            return $cap;
        // print out set number of words
        } else {
            for ($x = 0; $x < $size-$size + $iterate; $x++) {
                // if total message count <= count param
                // add space to word
                if ($size <= $iterate) {
                    $cap .= $message[$x] . ' ' ?? null; 
                // else if total message count > count param
                } else if ($size > $iterate) {
                    // if counter equal to count param minus 1
                    // end caption with two dots
                    if ($x == $iterate - 1) {
                        $cap .= $message[$x] . '..';
                    //else add space to word
                    } else {
                        $cap .= $message[$x] . ' ';
                    }
                }
            }
            return $cap;
        }
    }
?>
