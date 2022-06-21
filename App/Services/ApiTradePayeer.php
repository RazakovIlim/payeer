<?php
namespace App\Services;

class ApiTradePayeer
{
  private array $arError;
  private array $arParams;

  public function __construct($params = []) {
    $this->arParams = $params;
  }

  public function params($params = [])
  {
    $this->arParams = $params;
  }

  private function request($req = []) {
    $mc = round(microtime(true) * 1000);
    $req['post']['ts'] = $mc;

    $post = json_encode($req['post']);

    $sign = hash_hmac('sha256', $req['method'].$post, $this->arParams['key']);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://payeer.com/api/trade/" . $req['method']);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      "Content-Type: application/json",
      "API-ID: ".$this->arParams['id'],
      "API-SIGN: ".$sign
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $arResponse = json_decode($response, true);

    if ($arResponse['success'] !== true) {
      $this->arError = $arResponse['error'];
    }

    return $arResponse;
  }

  public function info(): array
  {
    return $this->request([
      'method' => 'info',
    ]);
  }

  public function getError(){
    return $this->arError;
  }

  public function account(){
    $res = $this->request([
      'method' => 'account',
    ]);

    return $res['balances'];
  }

  public function myOrders(array $req) {
    $res = $this->request([
      'method' => 'my_orders',
      'post' => $req,
    ]);

    return $res['items'];
  }

  public function orderCreate(array $req) {
    return $this->request([
      'method' => 'order_create',
      'post' => $req,
    ]);
  }

  public function orderStatus($req = []) {
    $res = $this->request([
      'method' => 'order_status',
      'post' => $req,
    ]);

    return $res['order'];
  }

  public function orders($pair = 'BTC_USDT'){
    $res = $this->request([
      'method' => 'orders',
      'post' => [
        'pair' => $pair,
      ],
    ]);

    return $res['pairs'];
  }
}