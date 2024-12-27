!function(t){t.fn.toc=function(e){
	var a={
		status:!1,
		selectors:"h1, h2, h3",
		container:t("body"),
		placeholder:lang.thieu_the_seo,
		listTag:"ol",
		onOpen:function(e){
			var a=t('<div class="toc-wrapper max-width">        <div class="toc-title-container">            <h4>'+
				lang.muc_luc_chi_tiet+
				'</h4>            <span class="toc-switch">                <a id="toc">                <i class="fa fa-outdent" aria-hidden="true"></i>                </a>            </span>        </div>        <div class="toc-list"></div>      </div>');
			a.find(".toc-list").html(e),t(".wrapper-toc .content").before(a)},
			onClose:function(){}},i=t.extend({},a,e),n=this,c=i.container,o=i.selectors,
			s="<"+i.listTag+"/>";
			function l(){
				var e=[],a=1,l=[t(s)];
				if(c.find(o).each((function(i,n){var o=t("<div/>").text(n.textContent.trim()).html(),c=n.id||o,
					s=n.tagName.toLowerCase();n.id!=c&&(t(n).data("toc-id",!0),n.id=c),
					e.push({index:c,text:o,tagName:s})})),e.length){var d=o.split(","),
					r=0;t.each(e,(function(e,a){var i=t.map(d,(function(t,e){return a.tagName===t.trim()?e:void 0}))[0];if(i>r){
						var n=l[0].children("li:last")[0];n&&l.unshift(t(s).appendTo(n))
					}else l.splice(0,Math.min(r-i,Math.max(l.length-1,0)));l[0].append('<li><a data-rel="#'+a.index+'" href="#'+a.index+'">'+a.text+"</a></li>"),r=i}))
			}else l[0].append('<li class="toc-empty">'+i.placeholder+"</li>");i.status=!0,i.onOpen.call(n,l[l.length-1])
		}i.status&&l(),n.on("click",(function(){
			i.status?(c.find(i.selectors).each((function(e,a){t(a).data("toc-id")&&t(a).removeAttr("id").removeData("toc-id")})),
				i.status=!1,i.onClose.call(n)):l()}))}}(jQuery);