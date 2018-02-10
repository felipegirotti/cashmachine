<?php

namespace Careship\AppBundle\Controller;

use Careship\AppBundle\Service\CashMachineServiceImpl;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CashMachineController
{

    /**
     * @var CashMachineServiceImpl
     */
    private $cashMachineService;

    /**
     * CashMachineController constructor.
     *
     * @param CashMachineServiceImpl $cashMachineService
     */
    public function __construct(CashMachineServiceImpl $cashMachineService)
    {
        $this->cashMachineService = $cashMachineService;
    }

    /**
     * @Method("GET")
     * @Route("/{value}", requirements={ "value": "\d+" }, defaults={"value" = 0}, name="cache_machine.with_draw")
     */
    public function withDraw($value)
    {
//        $value = $request->get('value', 0);
        $cash = $this->cashMachineService->withDraw($value);

        return new JsonResponse(['cash' => $cash]);
    }
}
