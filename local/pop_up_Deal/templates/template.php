<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("http://localhost/local/pop_up_Deal" . "/js/script.js");
Asset::getInstance()->addCss("http://localhost/local/pop_up_Deal" . "/css/style.js");

?>
<form action="" class="main" data-class="main">
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
                    <!-- value="1" -->
                    <input name="skills" id='<?= $item['NAME'] ?>' type="checkbox" <?= $check ?>>
                    <span class="title" name='<?= $item['NAME'] ?>' data-unchecked="Хочу"><?= $item['NAME'] ?></span>
                </label>
            </li>

        <? } ?>
    </ul>
</form>