function loadApplication(check = true) {
    Notiflix.Loading.init({
        svgColor: "#32c682",
        messageFontSize: "18px",
        messageMaxLength: 200,
    });
    if (check) {
        Notiflix.Loading.standard("Đang xử lý...");
    } else {
        setTimeout(function () {
            Notiflix.Loading.remove();
        }, 200);
    }
}

function handleExcelExport(postData = null) {
    $.ajax({
        url: "ajax/functions/excel.php",
        type: "POST",
        data: postData,
        contentType: "application/x-www-form-urlencoded", // Định dạng gửi dữ liệu
        xhrFields: {
            responseType: "blob", // Nhận dữ liệu trả về dưới dạng Blob (file)
        },
        success: function (blob) {
            console.log(blob);
            if (blob.size > 0) {
                // Tạo URL từ Blob
                const downloadUrl = window.URL.createObjectURL(blob);

                // Tạo thẻ a để tải file
                const link = document.createElement("a");
                link.href = downloadUrl;
                link.download = "Example.xlsx"; // Tên file khi tải về
                link.click();

                // Giải phóng bộ nhớ
                window.URL.revokeObjectURL(downloadUrl);
            } else {
                FRAMEWORK.showNotification({
                    title: "Thông báo hệ thống",
                    message: "Dữ liệu đang bị lỗi!",
                    status: "error",
                });
            }
        },
        error: function (xhr, status, error) {
            console.error("Download failed:", error);
        },
    });
}

function submitImportExcel() {
    $("body #form-import").submit(function (event) {
        event.preventDefault();
        let formData = new FormData(this);
        let _this = $(this);
        $("body").find("#form_modal *").remove();
        $.ajax({
            url: "ajax/functions/excel.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (response) {
                if (response.data.status == 200) {
                    FRAMEWORK.showNotification({
                        title: "Thông báo hệ thống!",
                        message: response.data.message,
                        status: "success",
                    });
                    $("body").find('input[name="keywords"]').val("").trigger("input");
                } else {
                    FRAMEWORK.showNotification({
                        title: "Thông báo hệ thống!",
                        message: response.data.message,
                        status: "error",
                    });
                }
            },
            error: function (error) {
                FRAMEWORK.showNotification({
                    title: "Thông báo hệ thống!",
                    message: "Hệ thống đang bị lỗi vui lòng quay lại sau!",
                    status: "error",
                });
            },
        });
    });
}

function getUrlParam(paramsToAdd = {}) {
    const urlParams = new URLSearchParams(window.location.search);
    let params = {};
    // Lấy tất cả tham số từ URL hiện tại
    urlParams.forEach((value, key) => {
        params[key] = value;
    });
    // Nếu có tham số key và value, thêm hoặc thay đổi tham số
    Object.keys(paramsToAdd).forEach((key) => {
        let value = paramsToAdd[key];
        params[key] = value; // Thêm hoặc cập nhật tham số với giá trị mới
    });
    // Chuyển mảng params thành chuỗi truy vấn
    params = Object.fromEntries(Object.entries(params).filter(([key, value]) => value !== "" && value !== null && value !== undefined));
    let queryString = $.param(params);
    // Tạo URL mới
    let url = "";
    if (queryString === "") {
        url = _URL; // Nếu không có tham số, chỉ trả về URL cơ bản
    } else {
        url = _URL + "?" + queryString; // Thêm tham số vào URL
    }

    return url;
}

