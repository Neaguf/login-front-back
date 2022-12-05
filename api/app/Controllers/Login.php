<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
  public function login()
  {
    $db = db_connect();

    $raspuns = new \stdClass();
    $raspuns->ok = false;
    $raspuns->idUser = -1;
    $raspuns->token = "";

    $email = $this->request->getVar("email");
    $password = $this->request->getVar("password");

    $query = "SELECT * from users WHERE email = ? AND password = ?";

    $results = $db->query($query, [$email, $password])->getResult();

    if (count($results) == 0) {
      $message = "User sau parola gresita";
    } else {
      $raspuns->ok = true;
      $user = $results[0];

      $token = md5(date("Y-m-d H:i:s.u"));
      $dataExpirare = "2023-12-12";
      // $dataExpirare->modify("+1 day");
      // $dataExpirare = $dataExpirare->format("Y-m-d");
      $sql =
        "INSERT INTO tokens (idUser, token, expirareToken) VALUES (?, ?, ?);";
      $result = $db->query($sql, [$user->id, $token, $dataExpirare]);

      $raspuns->idUser = $user->id;
      $raspuns->token = $token;
    }
    // var_dump($raspuns);

    echo json_encode($raspuns);
  }

  public function checkToken()
  {
    $db = db_connect();
    $res = new \stdClass();
    $res->ok = false;

    $token = $this->request->getVar("token");

    $query = "SELECT * from tokens WHERE token = ?";
    $results = $db->query($query, [$token])->getResult();

    if (count($results) != 0) {
      $res->ok = true;
    }

    echo json_encode($res);
  }
}
