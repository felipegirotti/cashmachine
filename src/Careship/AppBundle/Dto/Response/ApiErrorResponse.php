<?php

namespace Careship\AppBundle\Dto\Response;

class ApiErrorResponse
{
    /**
     * @var string
     */
    private $error;

    /**
     * @var int
     */
    private $code;

    /**
     * ApiErrorResponse constructor.
     *
     * @param string $error
     * @param int $code
     */
    public function __construct(string $error, int $code)
    {
        $this->error = $error;
        $this->code = $code;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'error' => $this->error
        ];
    }
}
