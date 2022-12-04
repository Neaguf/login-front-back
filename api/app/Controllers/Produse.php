<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Produse extends BaseController
{
  public function index()
  {
    //
  }
  public function getProduse()
  {
    $db = db_connect();

    $sql = "SELECT * FROM produse";
    $produse = $db->query($sql)->getResult();

    return json_encode($produse);
  }
  public function stergeProdus()
  {
    $db = db_connect();

    $id = $this->request->getVar("id");

    $sql = "DELETE FROM produse WHERE id = ?";
    $result = $db->query($sql, [$id]);
  }
  public function editeazaProdus()
  {
    $db = db_connect();

    $id = $this->request->getVar("produs");

    $sql = "UPDATE produse SET nume = ?, descriere = ?, pret = ? WHERE id = ?";
    $result = $db->query($sql, [
      $produs->nume,
      $produs->descriere,
      $produs->pret,
      $produs->id,
    ]);
  }
}
