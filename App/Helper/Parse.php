<?php

namespace App\Helper;

class Parse
{
  public static function keyAndId(array $post, array &$errors): array {
    $result = [];

    if (empty($_POST['key'])) {
      $errors[] = 'Не указан ключ';
    }
    if (empty($_POST['id'])) {
      $errors[] = 'Не указан id';
    }

    if (empty($errors)){
      $result = [
        'id' => $_POST['id'],
        'key' => $_POST['key'],
      ];
    };

    return $result;
  }

  public static function myOrders(array $post, array &$errors): array {
    $result = [];

    if (empty($_POST['pair'])) {
      $errors[] = 'Укажите список пар (BTC_USD,TRX_USD)';
    }
    if (empty($_POST['action'])) {
      $errors[] = 'Укажите действие (buy, sell)';
    }

    if (empty($errors)){
      $result = [
        'pair' => $_POST['pair'],
        'action' => $_POST['action'],
      ];
    };

    return $result;
  }

  public static function orderCreate(array $post, array &$errors): array {
    $result = [];

    if (empty($_POST['pair'])) {
      $errors[] = 'Укажите пару';
    }
    if (empty($_POST['type'])) {
      $errors[] = 'Укажите тип ордера';
    }
    if (empty($_POST['action'])) {
      $errors[] = 'Укажите действие (buy, sell)';
    }
    if (empty($_POST['amount'])) {
      $errors[] = 'Укажите количество';
    }
    if (empty($_POST['price'])) {
      $errors[] = 'Укажите цену';
    }

    if (empty($errors)){
      $result = [
        'pair' => $_POST['id'],
        'type' => $_POST['type'],
        'action' => $_POST['action'],
        'amount' => $_POST['amount'],
        'price' => $_POST['price'],
      ];
    };

    return $result;
  }

  public static function orderStatus(array $post, array &$errors): array {
    $result = [];

    if (empty($_POST['order_id'])) {
      $errors[] = 'Укажите id заказа';
    }
    if (empty($errors)){
      $result = [
        'order_id' => $_POST['order_id'],
      ];
    };

    return $result;
  }

  public static function order(array $post, array &$errors): array {
    $result = [];

    if (empty($_POST['pair'])) {
      $errors[] = 'Укажите список пар';
    }
    if (empty($errors)){
      $result = [
        'pair' => $_POST['pair'],
      ];
    };

    return $result;
  }
}