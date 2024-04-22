<?php

namespace App\Controllers;

use \App\Models\KategoriModel;
use \App\Models\userModels;

class contohdb extends BaseController
{
    public function find()
    {
        if (!session()->has('user_id')) {
            session()->setFlashdata('error', 'Akses ditolak. Anda belum login!!');
            return redirect()->to('/auth');
        }

        $user = new userModels();
        $res = $user->where('id', session()->get('user_id'))->first();

        $kategori = new KategoriModel();
        $result = $kategori->findAll();

        $data = [
            'judul' => 'Kategori Buku',
            'kategori' => $result,
            'anggota' => $res
        ];

        echo view('admin/header', $data);
        echo view('admin/sidebar', $data);
        echo view('admin/topbar', $data);
        echo view('admin/kategori', $data);
        echo view('admin/footer');
    }
}
