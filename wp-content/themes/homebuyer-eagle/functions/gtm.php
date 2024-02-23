<?php

/*******************************************************************************
 * Add Analytics
 */

add_action('wp_head', 'load_header_scripts', 10);
function load_header_scripts() {
  ?>
    <!-- Google Tag Manager -->
    <script>
      window.dataLayer = window.dataLayer || [];
      (function(w,d,s,l,i) {
        w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});
        var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';
        j.async=true;
        j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
        f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-KCTGB6Z');
    </script>
    <!-- End Google Tag Manager -->
  <?php
}

/*******************************************************************************
 * Add GTM for no-JS / non-browers
 */

add_action('wp_body_open', 'add_code_on_body_open');
function add_code_on_body_open() {
  ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KCTGB6Z"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
  <?php
}
