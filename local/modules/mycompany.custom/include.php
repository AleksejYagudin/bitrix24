<?php
use Bitrix\Main\EventManager;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/*
 * Здесь размещается код, выполняемый каждый раз при подключении этого модуля
 */

require_once __DIR__ . "/functions.php";
require_once __DIR__ . "/constants.php";

$eventManager = EventManager::getInstance();

$eventManager->addEventHandler('crm', 'OnAfterCrmControlPanelBuild', [
    '\MyCompany\Custom\EventHandlers\Menu',
    'addItems'
]);

//$eventManager->unRegisterEventHandler('crm', 'OnAfterCrmControlPanelBuild','mycompany.custom', '\MyCompany\Custom\EventHandlers\Main', 'addStores');

