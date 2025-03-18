<HTML>

<head>
  <TITLE>Thông báo chuyển trang</TITLE>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="REFRESH" content="5; url=<?= $page_transfer ?>">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
  <style type="text/css" media="screen">
    body {
      background-color: #f2f2f2
    }

    .page-center {
      max-width: 600px;
      background-color: #fff;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      padding: 30px;
      font-family: 'Arial';
      margin: 100px auto;
      border-radius: 4px
    }

    div.noidung {
      width: 100%;
      text-align: center;
    }

    .noidung p.noidung {
      color: #000;
      font-size: 15px;
    }

    .noidung p.click_here a {
      color: #000;
      font-size: 15px;
    }

    .svg__page {
      width: 50px;
      border-radius: 50%;
      border: 5px solid #0dcaf0;
      margin: 0 auto
    }

    .svg__page svg {
      fill: #0dcaf0
    }
  </style>
</head>

<body>
  <div class="page-center">
    <div class="noidung">
      <p class="svg__page"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
          <path d="M4.03033009,7.46966991 C3.73743687,7.1767767 3.26256313,7.1767767 2.96966991,7.46966991 C2.6767767,7.76256313 2.6767767,8.23743687 2.96966991,8.53033009 L6.32804531,11.8887055 C6.62093853,12.1815987 7.09581226,12.1815987 7.38870548,11.8887055 L13.2506629,6.02674809 C13.5435561,5.73385487 13.5435561,5.25898114 13.2506629,4.96608792 C12.9577697,4.6731947 12.4828959,4.6731947 12.1900027,4.96608792 L6.8583754,10.2977152 L4.03033009,7.46966991 Z"></path>
        </svg></p>
      <p class="noidung" style="font-weight:bold">
        THÔNG BÁO
      </p>
      <p class="noidung">
        <?= $showtext ?>
      </p>
      <p>-----------------------------------------</p>
      <p class="click_here">
        <a href="<?= $page_transfer ?>">(Click vào đây nếu bạn không muốn đợi lâu)</a>
      </p>
    </div>
  </div>
</body>

</HTML>