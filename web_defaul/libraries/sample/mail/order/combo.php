<tbody bgcolor="#f7f7f7" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
    <tr>
        <td align="left" style="padding:3px 9px" valign="top">
            <span style="display:block;font-weight:bold"><?= $params['nameCombo'] ?></span>
            <span style="display:block;font-size:12px">Mã combo:<?= $params['codeCombo'] ?></span>
        </td>

        <?php if ($params['priceCombo'] != 0) { ?>
            <td align="left" style="padding:3px 9px" valign="top">
                <span style="display:block;color:#ff0000;"><?= $params['priceCombo'] ?></span>
                <span style="display:block;color:#999;text-decoration:line-through;font-size:11px;"><?= $params['priceComboOld'] ?></span>
            </td>
        <?php } else { ?>
            <td align="left" style="padding:3px 9px" valign="top"><span style="color:#ff0000;"><?= $params['priceComboOld'] ?></span></td>
        <?php } ?>

        <td align="center" style="padding:3px 9px" valign="top"><?= $params['qtyCombo'] ?></td>

        <?php if ($params['priceCombo'] != 0) { ?>
            <td align="right" style="padding:3px 9px" valign="top">
                <span style="display:block;color:#ff0000;"><?= $params['priceComboTotal'] ?></span>
                <span style="display:block;color:#999;text-decoration:line-through;font-size:11px;"><?= $params['priceComboOldTotal'] ?></span>
            </td>
        <?php } else { ?>
            <td align="right" style="padding:3px 9px" valign="top"><span style="color:#ff0000;"><?= $params['priceComboOldTotal'] ?></span></td>
        <?php } ?>
    </tr>

</tbody>
<?php /*
foreach ($params['products'] as $item) { ?>
    <div style="display: flex; align-items:center; gap: 20px; margin-bottom: 20px;">
        <div style="display: inline-flex;width: 100px;height: auto;aspect-ratio: 100/100;align-items: center;justify-content: center;">
            <img src="<?= $params['https_config'] . 'upload/baiviet/' . $item["photo"] ?>" alt="<?= $item["ten"] ?>" style="position: absolute;width: 100%;height: 100%;object-fit: contain;top: 50%;left: 50%; transform: translate(-50%,-50%);">
        </div>
        <div class=""><?= $item["ten"] ?></div>
    </div>
<?php }
*/ ?>