<?php

namespace MyCompany\Custom\EventHandlers;

use Bitrix\Main\UserTable;

class Iblock
{
    static function onNewsAdd($arFields): void
    {
        if ($arFields['IBLOCK_ID'] !== IBLOCK_CUSTOM_ID) {
            return;
        }

        if (!$arFields['RESULT']) {
            return;
        }

        $userId = (int)$arFields['CREATED_BY'];
        $user = UserTable::getById($userId)->fetch();
        if (empty($user)) {
            return;
        }

        $newsId = (int)$arFields['ID'];
        $newsName = $arFields['NAME'];
        $author = "{$user['LAST_NAME']} {$user['NAME']} [$userId]";
        \CEventLog::Add([
            'SEVERITY' => 'INFO',
            'AUDIT_TYPE_ID' => 'ON_NEWS_ADD',
            'MODULE_ID' => '',
            'ITEM_ID' => $newsId,
            'DESCRIPTION' => "Добавлена новость [$newsId] - [$newsName] от [$author]"
        ]);
    }

    static function onLink(&$items)
    {
        foreach ($items as &$arItem) {
            if($arItem['ID'] == 'crm_analytics') {
                $l1=1;
                $newItem = [
                        'ID' => 'TEST_ITEM',
                        'NAME' => 'Тест',
                        'URL' => '',
                        'MENU_ID' => 'test_menu_item',
                        'TEXT' => 'Тест',
                        //'ON_CLICK' => "console.log('Привет123')"
                        'ON_CLICK' => "var request = BX.ajax.runComponentAction('mib:report.detail', 'sendDoc', {
                            mode: 'class',
                            data: {
                            sessid: BX.message('bitrix_sessid')
                            }
                            });
                            // промис в который прийдет ответ
                            request.then(function (response) {
                            console.log('Привет321');
                            })"
                    ];
                array_push($arItem['ITEMS'], $newItem);
            }
        }

    }
}