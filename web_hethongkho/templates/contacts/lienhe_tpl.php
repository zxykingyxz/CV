<?php
$chinhanh = $cache->getcache("select iframe_map,ten_$lang as ten, mota_$lang as mota from #_map where hienthi=1 and type=? order by stt asc,id desc", array('chi-nhanh'), 'result', _TIMECACHE);

?>

<section class="mt40 mb40 mt-m-20 mb-m-20">
    <div class="grid_s wide">
        <div class="row">
            <div class="col l-12 m-12 c-12">
                <?php foreach ($chinhanh as $k => $v) { ?>
                    <div class="wrapper-contact__box">
                        <div class="row">
                            <div class="col l-5 m-5 c-12 mb-m-20">
                                <div class="wrapper-contact__box-desc">
                                    <div class="title">
                                        <?= $v['ten'] ?>
                                    </div>
                                    <div class="lines mb15"></div>
                                    <div class="content">
                                        <?= htmlspecialchars_decode($v['mota']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col l-7 m-7 c-12">
                                <div class="wrapper-contact__box-iframe">
                                    <?= htmlspecialchars_decode($v['iframe_map']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>