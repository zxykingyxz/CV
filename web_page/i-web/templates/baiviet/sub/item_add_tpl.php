<?php if ($GLOBAL_LEVEL4[$com][$type]['seo'] == true) { ?>
	<script>
		function text_count_changed(textfield_id, counter_id) {
			var v = $(textfield_id).val();
			if (parseInt(v.length) > 300) {
				$(textfield_id).css('border', '1px solid #D90000');
				$(textfield_id).css('background', '#e5e5e5');
				$(counter_id).val(parseInt(v.length));
			} else {
				$(textfield_id).css('border', '1px solid #DDDDDD');
				$(textfield_id).css('background', '#FFF');
				$(counter_id).val(parseInt(v.length));
			}
		}
		$(document).ready(function() {
			text_count_changed("#description", "#des_char");
			$('#description').blur(function(event) {
				text_count_changed($(this), "#des_char");
			});
			$('#description').keypress(function(event) {
				text_count_changed($(this), "#des_char");
			});
		});
	</script>
<?php } ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('.chonngonngu li a').click(function(event) {
			var lang = $(this).attr('href');
			$('.chonngonngu li a').removeClass('active');
			$(this).addClass('active');
			$('.lang_hidden').removeClass('active');
			$('.lang_' + lang).addClass('active');
			return false;
		});
	});
</script>
<?php

function get_main_list()
{
	global $d, $item;
	$sql = "select * from table_baiviet_list where type='" . $_GET['type'] . "' order by stt asc";
	$stmt = $d->query($sql);
	$str = '
      <select id="id_list" name="data[id_list]" data-level="0"  data-type="' . $_GET['type'] . '" data-child="id_cat" class="main_select select_dmbaiviet">
      <option value="">' . _danhmuccap1 . '</option>';
	while ($row = @mysqli_fetch_array($stmt)) {
		if ($row["id"] == (int)@$item["id_list"])
			$selected = "selected";
		else
			$selected = "";
		$str .= '<option value=' . $row["id"] . ' ' . $selected . '>' . $row["ten_vi"] . '</option>';
	}
	$str .= '</select>';
	return $str;
}

function get_main_cat()
{
	global $d, $item;
	$sql = "select * from table_baiviet_cat where id_list='" . $item['id_list'] . "' and type='" . $_GET['type'] . "' order by stt asc";
	$stmt = $d->query($sql);

	$str = '
      <select id="id_cat" name="data[id_cat]" data-level="1" data-child="id_item" data-type="' . $_GET['type'] . '" class="main_select select_dmbaiviet">
      <option value="">' . _danhmuccap2 . '</option>';
	while ($row = @mysqli_fetch_array($stmt)) {
		if ($row["id"] == (int)@$item["id_cat"])
			$selected = "selected";
		else
			$selected = "";
		$str .= '<option value=' . $row["id"] . ' ' . $selected . '>' . $row["ten_vi"] . '</option>';
	}
	$str .= '</select>';
	return $str;
}
function get_main_item()
{
	global $d, $item;
	$sql = "select * from table_baiviet_item where id_cat='" . $item['id_cat'] . "' and type='" . $_GET['type'] . "' order by stt asc";
	$stmt = $d->query($sql);
	$str = '
      <select id="id_item" name="data[id_item]" data-level="2" data-child="id_sub" data-type="' . $_GET['type'] . '" class="main_select select_dmbaiviet">
      <option value="">Danh mục cấp 3</option>';
	while ($row = @mysqli_fetch_array($stmt)) {
		if ($row["id"] == (int)@$item["id_item"])
			$selected = "selected";
		else
			$selected = "";
		$str .= '<option value=' . $row["id"] . ' ' . $selected . '>' . $row["ten_vi"] . '</option>';
	}
	$str .= '</select>';
	return $str;
}
?>

