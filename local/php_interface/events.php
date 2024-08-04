<?php

use Bitrix\Main\EventManager;

$eventManager = EventManager::getInstance();
$eventManager->addEventHandler(
    'main',
    'onProlog',
    [
        '\\Mib\\Events\\Test',
        'testFunction'
    ]
);

$eventManager->addEventHandler(
    'main',
    'onEpilog',
    [
        '\\Mib\\Events\\Test',
        'changeColorButton'
    ]
);

$eventManager->addEventHandler(
    'main',
    'onEpilog',
    [
        '\\Mib\\Events\\Test',
        'newLeftMenuItem'
    ]
);

$eventManager->addEventHandler(
    'main',
    'OnUserTypeBuildList',
    [
        '\\Mib\\Currency\\CurrencyField',
        'getUserTypeDescription'
    ]
);
