// ページをリロードしてもスクロール位置を保持
$(window).scroll(function() {
  sessionStorage.scrollTop = $(this).scrollTop();
});
$(document).ready(function() {
  if (sessionStorage.scrollTop != "undefined") {
    $(window).scrollTop(sessionStorage.scrollTop);
  }
});