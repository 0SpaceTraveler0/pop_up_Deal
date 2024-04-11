<?
namespace Adtech\SectionDeal;

use Bitrix\Main\Entity;
class SectionDealTable extends Entity\DataManager
{
	public static function getTableName()
	{
		return 'section_deal';
	}
	
	public static function getMap()
	{
		return array(
            // new Entity\IntegerField('ID', [
            //     'primary' => true,
            //     'autocomplete' => true
            // ]),
			// new Entity\IntegerField('USER_ID',[
            //     'required' => true
            // ]),
			new Entity\StringField('NAME',[
                'required' => true,
                'primary' => true,
            ]),
            new Entity\StringField('TITLE', [
                'required' => true
            ]),
            new Entity\BooleanField('HIDDEN', [
                'values' => ['N', 'Y'],
                'default_value' => 'N'
            ])
		);
	}
} 