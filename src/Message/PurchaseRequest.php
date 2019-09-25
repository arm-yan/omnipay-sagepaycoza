<?php

namespace Omnipay\SagePay\Message;

use Omnipay\SagePay\Helpers\ParametersTrait;

/**
 * SagePay Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
    use ParametersTrait;

    /**
     * Prepare data to send
     * @return array|mixed
     */
    public function getData()
    {
        $this->validate('amount', 'currency',
            'confirmationType', 'returnUrl');

        $data = [
            'amount'      => [
                'value'    => $this->getAmount(),
                'currency' => $this->getCurrency()
            ],
            'client_ip'   => $this->getClientIp(),
            'description' => $this->getDescription()
        ];

        if ($this->getItems()) {
            $data['receipt']['items'] = $this->getItems();

            if ($this->getTaxSystemCode()) {
                $data['receipt']['tax_system_code'] = $this->getTaxSystemCode();
            }

            if ($this->getPhone()) {
                $data['receipt']['phone'] = $this->getPhone();
            } elseif ($this->getEmail()) {
                $data['receipt']['email'] = $this->getEmail();
            }
        }

        if ($this->getConfirmationType()) {
            $data['confirmation']['type'] = $this->getConfirmationType();
            $data['confirmation']['return_url'] = $this->getReturnUrl();
        }

        if ($this->getGatewayId()) {
            $data['recipient']['gateway_id'] = $this->getGatewayId();
        }

        if ($this->getPaymentMethodId()) {
            $data['payment_method_id'] = $this->getPaymentMethodId();
        }

        if ($this->getSavePaymentMethod()) {
            $data['save_payment_method'] = $this->getSavePaymentMethod();
        }

        if ($this->getCapture()) {
            $data['capture'] = $this->getCapture();
        }

        if ($this->getMetadata()) {
            $data['metadata'] = $this->getMetadata();
        }

        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data
     *
     * @return \Omnipay\Common\Message\ResponseInterface|\Omnipay\SagePay\Message\PurchaseResponse
     */
    public function sendData($data)
    {
        $response = $this->sagepay->createPayment($data);

        return $this->response = new PurchaseResponse($this, $response);
    }
}
