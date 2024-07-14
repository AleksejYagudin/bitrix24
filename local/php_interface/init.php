<?php

spl_autoload_register(function($sClassName)
{
    $sClassFile = __DIR__.'/classes';

    if ( file_exists($sClassFile.'/'.str_replace('\\', '/', $sClassName).'.php') )
    {
        require_once($sClassFile.'/'.str_replace('\\', '/', $sClassName).'.php');
        return;
    }

    $arClass = explode('\\', strtolower($sClassName));
    foreach($arClass as $sPath )
    {
        $sClassFile .= '/'.ucfirst($sPath);
    }

    $sClassFile .= '.php';
    if (file_exists($sClassFile))
    {
        require_once($sClassFile);
    }
});

foreach( [
             __DIR__.'/kernel.php',
             __DIR__.'/events.php',
             __DIR__.'/vendor/autoload.php',
         ]
         as $filePath ) {
    if ( file_exists($filePath) )
    {
        require_once($filePath);
    }
}

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler('main', 'OnUserTypeBuildList', [
    '\Main\GroupBinding',
    'getUserTypeDescription'
]);
