<?php

namespace MyCompany\Custom\EventHandlers;

use Bitrix\Market\Extension;

class Main
{
    static function redirectFromTestPage(): void
    {
        global $USER, $APPLICATION;
        $curPage = $APPLICATION->GetCurPage();

        if(str_ends_with($curPage, '/local/test123.php') && $USER->IsAdmin())
        {
            LocalRedirect('/');
        }
    }

    static function customExtension(): void
    {
        \Bitrix\Main\UI\Extension::load('Mib.test');
    }
}