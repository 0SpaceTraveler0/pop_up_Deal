<?
//qwe
use Adtech\SectionDeal\SectionDealTable;
use Bitrix\Main\Entity;
use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"] . "/local/pop_up_Deal/Section_deal.php");
//require($_SERVER["DOCUMENT_ROOT"] . "/local/pop_up_Deal/template.php");
global $USER;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($USER->IsAdmin()) {
    
    $connection = Bitrix\Main\Application::getConnection();
    $table = \Adtech\SectionDeal\SectionDealTable::class;

    if ($connection->isTableExists($table::getTableName())) {

        $arCrmFields = CUserOptions::GetOption(
            'crm.entity.editor',
            'deal_details_common',
            false,
            0
        )[0]['elements'];;

        foreach($arCrmFields as $item){
            $SectionDeal = \Adtech\SectionDeal\SectionDealTable::getList([
                'select' => ['NAME'],
                'filter' => [
                    '=NAME' => $item['name']
                ]

            ])->fetch();
            if(!$SectionDeal){
                $res = SectionDealTable::add([
                    'NAME' => $item['name'],
                    'TITLE' => $item['title'],
                ]); 
            }
        }

        $SectionDealTableList = \Adtech\SectionDeal\SectionDealTable::getList([
            'select' => array('*')
        ])->fetchAll();

        Asset::getInstance()->addCss("http://localhost/local/pop_up_Deal/templates/css/style.css");
  


?>
        <form action="" class="main" data-class="main">
            <ul class="list">
                <? foreach ($SectionDealTableList as $row) {

                    if ($row['HIDDEN'] == 'Y') {
                        $check = "checked";
                    } else {
                        $check = "";
                    }
                ?>
                    <li class="item">
                        <label>
                            <!-- value="1" -->
                            <input name="skills" id='<?= $row['NAME'] ?>' type="checkbox" <?= $check ?>>
                            <span class="title" name='<?= $row['NAME'] ?>' ><?= $row['TITLE'] ?></span>
                        </label>
                    </li>

                <? } ?>
            </ul>
        </form>
        <? $APPLICATION->IncludeComponent('bitrix:ui.button.panel', '', [

            'BUTTONS' => [
                [
                    'TYPE' => 'save', // тип - обязательный
                    'CAPTION' => 'Сохранить', // название - не обязательный
                    'NAME' => 'save', // атрибут `name` инпута - не обязательный
                    'ID' => 'my-save-id', // атрибут `id` инпута - не обязательный
                    'VALUE' => 'Y', // атрибут `value` инпута - не обязательный
                    'ONCLICK' => '', // атрибут `onclick` инпута - не обязательный
                ],
                [
                    'TYPE' => 'close', // тип - обязательный
                    'CAPTION' => 'ГАЛЯ ОТМЕНА', // название - не обязательный
                    'NAME' => 'save', // атрибут `name` инпута - не обязательный
                    'ID' => 'my-close-id', // атрибут `id` инпута - не обязательный
                    'VALUE' => 'Y', // атрибут `value` инпута - не обязательный
                    'ONCLICK' => '', // атрибут `onclick` инпута - не обязательный
                ],
            ],
                    // 'close' => header("Location: ".$_SERVER['HTTP_REFERER']),
        ]); ?>
<?
    } else {

        echo "create table";

        $map = array_filter($table::getMap(), fn ($el) => !($el instanceof \Bitrix\Main\ORM\Fields\Relations\Reference));
        $fields = [];
        foreach ($map as $field) {
            $fields[$field->getName()] = $field;
        }
        $connection->createTable($table::getTableName(), $fields, ["ID"], ["ID"]);

        $arCrmFields = CUserOptions::GetOption(
            'crm.entity.editor',
            'deal_details_common',
            false,
            0
        )[0]['elements'];
        
        foreach($arCrmFields as $fileds){
            $res = SectionDealTable::add([
                'NAME' => $fileds['name'],
                'TITLE' => $fileds['title'],
            ]);
        }

        
    }
    
}

