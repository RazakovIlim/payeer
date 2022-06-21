<?php
namespace App\Test;


use App\Services\ApiTradePayeer;
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . '/../Services/ApiTradePayeer.php';


class ApiTradePayeerTest extends TestCase
{
  public function testCreateOrder()
  {
    $params = [
      'id' => '618bda4a-d9b3-4ac7-9f9a-214501da4a0a',
      'key' => 'qiesipl3JdLneBtY',
    ];

    $stub = $this->createMock(ApiTradePayeer::class);
    $stub->params($params);

    $stub->method('orderCreate')->willReturn($this->returnSelf());

    $fields = [
      'pair' => 'BTC_RUB',
      'type' => 'limit',
      'action' => 'buy',
      'amount' => '10',
      'price' => '0.08',
    ];

    $this->assertSame($stub, $stub->orderCreate($fields));
  }
}