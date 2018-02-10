<?php

namespace Tests\AppBundle\Service;

use Careship\AppBundle\Service\BankNotesServiceImpl;
use Careship\AppBundle\Service\CashMachineServiceImpl;
use Careship\AppBundle\Service\Validator\CashMachineValidator;
use PHPUnit\Framework\TestCase;

class CashMachineServiceTest extends TestCase
{
    /**
     * @var \Careship\AppBundle\Service\CashMachineService
     */
    private $cashMachine;

    protected function setUp()
    {
        $bankNotesService = new BankNotesServiceImpl();
        $this->cashMachine = new CashMachineServiceImpl(
            new CashMachineValidator($bankNotesService),
            $bankNotesService
        );
    }

    public function testExecute30()
    {
        $this->assertEquals(
            array(20, 10),
            $this->cashMachine->withDraw(30)
        );
    }

    public function testExecute80()
    {
        $this->assertEquals(
            array(50, 20, 10),
            $this->cashMachine->withDraw(80)
        );
    }

    public function testExecuteNull()
    {
        $this->assertEmpty(
            $this->cashMachine->withDraw(null)
        );
    }

    /**
     * @expectedException \Careship\AppBundle\Service\Exception\NoteUnavailableException
     */
    public function testExecute125Exception()
    {
        $this->cashMachine->withDraw(125);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNegativeException()
    {
        $this->cashMachine->withDraw(-130);
    }
}
