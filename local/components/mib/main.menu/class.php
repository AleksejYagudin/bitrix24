<?php

namespace Aclips\Components;

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorableImplementation;

class MainMenuComponent extends \CBitrixComponent implements Controllerable, Errorable
{
    use ErrorableImplementation;

    public function __construct($component = null)
    {

        parent::__construct($component);
    }

    public function configureActions()
    {
        return [];
    }


    public function executeComponent()
    {

        $this->includeComponentTemplate();
    }

    public function chanageMenuItemsAction()
    {

        return ['result' => 'success'];
    }

}