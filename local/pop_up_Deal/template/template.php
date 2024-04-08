<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog.php");
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/local/pop_up_Deal/component.php");
Asset::getInstance()->addJs("http://localhost/local/pop_up_Deal/template/script.js");
Asset::getInstance()->addCss("http://localhost/local/pop_up_Deal/template/style.css");

if ($USER->IsAdmin()) {
?>
    <form action="../component.php" method="post"  class="main" data-class="main">
        <ul class="list">
            <? foreach ($arResult as $item) {

                if ($item['HIDDEN'] == 'Y') {
                    $check = "checked";
                } else {
                    $check = "";
                }
            ?>
                <li class="item">
                    <label>
                        <input name='<?= $item['NAME'] ?>' type="checkbox" <?= $check ?>>
                        <span class="title" name='<?= $item['NAME'] ?>'><?= $item['TITLE'] ?></span>
                    </label>
                </li>

            <? } ?>
        </ul>
        <? $APPLICATION->IncludeComponent('bitrix:ui.button.panel', '', [
            'BUTTONS' => ['save', 'cancel' => '/']
        ]); ?>
    </form>
<? } ?>