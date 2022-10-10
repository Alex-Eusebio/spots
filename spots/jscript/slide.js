let slideIndex = 1;

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

function plusSlidesAuto(n) {
  showSlides(slideIndex += n);
  setTimeout(plusSlidesAuto, 8200, 1);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let imgs = document.getElementsByClassName("demoP");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  let titleText = document.getElementById("title");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
  titleText.innerHTML = imgs[slideIndex-1].alt;
}
