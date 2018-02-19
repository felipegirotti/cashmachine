<?php

namespace Careship\AppBundle\Controller;

use Careship\AppBundle\Dto\Request\WithDrawRequest;
use Careship\AppBundle\Service\CashMachineServiceImpl;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @ParamConverter(name="withDrawRequest", converter="withdraw_param_converter")
     * @param WithDrawRequest $withDrawRequest
     * @return JsonResponse
     */
    public function withDraw(WithDrawRequest $withDrawRequest)
    {
        $cash = $this->cashMachineService->withDraw($withDrawRequest->getValue());

        return new JsonResponse(['code' => 200, 'data' => ['cash' => $cash]]);
    }
}
