// スムーズにスクロール
var indexLink = document.querySelectorAll('a[href^="#"]');
  for (let i=0; i<indexLink.length; i++){
    indexLink[i].addEventListener('click', (e) => {
      e.preventDefault();
      let href = indexLink[i].getAttribute('href');
      let targetElement = document.getElementById(href.replace('#', ''));
      const nowOffset = window.pageYOffset;
      const targetOffset = targetElement.getBoundingClientRect().top;
      const gap = 20;
      const offset = nowOffset + targetOffset - gap;
      window.scrollTo({
        top: offset,
        behavior: 'smooth',
      });
    });
  }

//scroll_effect
var scrollAnimationElms = document.querySelectorAll(
  '.scroll_up, .scroll_left, .scroll_right, .scroll_center,.scroll_rotateX_left, .scroll_rotateX_right, .flip-scale-2-ver-left, .flip-scale-2-ver-right');
var scrollAnimationFunc = function () {
  for (var i = 0; i < scrollAnimationElms.length; i++) {
    var triggerMargin = 100;
    if (window.innerHeight > scrollAnimationElms[i].getBoundingClientRect().top + triggerMargin) {
      scrollAnimationElms[i].classList.add('on');
    }
  }
}
window.addEventListener('load', scrollAnimationFunc);
window.addEventListener('scroll', scrollAnimationFunc);