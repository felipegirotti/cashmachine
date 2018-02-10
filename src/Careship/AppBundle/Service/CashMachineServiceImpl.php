<?php

namespace Careship\AppBundle\Service;

use Careship\AppBundle\Service\Validator\CashMachineValidator;

class CashMachineServiceImpl implements CashMachineService
{

    /**
     * @var BankNotesService
     */
    private $banknotes;

    /**
     * @var CashMachineValidator
     */
    private $validator;

    /**
     * @var array
     */
    private $withdrawBanknotes = [];

    public function __construct(CashMachineValidator $validator, BankNotesService $banknotes)
    {
        $this->banknotes = $banknotes;
        $this->validator = $validator;
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
        $this->validator->validate($value);

        while ($value > 0) {
            $this->banknotes->filterMaxValue($value);
            $banknote = $this->banknotes->getGreater();
            $this->withdrawBanknotes[] = $banknote;
            $value -= $banknote;
        }
        return $this->withdrawBanknotes;
    }
}
