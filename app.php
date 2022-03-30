<?php require 'auth.php' ?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>Social Media API Website</title>
  
	<meta name="viewport" content="width=device-width" />
	<meta name="description" content="Social Media API Website" />
	<meta name="keywords" content="Matt Waldron, technology, music" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	
	<link rel="icon" type="image/png" href="favicon.png" />
	<link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" title="style" />
	<link rel="stylesheet" href="css/style.css" type="text/css" title="style" />

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-151945826-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-151945826-1');
        
        /**
        * Function that registers a click on an outbound link in Analytics.
        * This function takes a valid URL string as an argument, and uses that URL string
        * as the event label. Setting the transport method to 'beacon' lets the hit be sent
        * using 'navigator.sendBeacon' in browser that support it.
        */
        var getOutboundLink = function(category, text) {
            gtag('event', 'Click Link', {
                'event_category': category,
                'event_label': text,
                'transport_type': 'beacon'
            });
        }
    </script>
    
    <style>
        p {
            display: block;
            text-align: left;
            font-size: 1.25em;
            line-height: 1.625em;
        }
        
        a, button {
            display: block; 
            text-align: center;
            font-family: 'Tajawal', sans-serif;
            text-decoration: none;
            color: #000;
            font-size: 1em;
        }

        h1, h2, h3, p {
            font-family: 'Tajawal', sans-serif;
            display: block; 
            text-align: center;
            margin: .7em;
        }
        
        @media screen and (min-width: 768px) {
            body {
                margin: 1.5em;
            }
        }
        
        .list {
            font-family: 'Tajawal', sans-serif;
            line-height: 1.625em;
        }
	
        .btn-container { 
            display: block; 
            text-align: center;
        } 

        div.pages .list a, div.pages .list button { 
            display: inline-block;
            font-size: 1.5em;
            letter-spacing: 0.125em;
            padding: .6em 1.2em .6em 1.2em;
        }

        div.footer .list a { 
            display: inline-block;
            letter-spacing: 0.125em;
            font-size: 1.5em;
            margin: .7em;
            padding: .3em 1.2em .3em 1.2em;
            text-align: center;
            color: #000;
            text-decoration: none;
            height: 100%;
            -webkit-transition: all .25s ease;
            -moz-transition: all .25s ease;
            -ms-transition: all .25s ease;
            -o-transition: all .25s ease;
            transition: all .25s ease;
        }

        .cool-link::after {
            content: '';
            display: block;
            width: 0;
            height: .125em;
            border-bottom: solid .2em;
            border-color: #52658f;  
            transition: width .3s;
        }

        .cool-link:hover::after {
            width: 100%;
            transition: width .3s;
        }
        
        div.pages, div.pages .list, div.footer, div.footer .list {
            display: inline;
            line-height: 30px;	
        }
        
        div.pages .list a, div.pages .list button { 
            font-family: 'Tajawal', sans-serif;
            margin: .7em;
            text-align: center;
            background-color: #fff;
            text-decoration: none;
            border: solid .2em;
            border-color: #333a56; 
            height: 100%;
            cursor: pointer;
            -webkit-transition: all .25s ease;
            -moz-transition: all .25s ease;
            -ms-transition: all .25s ease;
            -o-transition: all .25s ease;
            transition: all .25s ease;
        }
        
        div.pages .list a:hover, div.pages .list button:hover, div.pages .list.selected a, div.pages .list.selected a:hover { 
            color: #fff;
            background-color: #333a56;
        }
        
        .hero {
            background-image: url("pictures/hero-img-xs.jpg");
            height: 320px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        #overlay {
            position: sticky;
            height: 320px;
            width: 100%;
        }

        @media screen and (min-width: 480px) and (max-width: 767px) {
        .hero {
            background-image: url("pictures/hero-img-sm.jpg");
        }
        }

        @media screen and (min-width: 768px) and (max-width: 1023px) {
        .hero {
            background-image: url("pictures/hero-img-md.jpg");
        }
        }

        @media screen and (min-width: 1024px) and (max-width: 1439px) {
        .hero {
            background-image: url("pictures/hero-img-lg.jpg");
        }
        }

        @media all and (min-width: 1440px) {
        .hero {
            background-image: url("pictures/hero-img-xl.jpg");
        }
        }
    </style>
</head>

