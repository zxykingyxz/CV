<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Website Coming Soon Page</title>
    <style>
        /* Google Fonts - Poppins */
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .container {
            display: flex;
            row-gap: 15px;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        .container .image {
            position: absolute;
            height: 100%;
            width: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .container header {
            font-size: 60px;
            color: #fff;
            font-weight: 600;
            text-align: center;
        }

        .container p {
            font-size: 16px;
            font-weight: 400;
            color: #fff;
            max-width: 550px;
            text-align: center;
        }

        .container .time-content {
            display: flex;
            column-gap: 30px;
            align-items: center;
        }

        .time-content .time {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .time .number,
        .time .text {
            font-weight: 500;
            color: #fff;
        }

        .time .number {
            font-size: 40px;
        }

        .time .text {
            text-transform: capitalize;
            font-size: 12px;
        }

        .email-content {
            display: flex;
            align-items: center;
            flex-direction: column;
            margin-top: 30px;
            width: 100%;
        }

        .email-content p {
            font-size: 13px;
        }

        .input-box {
            display: flex;
            align-items: center;
            height: 40px;
            max-width: 360px;
            width: 100%;
            margin-top: 20px;
            column-gap: 20px;
        }

        .input-box input,
        .input-box button {
            height: 100%;
            outline: none;
            border: none;
            border: 1px solid #fff;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: 400;
        }

        .input-box input {
            width: 100%;
            padding: 0 15px;
            color: #fff;
        }

        /* input::placeholder {
        color: #fff;
    } */

        .input-box button {
            cursor: pointer;
            color: #fff;
            white-space: nowrap;
            padding: 0 20px;
            transition: all 0.3s ease;
        }

        .input-box button:hover {
            background-color: #fff;
            color: #0d6a81;
        }

        #bubbles-bg {

            width: 100%;

            height: 100vh;

            position: relative;

            overflow: hidden;

            -webkit-animation: bgcolor 20s linear infinite;

            animation: bgcolor 20s linear infinite;

            top: 0px;

            position: absolute;

            z-index: -1;

        }

        #bubbles-bg span {

            position: absolute;

            width: 80px;

            height: 80px;

            display: block;

            background-color: #fff;

            -webkit-animation: animate 10s linear infinite;

            animation: animate 10s linear infinite;

        }

        #bubbles-bg span:nth-child(3n + 1) {

            background-color: transparent;

            border: 2px solid #fff;

        }

        #bubbles-bg span:nth-child(1) {

            top: 50%;

            left: 20%;

        }

        #bubbles-bg span:nth-child(2) {

            top: 80%;

            left: 40%;

            -webkit-animation: animate 12s linear infinite;

            animation: animate 12s linear infinite;

        }

        #bubbles-bg span:nth-child(3) {

            top: 10%;

            left: 65%;

            -webkit-animation: animate 15s linear infinite;

            animation: animate 15s linear infinite;

        }

        #bubbles-bg span:nth-child(4) {

            top: 50%;

            left: 70%;

            -webkit-animation: animate 6s linear infinite;

            animation: animate 6s linear infinite;

        }

        #bubbles-bg span:nth-child(5) {

            top: 10%;

            left: 30%;

            -webkit-animation: animate 9s linear infinite;

            animation: animate 9s linear infinite;

        }

        #bubbles-bg span:nth-child(6) {

            top: 90%;

            left: 95%;

            -webkit-animation: animate 8s linear infinite;

            animation: animate 8s linear infinite;

        }

        #bubbles-bg span:nth-child(7) {

            top: 80%;

            left: 5%;

            -webkit-animation: animate 5s linear infinite;

            animation: animate 5s linear infinite;

        }

        #bubbles-bg span:nth-child(8) {

            top: 35%;

            left: 50%;

            -webkit-animation: animate 14s linear infinite;

            animation: animate 14s linear infinite;

        }

        #bubbles-bg span:nth-child(9) {

            top: 5%;

            left: 5%;

            -webkit-animation: animate 11s linear infinite;

            animation: animate 11s linear infinite;

        }

        #bubbles-bg span:nth-child(10) {

            top: 25%;

            left: 90%;

        }

        @-webkit-keyframes animate {

            0% {

                -webkit-transform: scale(0) translateY(0) rotate(0deg);

                transform: scale(0) translateY(0) rotate(0deg);

                opacity: 1;

            }

            100% {

                -webkit-transform: scale(1) translateY(-100px) rotate(360deg);

                transform: scale(1) translateY(-100px) rotate(360deg);

                opacity: 0;

            }

        }

        @keyframes animate {

            0% {

                -webkit-transform: scale(0) translateY(0) rotate(0deg);

                transform: scale(0) translateY(0) rotate(0deg);

                opacity: 1;

            }

            100% {

                -webkit-transform: scale(1) translateY(-100px) rotate(360deg);

                transform: scale(1) translateY(-100px) rotate(360deg);

                opacity: 0;

            }

        }

        @-webkit-keyframes bgcolor {

            0% {

                background-color: #f44336;

            }

            25% {

                background-color: #03a9f4;

            }

            50% {

                background-color: #9c27b0;

            }

            75% {

                background-color: #23c214;

            }

            100% {

                background-color: #f44336;

            }

        }

        @keyframes bgcolor {

            0% {

                background-color: #f44336;

            }

            25% {

                background-color: #03a9f4;

            }

            50% {

                background-color: #9c27b0;

            }

            75% {

                background-color: #23c214;

            }

            100% {

                background-color: #f44336;

            }

        }

        @media screen and (max-width: 300px) {
            .container header {
                font-size: 50px;
            }
        }
    </style>
