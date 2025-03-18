<?php if ($config['lang_check']) { ?>
    <ul class="fix-ul-lang d-flex align-items-center gap10">
        <li>
            <a href="<?= $func->currentLangLink('vi') ?>" title="<?= _tiengviet ?>">
                <img width="25" height="25" src="assets/images/lang/flag_vi.svg" alt="<?= _tiengviet ?>" />
            </a>
        </li>
        <li>
            <a href="<?= $func->currentLangLink('en') ?>" title="<?= _tienganh ?>">
                <img width="25" height="25" src="assets/images/lang/flag_en.svg" alt="<?= _tienganh ?>" />
            </a>
        </li>
    </ul>
<?php } ?>