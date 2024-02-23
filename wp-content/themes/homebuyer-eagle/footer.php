<?php 
  ['slug' => $slug] = $args;
  $no_cta = ['subscribe', 'subscribe-thank-you', 'subscription-confirmed', 'referral-hub'];
?>
      <?php if (!in_array($slug, $no_cta)) { ?>

        <!-- Nurla CTA
        ================================================== -->

        <div class="w-full bg-gradient-to-r from-brand-purple from-20% to-brand-purple-dark">
          <div class="max-w-screen-xl mx-auto h-full flex flex-col justify-center px-6 py-12 md:px-20 lg:px-40 md:py-24 md:flex-row md:justify-between md:items-center">
            <div>
              <h2 class="leading-relaxed text-center md:text-left text-white mb-4 md:m-0">Ready to get started?</h2>
              <p class="text-center text-white mb-12 md:m-0 md:text-left">Finding your dream starts here. Apply in minutes.</p>
            </div>
            <div>
              <a href="https://app.homebuyer.com" data-category="Pre-approval" data-action="Click" data-label="bottom-banner-button" class="btn-inverted md:btn-inverted-large">
                Get Pre-approved
              </a>
            </div>
          </div>
        </div>
      <?php } ?>

      <!-- Footer Menus
      ================================================== -->

      <div class="w-full bg-brand-purple-lighter md:bg-white">
        <div class="max-w-screen-xl mx-auto h-full px-6 py-8 md:flex md:px-10">
          <div class="grid gap-11 grid-cols-1 md:grid-cols-5">
            <div class="flex flex-col">
              <img class="mb-4 w-48" src="<?php echo get_template_directory_uri(); ?>/images/homebuyer-logo.png" alt="Homebuyer.com logo">
              <label class="text-brand-gray">Mortgages for first-time home buyers. Member FDIC. Equal Housing Lender.</label>
              <div class="flex gap-4 mt-4">
                <img class="w-12" src="<?php echo get_template_directory_uri(); ?>/images/equal-housing-lender.svg" alt="Equal Housing Lender">
                <img class="w-12" src="<?php echo get_template_directory_uri(); ?>/images/fdic-member.svg" alt="Member FDIC">
              </div>
            </div>
            <?php
              $output = '';
              ob_start();

              get_template_part(
                'partials/footer-menu',
                null,
                [ 'slug' => 'footer-first-column-menu' ],
              );

              get_template_part(
                'partials/footer-menu',
                null,
                [ 'slug' => 'footer-second-column-menu' ],
              );

              get_template_part(
                'partials/footer-menu',
                null,
                [ 'slug' => 'footer-third-column-menu' ],
              );

              get_template_part(
                'partials/footer-menu',
                null,
                [ 'slug' => 'footer-fourth-column-menu' ],
              );

              $output = ob_get_clean();
              // Make shortcodes work in nav menu
              echo do_shortcode($output);
            ?>
          </div>
        </div>
      </div>

      <!-- Bottom of Footer
      ================================================== -->

      <div class="pb-16 md:pb-1 w-full bg-brand-purple-lighter md:bg-white">
        <div class="max-w-screen-xl mx-auto h-full px-6 py-8 md:px-10">
          <div class="pt-6 border-t-2 border-brand-gray-light">
            <small>
              &copy; 2021-2023 All rights reserved. Growella Inc d/b/a Homebuyer. Homebuyer.com is
              powered by Novus Home Mortgage, a division of Ixonia Bank, NMLS 423065.
              www.nmlsconsumeraccess.org Homebuyer is located at 230 Findlay Street, Cincinnati,
              Ohio 45202. Novus Home Mortgage, a division of Ixonia Bank, is located at 20225 Water
              Tower Blvd. Suite 400, Brookfield, WI 53045. We have no affiliation with the US
              Department of Housing and Urban Development, the US Department of Veterans Affairs,
              the US Department of Agriculture, or any other government agency. US Government
              agencies have not reviewed this information and this site is not connected with any
              government agency. Equal Housing Lender.  Applicant subject to credit and underwriting
              approval. Not all applicants will be approved for financing. The receipt of the
              application does not represent an approval for financing or interest rate guarantee.
              Restrictions may apply.
            </small>
          </div>
        </div>
      </div>
    </div>

    <!-- Nurla CTA (Mobile)
    ================================================== -->

    <div class="fixed z-30 h-16 w-full bottom-0 flex md:hidden bg-brand-blue justify-center items-center">
      <a class="text-white" data-category="Pre-approval" data-action="Click" data-label="bottom-banner-text" href="https://app.homebuyer.com">Get Started »</a>
    </div>
    <?php
      wp_footer();
      require_once('components.php');
    ?>
  </body>
</html>
