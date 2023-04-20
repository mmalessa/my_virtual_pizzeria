<?php

declare(strict_types=1);

namespace App\OrderManager\Application\MessageHandler\TableService;

use App\OrderManager\Application\Message\Waiter\Command\ThankClient;
use App\OrderManager\Application\Message\Waiter\Event\BillPaid;
use App\OrderManager\Application\MessageHandler\TableServiceAbstract;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class BillPaidHandler extends TableServiceAbstract
{
    public function __invoke(BillPaid $event)
    {
        $sagaId = $event->sagaId;
        $this->logger->info(sprintf("[%s] onBillPaid", $sagaId));
        $tableService = $this->tableServiceRepository->get($sagaId);
        $tableService->finishService();
        $this->tableServiceRepository->save($tableService);
        $this->logger->info(sprintf("[%s] Dispatch->ThankClient", $sagaId));
        $this->messageBus->dispatch(new ThankClient($sagaId));
    }
}