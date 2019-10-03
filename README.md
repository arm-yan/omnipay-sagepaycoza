# Omnipay: SagePayCoZa

**SagePayCoZa driver for the Omnipay Laravel payment processing library**

[![Latest Stable Version](https://poser.pugx.org/armyan/omnipay-sagepaycoza/v/stable)](https://packagist.org/packages/armyan/omnipay-sagepaycoza)
[![Total Downloads](https://poser.pugx.org/armyan/omnipay-sagepaycoza/d/total.png)](https://packagist.org/packages/armyan/omnipay-sagepaycoza)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.5+. This package implements SagePayCoZa support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "armyan/omnipay-sagepaycoza": "dev-master"
    }
}
```

And run composer to update your dependencies:

    composer update

Or you can simply run

    composer require armyan/omnipay-sagepaycoza

## Basic Usage

1. Use Omnipay gateway class:

```php
    use Omnipay\Omnipay;
```

2. Initialize SagePayCoZa gateway:

```php

    $gateway = Omnipay::create('SagePay');
    $gateway->setVendorKey(env('VENDOR_KEY'));
    $gateway->setAccountId(env('ACCOUNT_ID'));
    $gateway->setServiceKey(env('SERVICE_KEY')); // Language
    $gateway->setAmount(10); // Amount to charge
    $gateway->setTransactionId(XXXX); // Transaction ID from your system

```

3. Call purchase, it will automatically redirect to SagePayCoZa's hosted page

```php

    $purchase = $gateway->purchase()->send();
    $purchase->redirect();

```

4. Create a webhook controller to handle the callback request at your `RESULT_URL` and catch the webhook as follows

```php

    $gateway = Omnipay::create('SagePay');
    $gateway->setAccountId(env('ACCOUNT_ID'));
    $gateway->setServiceKey(env('SERVICE_KEY'));
    
    $purchase = $gateway->completePurchase()->send();
    
    // Do the rest with $purchase and response with 'OK'
    if ($purchase->isSuccessful()) {
        
        // Your logic
        
    }
    
    return new Response('OK');

```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/arm-yan/omnipay-sagepaycoza/issues),
or better yet, fork the library and submit a pull request.
