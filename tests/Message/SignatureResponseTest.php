<?php
/**
 * @link https://github.com/phpviet/omnipay-vnpay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VNPay\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\VNPay\Message\SignatureResponse;
use Omnipay\VNPay\Support\Signature;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class SignatureResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new SignatureResponse($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);
        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testIncoming()
    {
        $request = $this->getMockRequest();
        $request->shouldReceive('getVnpHashSecret')->once()->andReturn('RAOEXHYVSDDIIENYWSLDIIZTANXUXZFJ');
        $response = new SignatureResponse($request, [
            'vnp_Amount' => 1000000,
            'vnp_BankCode' => 'NCB',
            'vnp_BankTranNo' => 20170829152730,
            'vnp_CardType' => 'ATM',
            'vnp_OrderInfo' => 'Thanh+toan+don+hang+thoi+gian%3A+2017-08-29+15%3A27%3A02',
            'vnp_PayDate' => 20170829153052,
            'vnp_ResponseCode' => '00',
            'vnp_TmnCode' => '2QXUI4J4',
            'vnp_TransactionNo' => 12996460,
            'vnp_TxnRef' => 23597,
            'vnp_SecureHash' => 'c9acf5dc3da383d6f415bee855e5286c53f3b75da755b32328db74f0509fcaa9d874189a91f4f3fbb5d5ed90fc3f34176f8f103401105f5e9406b0b1a6bc3b2f',
        ]);
        $this->assertFalse($response->isPending());
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('23597', $response->getTransactionId());
        $this->assertEquals('12996460', $response->getTransactionReference());
        $this->assertEquals('00', $response->getCode());
    }
}