<div class="wrapper">
	<div class="control_frm">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li><a href="index.php?com=baiviet&act=add_sub&tbl=<?= $_GET['tbl'] ?><?php if ($_REQUEST['id'] != '') echo '&id=' . $_REQUEST['id']; ?><?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?>"><span><?= $GLOBAL_LEVEL4[$com][$type]['title'] ?></span></a></li>
				<li class="current"><a href="#" onclick="return false;"><?= ($_GET['act'] == 'edit_item') ? 'Sửa' : 'Thêm' ?></a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form name="supplier" id="validate" class="form" action="index.php?com=baiviet&act=save_sub&tbl=<?= $_GET['tbl'] ?><?php if ($_REQUEST['id'] != '') echo '&id=' . $_REQUEST['id']; ?><?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?>" method="post" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">
		<div class="mtop0">

			<div class="oneOne">
				<div class="widget mtop0">
					<div class="title chonngonngu" style="border-bottom: 0px solid transparent">
						<ul>
							<?php foreach ($config['lang'] as $k => $v) { ?>
								<li><a href="<?= $k ?>" class="<?= ($k == 'vi') ? 'active' : '' ?> tipS" title="<?= $v ?>"><img src="./images/<?= $k ?>.png" alt="" class="<?= $func->changeTitle($v) ?>" /><?= $v ?></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>

			<div class="<?= ($GLOBAL_LEVEL4[$com][$type]['full'] == true) ? 'oneOne' : 'colLeft' ?>">
				<div class="widget mtop0">
					<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
						<h6><?= _thongtin ?></h6>
					</div>
					<?php foreach ($config['lang'] as $k => $v) { ?>
						<div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
							<label><?= _tieude ?> [<?= $v ?>]</label>
							<div class="formRight">
								<input data-validation="required" data-validation-error-msg="Tên không được để trống" type="text" name="data[ten_<?= $k ?>]" title="Nhập tên danh mục" id="ten_<?= $k ?>" class="tipS validate[required]" value="<?= @$item['ten_' . $k] ?>" />
							</div>
							<div class="clear"></div>
						</div>
						<?php if ($GLOBAL_LEVEL4[$com][$type]['mota'] == true) { ?>
							<div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
								<label><?= _mota ?> [<?= $v ?>]</label>
								<div class="ck_editor">
									<textarea title="Nhập mô tả . " id="mota_<?= $k ?>" class="ck_editors" name="data[mota_<?= $k ?>]"><?= @$item['mota_' . $k] ?></textarea>
								</div>
								<div class="clear"></div>
							</div>
						<?php } ?>
					<?php } ?>


				</div>
				<div class="clear"></div>
			</div>
			<div class="<?= ($GLOBAL_LEVEL4[$com][$type]['full'] == true) ? 'oneOne' : 'colRight' ?>">
				<div class="widget mtop0">
					<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
						<h6><?= _danhmuc ?></h6>
					</div>

					<?php if ($GLOBAL[$com][$type]['list'] == true) { ?>
						<div class="formRow">
							<label><?= $GLOBAL_LEVEL1[$com][$type]['title'] ?></label>
							<div class="formRight">
								<?= get_main_list() ?>
							</div>
							<div class="clear"></div>
						</div>
					<?php } ?>
					<?php if ($GLOBAL[$com][$type]['cat'] == true) { ?>
						<div class="formRow">
							<label><?= $GLOBAL_LEVEL2[$com][$type]['title'] ?></label>
							<div class="formRight">
								<?= get_main_cat() ?>
							</div>
							<div class="clear"></div>
						</div>
					<?php } ?>
					<?php if ($GLOBAL[$com][$type]['item'] == true) { ?>
						<div class="formRow">
							<label><?= $GLOBAL_LEVEL3[$com][$type]['title'] ?></label>
							<div class="formRight">
								<?= get_main_item() ?>
							</div>
							<div class="clear"></div>
						</div>
					<?php } ?>
					<?php if ($GLOBAL_LEVEL4[$com][$type]['img'] == true) { ?>
						<div class="formRow">
							<label>Tải hình ảnh:</label>
							<div class="formRight">
								<?php if ($_GET['act'] == 'edit_sub') { ?>
									<input type="file" id="file" name="file" />
								<?php } else { ?>
									<input data-validation="required"
										data-validation-allowing="jpg, png"
										data-validation-max-size="300kb"
										data-validation-error-msg-required="Bạn chưa chọn file" type="file" id="file" name="file" />
								<?php } ?>
								<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
								<span style="display: inline-block; line-height: 30px;color:#CCC; padding-left: 10px;">
									Width: <?= $GLOBAL_LEVEL4[$com][$type]['img-width'] * $GLOBAL_LEVEL4[$com][$type]['img-ratio'] ?>px - <?= $GLOBAL_LEVEL4[$com][$type]['img-height'] * $GLOBAL_LEVEL4[$com][$type]['img-ratio'] ?>px
								</span>
							</div>
							<div class="clear"></div>
						</div>
						<?php if ($_GET['act'] == 'edit_item' && $item['thumb'] != '') { ?>
							<div class="formRow">
								<label>Hình Hiện Tại :</label>
								<div class="formRight">

									<div class="mt10"><img src="<?= _upload_baiviet . $item['thumb'] ?>" alt="NO PHOTO" /></div>
								</div>
								<div class="clear"></div>
							</div>
						<?php } ?>
					<?php } ?>

					<div class="formRow">
						<label>Alias</label>
						<div class="formRight">
							<input type="text" name="data[tenkhongdau]" title="Nhập tên không dấu" id="tenkhongdau" class="tipS validate[required]" value="<?= @$item['tenkhongdau'] ?>" />
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow">
						<label><?= _hienthi ?> : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
						<div class="formRight">

							<input type="checkbox" name="hienthi" id="check1" value="1" <?= (!isset($item['hienthi']) || $item['hienthi'] == 1) ? 'checked="checked"' : '' ?> />
							<label><?= _sothutu ?>: </label>
							<input type="text" class="tipS" value="<?= isset($item['stt']) ? $item['stt'] : 1 ?>" name="data[stt]" style="width:40px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
						</div>
						<div class="clear"></div>
					</div>

				</div>
				<?php if ($GLOBAL_LEVEL4[$com][$type]['seo'] == true) { ?>
					<div class="widget mtop10">
						<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
							<h6><?= _noidungseo ?></h6>
						</div>

						<?php foreach ($config['lang'] as $k => $v) { ?>

							<div class="formRow">
								<label>Title [ <?= $v ?> ]: </label>
								<div class="formRight validate-input">
									<input data-validation="required" data-validation-error-msg="Description không được để trống" type="text" value="<?= @$item['title_' . $k] ?>" id="title" name="dataseo[title_<?= $k ?>]"
										title="Nội dung thẻ meta Title dùng để SEO" class="tipS input100" />
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<label>Description [ <?= $v ?> ]:</label>
								<div class="formRight validate-input">
									<textarea data-validation="required" data-validation-error-msg="Description không được để trống" rows="4" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS input100"
										name="dataseo[description_<?= $k ?>]" id="description"><?= @$item['description_' . $k] ?></textarea>
								</div>
								<div class="clear"></div>
							</div>
							<div class="formRow">
								<div class="formRight validate-input">
									<input readonly="readonly" type="text"
										style="width:45px; margin-top:10px; text-align:center;" name="des_char" id="des_char"
										value="<?= @$item['des_char'] ?>" /> <?= _kytu ?> <b>(<?= _kytutotnhat ?>)</b>
								</div>
								<div class="clear"></div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="clear"></div>
			</div>
		</div>
		<div class="formRow fixedBottom sidebar-bunker">
			<div class="formRight">
				<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?= _hoantat ?>" />
				<a href="index.php?com=baiviet&act=man_sub<?php if ($_REQUEST['id'] != '') echo '&id=' . $_REQUEST['id']; ?><?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS redB" original-title="Thoát"><?= _thoat ?></a>
			</div>
			<div class="clear"></div>
		</div>
	</form>
</div>