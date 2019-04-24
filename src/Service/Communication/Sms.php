<?php

declare(strict_types = 1);

namespace Service\Communication;

use Model;
use Service\Communication\OrderObserver\AbstractNotifyCommunication;

class Sms extends AbstractNotifyCommunication
{
    /**
     * @inheritdoc
     */
    public function process(Model\Entity\User $user, string $templateName, array $params = []): void
    {
        // Вызываем метод по формированию смс текста и последующего его отправления
        //var_dump("SMS оповещение");
    }
}