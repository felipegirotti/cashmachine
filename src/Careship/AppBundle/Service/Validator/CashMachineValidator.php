<?php

namespace Careship\AppBundle\Service\Validator;

use Careship\AppBundle\Service\BankNotesService;
use Careship\AppBundle\Service\Exception\NoteUnavailableException;
use \InvalidArgumentException;

class CashMachineValidator
{
    /**
     * @var BankNotesService
     */
    private $banknotes;

    /**
     * CashMachineValidator constructor.
     *
     * @param BankNotesService $banknotes
     */
    public function __construct(BankNotesService $banknotes)
    {
        $this->banknotes = $banknotes;
    }

    /**
     * @param int $value
     * @return boolean
     * @throws NoteUnavailableException InvalidArgumentException
     */
    public function validate($value)
    {
        $this->validateValue($value);
        $this->verifyAvailability($value);

        return true;
    }

    /**
     * Validate value passed to withdraw
     *
     * @param int $value
     * @throws InvalidArgumentException
     */
    private function validateValue($value)
    {
        if ($value != null && $value < 0) {
            throw new InvalidArgumentException('The value is not acceptable.');
        }
    }

    /**
     * Verify if is notes available to withdraw in CashMachine
     *
     * @param int $value
     *
     * @throws NoteUnavailableException
     */
    private function verifyAvailability($value)
    {
        $filtered = array_filter(
            $this->banknotes->getBanknotes(),
            function($note) use ($value) {
                return ($value % $note === 0);
            }
        );
        if (count($filtered) == 0) {
            throw new NoteUnavailableException('Note not available for this value.');
        }
    }
}
