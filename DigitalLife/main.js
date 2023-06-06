// ハンバーグメニュー
const navMenu = document.querySelector(".header-nav");
const hamBtn = document.querySelector("#ham-btn");
const circleContainer = document.querySelector(".circle-btn-container");
hamBtn.addEventListener("click", () => {
  hamBtn.classList.toggle("open");
  navMenu.classList.toggle("open");
  circleContainer.classList.toggle("open");
});
navMenu.addEventListener("click", () => {
  hamBtn.classList.remove("open");
  navMenu.classList.remove("open");
  circleContainer.classList.remove("open");
})

// 一番上に戻る
const BackToTopBtn = document.querySelector(".circle-btn-top");
BackToTopBtn.addEventListener("click", (e) => {
  e.preventDefault();
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
});

const fv = document.querySelector(".fv");
window.addEventListener("scroll", () => {
  const fvHeight = fv.getBoundingClientRect().top;
  if(fvHeight < -150){
    BackToTopBtn.classList.add("black");
  } else {
    BackToTopBtn.classList.remove("black");
  }
});

const header = document.querySelector(".header");
window.addEventListener("scroll", () => {
  const fvHeight = fv.getBoundingClientRect().bottom; //スクロールするごとに位置取得
  if(0 >= fvHeight) {
    header.classList.add("fixed");
  } else if(0 < fvHeight) {
    header.classList.remove("fixed");
  }
});


// スムーズにスクロール
var indexLink = document.querySelectorAll('a[href^="#"]');
  for (let i=0; i<indexLink.length; i++){
    indexLink[i].addEventListener('click', (e) => {
      e.preventDefault();
      let href = indexLink[i].getAttribute('href');
      let targetElement = document.getElementById(href.replace('#', ''));
      const nowOffset = window.pageYOffset;
      const targetOffset = targetElement.getBoundingClientRect().top;
      const gap = 100;
      const offset = nowOffset + targetOffset - gap;
      window.scrollTo({
        top: offset,
        behavior: 'smooth',
      });
    });
  }

//scroll_effect
var scrollAnimationElms = document.querySelectorAll(
  '.scroll_up, .scroll_left, .scroll_right, .scroll_center, .scroll_rotateX_left, .scroll_rotateX_right');

var scrollAnimationFunc = function () {
  for (var i = 0; i < scrollAnimationElms.length; i++) {
    var triggerMargin = 150;
    if (window.innerHeight > scrollAnimationElms[i].getBoundingClientRect().top + triggerMargin) {
      scrollAnimationElms[i].classList.add('on');
    }
  }
  // typing_effect
  var el = document.querySelectorAll(".myText.active");
  for(i=0; i<el.length; i++) {
    var triggerMargin = 100;
    if (window.innerHeight > el[i].getBoundingClientRect().top + triggerMargin) {
      var text = new ShuffleText(el[i]);
      text.start();
      el[i].classList.remove('active');
    }
  }
}
window.addEventListener('load', scrollAnimationFunc);
window.addEventListener('scroll', scrollAnimationFunc);

// スライドショー
$(function() {
  $('.video1').on('loadedmetadata', function() {
  var $video1 = $('.video1').get(0),
      $video2 = $('.video2').get(0),
      $video3 = $('.video3').get(0),
      videoTime1 = Math.floor($video1.duration * 1000),
      videoTime2 = Math.floor($video2.duration * 1000),
      videoTime3 = Math.floor($video3.duration * 1000);
    $video1.play();
    $('.slider').slick({
      autoplay: true,
      arrows: false,
      fade: true,
      autoplaySpeed: 1500,
      swipe: false,
      pauseOnHover: false,
      pauseOnFocus: false,
      dots: true,
      dotsClass: 'video_dots',
    }).on('afterChange', function(event, slick, currentSlide, nextSlide) {
      switch (currentSlide) {
        case 0:
          $(this).slick('slickSetOption', 'autoplaySpeed', videoTime1);
          $video1.play();
          $video2.pause();
          $video2.currentTime = 0;
          $video3.pause();
          $video3.currentTime = 0;
          break;
        case 1:
          $(this).slick('slickSetOption', 'autoplaySpeed', videoTime2);
          $video2.play();
          $video1.pause();
          $video1.currentTime = 0;
          $video3.pause();
          $video3.currentTime = 0;
          break;
        case 2:
          $(this).slick('slickSetOption', 'autoplaySpeed', videoTime3);
          $video3.play();
          $video1.pause();
          $video1.currentTime = 0;
          $video2.pause();
          $video2.currentTime = 0;
          break;
      }
    });
  });
});