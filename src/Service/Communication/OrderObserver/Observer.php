<?php

namespace Service\Communication\OrderObserver;
use Model\Entity\User;

interface Observer {
    /**
     * Реагируем на изменение в наблюдаемом объекте
     * 
     */
    public function update(User $user, string $templateName, array $params = []) : void;
}