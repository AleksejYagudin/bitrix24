<?php

namespace MyCompany\Custom\EventHandlers;

class Menu
{
    static function addItems(&$items)
    {
        foreach ($items as &$arItem) {
            if($arItem['ID'] == 'crm_analytics') {
                $newItem = [
                    'ID' => 'TEST_ITEM',
                    'NAME' => 'Тест',
                    'URL' => '',
                    'MENU_ID' => 'test_menu_item',
                    'TEXT' => 'Тест',
                    //'ON_CLICK' => "console.log('Привет123')"
                    'ON_CLICK' => "var request = BX.ajax.runComponentAction('mib:main.menu', 'chanageMenuItems', {
                            mode: 'class',
                            data: {
                            sessid: BX.message('bitrix_sessid')
                            }
                            });
                            // промис в который прийдет ответ
                            request.then(function (response) {
                            console.log('Привет3211');
                            })"
                ];
                array_push($arItem['ITEMS'], $newItem);
            }
        }
    }
}