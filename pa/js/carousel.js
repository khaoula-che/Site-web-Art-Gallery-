var carousel = document.querySelector('.carousel');
var carouselContainer = carousel.querySelector('.carousel-container');
var carouselItems = carouselContainer.querySelectorAll('.carousel-item');
var carouselPrev = carousel.querySelector('.carousel-prev');
var carouselNext = carousel.querySelector('.carousel-next');

var slideWidth = carouselItems[0].clientWidth;
var currentIndex = 0;

carouselPrev.addEventListener('click', function() {
  if (currentIndex > 0) {
    currentIndex--;
    carouselContainer.style.transform = 'translateX(-' + (slideWidth * currentIndex) + 'px)';
  }
});

carouselNext.addEventListener('click', function() {
  if (currentIndex < carouselItems.length - 1) {
    currentIndex++;
    carouselContainer.style.transform = 'translateX(-' + (slideWidth * currentIndex) + 'px)';
  }
});
