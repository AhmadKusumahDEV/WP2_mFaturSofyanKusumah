<?php

namespace App\Controllers;

use \App\Models\KategoriModel;
use \App\Models\userModels;

class kategori2 extends BaseController
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

    public function addKategori() {
        $kategori = new KategoriModel();
        $kategori_name = $this->request->getPost('kategori');
        $kategori->save([
            'nama_kategori' => $kategori_name,
        ]);
        return redirect()->to('/kategori');
    }

    public function hapusKategori($id = null) {
        $kategori = new KategoriModel();
        $search = $kategori->where("id_kategori", $id)->first();
        $kategori->delete($id);
        return redirect()->to('/kategori');
    }

    public function formUbahKategori($id = null) {
        $kategori = new KategoriModel();
        $user = new userModels();
        $res = $user->where('id', session()->get('user_id'))->first();
        $search = $kategori->where("id_kategori", $id)->first();
        $data = [
            'judul' => 'ubah Kategori',
            'kategori' => $search,
            'anggota' => $res
        ];
        echo view('admin/header', $data);
        echo view('admin/sidebar', $data);
        echo view('admin/topbar', $data);
        echo view('admin/ubah_kategori', $data);
        echo view('admin/footer');
    }

    public function ubahkategori() {
        $kategori = new KategoriModel();
        $kategori_name = $this->request->getPost('kategori');
        $id = $this->request->getPost('id');

        $kategori->save([
            "id_kategori" => $id,
            "nama_kategori" => $kategori_name
        ]);

        return redirect()->to('/kategori');
    }
}
