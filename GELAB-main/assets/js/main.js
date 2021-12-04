$('.ev-right-box').slick({
    infinite:false,
    speed:500,
    // autoplay:true,
    draggable:true,
    autoplaySpeed:5000,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow:$('#left-arrow'),
    nextArrow:$('#right-arrow'),
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 767,
        settings: {
          prevArrow:false,
          nextArrow:false,
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });


  $('.logo-slider').slick({
    infinite:false,
    speed:500,
    autoplay:true,
    draggable:true,
    autoplaySpeed:5000,
    slidesToShow: 5,
    slidesToScroll: 1,
    prevArrow:false,
    nextArrow:false,
    responsive: [
      {
        breakpoint: 1400,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 2,
          rows: 2,
          slidesToScroll: 1
        }
      }
      
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });





$(document).on('click', '.links-box a', function(){
  $(this).addClass('active-border').siblings().removeClass('active-border');
})


$(document).on('click', '.rotate', function(){
  if (!$(this).closest('.table-box').hasClass('opened')) {
    $('.table-box').removeClass('opened');    
  }
  $(this).closest('.table-box').toggleClass('opened'); 
});



var acc = document.getElementsByClassName("checks");
var i;

for (i = 0; i < acc.length; i++) {
  $(acc[i]).click(function(){
    $(this).toggleClass("check-active");
  }); 
}



$(window).scroll(function(){
  var headSticky = $('header'),
      scroll = $(window).scrollTop();

  if (scroll >= 1) headSticky.addClass('head-sticky');
  else headSticky.removeClass('head-sticky');
});

$(document).on('click', '.result-h', function(){
  if (!$(this).closest('.search-results').hasClass('result-height')) {
    $('.search-results').removeClass('result-height');    
  }
  $(this).closest('.search-results').toggleClass('result-height'); 
});
$('.burger-lines').on('click', function(){
  $('.burger-box').toggleClass('active-burger');
});


$(document).on('click', '.burger-link', function(){
  if (!$(this).closest('.burger-link').hasClass('burger-link-active')) {
    $('.burger-link').removeClass('burger-link-active');    
  }
  $(this).closest('.burger-link').toggleClass('burger-link-active'); 
});

// $(document).ready(function(){
//   $("#myInput").on("keyup", function() {
//     var value = $(this).val().toLowerCase();
//     $("#myTable ").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//     });
//   });
// });
