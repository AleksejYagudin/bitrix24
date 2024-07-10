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
}