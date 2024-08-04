<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use \Mib\Watcher\ActivityWatcher;
use Bitrix\Main\Config\Option;

CAgent::AddAgent(
    ActivityWatcher::class . '::runAgent();',
    'b24.academy',
    'Y',
    60,
    '',
    'Y',
    \Bitrix\Main\Type\DateTime::createFromPhp(new DateTime('tomorrow 12am'))
);