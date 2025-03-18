<?php 
    $comments = $db->rawQuery("select * from #_comment where type=? and pid=? and hienthi=1 order by id desc limit 0,3", array($row_detail["type"],$row_detail["id"]));
    $c_total = $db->rawQueryOne("select count(id) as num from #_comment where type=? and pid=? and hienthi=1 ", array($row_detail["type"],$row_detail["id"]));
    $c_rate5 = $db->rawQueryOne("select count(id) as num from #_comment where type=? and pid=? and rating=5 and hienthi=1", array($row_detail["type"],$row_detail["id"]));
    $c_rate4 = $db->rawQueryOne("select count(id) as num from #_comment where type=? and pid=? and rating=4 and hienthi=1", array($row_detail["type"],$row_detail["id"]));
    $c_rate3 = $db->rawQueryOne("select count(id) as num from #_comment where type=? and pid=? and rating=3 and hienthi=1", array($row_detail["type"],$row_detail["id"]));
    $c_rate2 = $db->rawQueryOne("select count(id) as num from #_comment where type=? and pid=? and rating=2 and hienthi=1", array($row_detail["type"],$row_detail["id"]));
    $c_rate1 = $db->rawQueryOne("select count(id) as num from #_comment where type=? and pid=? and rating=1 and hienthi=1", array($row_detail["type"],$row_detail["id"]));
    $c_avg = $db->rawQueryOne("select round(avg(rating),1) as rate from  #_comment where type=? and pid=? and hienthi=1", array($row_detail["type"],$row_detail["id"]));

    $c_total_rest = $c_total['num'] - 3;

    $rating = [
        5 => ["count" => $c_rate5['num']],
        4 => ["count" => $c_rate4['num']],
        3 => ["count" => $c_rate3['num']],
        2 => ["count" => $c_rate2['num']],
        1 => ["count" => $c_rate1['num']],
    ];
?>

