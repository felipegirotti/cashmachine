<?php

namespace Tests\AppBundle\Validator;

use Careship\AppBundle\Service\BankNotesServiceImpl;
use Careship\AppBundle\Validator\CashMachineValidator;
use PHPUnit\Framework\TestCase;

class CashMachineValidatorTest extends TestCase
{

    /**
     * @param int $value
     * @param bool $expectedResponse
     * @param string|null $expectedException
     * @dataProvider validatorDataProvider
     */
    public function testValidator(int $value, bool $expectedResponse, ?string $expectedException)
    {
        $validator = new CashMachineValidator(new BankNotesServiceImpl());


        $response = false;
        $exception = null;
        try {
            $response = $validator->validate($value);
        } catch (\Exception $e) {
            $exception = get_class($e);
        }

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedException, $exception);
    }

    public function validatorDataProvider()
    {
        return [
            [10, true, null],
            [20, true, null],
            [50, true, null],
            [150, true, null],
            [33, false, \Careship\AppBundle\Service\Exception\NoteUnavailableException::class],
            [-10, false, \InvalidArgumentException::class],
        ];
    }
}
