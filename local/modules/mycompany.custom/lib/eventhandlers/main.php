<?php

namespace MyCompany\Custom\EventHandlers;

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
}