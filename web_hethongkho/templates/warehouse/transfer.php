<HTML>

<head>
    <TITLE>Thông báo chuyển trang</TITLE>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="REFRESH" content="5; url=<?= $page_transfer ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
    <style type="text/css" media="screen">
        body {
            background: rgb(14 116 144);
            position: relative;
            margin: 0px;
            overflow: hidden;
        }

        .form_tranfer {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form_tranfer .content_tranfer {
            max-width: 600px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 1px 1px 12px 1px rgb(0 0 0 / 0.18);
            padding: 25px 35px;
            position: relative;
            z-index: 1;
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
            max-width: 100px;
            margin: 0 auto
        }
    </style>
</head>

<body class="">
    <canvas id="test" style="position: absolute;top: 0;left: 0; width: 100%;height: 100%;"></canvas>
    <section>
        <div class=" form_tranfer">
            <div class="content_tranfer">
                <div class="noidung">
                    <p class="svg__page">
                        <?php
                        switch ($check_svg) {
                            case  true:
                        ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
                                    <g clip-path="url(#clip0_1_1202)">
                                        <path d="M25 0C11.1934 0 0 11.1895 0 25C0 38.8105 11.1934 50 25 50C38.8066 50 50 38.8037 50 25C50 11.1963 38.8066 0 25 0Z" fill="#2AD352" />
                                        <path d="M2.32168e-05 25C-0.00562026 29.1323 1.01767 33.2009 2.97756 36.8389C5.47452 37.572 8.06369 37.9433 10.666 37.9414C25.6953 37.9414 37.8789 25.7578 37.8789 10.7285C37.8812 8.08491 37.4982 5.45508 36.7422 2.92188C33.1281 0.996803 29.0949 -0.00681503 25 4.00005e-06C11.1934 4.00005e-06 2.32168e-05 11.1895 2.32168e-05 25Z" fill="#74DA7F" />
                                        <path d="M39.2579 20.8574L24.2315 36.6377C23.822 37.0673 23.33 37.4098 22.785 37.6447C22.2399 37.8796 21.6531 38.0021 21.0596 38.0049H21.0401C20.4499 38.005 19.8657 37.8866 19.3221 37.6566C18.7786 37.4266 18.2868 37.0897 17.876 36.666L9.90238 28.4531C9.49039 28.0396 9.16464 27.5483 8.94404 27.0079C8.72343 26.4674 8.61237 25.8885 8.61728 25.3048C8.6222 24.7211 8.743 24.1441 8.97268 23.6075C9.20236 23.0708 9.53635 22.5851 9.95524 22.1786C10.3741 21.772 10.8696 21.4527 11.4129 21.2392C11.9562 21.0257 12.5365 20.9222 13.1201 20.9348C13.7037 20.9473 14.279 21.0756 14.8126 21.3123C15.3462 21.549 15.8275 21.8893 16.2286 22.3135L21.0088 27.2373L32.8731 14.7783C33.2705 14.3522 33.7485 14.009 34.2794 13.7688C34.8103 13.5285 35.3836 13.3959 35.966 13.3786C36.5485 13.3613 37.1286 13.4597 37.6729 13.668C38.2171 13.8763 38.7146 14.1905 39.1366 14.5923C39.5586 14.9941 39.8968 15.4756 40.1316 16.009C40.3663 16.5423 40.493 17.1169 40.5043 17.6996C40.5156 18.2822 40.4112 18.8613 40.1973 19.4033C39.9833 19.9453 39.664 20.4396 39.2579 20.8574Z" fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1_1202">
                                            <rect width="50" height="50" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            <?php break;
                            case  false:
                            ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
                                    <g clip-path="url(#clip0_1_1207)">
                                        <path d="M50 25C50 26.0937 50 27.0313 49.8437 28.125C49.6875 29.0625 49.5313 30 49.375 30.9375C48.125 36.25 45.1562 40.7812 41.0937 44.2187C40.9375 44.375 40.625 44.5313 40.4687 44.6875C39.0625 45.7813 37.5 46.7187 35.7812 47.5C35.4687 47.6562 35.1562 47.8125 34.8437 47.9688C33.4375 48.5938 32.1875 49.0625 30.625 49.375C29.8438 49.5313 29.2188 49.6875 28.4375 49.8437C27.1875 50 26.0937 50 25 50C11.25 50 0 38.75 0 25C0 11.25 11.25 0 25 0C38.75 0 50 11.25 50 25Z" fill="#EF4639" />
                                        <path d="M49.8437 28.125C49.6875 29.0625 49.5313 30 49.375 30.9375C48.125 36.25 45.1562 40.7812 41.0937 44.2188C40.9375 44.375 40.625 44.5313 40.4687 44.6875C39.0625 45.7813 37.5 46.7188 35.7812 47.5C35.4687 47.6563 35.1562 47.8125 34.8437 47.9688C33.4375 48.5938 32.1875 49.0625 30.625 49.375C29.8438 49.5313 29.2188 49.6875 28.4375 49.8438L14.375 35.7812C13.4375 34.8437 13.4375 33.2813 14.375 32.1875L21.5625 25L14.375 17.8125C13.4375 16.875 13.4375 15.3125 14.375 14.2188C15.3125 13.2813 16.875 13.2813 17.9688 14.2188L18.2813 14.5313L18.9063 15.1562L20.9375 17.1875L21.5625 17.8125L23.5938 19.8437L24.2188 20.4688L25.3125 21.5625L32.1875 14.0625C33.125 13.125 34.6875 13.125 35.7812 14.0625L49.8437 28.125Z" fill="#E2382F" />
                                        <path d="M35.7813 32.0312C36.7188 32.9687 36.7188 34.5312 35.7813 35.625C35.3125 36.0937 34.6875 36.4062 34.0625 36.4062C33.4375 36.4062 32.8125 36.0937 32.3438 35.625L25 28.4375L17.8125 35.625C17.3438 36.0937 16.7188 36.4062 16.0938 36.4062C15.4688 36.4062 14.8438 36.0937 14.375 35.625C13.4375 34.6875 13.4375 33.125 14.375 32.0312L21.5625 24.8437L14.375 17.6563C13.4375 16.7188 13.4375 15.1563 14.375 14.0625C15.3125 13.125 16.875 13.125 17.9688 14.0625L25.1563 21.25L32.1875 14.0625C33.125 13.125 34.6875 13.125 35.7813 14.0625C36.7188 15 36.7188 16.5625 35.7813 17.6563L28.5937 24.8437L35.7813 32.0312Z" fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1_1207">
                                            <rect width="50" height="50" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                        <?php break;
                            default:
                                echo $check_svg;
                                break;
                        }
                        ?>


                    </p>
                    <p class="noidung" style="font-weight:bold;font-size: 24px;">
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
        </div>
    </section>
</body>
<script>
    var w = window.innerWidth,
        h = window.innerHeight,
        canvas = document.getElementById('test'),
        ctx = canvas.getContext('2d'),
        rate = 60,
        arc = 150, // More particles
        time,
        count,
        size = 8, // Larger particles
        speed = 25, // Faster speed
        gravity = 0.3, // Gravity effect
        parts = new Array,
        colors = ['#3498db', '#e74c3c', '#f1c40f', '#8e44ad', '#2ecc71'];
    var mouse = {
        x: 0,
        y: 0
    };

    // Corrected this line
    canvas.setAttribute('width', w);
    canvas.setAttribute('height', h);

    function create() {
        time = 0;
        count = 0;

        for (var i = 0; i < arc; i++) {
            parts[i] = {
                x: Math.ceil(Math.random() * w),
                y: Math.ceil(Math.random() * h),
                toX: Math.random() * 5 - 1,
                toY: Math.random() * 2 - 1 + gravity, // Added gravity to vertical movement
                c: colors[Math.floor(Math.random() * colors.length)],
                size: Math.random() * size
            };
        }
    }

    function particles() {
        ctx.clearRect(0, 0, w, h);
        canvas.addEventListener('mousemove', MouseMove, false);

        for (var i = 0; i < arc; i++) {
            var li = parts[i];
            var distanceFactor = DistanceBetween(mouse, parts[i]);
            var distanceFactor = Math.max(Math.min(15 - (distanceFactor / 10), 10), 1);
            ctx.beginPath();
            ctx.arc(li.x, li.y, li.size * distanceFactor, 0, Math.PI * 2, false);
            ctx.fillStyle = li.c;
            ctx.strokeStyle = li.c;

            if (i % 2 == 0)
                ctx.stroke();
            else
                ctx.fill();

            // Movement with gravity effect
            li.x = li.x + li.toX * (time * 0.05);
            li.y = li.y + li.toY * (time * 0.05);

            if (li.x > w) {
                li.x = 0;
            }
            if (li.y > h) {
                li.y = 0;
            }
            if (li.x < 0) {
                li.x = w;
            }
            if (li.y < 0) {
                li.y = h;
            }
        }

        if (time < speed) {
            time++;
        }

        setTimeout(particles, 1000 / rate);
    }

    function MouseMove(e) {
        mouse.x = e.layerX;
        mouse.y = e.layerY;
    }

    function DistanceBetween(p1, p2) {
        var dx = p2.x - p1.x;
        var dy = p2.y - p1.y;
        return Math.sqrt(dx * dx + dy * dy);
    }

    create();
    particles();
</script>

</HTML>