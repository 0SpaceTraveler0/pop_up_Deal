<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog.php");
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

require_once($_SERVER["DOCUMENT_ROOT"] . "/local/pop_up_Deal/component.php");

if ($USER->IsAdmin()) {
?>
    <form name="form_name" class="main" data-class="main" action="javascript:;" onsubmit=" toggle() ">
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
        <input type="submit" />
        <? $APPLICATION->IncludeComponent('bitrix:ui.button.panel', '', [
            'BUTTONS' => ['save', 'cancel' => '/']
        ]); ?>
    </form>
    <script>
        function test() {
            // let qwe = document.forms["form_name"].getElementsByTagName("input");
            // console.log(qwe)
            toggle()

            function toggle() {
                checkboxes = document.getElementsByName('foo');
                for (var i = 0, n = checkboxes.length; i < n; i++) {
                    console.log(checkboxes[i].checked)
                }
            }

        }

        function toggle() {
            let checkboxes = document.querySelectorAll("input[type='checkbox']");
            // let arPost = [];
            let arPost = new Object();
            for (let i = 0, n = checkboxes.length; i < n; i++) {
                let name = checkboxes[i].name
                let value = checkboxes[i].checked
                arPost[name]= value;

            }
            // console.log(arPost)
            postData('/local/pop_up_Deal/index2.php',arPost )
        //         .then((data) => {
        //             console.log(data);
        //         });
        }

        const postData = async (url = '', data = {}) => {
            // Формируем запрос
            const response = await fetch(url, {
                // Метод, если не указывать, будет использоваться GET
                method: 'POST',
                // Заголовок запроса
                headers: {
                    'Content-Type': 'application/json'
                },
                // Данные
                body: JSON.stringify(data)
            });
            // return response.json();
        }
    </script>
<? } ?>