function getChartPie(
    data = {
        id: null,
        title: null,
        dataSeries: null,
        titleSeries: null,
    }
) {
    Highcharts.chart(data.id, {
        credits: {
            enabled: false,
        },
        exporting: {
            enabled: false,
        },
        legend: {
            enabled: true,
            layout: "horizontal",
            itemStyle: {
                whiteSpace: "normal", // Cho phép xuống dòng
                textOverflow: "clip", // Ngăn cắt chữ
                fontSize: "10px",
            },
            align: "center", // Canh giữa
            verticalAlign: "bottom", // Đặt ở dưới
            itemWidth: 120, // Đặt chiều rộng để tránh quá dài
            itemMarginTop: 10, // Khoảng cách giữa các mục
            itemWrap: true, // Cho phép xuống hàng
        },
        chart: {
            type: "pie",
            height: 520,
        },
        title: {
            text: data.title,
        },
        tooltip: {
            style: {
                fontSize: "14px",
            },
            pointFormatter: function () {
                return this.series.name + ": <b>" + Highcharts.numberFormat(this.y, 0, ".", ",") + " đ</b> (" + Highcharts.numberFormat(this.percentage, 1) + "%)";
            },
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true, // Bật nhãn trong lát cắt
                    distance: -30, // Đặt khoảng cách để nhãn nằm bên trong lát cắt
                    format: "{point.percentage:.1f}%",
                    style: {
                        fontSize: "13px",
                        fontWeight: "bold",
                        color: "white",
                        textOutline: "none",
                    },
                },
                showInLegend: true, // Vẫn hiện chú thích dưới biểu đồ
            },
            series: {
                allowPointSelect: true,
                cursor: "pointer",
            },
        },
        series: [
            {
                name: data.titleSeries,
                colorByPoint: true,
                data: data.dataSeries,
            },
        ],
    });
}

function getChartColumnStacked(
    data = {
        id: null,
        title: null,
        dataSeries: [],
        titleSeries: [],
        dataxAxis: null,
    }
) {
    Highcharts.chart(data.id, {
        credits: {
            enabled: false,
        },
        exporting: {
            enabled: false,
        },
        chart: {
            type: "column",
            scrollablePlotArea: {
                minWidth: 1200,
            },
            height: 450,
        },
        title: {
            text: data.title,
            style: {
                fontWeight: "bold",
                fontSize: "20px",
            },
        },
        xAxis: {
            categories: data.dataxAxis,
            title: {
                text: "Ngày",
                style: {
                    fontSize: "14px",
                },
            },
            tickWidth: 0,
            showFirstLabel: true,
            labels: {
                style: {
                    fontSize: "12px",
                },
            },
        },
        yAxis: {
            min: 0,
            title: {
                text: "Tổng tiền",
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: "bold",
                    fontSize: "55%",
                    color: "#333",
                    textOutline: "none",
                },
                formatter: function () {
                    return Highcharts.numberFormat(this.total / 1000, 0, ".", ",") + "k đ";
                },
            },
        },
        tooltip: {
            crosshairs: true,
            shared: true,
            useHTML: true, // Cho phép dùng HTML để tùy chỉnh giao diện
            formatter: function () {
                let tooltip = `<b>Ngày: ${this.x}</b><br>`;
                let total = 0;

                tooltip += `<hr style="margin: 5px 0;">`;

                this.points.forEach((point) => {
                    total += point.y;
                });

                this.points.forEach((point) => {
                    if (point.y > 0) {
                        const percent = total > 0 ? ((point.y / total) * 100).toFixed(2) : 0;
                        tooltip += `<span style="color: ${point.color}">\u25CF</span> ${point.series.name}: <b>${Highcharts.numberFormat(point.y / 1000, 0, ".", ",")}k đ (${percent}%)</b><br>`;
                    }
                });

                tooltip += `<hr style="margin: 5px 0;">`;
                tooltip += `<b>Tổng tiền: ${Highcharts.numberFormat(total / 1000, 0, ".", ",")} k đ</b>`;
                return tooltip;
            },
        },
        plotOptions: {
            column: {
                stacking: "normal",
                pointPadding: 0.1,
                groupPadding: 0.1,
                borderWidth: 0,
                maxPointWidth: 50,
                dataLabels: {
                    enabled: false,
                    style: {
                        fontWeight: "bold",
                        textOutline: "none",
                        fontSize: "clamp(8px,50%,16px)",
                    },
                    formatter: function () {
                        if (this.percentage) {
                            return Highcharts.numberFormat(this.percentage, 1) + "%";
                        }
                    },
                },
            },
        },
        legend: {
            align: "center",
            verticalAlign: "top",
            layout: "horizontal",
        },
        series: data.dataSeries,
    });
}
