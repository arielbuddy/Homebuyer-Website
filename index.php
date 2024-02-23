<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>

<link rel="stylesheet" href="https://www.gstatic.com/dialogflow-console/fast/df-messenger/prod/v1/themes/df-messenger-default.css">

<style>
  df-messenger {
    z-index: 999;
    position: fixed;
    bottom: 16px;
    right: 16px;
  }

</style>

<body>
<script src="https://www.gstatic.com/dialogflow-console/fast/df-messenger/prod/v1/df-messenger.js">
  dfMessenger = document.querySelector('df-messenger');

  // Pass custom payload
  dfMessenger.customPayload = {
    event: 'WELCOME' 
  }

</script>

<df-messenger
  intent="WELCOME"
  project-id="programmable-sea-1704140431235"
  agent-id="aaa05f71-daa0-489c-bb5e-d7caefcaf267"
  language-code="en"
  allow-feedback="all"
  >
  <df-messenger-chat-bubble
   chat-title="homebuyerchat">
  </df-messenger-chat-bubble>
</df-messenger>
</body>
</html>