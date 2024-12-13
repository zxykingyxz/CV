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
    if (a.value)
        a = a.value;
    if (a == '')
        return;
    var b = a.split('|')[1];
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
        c.value = b;
        GTranslateFireEvent(c, 'change');
        GTranslateFireEvent(c, 'change')
    }
}

function goToByScroll(id) {
    $('body,html').animate({ scrollTop: $(id).offset().top - 200 }, 500);
};

function updateLoginStatus(data) {
    if (data != '') { window.location.reload(); }
}

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

function removeParam(key, sourceURL) {
    var rtn = sourceURL.split("?")[0];
    var queryString = sourceURL.indexOf("?") !== -1 ? sourceURL.split("?")[1] : "";
    if (queryString !== "") {
        var params_arr = queryString.split("&");
        if (Array.isArray(key)) {
            key.forEach(function(item) {
                params_arr = params_arr.filter(function(param) {
                    return param.split("=")[0] !== item;
                });
            });
        } else if (typeof key === 'object') {
            for (var k in key) {
                params_arr = params_arr.filter(function(param) {
                    return param.split("=")[0] !== key[k];
                });
            }
        } else {
            params_arr = params_arr.filter(function(param) {
                return param.split("=")[0] !== key;
            });
        }
        if (params_arr.length > 0) {
            rtn = rtn + "?" + params_arr.join("&");
        }
    }
    return rtn;
}

function countNumberWhenScrollPage(parent, element) {
    var a = 0;
    $(window).scroll(function() {
        var b = $(parent).offset().top - window.innerHeight;
        if (0 == a && $(window).scrollTop() > b) {
            $(element).each(function() {
                var a = $(this),
                    b = a.attr("data-count");
                $({
                    countNum: a.text()
                }).animate({
                    countNum: b
                }, {
                    duration: 3000,
                    easing: "swing",
                    step: function() {
                        a.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        a.text(this.countNum);
                    }
                });
            });
            a = 1;
        }
    });
};

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

function getSketon(numb = 8, col = ' move-loading') {
    let output = '';
    for (let i = 0; i < numb; i++) {
        output += '<div class="' + col + '">';
        output += '<div class="box-loading">';
        output += '<div class="box-thumbnail"></div>';
        output += '<div class="box-line-df"></div>';
        output += '<div class="box-line-lgx"></div>';
        output += '<div class="box-line-lg"></div>';
        output += '</div>';
        output += '</div>';
    }
    return output;

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

function updatePriceDetail(pid, color = 0, size = 0) {
    $.ajax({
        url: 'ajax/ajaxUpdatePrice.php',
        data: { pid: pid, color: color, size: size },
        dataType: 'json',
        type: 'post',
        success: function(data) {
            $('#view-price-detail').html(data["price-string"]);
        }
    });
};

function updatePriceDetailColor(pid, size = 0, color = 0) {
    $.ajax({
        url: 'ajax/ajaxUpdatePrice.php',
        data: { pid: pid, size: size, color: color },
        dataType: 'json',
        type: 'post',
        success: function(data) {
            $('#view-price-detail').html(data["price-string"]);
        }
    });
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

function onChangeSelect(e, p) {
    $.ajax({
        url: _ROOT + 'users.js',
        type: 'POST',
        data: { p: p, src: 'load-place' },
        success: function(data) {
            $(e).html(data);
        }
    });
};

function onChangeCatalog(e, p, n) {
    $.ajax({
        url: 'ajax/loadCatalog.php',
        type: 'POST',
        data: { p: p },
        success: function(data) {
            $(e).html(data);
            if (n === 'destroy') { $('#idi').html('<option>Hãng</option>'); }
            $('.nice-select').niceSelect('update');
        }
    });
};

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
};

function copyToClipboardText(text) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(text).select();
    document.execCommand("copy");
    $temp.remove();
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

function loadImageRender() {
    var ratioAll = document.querySelectorAll('.ratio-img');
    if (ratioAll.length > 0) {
        for (let index = 0; index < ratioAll.length; index++) {
            let width = ratioAll[index].getAttribute("img-width");
            let height = ratioAll[index].getAttribute("img-height");
            ratioAll[index].style.setProperty('--data-ratio', 'calc((' + height + ' / ' + width + ') * 100%)');
        }
    }
}

function addLoadHtml(data) {
    $('.move-loading').remove();
    $('#wrap__product').html(data.html);
    $('#paging').html(data.paging);
    if ($('body,html #wrap__product').length > 0) {
        $('body,html').animate({ scrollTop: $('#wrap__product').offset().top - 110 }, 500);
    }
    loadImageRender();
}

function fetch_filter(url) {
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        beforeSend: function() {
            $('#wrap__product').html(getSketon(8, ' move-loading'));
        },
        success: function(data) {
            pushState({}, '', url);
            if (_LANG) {
                window.location.reload();
            } else {
                addLoadHtml(data);
            }
            _FRAMEWORK.Lazys();

        }
    });
}

function create_link() {
    let obj_create_link = {};
    let link_filter = [];
    let the_url = "";
    let ar = [];
    let ar2 = [];
    $('input[name="brand"]').each(function() {
        if ($(this).is(":checked")) {
            ar.push($(this).val());
            obj_create_link["is_brand"] = ar.join(",");
        }
    });
    $('input[name="price"]').each(function() {
        if ($(this).is(":checked")) {
            ar2.push($(this).val());
            obj_create_link["is_price"] = ar2.join(",");
        }
    });
    // obj_create_link["typeRange"] = $("#arrange option:selected").val();
    if (_KEYWORD != '') {
        obj_create_link["keywords"] = _KEYWORD;
    }
    for (const property in obj_create_link) {
        link_filter.push(`${property}=${obj_create_link[property]}`)
    }
    link_filter = link_filter.join("&");
    the_url = _URL;
    if (link_filter) {
        the_url += `?${link_filter}`
    }

    return the_url
}

function searchEnter(t) {
    var k = t.val();
    var url;
    if (!isBlank(k)) {
        url = 'keywords=' + k;
        window.location.href = _ROOT + 'tim-kiem?' + encodeURI(url);
    } else {
        t.focus();
    }
};

function loadScrollPage(url, type, width, height, ele) {
    var a = !1;
    $(window).scroll(function() {
        $(window).scrollTop() > 10 && !a && ($('#' + ele).load('ajax/load_addons.php?url=' + url + '&width=' + width + '&height=' + height + '&type=' + type), a = !0)
    });
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