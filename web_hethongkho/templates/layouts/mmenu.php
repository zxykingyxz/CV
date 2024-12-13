<nav id="menu">
    <ul>
        <li><a class="<?= $func->activeMenu('', true) ?>" href="">Trang chủ</a></li>
        <li><a class="<?= $func->activeMenu('ve-chung-toi', true) ?>" href="<?=$func->getType('ve-chung-toi')?>">Về chúng tôi</a></li>
        <li><a class="<?= $func->activeMenu('khoa-hoc', true) ?>" href="<?=$func->getType('khoa-hoc')?>">Khóa học</a><?= $func->primaryMenu(['type' => 'khoa-hoc',]) ?></li>
        <li><a class="<?= $func->activeMenu('dich-vu', true) ?>" href="<?=$func->getType('dich-vu')?>">Dịch vụ</a></li>
        <li><a class="<?= $func->activeMenu('viec-lam', true) ?>" href="<?=$func->getType('viec-lam')?>">Việc làm</a></li>
        <li><a class="<?= $func->activeMenu('du-hoc', true) ?>" href="<?=$func->getType('du-hoc')?>">Du học</a></li>
        <li><a class="<?= $func->activeMenu('tin-tuc', true) ?>" href="<?=$func->getType('tin-tuc')?>">Tin tức</a><?= $func->primaryMenu(['type' => 'tin-tuc',]) ?></li>
        <li><a class="<?= $func->activeMenu('lien-he', true) ?>" href="<?=$func->getType('lien-he')?>">Liên hệ</a></li>
    </ul>
</nav>