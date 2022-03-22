const menu = document.querySelector('#mobile-menu');
const menuLinks = document.querySelector('.navbar__menu');

menu.addEventListener('click', function() {
    menu.classList.toggle('is-active');
    menuLinks.classList.toggle('active');
});

var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 4000); // Change image every 4 seconds
}
function DoubleScroll(element) {
  var scrollbar = document.createElement('div');
  scrollbar.appendChild(document.createElement('div'));
  scrollbar.style.overflow = 'auto';
  scrollbar.style.overflowY = 'hidden';
  scrollbar.firstChild.style.width = element.scrollWidth+'px';
  scrollbar.firstChild.style.paddingTop = '1px';
  scrollbar.firstChild.appendChild(document.createTextNode('\xA0'));
  scrollbar.onscroll = function() {
      element.scrollLeft = scrollbar.scrollLeft;
  };
  element.onscroll = function() {
      scrollbar.scrollLeft = element.scrollLeft;
  };
  element.parentNode.insertBefore(scrollbar, element);
}

DoubleScroll(document.getElementById('doublescroll'));
