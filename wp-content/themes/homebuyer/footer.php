<?php
$hostname = parse_url(get_site_url(), PHP_URL_HOST);
$target = 'https://app.homebuyer.com';

if (preg_match("/local/i", $hostname)) {
    $target = 'http://localhost:3000';
} else if (preg_match("/stage/i", $hostname)) {
    $target = 'https://app-staging.homebuyer.com';
}
?><div class="footer a" role="complementary">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6 first quarter left widget-area">
				<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
			</div><!-- .first .widget-area -->

			<div class="col-lg-3  col-md-6 second quarter widget-area">
				<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
			</div><!-- .second .widget-area -->

			<div class="col-lg-3 col-md-6 third quarter widget-area">
				<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
			</div><!-- .third .widget-area -->

			<div class="col-lg-3 col-md-6 fourth quarter right widget-area">
				<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
			</div><!-- .fourth .widget-area -->
		</div>

		<div class="row">
			<div class="col-md-12">
				<ul class="social_links">
					<!--<li><a href="https://www.facebook.com/homebuyercom" target="_blank" aria-label="go to facebook"><span class="mdi mdi-facebook"></span></a></li>
					<li><a href="https://twitter.com/homebuyer" target="_blank" aria-label="go to twitter"><span class="mdi mdi-twitter"></span></a></li>
					<li><a href="https://www.instagram.com/homebuyercom" target="_blank" aria-label="go to instagram"><span class="mdi mdi-instagram"></span></a></li>-->
					<li><a href="https://www.linkedin.com/company/homebuyer" target="_blank" aria-label="go to linkedin"><span class="mdi mdi-linkedin"></span></a></li>
					<li><a href="https://www.youtube.com/homebuyermortgage" target="_blank" aria-label="go to youtube"><span class="mdi mdi-youtube"></span></a></li>
				</ul>
			</div>
		</div>
		<div class="footer_bottom">
			<div class="row">
			<div class="col-md-6 col-lg-4 col-xl-5 bottom quarter left widget-area">
				<?php dynamic_sidebar( 'bottom-footer-widget-area' ); ?>
			</div>
			<div class="col-md-6 col-lg-6 copyright quarter left widget-area">
				<?php dynamic_sidebar( 'copyright-footer-widget-area' ); ?>
			</div>
			</div>
		</div>
	</div>
</div>
<div class="d-none footer-cta">
    <a data-category="Pre-approval" data-action="Click" data-label="bottom-banner-text" href="<?php echo $target; ?>">Get Pre-approved »</a>
</div>

<script>
jQuery(document).ready(function (e) {
    function t(t) {
        e(t).bind("click", function (t) {
            t.preventDefault();
            e(this).parent().fadeOut()
        })
    }
    e(".dropdown-toggle").click(function () {
        var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(":hidden");
        e(".button-dropdown .dropdown-menu").hide();
        e(".button-dropdown .dropdown-toggle").removeClass("active");
        if (t) {
            e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(".button-dropdown").children(".dropdown-toggle").addClass("active")
        }
    });
    e(document).bind("click", function (t) {
        var n = e(t.target);
        if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu").hide();
    });
    e(document).bind("click", function (t) {
        var n = e(t.target);
        if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle").removeClass("active");
    })

    jQuery(document).on('click','.cross-notification',function(){
      jQuery(this).closest('.custom__notification').hide();
      jQuery('body').addClass('no-custom-notification');
    });

});
</script>
<script>
function openNav() {
  document.getElementById("navbarSupportedContent").style.width = "100%";
}
function closeNav() {
  document.getElementById("navbarSupportedContent").style.width = "0";
}
</script>

<script>
  jQuery(function($){
    var toggle = '[data-toggle="dropdown"]';

    function toggleActive(currentItem) {
      var parent = currentItem.parent(),
          currentAttr = currentItem.attr('aria-expanded'),
          newAttr = currentAttr == 'false' ? 'true' : 'false';
  
      parent.toggleClass('show');
      parent.find('.dropdown-menu').toggleClass('show');
      currentItem.attr('aria-expanded', newAttr);
    }

    $(toggle).click(function(e) {
      e.preventDefault();

      var currentItem = $(this);
      
      if (currentItem.parent().hasClass('show')) {
        toggleActive(currentItem);
      } else {
        $(toggle).attr('aria-expanded', 'false');
        $(toggle).parent().removeClass('show');
        $(toggle).parent().find('.dropdown-menu').removeClass('show');

        toggleActive(currentItem);
      }
    });
  
    $(function() {
      $("#btnClose").click(function(evt) {
        $("#dvNotify").slideUp('slow');
      });
      $("#btnShow").click(function(evt) {
        $("#dvNotify").slideDown('slow');
      });
    });

    function throttle(callback, delay) {
        var timeoutHandler = null;
        return function () {
            if (timeoutHandler == null) {
                timeoutHandler = setTimeout(function () {
                    callback();
                    timeoutHandler = null;
                }, delay);
            }
        }
    }

    var lastScrollTop = 0;
    $(window).scroll(throttle(function(){
        var scrollTop = $(this).scrollTop();
        if (scrollTop > 66 && scrollTop > lastScrollTop) {
            // downscroll code - hide header
            if (!$('.header').hasClass('hidden')) {
                $('.header').addClass('hidden');
            }
        } else {
            // upscroll code - show header
            if ($('.header').hasClass('hidden')) {
                $('.header').removeClass('hidden');
            }
        }
        lastScrollTop = scrollTop;
    }, 350));

    if ($("#counter").length){ 
      var a = 0;
      $(window).scroll(function() {
        var oTop = $('#counter').offset().top - window.innerHeight;
        if (a == 0 && $(window).scrollTop() > oTop) {
          $('.counter-value').each(function() {
            var $this = $(this),
              countTo = $this.attr('data-count');
            $({
              countNum: $this.text()
            }).animate({
                countNum: countTo
              },

              {
                duration: 2000,
                easing: 'swing',
                step: function() {
                  $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                  $this.text(this.countNum);
                  //alert('finished');
                }
              });
          });
          a = 1;
        }

      });
    }
  });
</script>

<?php wp_footer(); ?>
</body>
</html>