<body>
	<a href="app.php"><img src="pictures/main.png" alt="logo"></a>
	<h1>Social Media API Website</h1>
	<h2><u>Scroll down</u> to see your most recent music, tweets, videos, posts, and listings!</h2>
        <div class="hero">
		<div id="overlay">
			</div>
		</div>
	</div>
	
	<h1>Recent Albums</h1>
	<div class="spotify-grid"></div>
	<div class="btn-container">
		<div class="pages" id="spotify-btn">
			<div class="list" id="spotify-load"><button>Load More</button></div>
		</div>	
	</div>
	
    <h1>Album Tracks</h1>
	<div class="spotify-tracks-grid"></div>
	<div class="btn-container">
		<div class="pages" id="spotify-tracks-btn">
			<div class="list" id="spotify-tracks-load"><button>Load More</button></div>
		</div>	
	</div>
	
    <h1>Latest News</h1>
	<div class="twitter-grid"></div>
	<div class="btn-container">
		<div class="pages" id="twitter-btn">
			<div class="list" id="twitter-load"><button>Load More</button></div>
		</div>	
	</div>
	
    <h1>Recent Videos</h1>
    <div class="youtube-grid"></div>
    	<div class="btn-container">
		<div class="pages" id="youtube-btn">
			<div class="list" id="youtube-load"><button>Load More</button></div>
		</div>	
	</div>

    <h1>Picture Gallery</h1>
    <div class="instagram-grid"></div>
    	<div class="btn-container">
		<div class="pages" id="instagram-btn">
			<div class="list" id="instagram-load"><button>Load More</button></div>
		</div>	
	</div>
	
    <h1>My Listings</h1>
    <div class="etsy-grid"></div>
    	<div class="btn-container">
		<div class="pages" id="etsy-btn">
			<div class="list" id="etsy-load"><button>Load More</button></div>
		</div>	
	</div>

    <div class="btn-container">
		<div class="footer">
			<div class="list"><a class="cool-link" href="http://www.instagram.com" target="_blank">Instagram</a></div>
			<div class="list"><a class="cool-link" href="http://www.itunes.com" target="_blank">iTunes</a></div>
		</div>	
	</div>
	<a href="web.php">&copy; Copyright <span id="footer-copyright"></span> Matthew Waldron. All Rights Reserved.</a>
	
    <script type="text/javascript">
 
        // use on.click functions because content dynamically loaded from api
        function playAudio(getAudio) {
            var $player = $(getAudio);
            var $fadeDuration = 500;
            var $playbackClass = 'is-playing'
            
            // loop all players
            $player.each(function(index) {
                var $this = $(this);
                var id = 'audio-player-' + index;
                var title = $('.audio-player__title').eq(index).text();
                $this.attr('id', id);
                // on click, play audio; pause if this not playing
                $this.find($('.js-control')[index]).on('click', function (e) {
                    resetPlayback(id);
                    playback($this, $this.find($('audio')), title);
                });
                // $this.find($('.js-control')[index]).trigger('click');
                    // Reset state once audio has finished playing
                $this.find($('audio')[index]).on('ended', function() {
                    resetPlayback();
                });
            });

            function playback($player, $audio, title) {
                // e.stopImmediatePropagation();
                if ($audio[0].paused) {
                    // play, fade in, add pause button
                    $audio[0].play();
                    $audio.animate({volume:1}, $fadeDuration);
                    $player.addClass($playbackClass);
                    
                    gtag('event', 'Play Song', {
                        'event_category': 'Spotify',
                        'event_label': title
                    });
                } else {
                    // pause, fade out, add play button
                    $audio.animate({volume:0}, $fadeDuration, function() {
                        $audio[0].pause();
                    });
                    $player.removeClass($playbackClass);
                }
            };

            function resetPlayback(id) {
                // loop all players
                $player.each(function() {
                    var $this = $(this);
                    // if not player, pause, fade out, add play button
                    if ($this.attr('id') !== id) {
                        $this.find($('audio')).animate({volume:0}, $fadeDuration, function() {
                            $(this)[0].pause();
                        });
                        $this.removeClass($playbackClass);
                    }
                });
            };
        };
        
        // youtube iframe load on click
        function playVideo(event) { 
            var id = $(this).parent().attr('data-id');
            var title = $(this).parent().attr('data-title');

            var iframe = document.createElement('iframe');
            var embed = 'https://www.youtube.com/embed/ID?autoplay=1';
            iframe.setAttribute('src', embed.replace('ID', id));
            iframe.setAttribute('frameborder', '0');
            iframe.setAttribute('allowfullscreen', '1');
            iframe.setAttribute('allow', 'autoplay');
            this.parentNode.replaceChild(iframe, this);
            
            gtag('event', 'Play Video', {
                'event_category': 'YouTube',
                'event_label': title
            });
        };
        $(document).on('click', '.change, .play', playVideo);
        
        // determine picture size from screen width
        // unfortunately each platform has different picture sizes :(
        var spotifyCount = 0;
        var spotifyTracksCount = 0;
        var twitterCount = 0;
        var youtubeCount = 0;
        var instaCount = 0;
        var etsyCount = 0;
        var width = $(window).width();

        function spotifyPicture(width) {
            var value = 'large'
            if (width <= 767 ) {
                value = 'small';
            } else {
                value = 'large';
            }
            return value;
        };
        var spotifyWidth = spotifyPicture(width);
        var spotifyTracksWidth = spotifyPicture(width);

        function youtubePicture(width) {
            var value = 'large'
            if (width <= 479 ) {
                value = 'small';
            } else if (width >= 480 && width <= 767 ) {
                value = 'medium';
            } else {
                value = 'large';
            }
            return value;
        };
        var youtubeWidth = youtubePicture(width);

        function instagramPicture(width) {
            var value = 'x-large'
            if (width <= 320 ) {
                value = 'small';
            } else if (width >= 321 && width <= 479 ) {
                value = 'medium';
            } else if (width >= 480 && width <= 767 ) {
                value = 'large';
            } else {
                value = 'x-large';
            }
            return value;
        };
        var instagramWidth = instagramPicture(width);
        
        function etsyPicture(width) {
            var value = 'large'
            if (width <= 767 ) {
                value = 'small';
            } else {
                value = 'large';
            }
            return value;
        };
        var etsyWidth = etsyPicture(width);
        
        // get instagram data
        function getPostInstaData() {
            var username = "instagram";
            var max_num_items = 6;

            // get data
            $.ajax( "https://www.instagram.com/"+username+"/?__a=1" ).done(function(data) {
            // post data to ajax call posting to instagram app
                ajax('instagram.php', '.instagram-grid', 'instagramWidth', instagramWidth, 'instagram-data', data);
            });
        }
        
        // the almighty ajax function
        function ajax(url, success, dataKey, dataValue, instaKey, instaValue) {
            $.ajax({
                type: 'POST',
                url: url,
                data: {dataKey:dataValue, instaKey:instaValue},
                success: function(data) {
                    $(success).append(data);
                }
            }).done(function(response) {
                // get music players if spotify
                if (url === 'spotify.php' || url === 'spotify-tracks.php') {
                    // unbind click
                    $('.js-control').off('click');
                    // concatenate response
                    response =+ response;
                    // find all audio players from ajax response, not the DOM
                    var getAudio = $('.js-audio-player', $(response).context);
                    // call player function
                    playAudio(getAudio);
                }
            });     
        };

        // load social media on scroll
        $(window).scroll(function() {
            var sTop = $(window).scrollTop();
            var winHeight = $(window).height();
            var docHeight = $(document).height();
            
            if (sTop + winHeight > docHeight - 1000 && spotifyCount < 3) {
                ajax('spotify.php', '.spotify-grid', 'spotifyWidth', spotifyWidth);
                spotifyCount += 3;
            }
            if (sTop + winHeight > docHeight - 900 && spotifyTracksCount < 3) {
                ajax('spotify-tracks.php', '.spotify-tracks-grid', 'spotifyTracksWidth', spotifyTracksWidth);
                spotifyTracksCount += 3;
            }
            if (sTop + winHeight > docHeight - 800 && twitterCount < 3) {
                ajax('twitter.php', '.twitter-grid');
                twitterCount += 3;
            }
            if (sTop + winHeight > docHeight - 600 && youtubeCount < 3){
                ajax('youtube.php', '.youtube-grid', 'youtubeWidth', youtubeWidth);
                youtubeCount += 3;
            }
            if (sTop + winHeight > docHeight - 400 && instaCount < 3) {
                getPostInstaData();
                instaCount += 3;
            }
            if (sTop + winHeight > docHeight - 300 && etsyCount < 3) {
                ajax('etsy.php', '.etsy-grid', 'etsyWidth', etsyWidth);
                etsyCount += 3;
            }
        });

        // load more social media on click, hide load more button
        $('#spotify-load').click(function(){
            ajax('spotify.php', '.spotify-grid', 'spotifyWidth', spotifyWidth);
            $('#spotify-btn').hide();
        });
        $('#spotify-tracks-load').click(function(){
            ajax('spotify-tracks.php', '.spotify-tracks-grid', 'spotifyTracksWidth', spotifyTracksWidth);
            $('#spotify-tracks-btn').hide();
        });
        $('#twitter-load').click(function(){
            ajax('twitter.php', '.twitter-grid');
            $('#twitter-btn').hide();
        });
        $('#youtube-load').click(function(){
            ajax('youtube.php', '.youtube-grid', 'youtubeWidth', youtubeWidth);
            $('#youtube-btn').hide();
        });
        $('#instagram-load').click(function(){
            getPostInstaData();
            $('#instagram-btn').hide();
        });
        $('#etsy-load').click(function(){
            ajax('etsy.php', '.etsy-grid', 'etsywidth', etsyWidth);
            $('#etsy-btn').hide();
        });
        // copyright year
        document.getElementById('footer-copyright').appendChild(document.createTextNode(new Date().getFullYear())); 
    </script>

	<script src="js/lightbox.js"></script>
</body>
</html>
