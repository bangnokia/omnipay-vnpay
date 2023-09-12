<?php

namespace Omnipay\VNPay\Tests\Mock;

use Omnipay\VNPay\Support\Signature;

class SignatureMock extends Signature
{
    public function generate(array $data): string
    {
        return 'FOO';
    }

    public function validate(array $data, string $expect): bool
    {
        return 'FOO' === $expect;
    }
}
