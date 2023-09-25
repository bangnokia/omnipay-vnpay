<?php
/**
 * @link https://github.com/phpviet/omnipay-vnpay
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\VNPay\Message\Concerns;

use Omnipay\VNPay\Support\Signature;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait RequestSignature
{
    /**
     * Trả về chữ ký điện tử gửi đến VNPay dựa theo [[getSignatureParameters()]].
     *
     * @return string
     */
    protected function generateSignature(): string
    {
        $data = [];

        foreach ($this->getSignatureParameters() as $parameter) {
            $data[$parameter] = $this->getParameter($parameter);
        }

        $signature = new Signature($this->getVnpHashSecret());

        return $signature->generate($data);
    }

    /**
     * Trả về danh sách parameters dùng để tạo chữ ký số.
     *
     * @return array
     */
    abstract protected function getSignatureParameters(): array;
}
