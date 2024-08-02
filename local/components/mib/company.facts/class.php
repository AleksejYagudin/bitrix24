<?php

use Bitrix\Main\Config\Option;
use Bitrix\Main\Context;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\UI\Extension;

defined('B_PROLOG_INCLUDED') || die;

class CompanyFactsComponent extends CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable
{
    private const FACTS_NUMBER = 10;

    public function configureActions()
    {
        // TODO: Implement configureActions() method.
    }

    public function executeComponent()
    {
        $factsIblockId = $this->arParams['FACTS_IBLOCK_ID'];
        $factsNumber = $this->arParams['FACTS_NUMBER'] ?? CompanyFactsComponent::FACTS_NUMBER;

        $result = CIBlockElement::GetList(
            arFilter: ['IBLOCK_ID' => $factsIblockId],
            arNavStartParams: ['nPageSize' => $factsNumber],
        );

        $facts = [];
        while ($fact = $result->Fetch()) {
            $facts[] = $fact;
        }
        $this->arResult['facts'] = $facts;
        $this->includeComponentTemplate();
    }

    public static function getFactAction()
    {
        global $APPLICATION;

        ob_start();
        $APPLICATION->IncludeComponent(
            'mib:company.facts',
            '.default',
            array(
                'FACTS_IBLOCK_ID' => Option::get('b24.academy', 'FACTS_IBLOCK_ID'),
                'FACTS_NUMBER' => self::FACTS_NUMBER,
            )
        );
        $fact = ob_get_clean();
        //Для того, чтобы верстка (результат работы компонента) попал в JSON.
        return ['fact' => $fact];
    }
}