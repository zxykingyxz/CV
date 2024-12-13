var LIST_ORDER_NEW = {code:123456789,time_ago:'01/08/2021',link_active:'gio-hang'};
function fisherYates ( myArray ) {
	var i = myArray.length, j, temp;
	if ( i === 0 ) return false;
	while ( --i ) {
		j = Math.floor( Math.random() * ( i + 1 ) );
		temp = myArray[i];
		myArray[i] = myArray[j]; 
		myArray[j] = temp;
	}
}
var collection = new Array();
function getTemplateSticket (){
	$.each(LIST_ORDER_NEW, function( i, v ) {
		var k = '';
		/*<a href="'+v.link_detail+'" class="ajax-popup-link">Xem ngay</a>*/
		k += '<div class="info-stiket">\
				<h3>Bạn vừa có 1 đơn hàng mới</h3>\
				<p>Mã đơn: <span>'+v.code+'</span></p>\
				<p>'+v.time_ago+'</p>\
				<p><a href="'+v.link_active+'">Nhận ngay</a></p>\
				<span class="pe-7s-close pa fs__20"></span>\
			</div>';
	  	collection.push(k);
	});
}
getTemplateSticket();
/*setInterval(function(){
	collection = new Array();
	
	
},2000);*/
fisherYates(collection);
console.log(collection);
function SalesPop() {
	if(collection.length > 0){
		if ($('.jas-sale-pop').length < 0) return;
		var kx = 0;
		setInterval(function() {
			if(kx<collection.length){
				$('.jas-sale-pop').fadeIn(function() {
					$(this).removeClass('slideUp');
				}).delay(3000).fadeIn(function() {
					console.log(kx);
					var randomShowP = collection[kx];
					$(".jas-sale-pop").html(randomShowP);
					$(this).addClass('slideUp');
					$('.pe-7s-close').on('click', function() {
						$(".jas-sale-pop").removeClass('slideUp');
					});

					$('.ajax-popup-link').magnificPopup({
						type: 'ajax',
						alignTop: true,
						closeOnBgClick: false,
						showCloseBtn: true
					});
					kx++;
				}).delay(3000);
			}
			
		}, 3000);
	}
}

SalesPop();