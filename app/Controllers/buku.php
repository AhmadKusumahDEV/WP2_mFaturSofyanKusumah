<?php

namespace App\Controllers;

use \App\Models\bukumodels;
use \App\Models\KategoriModel;
use \App\Models\userModels;

class buku extends BaseController
{

    public function view() {
        return view('/book/form_book');
    }

    public function find()
    {
        $buku = new bukumodels();
        $kategori = new KategoriModel();
        $user = new userModels();
        $res = $user->where('id', session()->get('user_id'))->first();
        $result_buku = $buku->findAll();
        $result_kategori = $kategori->findAll();
        $data = [
            'judul' => "Data Buku",
            'buku' => $result_buku,
            'kategori' => $result_kategori,
            'anggota' => $res,
        ];
        echo view('admin/header', $data);
        echo view('admin/sidebar', $data);
        echo view('admin/topbar', $data);
        echo view('admin/buku', $data);
        echo view('admin/footer');
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

    


    public function simpanBuku()
    {
        $buku = new bukumodels();
        
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
