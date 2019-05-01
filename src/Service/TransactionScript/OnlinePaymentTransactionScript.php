<?php

namespace Service\TransactionScript;

class OnlinePaymentTransactionScript
{
    /**
     * @var int
     */
    private $sumOrder;

    public function __construct(int $sumOrder) {
        $this->sumOrder = $sumOrder;
    }

    private function checkPaymentData() {/*
        проверяются платежные данные клиента - возможно ли впринципе списать деньги со счета
    */}
    private function checkBalance(int $sum) {/*
        проверяем баланс клиента
    */}

    private function holdSum(int $sum) {/*
        удерживаем нужную сумму
    */}
    private function approveSum(int $sum) {/*
        проводим платеж
    */}

    public function makeTransaction() {
        $this->checkPaymentData();
        $this->checkBalance($this->sumOrder);
        $this->holdSum($this->sumOrder);
        $this->approveSum($this->sumOrder);
    }
}
