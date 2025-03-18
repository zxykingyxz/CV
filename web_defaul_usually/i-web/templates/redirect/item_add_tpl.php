<div class="wrapper">
    <div class="control_frm">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a
                        href="index.html?com=redirect&act=add<?php if($_GET['type']!='') echo'&type='. $_GET['type'];?>"><span>Thêm redirect url</span></a></li>
                <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>

    <form name="supplier" class="form"
        action="index.html?com=redirect&act=save&id=<?=($_GET['id']!='') ? $_GET['id'] : ''?>&type=<?=($_GET['type']!='') ? $_GET['type'] : ''?>"
        method="post" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">
        <div class="oneOne">
            <div class="widget mtop0">
                <div class="formRow">
                    <label>Địa chỉ Cần chuyển hướng</label>
                    <div class="formRight">
                        <input data-validation="required" data-validation-error-msg="Không được để trống" type="text" name="data[oldlink]" value="<?=$item['oldlink']?>" placeholder="https://link-redirect-old.com/abc.html"/>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Loại chuyển hướng</label>
                    <div class="formRight">
                        <select data-validation="required" data-validation-error-msg="Không được để trống"  class="main-select" name="data[typelink]">
                            <option></option>
                            <option value="301" <?php if($item['typelink']=='301') echo 'selected'; ?>>301 — Moved Permanently</option>
                            <option value="302" <?php if($item['typelink']=='302') echo 'selected'; ?>>302 — Moved Temporarily</option>
                            <option value="303" <?php if($item['typelink']=='303') echo 'selected'; ?>>303 — Replaced</option>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Địa chỉ sẽ chuyển hướng đến</label>
                    <div class="formRight">
                        <input data-validation="required" data-validation-error-msg="Không được để trống"  type="text" name="data[newlink]" value="<?=$item['newlink']?>" placeholder="https://link-redirect-old.com/xyz.html"/>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="formRow fixedBottom">
                <div class="box-admin" style="display:flex; align-items:center;justify-content:flex-end">
                    <div class="box-action">
                        <button type="submit" class="btn btn-sm bg-gradient-primary text-white submit-check">
                            <i class="far fa-save mr-2"></i>Lưu
                        </button>
                        <button type="submit" class="btn btn-sm bg-gradient-success" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
                        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i
                                class="fas fa-redo mr-2"></i>Làm lại</button>
                        <a class="btn btn-sm bg-gradient-danger text-white"
                            href="index.html?com=redirect&act=man&id=<?=($_GET['id']!='') ? $_GET['id'] : ''?>&type=<?=($_GET['type']!='') ? $_GET['type'] : ''?>">
                            <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                        </a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </form>
</div>