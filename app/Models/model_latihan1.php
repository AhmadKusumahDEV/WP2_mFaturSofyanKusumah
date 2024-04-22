<?php namespace App\Models;

use CodeIgniter\Model;

class Model_latihan1 extends Model
{
 //membuat variable untuk menampung nilai
 public $nilai1, $nilai2, $hasil;


 public function jumlah($n1 = 0, $n2 = 0)
 {
 $this->nilai1 = $n1;
 $this->nilai2 = $n2;
 $this->hasil = $this->nilai1 + $this->nilai2;
 return $this->hasil;
 }


}