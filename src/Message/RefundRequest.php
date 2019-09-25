<?php

namespace Omnipay\SagePay\Message;

use SagePay\Model\PaymentStatus;

/**
 * Class RefundRequest
 * @package Omnipay\SagePay\Message
 */
class RefundRequest extends AbstractRequest
{
    /**
     * Sets the request shop ID.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setShopId($value)
    {
        return $this->setParameter('shopId', $value);
    }

    /**
     * Get the request shop ID.
     * @return $this
     */
    public function getShopId()
    {
        return $this->getParameter('shopId');
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
     * Prepare data to send
     * @return array|mixed
     */
    public function getData()
    {
        $this->validate('amount', 'currency', 'paymentMethodId');

        return [
            'payment_id'  => $this->getPaymentMethodId(),
            'amount'      => [
                'value'    => $this->getAmount(),
                'currency' => $this->getCurrency()
            ],
            'description' => $this->getDescription()
        ];
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data
     *
     * @return \Omnipay\Common\Message\ResponseInterface|\Omnipay\SagePay\Message\RefundResponse
     */
    public function sendData($data)
    {
        $payment = $this->sagepay->createRefund($data);

        if ($payment->getStatus() == PaymentStatus::WAITING_FOR_CAPTURE) {
            $response = $this->sagepay->capturePayment(['amount' => array_get($data, 'amount', [])], $payment->getId());
        } else {
            $response = $payment;
        }

        return $this->response = new RefundResponse($this, $response);
    }
}
