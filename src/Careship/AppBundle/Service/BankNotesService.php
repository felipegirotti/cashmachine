<?php

namespace Careship\AppBundle\Service;

interface BankNotesService
{

    /**
     * Get banknotes
     *
     * @return array
     */
    public function getBanknotes(): array;

    /**
     * Filter max value to banknotes
     *
     * @param int $max
     */
    public function filterMaxValue(int $max);

    /**
     * Get grater banknote
     *
     * @return float|int
     */
    public function getGreater();
}
