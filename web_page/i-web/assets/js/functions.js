function redirect(url) {
    window.location.href = url;
}

function updateSt(url, table, id, type, value) {
    $.ajax({
        url: 'ajax/' + url + '.php',
        type: 'post',
        data: {
            table: table,
            id: id,
            value: value,
            type: type
        },
        success: function() {
            window.location.reload();
        }
    });
}

function checkStatus(table, id, val, type) {
    $.ajax({
        type: "POST",
        url: "ajax/update_status.php",
        data: {
            table: table,
            id: id,
            val: val,
            type: type
        },
        dataType: 'json',
        success: function(result) {
            if (result.status == 1) {
                console.log('Đã cập nhật trạng thái');
            } else {
                alert('Bạn không cập nhật được trạng thái này');
            }
        }
    });
}

function onChangePage(val, table, type, el, field_change) {
    var params = {
        val: val,
        table: table,
        type: type,
        field_change: field_change
    }

    $.ajax({
        url: 'ajax/load_catalogy.php',
        data: params,
        type: 'post',
        success: function(data) {
            $('#' + el).html(data);
        }
    });

}



function changeSlug(name, el, url = '', title = '', title_seo = '') {
    var res = name.split("_"); //array name_en array(name,en)
    if ($('#checkUrl' + res[1]).is(':checked')) {
        // console.log('Khóa không cho thay đổi link');
        return false;
    } else {
        // console.log('Cho thay đổi link');
        var v = $('#' + name).val();
        var slug = getSlug(v);
        $('#' + el).val(slug);
        if (url != '') {
            $('#' + url).text(slug);
        }
        var seo = $('#' + title_seo).val();
        if (seo != '') {
            $('#' + title).text(seo);
        } else {
            $('#' + title).text(v);
        }

        $.ajax({

            url: 'ajax/url_hienthi.php',

            type: "POST",

            dataType: 'json',

            data: {

                keywords: slug,

                lang: res[1]

            },

            success: function(data) {
                console.log(data);
                if (data.status == 201) {
                    $(`#alias_${res[1]}`).addClass('error');
                    $('.btn-disabled').prop('disabled', 'disabled');
                    $(`#alias_${res[1]}`).parent().find(`span`).remove();
                    $(`#alias_${res[1]}`).parent().append(`<span class="help-block form-error">${data.msg}</span>`);
                } else {
                    $(`#alias_${res[1]}`).removeClass('error');
                    $('.btn-disabled').prop('disabled', '');
                    $(`#alias_${res[1]}`).parent().find(`span`).remove();
                }

            }

        });
    }
}

function changeSeo(name, el, ty) {
    var v = $('#' + name).val();
    if (ty == 'null') {
        $('#' + el).text(v);
    } else {
        if (v != '') {
            $('#' + el).text(v);
        } else {
            $('#' + el).text($('#' + el).val());
        }
    }
}

function OnlyNumber(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 47 && charCode < 58)
        return true;

    return false;
}

function changeUrl(name, el) {
    var v = $('#' + name).val();
    v = getSlug(v, '-');
    $('#' + name).val(v);
    $('#' + el).text(v);
}

function login(username, password) {
    var _username = $('#' + username).val();
    var _password = $('#' + password).val();
    var _flag = true;
    if (_username == '') {
        errorLog('Bạn chưa nhập tên đăng nhập!', 'error');
        $('#' + username).focus();
        _flag = false;
        return false;
    }
    if (_password == '') {
        errorLog('Bạn chưa nhập mật khẩu!', 'error');
        $('#' + password).focus();
        _flag = false;
        return false;
    }
    if (_flag == true) {
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            data: {
                username: _username,
                password: _password
            },
            dataType: 'json',
            error: function(a, b, c) {
                alert(c);
            },
            beforeSend: function() {
                $(this).addClass('loading');
            },
            success: function(data) {
                if (data.status == 200) {
                    window.location.href = data.url;
                } else {
                    FRAMEWORK.errorPage(data.message, data.error);
                }
            },
            complete: function() {
                setTimeout(function() {
                    $(this).removeClass('loading');
                }, 2000);
            }
        });
    }
}

function ajaxCheckFlashSale(id_check, id_sale) {

    $.ajax({
        url: 'ajax/ajaxUpdateFlashSale.php',

        type: 'post',

        data: {

            id_check: id_check,

            id_sale: id_sale,
        },
        dataType: 'json',

        beforeSend: function() {

        },
        success: function() {
            FRAMEWORK.errorPage("Thêm vào sản phẩm thành công!", "success");
        },
        complete: function() {}
    });
}

function actionPopup(class_form = null, class_close_form = null, class_view_form = null) {
    $('body').on('click', '.' + class_view_form, function() {
        if (!$('body .' + class_form).hasClass('active')) {
            $('body .' + class_form).addClass('active');
            $("body ").css('overflow', 'hidden');
        }
    });
    $('body').on('click', '.' + class_close_form, function() {
        if ($(this).closest(' .' + class_form).hasClass('active')) {
            $(this).closest(' .' + class_form).removeClass('active');
            $("body ").css('overflow', 'auto');
        }
    });
}

function handleExcelExport(postData = null) {
    fetch('ajax/excel.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded', // Định dạng gửi dữ liệu
            },
            body: new URLSearchParams(postData) // Dữ liệu gửi đi dưới dạng URL encoded
        })
        .then(response => response.blob()) // Chuyển đổi dữ liệu trả về thành Blob (file)
        .then(blob => {

            if (blob.size > 0) {
                // Tạo đối tượng URL từ Blob
                const downloadUrl = window.URL.createObjectURL(blob);

                // Tạo một liên kết ẩn và kích hoạt tải file
                const link = document.createElement('a');
                link.href = downloadUrl;
                link.download = 'Example.xlsx'; // Tên file khi tải về
                link.click();

                // Giải phóng bộ nhớ
                window.URL.revokeObjectURL(downloadUrl);
            } else {
                alert('Dữ liệu bị lỗi');
            }
        })
        .catch(error => {
            console.error('Download failed:', error, );
        });
}