<?php

namespace Omnipay\SagePay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Http\ClientInterface;
use Omnipay\SagePay\Helpers\ParametersTrait;
use Omnipay\SagePay\Message\RefundRequest;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Omnipay\SagePay\Message\CompletePurchaseRequest;
use Omnipay\SagePay\Message\PurchaseRequest;

/**
 * Class Gateway
 * @package Omnipay\Bizmail
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 */
class Gateway extends AbstractGateway
{
    use ParametersTrait;

     protected $sagepay;

    /**
     * Gateway constructor.
     *
     * @param \Omnipay\Common\Http\ClientInterface|null      $httpClient
     * @param \Symfony\Component\HttpFoundation\Request|null $httpRequest
     */
    public function __construct(ClientInterface $httpClient = null, HttpRequest $httpRequest = null)
    {
        $this->sagepay = new Client();

        parent::__construct($httpClient, $httpRequest);
    }

    /**
     * Create request
     *
     * @param string $class
     * @param array  $parameters
     *
     * @return mixed|\Omnipay\Common\Message\AbstractRequest
     */
    public function createRequest($class, array $parameters)
    {
        $this->sagepay->setAuth($this->getAccount(), $this->getSecretKey());

        $obj = new $class($this->httpClient, $this->httpRequest, $this->sagepay);

        return $obj->initialize(array_replace($this->getParameters(), $parameters));
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return 'SagePay';
    }

    /**
     * Get default parameters
     * @return array|\Illuminate\Config\Repository|mixed
     */
    public function getDefaultParameters()
    {
        return [
            'account'    => '',
            'secretKey' => '',
            'returnUrl' => '',
        ];
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    /**
     * Complete purchase
     *
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest(CompletePurchaseRequest::class, $parameters);
    }

    /**
     * Create a refund request
     *
     * @param array $options
     *
     * @return mixed|\Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function refund(array $options = array())
    {
        return $this->createRequest(RefundRequest::class, $options);
    }
}
