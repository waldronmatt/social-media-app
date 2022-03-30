<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>Matt Waldron</title>
  
	<meta name="viewport" content="width=device-width" />
	<meta name="description" content="Matt Waldron Portfolio" />
	<meta name="keywords" content="Matt Waldron, technology, music" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	
	<link rel="icon" type="image/png" href="http://waldronmatthew.com/favicon.png">
	<link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
    <style>
        p {
            display: block;
            font-family: 'Tajawal', sans-serif;
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
            margin: .7em;
        }

        h1, h2, h3 {
            font-family: 'Tajawal', sans-serif;
            display: block; 
            text-align: center;
            margin: .7em;
        }
        
        body {
            margin: 1.5em;
        }
        
        @media screen and (min-width: 768px) {
            
            #center {
                margin: 0 auto;
                width: 700px;
            }
        }

    </style>
</head>

<body>
	<a href="app.php"><img src="pictures/main.png" alt="logo"></a>
	
	<h1>Terms of Use</h1>
	<h2>waldronmatthew.com</h2>
	<div id="center">
	<p>All information presented on the website is reserved with the exception of third-party logos, pictures, text and / or links that are subject to the copyright rights of their providers. 
		Any duplication or use of objects such as images or texts in other electronic or printed publications is not permitted without Matthew Waldron's agreement.</p>
	<h1>Website Credits</h1>
	<h2>Matthew Waldron</h2>
	<p>Website developed by Matthew Waldron except where noted. Website content copyrighted. Website code proprietary. Website code mentioned below distributed under the MIT License.</p>
	<h2>Ronny Siikaluoma</h2>
	<p>CodePen by Ronny Siikaluoma that allows for squares that resize according to screen size. Parts of HTML and CSS used. Updated for
		even tile size and picture replacement and dynamic resizing. CodePen under the MIT license.</p>
	<h2>Lokesh Dhakar</h2>
	<p>Lightbox photo viewer by Lokesh Dhakar. Allows for modal photo viewing when the picture thumbnail is clicked. Downloaded from GitHub. Code under the MIT license.</p>
	<h2>Vaishal</h2>
	<p>CodePen by Vaishal that allows for music playback when clicked for multiple audio files. Code under the MIT license. Downloaded and modified from CodePen. CodePen under the MIT license.</p>
	<h2>Amit Agarwal</h2>
	<p>Code by Amit Agarwal that embeds YouTube videos by using the video thumbnail. The player loads when the user clicks the play button. This approach decreases page load time. Code under the MIT license.</p>
	<h2>Martin Wolf</h2>
	<p>CodePen by Martin Wolf that allows for a bottom border animation link hover effect. Parts of CSS used. CodePen under the MIT license.</p><br />
	</div>
	
	<a href="web.php">&copy; Copyright <span id="footer-copyright"></span> Matthew Waldron. All Rights Reserved.</a>
	
	<script>
	document.getElementById('footer-copyright').appendChild(document.createTextNode(new Date().getFullYear())); 
	</script>
</body>
</html>
