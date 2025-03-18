<script type="text/javascript">
	$(document).ready(function() {
		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'baiviet_sub';
			var value = $(this).val();
			$.ajax ({
				type: "POST",
				url: "ajax/update_stt.php",
				data: {id:id,table:table,value:value},
				success: function(result) {
				}
			});
		});
		$('.timkiem button').click(function(event) {
			var keyword = $(this).parent().find('input').val();
			window.location.href="index.php?com=baiviet&act=man_sub&tbl=<?=$_GET['tbl']?>&type=<?=$_GET['type']?>&keyword="+keyword;
		});
    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
        })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=baiviet&act=delete_sub&tbl=<?=$_GET['tbl']?>&type=<?=$_GET['type']?>&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
	});

  function select_list()
  {
    var a=document.getElementById("id_list");
    window.location ="index.php?com=baiviet&act=man_sub&tbl=<?=$_GET['tbl']?>&type=<?=$_GET['type']?>&id_list="+a.value; 
    return true;
  }

  function select_cat()
  {
    var a=document.getElementById("id_list");
    var b=document.getElementById("id_cat");
    window.location ="index.php?com=baiviet&act=man_sub&tbl=<?=$_GET['tbl']?>&type=<?=$_GET['type']?>&id_list="+a.value+"&id_cat="+b.value; 
    return true;
  }
  function select_item()
  {
    var a=document.getElementById("id_list");
    var b=document.getElementById("id_cat");
    var c=document.getElementById("id_item");
    window.location ="index.php?com=baiviet&act=man_sub&tbl=<?=$_GET['tbl']?>&type=<?=$_GET['type']?>&id_list="+a.value+"&id_cat="+b.value+"&id_item="+c.value; 
    return true;
  }

</script>
<?php
  function get_main_list()
  {
    global $d;
    $sql="select * from table_baiviet_list where type='".$_GET['type']."' order by stt asc";
    $stmt=$d->query($sql);
    $str='
      <select id="id_list" name="id_list" onchange="select_list()" class="main_select">
      <option value="">'._danhmuccap1.'</option>';
    while ($row=@mysqli_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$_REQUEST["id_list"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }

  function get_main_cat()
  {
    global $d;
    $sql="select * from table_baiviet_cat where id_list='".$_GET['id_list']."' and type='".$_GET['type']."' order by stt asc";
    $stmt=$d->query($sql);
    $str='
      <select id="id_cat" name="id_cat" onchange="select_cat()" class="main_select">
      <option value="">'._danhmuccap2.'</option>';
    while ($row=@mysqli_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$_REQUEST["id_cat"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }
  function get_main_item()
  {
    global $d;
    $sql="select * from table_baiviet_item where id_cat='".$_GET['id_cat']."' and type='".$_GET['type']."' order by stt asc";
    $stmt=$d->query($sql);
    $str='
      <select id="id_item" name="id_item" onchange="select_item()" class="main_select">
      <option value="">Danh mục cấp 3</option>';
    while ($row=@mysqli_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$_REQUEST["id_item"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }
?>

<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=baiviet&act=man_sub&tbl=<?=$_GET['tbl']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=$GLOBAL_LEVEL3[$com][$type]['title']?></span></a></li>
        	<?php if($_GET['keyword']!=''){ ?>
				  <li class="current"><a href="#" onclick="return false;"><?=_ketquatimkiem?> " <?=$_GET['keyword']?> " </a></li>
			    <?php }else{ ?>
          <li class="current"><a href="#" onclick="return false;"><?=_tatca?></a></li>
          <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form name="f" id="f" method="post">
  <div class="control_frm" style="margin-top:0;">
    	<div style="float:left;">
      	<input type="button" class="greenB" value="Thêm" onclick="location.href='index.php?com=baiviet&act=add_sub&tbl=<?=$_GET['tbl']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
        <input type="button" class="redB" value="Xoá Chọn" id="xoahet" />
      </div>  
  </div>
   <div class="oneOne">
      <div class="title">
        <div class="timkiem">
          <span><?=_timkiem?>:</span>
          <input type="text" value="" placeholder="<?=_nhaptukhoatimkiem?> ">
          <button type="button" class="blueB"  value=""><?=_timkiem?></button>
        </div>
      </div>
     <div class="clear"></div>
   </div>
  <div class="oneOne">
    <div class="widget mtop0">
      <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
        <thead>
          <tr>
            <td style="position: relative;">
              <span class="titleIcon"><input type="checkbox"  id="titleCheck" name="titleCheck" /></span>
            </td>
            <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;"><?=_thutu?></a></td>     
            <td class="tb_data_small"><?=get_main_list()?></td>   
            <td class="tb_data_small"><?=get_main_cat()?></td>
            <td class="tb_data_small"><?=get_main_item()?></td>       
            <td class="sortCol"><div><?=_tendanhmuc?><span></span></div></td>
            <td class="tb_data_small"><?=_anhien?></td>
            <td class="tb_data_small"><?=_thaotac?></td>
          </tr>
        </thead>

        <tbody>
          <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
            <td>
              <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
            </td>

            <td align="center">
              <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />

              <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
            </td> 

            <td align="center">
              <?php
                $d->reset();
                $sql = "select ten_vi from table_baiviet_list where id='".$items[$i]['id_list']."'";
                $result=$d->query($sql);
                $name_danhmuc =mysqli_fetch_array($result);
                echo @$name_danhmuc['ten_vi'];
              ?>  
            </td>
            <td align="center">
              <?php
                $d->reset();
                $sql = "select ten_vi from table_baiviet_cat where id='".$items[$i]['id_cat']."'";
                $result=$d->query($sql);
                $name_danhmuc =mysqli_fetch_array($result);
                echo @$name_danhmuc['ten_vi'];
              ?>  
            </td>
            <td align="center">
              <?php
                $d->reset();
                $sql = "select ten_vi from table_baiviet_item where id='".$items[$i]['id_item']."'";
                $result=$d->query($sql);
                $name_danhmuc =mysqli_fetch_array($result);
                echo @$name_danhmuc['ten_vi'];
              ?>  
            </td>
            <td class="title_name_data">
              <a href="index.php?com=baiviet&act=edit_sub&tbl=<?=$_GET['tbl']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>
            </td>

            <td align="center">
              <a data-val2="table_baiviet_sub" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
            </td>
           
            <td class="actBtns">
                <a class="text-primary" href="index.php?com=baiviet&act=edit_sub&tbl=<?=$_GET['tbl']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><i class="fas fa-edit"></i></a>

                <a class="text-danger" href="index.php?com=baiviet&act=delete_sub&tbl=<?=$_GET['tbl']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm"><i class="fas fa-trash-alt"></i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</form>  
<div class="paging"><?=$paging?></div>