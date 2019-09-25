<?php

namespace Omnipay\SagePay\Message;

use Omnipay\Common\Http\ClientInterface;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\SagePay\Helpers\ParametersTrait;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class AbstractRequest
 * @package Omnipay\SagePay\Message
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    use ParametersTrait;


    protected $sagepay;

    /**
     * AbstractRequest constructor.
     *
     * @param \Omnipay\Common\Http\ClientInterface      $httpClient
     * @param \Symfony\Component\HttpFoundation\Request $httpRequest
     */
    public function __construct(ClientInterface $httpClient, HttpRequest $httpRequest, Client $sagepay)
    {
        $this->sagepay = $sagepay;

        parent::__construct($httpClient, $httpRequest);
    }
}
