<?php

declare(strict_types = 1);

namespace Service\Communication;

use Model;
use Service\Communication\OrderObserver\AbstractNotifyCommunication;

class Email extends AbstractNotifyCommunication implements ICommunication
{
    /**
     * @inheritdoc
     */
    public function process(Model\Entity\User $user, string $templateName, array $params = []): void
    {
        // Вызываем метод по формированию тела письма и последующего его отправления
        //var_dump("Email оповещение");
    }
}
