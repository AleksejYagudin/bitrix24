<?php

class testRender extends \CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable
{
    public function configureActions()
    {
        // TODO: Implement configureActions() method.
    }

    //Не понятно как передатать с фронта ID сущности, для которой требуется действие
    //Может быть полезно: анализ массива с меню - можно выдернуть различные действия.
    public function renderAction(string $person)
    {

        return ['result' => 'succes'];
    }

}