<?php
namespace App\Controllers;

use App\Helper\Parse;
use App\Services\http;
use App\Services\ApiTradePayeer;

class Payeer
{
  public static function info()
  {
    $ApiTradePayeer = new ApiTradePayeer();
    $result = $ApiTradePayeer->info();

    return http::response(200, $result);
 }

  public static function account()
  {
    $errors = [];
    $result = [];
    $responseCode = 200;
    $parameters = Parse::keyAndId($_POST, $errors);

    if (empty($errors)) {
      $ApiTradePayeer = new ApiTradePayeer($parameters);
      $result = $ApiTradePayeer->account();
      if (empty($result)) {
        $errors[] = 'Что-то пошло не так! Обратитесь к специалисту.';
      }
    }

    if (!empty($errors)) {
      $responseCode = 400;
      $result = [
        'errors' => $errors,
        'success' => empty($errors),
      ];
    }

    return http::response($responseCode, $result);
 }

  public static function myOrders()
  {
    $errors = [];
    $result = [];
    $responseCode = 200;
    $parameters = Parse::keyAndId($_POST, $errors);

    if (empty($errors)) {
      $fields = Parse::myOrders($_POST, $errors);

      if (empty($fields)) {
        $ApiTradePayeer = new ApiTradePayeer($parameters);
        $result = $ApiTradePayeer->myOrders($fields) ;
      }
    }

    if (!empty($errors)) {
      $responseCode = 400;
      $result = [
        'errors' => $errors,
        'success' => empty($errors),
      ];
    }

    return http::response($responseCode, $result);
  }

  public static function orderCreate()
  {
    $errors = [];
    $result = [];
    $responseCode = 200;
    $parameters = Parse::keyAndId($_POST, $errors);

    if (empty($errors)) {
      $fields = Parse::orderCreate($_POST, $errors);

      if (empty($errors)) {
        $ApiTradePayeer = new ApiTradePayeer($parameters);
        $result = $ApiTradePayeer->orderCreate($fields);

        if ($ApiTradePayeer->getError()) {
          $errors = $ApiTradePayeer->getError();
        }
      }
    }

    if (!empty($errors)) {
      $responseCode = 400;
      $result = [
        'errors' => $errors,
        'success' => empty($errors),
      ];
    }

    return http::response($responseCode, $result);
  }

  public static function orderStatus()
  {
    $errors = [];
    $result = [];
    $responseCode = 200;
    $parameters = Parse::keyAndId($_POST, $errors);

    if (empty($errors)) {
      $fields = Parse::orderStatus($_POST, $errors);
      $ApiTradePayeer = new ApiTradePayeer($parameters);
      $result = $ApiTradePayeer->orderStatus($fields);
      if ($ApiTradePayeer->getError()) {
        $errors = $ApiTradePayeer->getError();
      }
    }

    if (!empty($errors)) {
      $responseCode = 400;
      $result = [
        'errors' => $errors,
        'success' => empty($errors),
      ];
    }

    return http::response($responseCode, $result);
  }

  public static function orders()
  {
    $errors = [];
    $result = [];
    $responseCode = 200;
    $parameters = Parse::keyAndId($_POST, $errors);

    if (empty($errors)) {
      $fields = Parse::orderCreate($_POST, $errors);
      if (empty($errors)) {
        $ApiTradePayeer = new ApiTradePayeer($parameters);
        $result = $ApiTradePayeer->orders($fields);
        if ($ApiTradePayeer->getError()) {
          $errors = $ApiTradePayeer->getError();
        }
      }
    }

    if (!empty($errors)) {
      $responseCode = 400;
      $result = [
        'errors' => $errors,
        'success' => empty($errors),
      ];
    }

    return http::response($responseCode, $result);
  }

  public static function notFound()
  {
    header('HTTP/1.1 404 Not Found');
    header('Content-Type: application/json');

    $jsonArray = array();
    $jsonArray['status'] = "404";
    $jsonArray['status_text'] = "route not defined";

    echo json_encode($jsonArray);
  }
}