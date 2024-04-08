<?
use Adtech\SectionDeal\SectionDealTable;
use Bitrix\Main\Entity;
use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"] . "/local/pop_up_Deal/Section_deal.php");

global $USER;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
file_put_contents(__DIR__ . '/POST.txt', print_r($_POST, true),FILE_APPEND);
if (empty($_POST)) {
    
    foreach($_POST as $name => $item){
        if($name != 'save'){
            $res = SectionDealTable::update($name,[
                'HIDDEn' => 'Y',
            ]);
        }

    }
    // $checkedValues = array_filter($_POST['checkbox_name'], 'isset'); // В массив попадут только выбранные флажки
}else{
    if ($USER->IsAdmin()) {

        $connection = Bitrix\Main\Application::getConnection();
        $table = \Adtech\SectionDeal\SectionDealTable::class;

        if ($connection->isTableExists($table::getTableName())) {

            $arCrmFields = CUserOptions::GetOption(
                'crm.entity.editor',
                'deal_details_common',
                false,
                0
            )[0]['elements'];

            foreach ($arCrmFields as $item) {
                $SectionDeal = \Adtech\SectionDeal\SectionDealTable::getList([
                    'select' => ['NAME'],
                    'filter' => [
                        '=NAME' => $item['name']
                    ]

                ])->fetch();
                if (!$SectionDeal) {
                    $res = SectionDealTable::add([
                        'NAME' => $item['name'],
                        'TITLE' => $item['title'],
                    ]);
                }
            }

        } else {

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

            foreach ($arCrmFields as $fileds) {
                $res = SectionDealTable::add([
                    'NAME' => $fileds['name'],
                    'TITLE' => $fileds['title'],
                ]);
            }
        }

        $SectionDealTableList = \Adtech\SectionDeal\SectionDealTable::getList([
            'select' => array('*')
        ])->fetchAll();
        $arResult = $SectionDealTableList;

    }
}