</head>

<body>
    <section class="container">
        <div id="bubbles-bg">

            <span></span>

            <span></span>

            <span></span>

            <span></span>

            <span></span>

            <span></span>

            <span></span>

            <span></span>

            <span></span>

            <span></span>

        </div>
        <header>Coming Soon</header>
        <p>
            Our website is under construction. We're working hard to improve our
            website and we'll ready to launch after.
        </p>
        <div class="time-content">
            <div class="time days">
                <span class="number"></span>
                <span class="text">days</span>
            </div>
            <div class="time hours">
                <span class="number"></span>
                <span class="text">hours</span>
            </div>
            <div class="time minutes">
                <span class="number"></span>
                <span class="text">minutes</span>
            </div>
            <div class="time seconds">
                <span class="number"></span>
                <span class="text">seconds</span>
            </div>
        </div>

        <div class="email-content">
            <p>Subscribe now to get the latest updates!</p>

            <div class="input-box">
                <input type="email" id="input__email" placeholder="Enter your email" />
                <button id="btn__submit">Notify Me</button>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script>
        const seconds = document.querySelector(".seconds .number"),
            minutes = document.querySelector(".minutes .number"),
            hours = document.querySelector(".hours .number"),
            days = document.querySelector(".days .number");

        let secValue = 59,
            minValue = 59,
            hourValue = 23,
            dayValue = 3;

        const timeFunction = setInterval(() => {
            secValue--;

            if (secValue === 0) {
                minValue--;
                secValue = 60;
            }
            if (minValue === 0) {
                hourValue--;
                minValue = 60;
            }
            if (hourValue === 0) {
                dayValue--;
                hourValue = 24;
            }

            if (dayValue === 0) {
                clearInterval(timeFunction);
            }
            seconds.textContent = secValue < 10 ? `0${secValue}` : secValue;
            minutes.textContent = minValue < 10 ? `0${minValue}` : minValue;
            hours.textContent = hourValue < 10 ? `0${hourValue}` : hourValue;
            days.textContent = dayValue < 10 ? `0${dayValue}` : dayValue;
        }, 1000); //1000ms = 1s

        const btn = document.getElementById('btn__submit');

        btn.addEventListener('click', function() {

            let email = document.getElementById('input__email').value;

            var a = new RegExp(
                /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i
            );

            var flag = true;

            if (email == '') {

                alert('Email not empty!');

                flag = false;

                return false;

            }

            if (!a.test(email)) {

                alert('Email invalidate!');

                flag = false;

                return false;
            }

            if (flag) {

                alert('sucess!');
            }
        });
    </script>
</body>

</html>