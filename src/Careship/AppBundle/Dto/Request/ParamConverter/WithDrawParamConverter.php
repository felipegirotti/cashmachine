<?php

namespace Careship\AppBundle\Dto\Request\ParamConverter;

use Careship\AppBundle\Dto\Request\WithDrawRequest;
use Careship\AppBundle\Validator\CashMachineValidator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class WithDrawParamConverter implements  ParamConverterInterface
{

    /**
     * @var CashMachineValidator
     */
    private $cashMachineValidator;

    /**
     * WithDrawParamConverter constructor.
     *
     * @param CashMachineValidator $cashMachineValidator
     */
    public function __construct(CashMachineValidator $cashMachineValidator)
    {
        $this->cashMachineValidator = $cashMachineValidator;
    }

    /**
     * Stores the object in the request.
     *
     * @param ParamConverter $configuration Contains the name, class and options of the object
     *
     * @return bool True if the object has been successfully set, else false
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $this->cashMachineValidator->validate($request->get('value'));

        $withDraw = new WithDrawRequest();
        $withDraw->setValue($request->get('value'));
        $request->attributes->set($configuration->getName(), $withDraw);
        return true;
    }

    /**
     * Checks if the object is supported.
     *
     * @return bool True if the object is supported, else false
     */
    public function supports(ParamConverter $configuration)
    {
        return $configuration->getClass() === WithDrawRequest::class;
    }
}
