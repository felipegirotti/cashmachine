<?php

namespace Tests\AppBundle\Service;

use Careship\AppBundle\Service\BankNotesService;
use Careship\AppBundle\Service\BankNotesServiceImpl;
use PHPUnit\Framework\TestCase;

class BankNotesServiceTest extends TestCase
{
    /**
     * @var BankNotesService
     */
    private $banknotes;
    public function setUp()
    {
        $this->banknotes = new BankNotesServiceImpl();
    }
    public function testGetGreater()
    {
        $this->assertEquals(100, $this->banknotes->getGreater());
    }
    public function testFilterMaxValue()
    {
        $this->banknotes->filterMaxValue(10);
        $this->assertEquals(array(10), $this->banknotes->getBanknotes());
    }
}
