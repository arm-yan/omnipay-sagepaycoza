<?php

namespace Omnipay\SagePay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\SagePay\Helpers\ParametersTrait;

/**
 * SagePay Purchase Response
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    use ParametersTrait;

    /**
     * Get redirect status
     * @return bool
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * Get successful status
     * @return bool
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * Get pending status
     * @return bool
     */
    public function isPending()
    {
        return false;
    }

    /**
     * Get redirect Url
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->data->getConfirmation()->confirmationUrl;
    }

    /**
     * Get TransactionId
     * @return string
     */
    public function getTransactionId()
    {
        return $this->data->getId();
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
     * Gets the redirect form data array, if the redirect method is POST.
     * @return array
     */
    public function getRedirectData()
    {
        return $this->data;
    }

    /**
     * Get Message
     * @return null|string
     */
    public function getMessage()
    {
        return $this->data->getDescription();
    }
}
