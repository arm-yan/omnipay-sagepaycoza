<?php

namespace App\Gateways;

use App;
use Exception;
use Illuminate\Support\Arr;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Omnipay;
use Ptuchik\Billing\Contracts\Billable;
use Ptuchik\Billing\Contracts\PaymentGateway;
use Ptuchik\Billing\Models\Order;
use Ptuchik\Billing\Models\Plan;
use Ptuchik\Billing\Models\Subscription;
use Ptuchik\Billing\Factory as BillingFactory;
use Ptuchik\Billing\Models\PaymentMethod;

/**
 * Class SagePay
 * @package App\Gateways
 */
class SagePay implements PaymentGateway
{
    public $name = 'SagePay';

    /**
     * @var \Omnipay\Common\GatewayInterface
     */
    protected $gateway;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var \App\User
     */
    protected $user;

    /**
     * Gateway currency
     * @var string
     */
    protected $currency = 'ZAR';

    /**
     * SagePay constructor.
     *
     * @param \Ptuchik\Billing\Contracts\Billable $user
     * @param array                               $config
     */
    public function __construct(Billable $user, array $config = [])
    {
        $this->user = $user;
        $this->config = $config;
        $this->gateway = Omnipay::create(Arr::get($this->config, 'driver'));
        $this->setCredentials();
    }

    /**
     * Set credentials
     *
     * @return void
     */
    protected function setCredentials()
    {
        $this->gateway->setVendorKey(Arr::get($this->config, 'vendorKey'));
        $this->gateway->setAccountId(Arr::get($this->config, 'accountId'));
        $this->gateway->setServiceKey(Arr::get($this->config, 'serviceKey'));

    }

    /**
     * Purchase
     *
     * @param                                    $amount
     * @param string|null                        $description
     * @param \Ptuchik\Billing\Models\Order|null $order
     *
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function purchase($amount, string $description = null, Order $order = null) : ResponseInterface
    {
        $purchaseData = $this->gateway->purchase();


        // Set transaction ID from $order if provided
        if ($order) {
            $purchaseData->setTransactionId($order->id);
        }

        // Set amount
        $purchaseData->setAmount($amount);

        // Set description
        if ($order && (($reference = $order->reference) instanceof Plan || $reference instanceof Subscription)) {
            $purchaseData->setDescription($reference->name);
        } else {
            $purchaseData->setDescription($description);
        }

        // Finally charge user and return the gateway purchase response
        return $purchaseData->send();
    }

    /**
     * Complete purchase
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function completePurchase()
    {
        return $this->gateway->completePurchase()->send();
    }

    /**
     * @param string                             $nonce
     * @param \Ptuchik\Billing\Models\Order|null $order
     *
     * @return mixed|void
     * @throws Exception
     */
    public function createPaymentMethod(string $nonce, Order $order = null)
    {
        return;
    }

    /**
     * Parse Payment Method
     *
     * @param $paymentData
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function parsePaymentMethod($paymentData)
    {
        $paymentMethod = BillingFactory::get(PaymentMethod::class, true);
        $paymentMethod->token = '';
        $paymentMethod->type = $this->name;
        $paymentMethod->last4 = '';
        $paymentMethod->gateway = $this->name;

        return $paymentMethod;
    }

    /**
     * Get payment methods
     * @return array
     */
    public function getPaymentMethods() : array
    {
        return [];
    }

    /**
     * Not supported
     *
     * @param string $token
     *
     * @return mixed|void
     */
    public function setDefaultPaymentMethod(string $token)
    {
        return;
    }

    /**
     * Not supported
     *
     * @param string $token
     *
     * @return mixed|void
     */
    public function deletePaymentMethod(string $token)
    {
        return;
    }

    /**
     * Get payment method from last success transaction of provided user
     * @return mixed|void
     */
    public function createPaymentProfile()
    {
        return;
    }

    /**
     * Not supported
     * @return mixed|void
     */
    public function findCustomer()
    {
        return;
    }

    /**
     * Not supported
     * @return mixed|void
     */
    public function getPaymentToken()
    {
        return;
    }

    /**
     * @param string $reference
     *
     * @return mixed|string
     */
    public function void(string $reference)
    {
        return;
    }

    /**
     * ReversePayment Payment
     *
     * @param string $reference
     *
     * @return mixed|string
     * @throws \Exception
     */
    public function refund(string $reference)
    {
        return;
    }
}