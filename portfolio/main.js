// スムーズにスクロール
var indexLink = document.querySelectorAll('a[href^="#"]');
  for (let i=0; i<indexLink.length; i++){
    indexLink[i].addEventListener('click', (e) => {
      e.preventDefault();
      let href = indexLink[i].getAttribute('href');
      let targetElement = document.getElementById(href.replace('#', ''));
      const nowOffset = window.pageYOffset;
      const targetOffset = targetElement.getBoundingClientRect().top;
      const gap = 10;
      const offset = nowOffset + targetOffset - gap;
      window.scrollTo({
        top: offset,
        behavior: 'smooth',
      });
    });
  }