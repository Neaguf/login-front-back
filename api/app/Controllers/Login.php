<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
  public function login()
  {
    $db = db_connect();

    $message = "";
    $ok = false;

    $raspuns = new \stdClass();

    $email = $this->request->getVar("email");
    $password = $this->request->getVar("password");

    $query = "SELECT * from users WHERE email = ? AND password = ?";

    $results = $db->query($query, [$email, $password])->getResult();

    if (count($results) == 0) {
      $message = "User sau parola gresita";
    } else {
      $message = "Ok";
      $ok = true;
    }

    $raspuns->ok = $ok;

    // var_dump($raspuns);

    echo json_encode($raspuns);
  }
}
