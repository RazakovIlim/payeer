<?php

namespace App\Services;

class HTTP
{
  public static function response(int $responseCode, array $response) {
    if (!is_int($responseCode) || !is_array($response)) {
      return false;
    }

    header('Content-Type: application/json');

    echo json_encode($response); exit();
  }
}