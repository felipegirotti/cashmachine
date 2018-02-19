<?php

namespace Careship\AppBundle\Service;

class CashMachineServiceImpl implements CashMachineService
{

    /**
     * @var BankNotesService
     */
    private $banknotes;

    /**
     * @var array
     */
    private $withdrawBanknotes = [];

    public function __construct(BankNotesService $banknotes)
    {
        $this->banknotes = $banknotes;
    }
    /**
     * Withdraw some money
     *
     * @param int
     *
     * @return array
     */
    public function withDraw($value): array
    {
        while ($value > 0) {
            $this->banknotes->filterMaxValue($value);
            $banknote = $this->banknotes->getGreater();
            $this->withdrawBanknotes[] = $banknote;
            $value -= $banknote;
        }
        return $this->withdrawBanknotes;
    }
}
