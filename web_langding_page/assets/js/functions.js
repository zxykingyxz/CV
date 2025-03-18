function pushState(options, targetTitle, targetUrl) {
    window.history.pushState(options, targetTitle, targetUrl);
};

function GTranslateFireEvent(a, b) {
    try {
        if (document.createEvent) {
            var c = document.createEvent("HTMLEvents");
            c.initEvent(b, true, true);
            a.dispatchEvent(c)
        } else {
            var c = document.createEventObject();
            a.fireEvent('on' + b, c)
        }
    } catch (e) {}
}

function doGoogleLanguageTranslator(a) {
    var c;
    var d = document.getElementsByTagName('select');
    for (var i = 0; i < d.length; i++)
        if (d[i].className == 'goog-te-combo')
            c = d[i];
    if (document.getElementById('google_language_translator') == null || document.getElementById('google_language_translator').innerHTML.length == 0 || c.length == 0 || c.innerHTML.length == 0) {
        setTimeout(function() {
            doGoogleLanguageTranslator(a)
        }, 100)
    } else {
        c.value = a;
        GTranslateFireEvent(c, 'change');
        GTranslateFireEvent(c, 'change');
    }
}

function goToByScroll(id) {
    $('body,html').animate({ scrollTop: $(id).offset().top - 200 }, 500);
};

function setCookie(key, value, expiry) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString()
}

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null
}

function eraseCookie(key) {
    var keyValue = getCookie(key);
    setCookie(key, keyValue, '-1')
}

function ValidationFormSelf(ele = '') {
    if (ele) {
        $("." + ele).find("[type=submit]").removeAttr("disabled");
        var forms = document.getElementsByClassName(ele);
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }
};

function ValidationFormSelfAgree(ele = '') {
    if (ele) {
        $("." + ele).find("input[type=submit]").removeAttr("disabled");
        var forms = document.getElementsByClassName(ele);
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                var agreeCheckbox = form.querySelector('#agreeCheck');
                if (form.checkValidity() && !agreeCheckbox.checked) {
                    event.preventDefault();
                    showNotify('Bạn chưa đồng ý điều khoản của chúng tôi!', 'Thông báo', 'error');
                }
            }, false);
        });
    }
};

function updateProgressBarWidth() {
    const scrolled = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
    const height = getDocumentHeight();
    const windowHeight = getWindowHeight();
    const progressBar = document.getElementsByClassName("scroll-indicator")[0];
    progressBar.style.width = height > 0 ? (scrolled / (height - windowHeight)) * 100 + "%" : "0%";
};

function getDocumentHeight() {
    const body = document.body;
    const html = document.documentElement;
    return Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);
};

function getWindowHeight() {
    return window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
};

function redirect(url) {
    window.location.href = url;
};

function exists(el) {
    if (el.length > 0) return true;
    else return false
};

function onlyNumber(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 47 && charCode < 58) {
        return true;
    } else {
        return false;
    }
};

function log(str) {
    console.log(
        `%c${str}`,
        `font-size:18px;color:orange`
    );
};

function slugConvert(slug, focus = false) {
    slug = slug.toLowerCase();
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    slug = slug.replace(/ /gi, "-");
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    if (!focus) {
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    }
    return slug;
};

function sideScroll(element, direction, speed, distance, step) {
    scrollAmount = 0;
    var slideTimer = setTimeout(function() {
        if (direction == 'left') {
            $(element).animate({
                scrollLeft: "-=" + step
            }, "slow");
        } else {
            $(element).animate({
                scrollLeft: "+=" + step
            }, "slow");
        }
        scrollAmount += step;
        if (scrollAmount >= distance) {
            window.clearInterval(slideTimer);
        }
    }, speed);
};

function isBlank(a) {
    if (a.length == 0) {
        return true
    }
    return false
};

function sum(...args) {
    return args.reduce((acc, val) => acc + val, 0);
}

function searchEnter(t, com = 'tim-kiem', key = 'keywords') {
    var k = t.val();
    var url;
    if (!isBlank(k)) {
        url = key + '=' + k;
        window.location.href = _ROOT + com + '?' + encodeURI(url);
    } else {
        t.focus();
    }
};

function isEmail(b) {
    var a = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return a.test(b)
};

function validatePhone(b) {
    var a = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    return a.test(b);
};

function isMobileDevice() {
    return (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));
}

function loadApplication(check = true) {
    if (check) {
        $('body').append(`
        <div id="loader">
            <div class="loader">
                <div class="icon_loader">
                    <div class="inner one"></div>
                    <div class="inner two"></div>
                    <div class="inner three"></div>
                </div>
                <span>
                    Loading...
                </span>
            </div>
        </div>
        `);
    } else {
        setTimeout(function() {
            $("body #loader").remove();
        }, 200)
    }
}

function getUrlParam(paramsToAdd = {}, dataParamClose = [], baseUrl = window.location.origin) {
    const urlParams = new URLSearchParams(window.location.search);
    let params = {};

    // Lấy tất cả tham số từ URL hiện tại (trừ tham số cần đóng)
    urlParams.forEach((value, key) => {
        if (!dataParamClose.includes(key)) {
            params[key] = value.trim();
        }
    });

    // Thêm hoặc cập nhật tham số mới
    Object.entries(paramsToAdd).forEach(([key, value]) => {
        if (value !== "" && value !== null && value !== undefined) {
            params[key] = String(value).trim();
        }
    });

    // Chuyển object thành chuỗi truy vấn
    let queryString = new URLSearchParams(params).toString();

    // Tạo URL mới
    let url = queryString ? `${baseUrl}?${queryString}` : baseUrl;

    return url;
}


function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}