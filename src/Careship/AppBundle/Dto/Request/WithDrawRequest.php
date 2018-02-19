<?php

namespace Careship\AppBundle\Dto\Request;

class WithDrawRequest
{

    /**
     * @var int
     */
    private $value;

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value)
    {
        $this->value = $value;
    }
}
