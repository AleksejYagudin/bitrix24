<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI\Extension;

defined('B_PROLOG_INCLUDED') || die;

/**
 * @var array{additionalParameters: array} $arResult
 */

$additionalParameters = $arResult['additionalParameters'];

Extension::load('ui.hint');
?>
<tr>
    <td>
        <div id="currency-format-setting">
            <span><?= 'Формат валюты'; ?></span>
            <span data-hint-html data-hint="<?= 'Поддерживаемые макросы для формата валюты:<br>#FULL_NAME# - Полное название валюты (Доллар Соединенных Штатов)<br>#SYMBOL# - Юникод символ ($)'; ?>"></span>
        </div>
    </td>
    <td>
        <input
                type="text"
                name="<?= $additionalParameters['NAME']; ?>[FORMAT]"
                size="50"
                maxlength="255"
                value="<?= $arResult['values']['format']; ?>"
        />
    </td>
</tr>
<script>
    BX.ready(function () {
        BX.UI.Hint.init();
    })
</script>