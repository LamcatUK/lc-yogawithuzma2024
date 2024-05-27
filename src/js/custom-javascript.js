// Add your custom JS here.

// const lightbox = GLightbox();

document.addEventListener('DOMContentLoaded', function() {
  const navbar = document.getElementById('navholder');

  let lastScrollPosition = 0;
  const navbarHeight = 0; // Get the height of the navbar
  const smallerScrollThreshold = 250; // Threshold for adding the .smaller class

  window.addEventListener('scroll', function() {
      const currentScroll = window.scrollY || document.documentElement.scrollTop;
  
      if (currentScroll > navbarHeight) {
          if (currentScroll > lastScrollPosition) {
              // Down scroll
              navbar.classList.add('hidden');
          } else {
              // Up scroll
              navbar.classList.remove('hidden');
          }
      }
  
      if (currentScroll > smallerScrollThreshold) {
          navbar.classList.add('smaller');
      } else {
          navbar.classList.remove('smaller');
      }

      lastScrollPosition = currentScroll <= 0 ? 0 : currentScroll;
  });

});


// document.addEventListener('DOMContentLoaded', function() {
//   const navbar = document.getElementById('navholder');

//   let lastScrollPosition = 0;
//   const navbarHeight = 0; // Get the height of the navbar
  
//   window.addEventListener('scroll', function() {
//       const currentScroll = window.scrollY || document.documentElement.scrollTop;
  
//       if (currentScroll > navbarHeight) {
//           if (currentScroll > lastScrollPosition) {
//               // Down scroll
//               navbar.classList.add('hidden');
//           } else {
//               // Up scroll
//               navbar.classList.remove('hidden');
//           }
//       }
  
//       lastScrollPosition = currentScroll <= 0 ? 0 : currentScroll;
//   });

// });

// (function(){
//     // hide header on scroll
  
//     var doc = document.documentElement;
//     var w = window;
  
//     var prevScroll = w.scrollY || doc.scrollTop;
//     var curScroll;
//     var direction = 0;
//     var prevDirection = 0;
  
//     var header = document.getElementById('wrapper-navbar');
  
//     var checkScroll = function() {
  
//       /*
//       ** Find the direction of scroll
//       ** 0 - initial, 1 - up, 2 - down
//       */
  
//       curScroll = w.scrollY || doc.scrollTop;
//       if (curScroll > prevScroll) { 
//         //scrolled up
//         direction = 2;
//       }
//       else if (curScroll < prevScroll) { 
//         //scrolled down
//         direction = 1;
//       }
  
//       if (direction !== prevDirection) {
//         toggleHeader(direction, curScroll);
//       }
  
//       prevScroll = curScroll;
//     };
  
//     var toggleHeader = function(direction, curScroll) {
//       if (direction === 2 && curScroll > 52) { 
  
//         //replace 52 with the height of your header in px
//         if (!document.getElementById('navbar').classList.contains("show")) {
//             header.classList.add('hide');
//             prevDirection = direction;
//         }
//       }
//       else if (direction === 1) {
//         header.classList.remove('hide');
//         prevDirection = direction;
//       }
//     };
  
//     window.addEventListener('scroll', checkScroll);
  
//       // header background
  
//     $(document).on('scroll', function () {
//       var $nav = $("#navbar");
//       // $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height() );
//       if (!$('#primaryNav').hasClass('show')) {
//         $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height() );
//       }
//     });
  
//     $('#navToggle').on('click', function(){
//       var $nav = $("#navbar");
//       $nav.toggleClass('navdark');
//     });
  
  
// })(jQuery);
  