<div class="wrapper-comment mt30">
    <div class="wrapper-comment__title mb20">
        <span>Đánh giá và nhận xét:</span> <?=$row_detail["ten_$lang"]?>
    </div>
    <div class="wrapper-comment__charts mb20">
        <div class="wrapper-comment__charts-total">
            <div class="number">
                <?=($c_avg['rate']!=NULL)?$c_avg['rate']:'0'?>/5
            </div>
            <div class="subtitle">
                <?=$c_total['num']?> lượt đánh giá
            </div>
        </div>
        <div class="wrapper-comment__charts-rankingTree flex-cl-1">
            <table class="wrapper-comment__charts-rankingTree-table">
                <tbody> 
                    <?php foreach ($rating as $k => $v) { 
                        $percentageByTotal = $v['count'] / $c_total['num'] * 100;
                        ?>
                        <tr class="wrapper-comment__charts-rankingTree-score">
                            <td class="numbStar">
                                <span><?=$k?></span> <i class="fa-solid fa-star active"></i>
                            </td>
                            <td class="percentage flex-cl-1">
                                <div style="--percentage:<?="$percentageByTotal%"?>"></div>
                            </td>
                            <td class="vote">
                                <span><?=$v['count']?> vote</span>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="wrapper-comment__box">
        <div class="wrapper-comment__box-evaluate mb35">
            <div class="wrapper-comment__box-evaluate-title">
                Bạn đánh giá sao về dịch vụ của chúng tôi?
            </div>
            <div class="wrapper-comment__box-evaluate-btn t-center">
                <a class="js-activeComment" href="javascript:void(0)" title="Đánh giá ngay">Đánh giá ngay</a>
            </div>
        </div>
        <div class="wrapper-comment__box-result" id="comment-list">
            <?php foreach($comments as $k => $v) {
                $firstName = substr($v['hoten'], 0, 1);
                ?>
                <div class="wrapper-comment__box-result-item">
                    <div class="wrapper-comment__box-result-item-img" style="<?=$func->randomColor()?>">
                        <?=$firstName?>
                    </div>
                    <div class="wrapper-comment__box-result-item-info flex-cl-1">
                        <div class="title d-flex align-items-center">
                            <span class="mb10 mr15">@<?=$v['hoten']?></span> <p><?=date('d/m/Y', $v['ngaytao'])?></p>
                        </div>
                        <div class="rating mb10">
                            <?php $maxCount = 5; $count = ($v["rating"] != 0)?$v["rating"]:5;
                                for ($i = 0; $i < $maxCount; $i++) {?>
                                <span class="fa-solid fa-star <?= $i < $count ? 'active' : '' ?>"></span>
                            <?php }?>
                        </div>
                        <div class="content mb10">
                            <?=htmlspecialchars_decode($v['content'])?>
                        </div>
                        <?php if($v["photo"] != '') {?>
                            <div class="imgMultiple">
                                <a data-fancybox href="<?=_upload_user_l.$v["photo"]?>" title="<?=$v['hoten']?>" class="d-block hover-left ratio-scale ratio-img"
                                    img-width="85" img-height="55">
                                    <img class="ratio-img__content" width="85" height="55" src="<?=_upload_user_l.$v["photo"]?>" alt="<?=$v['hoten']?>">             
                                </a>
                            </div>
                        <?php }?>
                        <?php if($v['traloi'] != '') {?>
                            <div class="wrapper-comment__box-result-item-replyAdmin mt10">
                                <div class="d-flex align-items-center gap10 mb5">
                                    <div class="wrapper-comment__box-result-item-img" style="background: var(--html-bg-website); font-size:14px">
                                        QTV
                                    </div>
                                    <div class="wrapper-comment__box-result-item-info flex-cl-1">
                                        <div class="title">
                                            <span>Quản trị viên</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrapper-comment__box-result-item-replyAdmin-content">
                                    <?=htmlspecialchars_decode($v['traloi'])?>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            <?php }?>
        </div>
        <?php if($c_total['num'] > count($comments)) {?>
            <div class="wrapper-comment__box-result-showMore t-center">
                <a data-id="<?=$row_detail['id']?>" data-type="<?=$row_detail['type']?>" data-target="#comment-list"
                    class="js-viewall-comment" href="javascript:void(0)" title="Hiển thị thêm bình luận">
                    <span class="pr10">Hiển thị thêm <?=$c_total_rest?> bình luận</span>
                    <i class="fa-regular fa-angle-right"></i>
                </a>
            </div>
        <?php }?>
    </div>
</div>

<div class="wrapper-formComment">
    <div class="wrapper-formComment-bg"></div>
    <div class="wrapper-formComment-container">
        <div class="wrapper-formComment__box">
            <div class="wrapper-formComment__close closes">
                <i class="fa-regular fa-xmark"></i>
            </div>
            <div class="wrapper-formComment__box-title">
                Đánh giá & nhận xét
            </div>
            <div class="wrapper-formComment__box-form">
                <form action="" method="post" enctype="multipart/form-data" id="form-comment">
                    <input type="hidden" name="data[pid]" id="pid" value="<?=$row_detail['id']?>">
                    <input type="hidden" name="data[type]" id="type" value="<?=$row_detail['type']?>">
                    <input type="hidden" id="rating" name="data[rating]" value="0">
                    
                    <div class="wrapper-formComment__box-form-rating">
                        <div class="title">
                            Đánh giá chung
                        </div>
                        <div class="wrapper-formComment__box-form-rating-star re--star-selector">
                            <span class="re--star fa-solid fa-star">
                                <p class="mb0">Rất tệ</p>
                            </span>
                            <span class="re--star fa-solid fa-star">
                                <p class="mb0">Tệ</p>
                            </span>
                            <span class="re--star fa-solid fa-star">
                                <p class="mb0">Bình thường</p>
                            </span>
                            <span class="re--star fa-solid fa-star">
                                <p class="mb0">Tốt</p>
                            </span>
                            <span class="re--star fa-solid fa-star">
                                <p class="mb0">Tuyệt vời</p>
                            </span>
                        </div>
                    </div>
                    <div class="wrapper-formComment__box-form-group">
                        <div class="wrapper-formComment__box-form-group-input mb10">
                            <input type="text" name="data[fullname]" id="fullname" placeholder="Nhập họ tên">
                        </div>
                        <div class="wrapper-formComment__box-form-group-input mb10">
                            <textarea name="data[content]" id="content" rows="7" placeholder="Nhập nội dung đánh giá"></textarea>
                        </div>
                        <div class="wrapper-formComment__box-form-group-captcha mb10">
                            <div class="flex-cl-1 wrapper-formComment__box-form-group-input">
                                <input type="text" id="captcha" name="data[captcha]" value="" placeholder="Nhập mã captcha">
                            </div>
                            <div class="d-flex justify-content-end gap10 result-code">
                                <div class="captcha-code"></div>
                                <div class="reload-captcha"><i class="fa-solid fa-arrows-rotate"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper-formComment__box-form-group-file">
                        <div class="preview"></div>
                        <input class="d-none" type="file" id="file" name="file"> 
                        <label for="file">
                            <div class="input-icon mb5">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 8C3 8.55 3.45 9 4 9C4.55 9 5 8.55 5 8V6H7C7.55 6 8 5.55 8 5C8 4.45 7.55 4 7 4H5V2C5 1.45 4.55 1 4 1C3.45 1 3 1.45 3 2V4H1C0.45 4 0 4.45 0 5C0 5.55 0.45 6 1 6H3V8Z" fill="#637381"></path> 
                                    <circle cx="13" cy="14" r="3" fill="#637381"></circle> 
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.83 6H21C22.1 6 23 6.9 23 8V20C23 21.1 22.1 22 21 22H5C3.9 22 3 21.1 3 20V9.72C3.3 9.89 3.63 10 4 10C5.1 10 6 9.1 6 8V7H7C8.1 7 9 6.1 9 5C9 4.63 8.89 4.3 8.72 4H15.12C15.68 4 16.22 4.24 16.59 4.65L17.83 6ZM8 14C8 16.76 10.24 19 13 19C15.76 19 18 16.76 18 14C18 11.24 15.76 9 13 9C10.24 9 8 11.24 8 14Z" fill="#637381"></path>
                                </svg>
                            </div>
                            Thêm hình ảnh
                        </label>
                    </div>
                    <div class="wrapper-formComment__box-btn">
                        <button type="submit" id="submit_comment">Gửi đánh giá</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    const selectors = {
      starContainer: ".re--star-selector",
      star: ".re--star",
      starInput: "#rating",
    };

    let currentValue = 0;
    const stars = $(selectors.starContainer).find(selectors.star);

    $(stars).each((index, star) => {
        $(star).on("mouseover", (e) => {
            $(e.currentTarget).nextAll(selectors.star).removeClass("hovering");
            $(e.currentTarget).addClass("hovering");
            $(e.currentTarget).prevAll(selectors.star).addClass("hovering");
        });
        $(star).on("mouseout", () => {
            $(stars).removeClass("hovering");
        });
        $(star).on("click", (e) => {
            $(e.currentTarget).nextAll(selectors.star).removeClass("active");
            $(e.currentTarget).addClass("active");
            $(e.currentTarget).prevAll(selectors.star).addClass("active");
            currentValue = index + 1;

            $("#rating").val(currentValue);
        });
    });

</script>

<script>
    const ipnFileElement = document.querySelector('#file');
    const resultElement = document.querySelector('.preview');
    const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

    ipnFileElement.addEventListener('change', function(e) {
        const files = e.target.files;
        const file = files[0];
        const fileType = file['type'];

        if (!validImageTypes.includes(fileType)) {
            
            $.confirm({

                title: 'Thông báo',

                content: 'Tập tin không hợp lệ :3',

                icon: 'fa-light fa-circle-check',

                theme: 'modern',

                closeIcon: true,

                animation: 'scale',

                type: 'green',

                buttons: {

                    cancel: {   

                        text: 'Thoát',

                        btnClass: 'btn-red',

                    }

                }

            });

            $(ipnFileElement).val("");
            
            return

        };

        const fileReader = new FileReader();
        fileReader.readAsDataURL(file);

        fileReader.onload = function() {
            const url = fileReader.result;
            resultElement.insertAdjacentHTML(
            'beforeend',
            `<div class="preview-img"><img src="${url}" alt="${file.name}"/><span class="remove-preview-img"></span></div>`
            );
        };

    });

    $('.preview').on('click', '.remove-preview-img', function() {
        $(this).parent('.preview-img').remove();
        $('#file').val("");
    });

</script>