<?php
   session_start();
   userpath('designIndex');   
?>

<!doctype html>
<html>
    <head>
  <meta charset="utf-8">
  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Webvantage</title>

  <meta name="description" content=""><!--120 word description for SEO purposes goes here.-->
  <meta name="keywords" content=""><!--Keywords to help with SEO go here.-->

  <META NAME="robots" CONTENT="noindex,nofollow,noarchive" /><!--All sites in development should not be searchable or cached. THIS MUST BE REMOVED ON GO-LIVE.-->
  <META NAME="GOOGLEBOT" CONTENT="NOARCHIVE"/><!--All sites in development should not be searchable or cached. THIS MUST BE REMOVED ON GO-LIVE.-->
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache"/><!--All sites in development should not be searchable or cached. THIS MUST BE REMOVED ON GO-LIVE.-->

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1"><!--Include only if using responsive design and media queries.-->
  <meta name="viewport" content="initial-scale=1, maximum-scale=1"><!--Include only if using responsive design and media queries.-->
  <meta name="apple-mobile-web-app-capable" content="yes">

  <!-- Place favicon.ico in the root directory: mathiasbynens.be/notes/touch-icons -->
  <link rel="shortcut icon" href="favicon.ico" />

  <link rel="stylesheet" media="screen" href="assets/css/style.css" >
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>        
  <script>window.jQuery || document.write('<script src="assets/vendor/libs/jquery-1.8.2.min.js"><\/script>')</script>
  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->
</head>
<body>  
  <div class="container"> <!-- start of container -->    
    <header>
      <h1>WEBVANTAGE</h1>
        <?php  ?>
    </header>
    <div class="content">