<?php

declare(strict_types=1);

// namespace Gio;  // * this is how you create a namespace

namespace PaymentGateway\Paddle; // * this is how you create a namespace (and sub-namespaces)

//use DateTime; // * ALTERNATIVE WAY OF IMPORTING A CLASS FROM THE GLOBAL NAMESPACE (built-in php classes)

use PaymentGateway\Stripe\Transaction3 as StripeTransaction; // Like This


class Transaction3
{
    private CustomerProfile $customerProfile; // we don't need to use the full namespace here, because this file and the 'CustomerProfile' class are in the same namespace
    private \Notification\Email $email;

    public function __construct()
    {
        $this->stripeTransaction = new StripeTransaction(); // This works because we are using the 'StripeTransaction' class, which is in the same namespace as this class
        $this->customerProfile = new CustomerProfile();
        $this->email = new \Notification\Email;
        // var_dump(new DateTime()); // ! this won't work because we don't have a DateTime class in the same namespace (the 'DateTime' is a global php built-in class)
        var_dump(new \DateTime()); // This works because we are specifying the namespace as the global namespace (built-in php classes)

        var_dump(explode(',', 'hello world')); // This works because we are calling a built-in function, and not a built-in class...
    }
}