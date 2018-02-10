<?php

namespace Careship\AppBundle\Service;

interface CashMachineService
{
    /**
     * @param int $input
     * @return array
     */
    public function withDraw($input): array;
}
