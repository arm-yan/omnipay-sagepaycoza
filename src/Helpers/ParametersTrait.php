<?php

namespace Omnipay\SagePay\Helpers;

/**
 * Trait ParametersTrait
 * @package Omnipay\SagePay
 */
trait ParametersTrait
{
    /**
     * Sets the request Account.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setAccount($value)
    {
        return $this->setParameter('account', $value);
    }

    /**
     * Get the request Account.
     * @return $this
     */
    public function getAccount()
    {
        return $this->getParameter('account');
    }

    /**
     * Sets the request secret key.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    /**
     * Get the request secret key.
     * @return $this
     */
    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    /**
     * Sets the request Amount
     * @param $value
     * @return mixed
     */
    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    /**
     * Get Amount
     * @return mixed
     */
    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    /**
     * Sets the request Currency
     * @param $value
     * @return mixed
     */
    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }

    /**
     * Get Currency
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->getParameter('currency');
    }

    /**
     * Get the request description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getParameter('description');
    }

    /**
     * Sets the request description.
     *
     * @param string $value
     * @return $this
     */
    public function setDescription($value)
    {
        return $this->setParameter('description', $value);
    }

    /**
     * Sets the request confirmation type.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setConfirmationType($value)
    {
        return $this->setParameter('confirmationType', $value);
    }

    /**
     * Get the request confirmation type.
     * @return $this
     */
    public function getConfirmationType()
    {
        return $this->getParameter('confirmationType');
    }

    /**
     * Sets the request Return Url.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setReturnUrl($value)
    {
        return $this->setParameter('returnUrl', $value);
    }

    /**
     * Get the request Return Url.
     * @return $this
     */
    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    /**
     * Sets the request save payment method.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setSavePaymentMethod($value)
    {
        return $this->setParameter('savePaymentMethod', !empty($value));
    }

    /**
     * Get the request save payment method.
     * @return $this
     */
    public function getSavePaymentMethod()
    {
        return $this->getParameter('savePaymentMethod');
    }

    /**
     * Sets the request capture.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setCapture($value)
    {
        return $this->setParameter('capture', !empty($value));
    }

    /**
     * Get the request capture.
     * @return $this
     */
    public function getCapture()
    {
        return $this->getParameter('capture');
    }

    /**
     * Sets the request Client Ip.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setClientIp($value)
    {
        return $this->setParameter('clientIp', $value);
    }

    /**
     * Get the request Client Ip.
     * @return $this
     */
    public function getClientIp()
    {
        return $this->getParameter('clientIp');
    }

    /**
     * Sets the request tax system code.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setTaxSystemCode($value)
    {
        return $this->setParameter('taxSystemCode', $value);
    }

    /**
     * Get the request tax system code.
     * @return $this
     */
    public function getTaxSystemCode()
    {
        return $this->getParameter('taxSystemCode');
    }

    /**
     * Sets the request phone.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setPhone($value)
    {
        return $this->setParameter('phone', $value);
    }

    /**
     * Get the request phone.
     * @return $this
     */
    public function getPhone()
    {
        return $this->getParameter('phone');
    }

    /**
     * Sets the request phone.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    /**
     * Get the request phone.
     * @return $this
     */
    public function getEmail()
    {
        return $this->getParameter('email');
    }

    /**
     * Sets the request gateway ID.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setGatewayId($value)
    {
        return $this->setParameter('gatewayId', $value);
    }

    /**
     * Get the request gateway ID.
     * @return $this
     */
    public function getGatewayId()
    {
        return $this->getParameter('gatewayId');
    }

    /**
     * Sets the request payment method ID.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setPaymentMethodId($value)
    {
        return $this->setParameter('paymentMethodId', $value);
    }

    /**
     * Get the request payment method ID.
     * @return $this
     */
    public function getPaymentMethodId()
    {
        return $this->getParameter('paymentMethodId');
    }

    /**
     * Sets the request metadata.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setMetadata($value)
    {
        return $this->setParameter('metadata', $value);
    }

    /**
     * Get the request metadata.
     * @return $this
     */
    public function getMetadata()
    {
        return $this->getParameter('metadata');
    }
}
