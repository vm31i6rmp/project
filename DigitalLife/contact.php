<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="img/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&family=Mallanna&family=Noto+Sans+JP:wght@100;200;300;400&family=Noto+Serif+JP:wght@300;400;500;600;700&family=Sofia+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">
  <title>Digital Life｜未経験からITエンジニアへ</title>
</head>
<body>
  <!-- ここからは header です -->
  <header class="header header-page">
    <h1 class="header-ttl">
      <a href="index.html">
        <div class="header-ttl-img">
          <img src="img/favicon.png" alt="デジタルＸ">
        </div>
        <div class="header-ttl-txt">Digital Life</div>
      </a>
    </h1>
    <nav class="header-nav">
      <ul>
        <li><a href="vision.html">企業理念<br class="br-pc"><p>Vision</p></a></li>
        <li><a href="business.html">事業分野<br class="br-pc"><p>Business</p></a></li>
        <li><a href="company.html">会社概要<br class="br-pc"><p>Company</p></a></li>
        <li><a href="recruit.html">採用情報<br class="br-pc"><p>Recruit</p></a></li>
      </ul>
    </nav>
    <div id="ham-btn">
      <div class="ham-btn-inner">
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
    <!-- <div id="cover"></div> -->
  </header>
  <!-- ここまでは header です -->
  <main style="z-index: 1;">
    <section id="contact" class="section section-page">
      <h3 class="section-ttl section-ttl-page">お問い合わせ<br><span>Contact</span></h3>
      <div class="vision-cnt">
        <!-- ここからは form です -->
        <form class="form-wrapper" action="" name="contact-form" method="post">
          <div class="form-q form-q1">
            <p>お問合せ種類</p>
            <div>
              <label>
                <input type="radio" name="form-q1">
                <span>お電話でのご相談を希望</span>
              </label>
              <label>
                <input type="radio" name="form-q1">
                <span>募集関連</span>
              </label>
              <label>
                <input type="radio" name="form-q1">
                <span>その他</span>
              </label>
            </div>
          </div>
          <div class="form-q">
            <label>
              <span class="required">お名前</span>
              <input type="text" required>
            </label>
          </div>
          <div class="form-q">
            <label>
              <span class="required">電話番号</span>
              <input type="tel" required>
            </label>
          </div>
          <div class="form-q">
            <label>
              <span class="required">メールアドレス</span>
              <input type="email" required>
            </label>
          </div>
          <div class="form-q">
            <label>
              <span class="required">お問い合わせ内容</span>
              <textarea name="contact-other" cols="30" rows="10" required></textarea>
            </label>
          </div>
          <button class="btn-submit">
            <div>
              <span>入力内容を送信する</span><br>
              <span class="en">Submit</span>
            </div>
          </button>
        </form>
        <!-- ここまでは form です -->
      </div>
      <div class="circle-btn-container">
        <a href="index.html" class="circle-btn circle-btn-homepage">
          <div class="circle-btn-txt">
            ホーム<br>ページ
            <p class="en">Home Page</p>
          </div>
        </a>
        <a class="circle-btn circle-btn-top">
          <div class="circle-btn-txt">
            <div class="top-arrow"></div>
            TOP
          </div>
        </a>
      </div>
    </section>
  </main>
  <footer class="footer">
    <div class="copyright">&copy; Digital Life 2023</div>
  </footer>
  <script src="page.js"></script>
</body>
</html>