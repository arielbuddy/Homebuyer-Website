<?php

/*******************************************************************************
 *  Add Org Schema for SEO. See ./includes/orgschema.php
 */

function org_schema() {
  echo <<<EOL
  <script type="application/ld+json">
  {
      "@context": "http://schema.org",
      "@type": "Corporation",
      "name": "Homebuyer",
      "description": "Homebuyer.com is the best mortgage lender for first-time home buyers. We make the mortgage process fast & easy.",
      "image": "https://homebuyer.com/wp-content/uploads/2022/02/homepage-illustration.png",
      "logo": "https://homebuyer.com/wp-content/uploads/2022/03/homebuyer-logo.png",
      "url": "https://homebuyer.com",
      "telephone": "(513) 824-8171",
      "sameAs": ["https://twitter.com/homebuyer","https://www.linkedin.com/company/homebuyer","https://www.facebook.com/homebuyercom","https://www.youtube.com/homebuyermortgage","https://www.instagram.com/homebuyercom","https://www.crunchbase.com/organization/homebuyer"],
      "address": {
          "@type": "PostalAddress",
          "streetAddress": "230 Findlay Street, Second Floor",
          "addressLocality": "Cincinnati",
          "postalCode": "45214",
          "addressCountry": "USA"
      }
  }
  </script>
EOL;
}
add_action( 'wp_head', 'org_schema', 10 );
