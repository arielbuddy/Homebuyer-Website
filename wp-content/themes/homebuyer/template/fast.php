<?php
/*
Template Name: Fast
*/

$hostname = parse_url(get_site_url(), PHP_URL_HOST);
$target = 'https://app.homebuyer.com';

if (preg_match("/local/i", $hostname)) {
    $target = 'http://localhost:3000';
} else if (preg_match("/stage/i", $hostname)) {
    $target = 'https://app-staging.homebuyer.com';
}
?><!DOCTYPE html>
<html lang="en-US" prefix="og: https://ogp.me/ns#">
    <head>
        <script>
            (function(w,d,s,l,i) {
                w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});
                var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';
                j.async=true;
                j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
                f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-KCTGB6Z');

            window.dataLayer = window.dataLayer || [];
            dataLayer.push({
              event: 'gtm.redirect',
              gtmRedirectUrl: '<?php echo $target; ?>' + window.location.search,
            });

        </script>
      </head>
</html>
