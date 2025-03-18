
$(document).ready(function() {
	/* ajax hienthi*/
	$("a.diamondToggle").click(function(){
		if($(this).attr("rel")==0){
			$.ajax({
				type: "POST",
				url: "ajax/ajax_hienthi.php",
				data:{
					id: $(this).attr("data-val0"),
					bang: $(this).attr("data-val2"),
					type: $(this).attr("data-val3"),
					value:1
				}
			});
			$(this).addClass("diamondToggleOff");
			$(this).attr("rel",1);
			
		}else{
			
			$.ajax({
				type: "POST",
				url: "ajax/ajax_hienthi.php",
				data:{
					id: $(this).attr("data-val0"),
					bang: $(this).attr("data-val2"),
					type: $(this).attr("data-val3"),
					value:0
					}
			});
			$(this).removeClass("diamondToggleOff");
					$(this).attr("rel",0);
		}

	});
	
	/*end  ajax hienthi*/

	/*select danhmuc*/
	$(".select_danhmuc").change(function() {
		var child = $(this).data("child");
		var levell = $(this).data('level');
		var types = $(this).data('type');
		$.ajax({
			url: 'ajax/ajax_danhmuc.php',
			type: 'POST',
			data: {level: levell,
					id:$(this).val(),
					type: types},
			success:function(data){
				var op = "<option value='0'>Chọn danh mục</option>";

				if(levell=='0'){
					$("#id_cat").html(op);
					$("#id_item").html(op);
					$("#id_sub").html(op);
				}else if(levell=='1'){
					$("#id_sub").html(op);
					$("#id_item").html(op);
				}else if(levell=='2'){
					$("#id_sub").html(op);
				}
				$("#"+child).html(data);
			}
		});
	});
	/*end select danhmuc*/
	$('body').on('click', '.btn-save-export', function(event) {

        var _o = $(this);

        var _i = _o.data('id');

        window.location.href = 'ajax/export_order_detail.php?id='+_i;

    });

    $('body').on('click', '.btn-export-orders', function(event) {

        event.preventDefault();

		var _o = $(this);

        window.location.href = 'ajax/export_orders.php';

    });

    $('body').on('click', '.btn-save-print', function(event) {

        var _o = $(this);

        var _i = _o.data('id');

        var _t = _o.data('title');

        var contents = $("#print-"+_i).html();

        var frame1 = $('<iframe />');

        frame1[0].name = "frame1";

        frame1.css({ "position": "absolute", "top": "-1000000px" });

        $("body").append(frame1);

        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;

        frameDoc.document.open();

        frameDoc.document.write('<html><head><title>' + _t + '</title>');

        frameDoc.document.write('</head><body>');

        // frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');

        frameDoc.document.write(contents);

        frameDoc.document.write('</body></html>');

        frameDoc.document.close();

        setTimeout(function () {

            window.frames["frame1"].focus();

            window.frames["frame1"].print();

            frame1.remove();

        }, 500);

    });
	/*select danhmuc*/
	$(".select_dmbaiviet").change(function() {
		var child = $(this).data("child");
		var levell = $(this).data('level');
		var types = $(this).data('type');
		$.ajax({
			url: 'ajax/ajax_dmbaiviet.php',
			type: 'POST',
			data: {level: levell,
					id:$(this).val(),
					type: types},
			success:function(data){
				var op = "<option value='0'>Chọn danh mục</option>";

				if(levell=='0'){
					$("#id_cat").html(op);
					$("#id_item").html(op);
					$("#id_sub").html(op);
				}else if(levell=='1'){
					$("#id_sub").html(op);
					$("#id_item").html(op);
				}else if(levell=='2'){
					$("#id_sub").html(op);
				}
				$("#"+child).html(data);
			}
		});
	});
	/*end select danhmuc*/
	// push news
	$('.push-news').click(function(event){
		event.preventDefault();
		var id=$(this).attr('data-push');
		var url=$(this).attr('data-url');
		var type=$(this).attr('data-type');
		$.ajax({
			url:'ajax/daytin.php',
			type:'GET',
			data:{id:id,type:type,url:url},
			success:function(res){
				if(res==1){
					window.location.href="index.php?com=baiviet&act=man&type="+type;
				}
			}
		});
	});
});