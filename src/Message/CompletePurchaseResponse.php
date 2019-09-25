<?php

namespace Omnipay\SagePay\Message;

use Omnipay\Common\Message\AbstractResponse;
use SagePay\Model\PaymentStatus;

/**
 * SagePay Complete Purchase Response
 */
class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * Get successful status
     * @return bool
     */
    public function isSuccessful()
    {
        return ($this->data['status'] === PaymentStatus::SUCCEEDED);
    }

    /**
     * Get TransactionId
     * @return string
     */
    public function getTransactionId()
    {
        return $this->data['id'];
    }


    /**
     * Get
     * @return null|string
     */
    public function getTransactionReference()
    {
        return $this->getTransactionId();
    }

    /**
     * Get Description
     * @return string
     */
    public function getDescription()
    {
        return $this->data['description'];
    }

    /**
     * Get Payment Method Data
     * @return string
     */
    public function getPaymentMethodData()
    {
        return $this->data['payment_method'];
    }

    /**
     * Get Message
     * @return null|string
     */
    public function getMessage()
    {
        return $this->data['description'];
    }
}
