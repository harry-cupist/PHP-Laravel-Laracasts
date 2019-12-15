<?php namespace Acme;

class AreaCalculator {
    public function calculate($shapes)
    {
        foreach ($shapes as $shape)
        {
            $area[] = $shape->area();
        }

        return array_sum($area);
    }
}


interface PaymentMethodInterface {
    public function acceptPayment($receipt);
}

class CashPaymentMethod implements PaymentMethodInterface {
    public function acceptPayment($receipt)
    {

    }
}

class Checkout{
    public function begin(Receipt $receipt, PaymentMethodInterface $payment)
    {
        $payment->acceptPayment();
    }
}
