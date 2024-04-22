<?php

namespace App\Controllers;

use \App\Models\KategoriModel;

class contohdb extends BaseController
{
    public function find()
    {
        dd("hell nah");
        if (!session()->has('user_id')) {
            session()->setFlashdata('error', 'Akses ditolak. Anda belum login!!');
            return redirect()->to('/auth');
        }

        $kategori = new KategoriModel();
        $result = $kategori->findAll();

        $data = [
            'judul' => 'Kategori Buku',
            'kategori' => $result
        ];

        return view('admin/kategori', $data);
    }

    // public function kategoriWhere($where)
    // {
    //     return $this->db->get_where('kategori', $where);
    // }
    // public function simpanKategori($data = null)
    // {
    //     $this->db->insert('kategori', $data);
    // }
    // public function hapusKategori($where = null)
    // {
    //     $this->db->delete('kategori', $where);
    // }
    // public function updateKategori($where = null, $data = null)
    // {
    //     $this->db->update('kategori', $data, $where);
    // }
    //joi
}
