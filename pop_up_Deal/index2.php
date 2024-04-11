<?

use Adtech\SectionDeal\SectionDealTable;

require_once $_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/main/include/prolog_before.php';
require($_SERVER["DOCUMENT_ROOT"] . "/local/pop_up_Deal/Section_deal.php");

$post = json_decode(file_get_contents('php://input'), true);
if(!empty($post)){    
   foreach($post as $name => $hidden) {
        
        $sectionDeal = SectionDealTable::getList([
            'select' => ['NAME'],
            'filter' => [
                '=NAME' => $name
            ]

        ])->fetch();
        if($hidden == true){                
            $value = "Y";
        }else{
            $value = "N";
        }
        SectionDealTable::update($sectionDeal['NAME'], array(
            'HIDDEN' => $value
        ));
    }
}else{
    $SectionDeal = \Adtech\SectionDeal\SectionDealTable::getList([
        'select' => ['NAME','HIDDEN']

    ])->fetchAll();
    echo json_encode($SectionDeal);

}

