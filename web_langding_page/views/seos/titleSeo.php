<div class="<?= $class ?>  " style="<?= $style ?>">
    <?php if (empty($banner_tpl)) { ?>
        <h1>
        <?php } ?>
        <span>
            <?= $title ?>
        </span>
        <?php if (empty($banner_tpl)) { ?>
        </h1>
    <?php } ?>
</div>