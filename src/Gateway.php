<?php

namespace Omnipay\SagePayCoZa;

use Omnipay\Common\Http\ClientInterface;
use Omnipay\Common\AbstractGateway;
use Omnipay\SagePayCoZa\Message\CompletePurchaseRequest;
use Omnipay\SagePayCoZa\Message\PurchaseRequest;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class Gateway
 * @package Omnipay\SagePayCoZa
 */
class Gateway extends AbstractGateway
{
    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return 'SagePay';
    }

    /**
     * Gateway constructor.
     *
     * @param \Omnipay\Common\Http\ClientInterface|null      $httpClient
     * @param \Symfony\Component\HttpFoundation\Request|null $httpRequest
     */
    public function __construct(ClientInterface $httpClient = null, HttpRequest $httpRequest = null)
    {
        parent::__construct($httpClient, $httpRequest);
    }

    /**
     * Get default parameters
     * @return array|\Illuminate\Config\Repository|mixed
     */
    public function getDefaultParameters()
    {
        return [
            'serviceKey' => '',
            'vendorKey' => '24ade73c-98cf-47b3-99be-cc7b867b3080',
        ];
    }

    /**
     * Sets the request account ID.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setAccountId($value)
    {
        return $this->setParameter('accountId', $value);
    }

    /**
     * Get the request account ID.
     * @return mixed
     */
    public function getAccountId()
    {
        return $this->getParameter('accountId');
    }

    /**
     * Sets the request Pay Now Service Key.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setServiceKey($value)
    {
        return $this->setParameter('serviceKey', $value);
    }

    /**
     * Get the request Pay Now Service Key.
     * @return mixed
     */
    public function getServiceKey()
    {
        return $this->getParameter('serviceKey');
    }

    /**
     * Sets the request Pay Now Vendor Key.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setVendorKey($value)
    {
        return $this->setParameter('vendorKey', $value);
    }

    /**
     * Get the request Pay Now Vendor Key.
     * @return mixed
     */
    public function getVendorKey()
    {
        return $this->getParameter('vendorKey');
    }


    /**
     * Create a purchase request
     *
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function purchase(array $options = array())
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * Complete purchase
     *
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function completePurchase(array $options = array())
    {
        return $this->createRequest(CompletePurchaseRequest::class, $options);
    }
}
