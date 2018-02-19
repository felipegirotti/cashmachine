<?php

namespace Careship\AppBundle\EventListener;

use Careship\AppBundle\Dto\Response\ApiErrorResponse;
use Careship\AppBundle\Exception\ApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        $response = new JsonResponse();

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } elseif ($exception instanceof \InvalidArgumentException || $exception instanceof ApiException) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $apiResponse = new ApiErrorResponse($exception->getMessage(), $response->getStatusCode());
        $response->setData($apiResponse->toArray());

        // sends the modified response object to the event
        $event->setResponse($response);
    }
}
