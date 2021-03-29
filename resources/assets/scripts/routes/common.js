import SimpleLightbox from 'simplelightbox';
import Lightense from 'lightense-images';

export default {
  init() {
    // JavaScript to be fired on all pages
  },
  finalize() {
    setupLightbox()
    toggleNavbar()
    hideNewBtn()
    showNewBtn()
    scrollTop()
    showScrollBtn()
    hideNavbar()
    navbarHoverAnimationSetup()
    console.log('finalize')
    // JavaScript to be fired on all pages, after page specific JS is fired

    function setupLightbox () {
      let gallery = new SimpleLightbox('.gallery a', {
        animationSlide: false,
        fadeSpeed: 100,
        swipeClose: false,
      });
      console.log(gallery)
    }

  //  let elements = $('.vin-img-img')

    // Lightense({
    //   time: 300,
    //   padding: 40,
    //   offset: 40,
    //   keyboard: true,
    //   cubicBezier: 'cubic-bezier(.2, 0, .1, 1)',
    //   background: 'rgba(255, 255, 255, .98)',
    //   zIndex: 2147483647,
    // });

  

    window.addEventListener('load', function () {
      Lightense('.vin-img-img');
    }, false);

    $('.vin-img-img').on('click', function () {
      $('.vin-img').toggleClass('zoom')
    })

    function toggleNavbar () {
      // console.log('click')
      $('.navbar button').on('click', function () {
        $('.navbar button').toggleClass('is-active')
      })
    }
    
    function hideNewBtn () {
      $('.show-news').on('click', function () {
        console.log('show news clicked')
        $('.show-news').addClass('hide-news-btn')
      })
    }

    function showNewBtn () {
      $('.hide-news').on('click', function () {
        console.log('show news clicked')
        $('.show-news').removeClass('hide-news-btn')
      })
    }

    function scrollTop () {
      $('.toTop').on('click', function () {
        console.log('totop clicked')
        $('html, body').animate({
          scrollTop: $('body').offset().top -30,
      }, 600);
      })
    }

      // function showScrollBtn() {
      //   $('body').scroll(function () {
      //     if ($(this).scrollTop()>30) {
      //       console.log('show')
      //     $('.toTop').css('display', 'block')
      //   } else {
      //     $('.toTop').css('display', 'none');
      //     console.log('hide')
      //   }
      // })
    // }


      function showScrollBtn() {
      $(window).scroll(function() {
        // var windowH = $(window).height();
        if ($(this).scrollTop() < 30) {
          $('.toTop').css('display', 'none');
        } else {
          $('.toTop').css('display', 'block')
        }
      });
    }

    function navbarHoverAnimationSetup () {
      setTimeout(function(){
        $('.button-stroke').css('display', 'block')
      }, 1000);
    }

    function hideNavbar () {
      $(window).scroll(function() {
        if ($(this).scrollTop() > 100 && $('.navbar-collapse').hasClass('show')) {
          console.log('scroll')
          $('.navbar-nav').addClass('disapear')
          $('.nav-item').css('visibility', 'hidden')
          $('.navbar-toggler').removeClass('is-active')

          setTimeout(function(){
            $('.navbar-collapse').removeClass('show')
          }, 1000)

          setTimeout(function(){
          $('.navbar-nav').removeClass('disapear')
          $('.nav-item').css('visibility', 'visible')

          }, 1000);
        }
      })
    }
  },
};
