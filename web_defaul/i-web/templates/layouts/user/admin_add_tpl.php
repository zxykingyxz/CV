<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.html?com=setting&act=capnhat"><span><?=_thongtintaikhoan?></span></a></li>
            <li class="current"><a href="#" onclick="return false;"><?=_capnhatthongtin?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="index.html?com=user&act=admin_edit" method="post" enctype="multipart/form-data">	        
    <div class="oneOne">
    	<div class="widget mtop0">
			<div class="title"><img src="./images/icons/dark/pencil.png" alt="" class="titleIcon" />
				<h6><?=_thongtintaikhoan?></h6>
			</div>			
			<div class="formRow">
				<label><?=_tendangnhap?></label>
				<div class="formRight">
					<input type="text" value="<?=@$item['username']?>" name="username" title="Tên đăng nhập quản trị" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
	        <div class="formRow">
				<label><?=_matkhau?></label>
				<div class="formRight">
					<input type="password" value="" name="oldpassword" title="Nhập mật khẩu hiện tại" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
	        
	         <div class="formRow">
				<label><?=_matkhaumoi?></label>
				<div class="formRight">
					<input type="password" value="" name="new_pass" title="Nhập mật khẩu mới" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
	        
	         <div class="formRow">
				<label><?=_nhaplaimatkhau?></label>
				<div class="formRight">
					<input type="password" value="" name="renew_pass" title="Nhập lại mật khẩu mới" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
				<label><?=_hoten?></label>
				<div class="formRight">
					<input type="text" value="<?=@$item['ten']?>" name="ten" title="Nhập họ tên của bạn" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
	        
	        <div class="formRow">
				<label><?=_email?></label>
				<div class="formRight">
					<input type="text" value="<?=@$item['email']?>" name="email" title="Nhập email của bạn" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
	        
	        <div class="formRow">
				<label><?=_dienthoai?></label>
				<div class="formRight">
					<input type="text" value="<?=@$item['dienthoai']?>" name="dienthoai" title="Nhập điện thoại của bạn" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
                <label>Avatar:</label>
                <div class="formRight">
                    <input type="file" id="file1" name="avatar" />
                    <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải file pdf">
                </div>
                <div class="clear"></div>
           	</div>
            <?php if($_GET['act']=='admin_edit'){?>
               	<div class="formRow">
                    <label>Avatar Hiện Tại :</label>
                    <div class="formRight">
                        <div class="mt10">
                        	<img src="<?=_upload_avatar.$item['avatar']?>" alt="Avatar"/>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php } ?>

	        <div class="formRow">
				<div class="formRight">
	               <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
				</div>
				<div class="clear"></div>
			</div> 			
		</div>
    </div>
    
      
</form>   