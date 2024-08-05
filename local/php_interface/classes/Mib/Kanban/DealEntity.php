<?php

namespace Mib\Kanban;

use Bitrix\Crm\Kanban\Entity\Deal;
use Bitrix\Crm\PhaseSemantics;
use Bitrix\Main\DI\ServiceLocator;
use Bitrix\Main\Error;
use Bitrix\Main\Loader;
use Bitrix\Main\Result;
use Mib\Deal\Observer;

Loader::requireModule('crm');

class DealEntity extends Deal
{
    public static function registerService(): void {
        $serviceLocator = ServiceLocator::getInstance();
        $serviceLocator->addInstance('crm.kanban.entity.deal', new DealEntity());
    }

    public function updateItemStage(int $id, string $stageId, array $newStateParams, array $stages): Result
    {
        $result = $this->getItemViaLoadedItems($id);
        if (!$result->isSuccess()) {
            return $result;
        }

        $item = $result->getData()['item'];
        $newStage = $this->factory->getStage($stageId);
        if ($item['STAGE_ID'] == $stageId || !PhaseSemantics::isLost($newStage->getSemantics())) {
            return parent::updateItemStage($id, $stageId, $newStateParams, $stages);
        }

        $lastComment = Observer::getLastComment($id);
        if (empty($lastComment) || $lastComment['AUTHOR_ID'] != $item['ASSIGNED_BY_ID']) {
            return $result->addError(new Error('Чтобы перевести сделку в неуспешный статус, необходимо, чтобы ответственный оставил комментарий. Внесённые изменения не будут применены.'));
        }

        return parent::updateItemStage($id, $stageId, $newStateParams, $stages);
    }
}