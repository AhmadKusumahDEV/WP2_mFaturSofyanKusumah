<?php

namespace App\Controllers;

use \App\Models\bukumodels;

class buku extends BaseController
{

    public function view() {
        return view('/book/form_book');
    }

    public function find()
    {
        $buku = new bukumodels();
        // $result = $buku->findAll();
        $this->totalstok();
    }

    public function findone()
    {
        $result = $this->request->getpost('nama');
        $buku = new bukumodels();
        $serach = $buku->where('judul_buku', $result)->first();
        if ($serach) {
            dd($serach['id']);
        }else {
            dd('data tidak ditemukan');
        }

    }

    public function totalstok()
    {
        $buku = new bukumodels();
        $totalStock = $buku->selectSum('stok')->findAll();
        $result = $totalStock[0]['stok'];
        echo $result;
    }

    


    public function simpanBuku($data = null)
    {
        $buku = new bukumodels();
        $simpan = $buku->insert($data);
    }

    public function updateBuku($id = null, $data = null)
    {
        $buku = new bukumodels();
        $updated = $buku->update($id, $data);
    }

    public function deleteBuku($id = null) {
        $buku = new bukumodels();
        $buku->delete($id);
    }
}
