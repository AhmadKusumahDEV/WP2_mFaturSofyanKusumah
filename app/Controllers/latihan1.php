<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_latihan1;

class Latihan1 extends BaseController
{
  public function index()
  {
    echo "Selamat Datang.. selamat belajar Web Programming";
  }

  public function penjumlahan0($n1 = 1, $n2 = 2)
  {
    $model = new Model_latihan1();
    $result = $model->jumlah($n1, $n2);
    echo "Hasil Penjumlahan dari " . $n1 . " + " . $n2 . " = " . $result;
  }

  public function penjumlahan($n1, $n2): string
  {
    $model = new Model_latihan1();
    $data['nilai1'] = $n1;
    $data['nilai2'] = $n2;
    $result = $model->jumlah($n1, $n2);
    $data['hasil'] = $result;
    return view('view-latihan', $data);
  }
}
