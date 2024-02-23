jQuery(function($){
  $('#education_course_testi').slick({
    centerMode: true,
    centerPadding: '350px',
    slidesToShow: 1,
    responsive: [
      {
        breakpoint:3500,
        settings: {
          slidesToShow: 1,
          centerPadding: '1000px',
          slidesToScroll: 1,
        }
      },
      {
        breakpoint:2500,
        settings: {
          slidesToShow: 1,
          centerPadding: '800px',
          slidesToScroll: 1,
        }
      },
      {
        breakpoint:2000,
        settings: {
          slidesToShow: 1,
          centerPadding: '550px',
          slidesToScroll: 1,
        }
      },
          {
        breakpoint: 1600,
        settings: {
          slidesToShow: 1,
          centerPadding: '450px',
          slidesToScroll: 1,
        }
      },
        {
        breakpoint: 1400,
        settings: {
          slidesToShow: 1,
          centerPadding: '350px',
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 1199,
        settings: {
          slidesToShow: 1,
          centerPadding: '200px',
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 2,
          centerPadding: '0',
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          centerPadding: '0',
          slidesToScroll: 1,
        }
      }
    ]
  });

  $( "#education_course_testi button" ).wrapAll( "<div class='slick_btn' />");

  $('.slick-carousel').slick({
    arrows: true,
    centerPadding: "0px",
    dots: true,
    slidesToShow: 1,
    infinite: false 
  });
});