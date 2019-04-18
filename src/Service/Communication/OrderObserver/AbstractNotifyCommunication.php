<?php

namespace Service\Communication\OrderObserver;

use Model\Entity\User;
use Service\Communication\ICommunication;

abstract class AbstractNotifyCommunication implements Observer, ICommunication {
    public function update(User $user, string $templateName, array $params = []) : void {
        $this->process($user, $templateName, $params);
    }
}