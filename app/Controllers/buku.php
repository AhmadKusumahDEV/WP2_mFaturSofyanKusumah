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


    public function formbukuubah($id = null) {
        $buku = new bukumodels();
        $kategori = new KategoriModel();
        $user = new userModels();
        $res = $user->where('id', session()->get('user_id'))->first();
        $result_buku = $buku->where('id', $id)->first();
        $join_kategori = $kategori->where('id_kategori', $result_buku['id_kategori'])->first();
        $result_kategori = $kategori->findAll();

        $data = [
            'judul' => "Data Buku",
            'buku' => $result_buku,
            'kategori' => $result_kategori,
            'anggota' => $res,
            'kategori_convert' => $join_kategori
        ];

        echo view('admin/header', $data);
        echo view('admin/sidebar', $data);
        echo view('admin/topbar', $data);
        echo view('admin/ubahbuku', $data);
        echo view('admin/footer');
    }

    public function simpanBuku()
    {
        $buku = new bukumodels();
        $kategori_name = $this->request->getPost();
        $getimage = $this->request->getFile('image');
        
        $search_image = $buku->where('image', $getimage->getName())->first();
        if ($search_image != null) {
            $buku->save([
                'judul_buku' => $kategori_name["judul_buku"],
                'id_kategori' => $kategori_name["id_kategori"],
                'pengarang' => $kategori_name["pengarang"],
                'penerbit' => $kategori_name["penerbit"],
                'tahun_terbit' => $kategori_name["tahun"],
                'isbn' => $kategori_name["isbn"],
                'stok' => $kategori_name["stok"],
                'dipinjam' => 0,
                'dibooking' => 0,
                'image' => $search_image['image']
            ]);
            return redirect()->to('/buku');
        }else {
            $buku->save([
                'judul_buku' => $kategori_name["judul_buku"],
                'id_kategori' => $kategori_name["id_kategori"],
                'pengarang' => $kategori_name["pengarang"],
                'penerbit' => $kategori_name["penerbit"],
                'tahun_terbit' => $kategori_name["tahun"],
                'isbn' => $kategori_name["isbn"],
                'stok' => $kategori_name["stok"],
                'dipinjam' => 0,
                'dibooking' => 0,
                'image' => $getimage->getName()
            ]);
            $getimage->move(ROOTPATH . 'public', $getimage->getName());
            return redirect()->to('/buku');
        }
    }

    public function updateBuku($id = null)
    {
        $buku = new bukumodels();
        $user = new userModels();
        $res = $user->where('id', session()->get('user_id'))->first();
        $kategori_name = $this->request->getPost();
        $getimage = $this->request->getFile('image');
        $old_data_buku = $buku->where('id', $kategori_name['id'])->first();

        if ($getimage->getName() == $old_data_buku['image']) {
            $buku->save([
                'id' => $kategori_name['id'],
                'judul_buku' => $kategori_name['judul_buku'],
                'id_kategori' => $kategori_name["id_kategori"],
                'pengarang' => $kategori_name["pengarang"],
                'penerbit' => $kategori_name["penerbit"],
                'tahun_terbit' => $kategori_name["tahun"],
                'isbn' => $kategori_name["isbn"],
                'stok' => $kategori_name["stok"],
            ]);
            return redirect()->to('/buku');
        }
        
        if (empty($getimage->getName())) {
            $buku->save([
                'id' => $kategori_name['id'],
                'judul_buku' => $kategori_name['judul_buku'],
                'id_kategori' => $kategori_name["id_kategori"],
                'pengarang' => $kategori_name["pengarang"],
                'penerbit' => $kategori_name["penerbit"],
                'tahun_terbit' => $kategori_name["tahun"],
                'isbn' => $kategori_name["isbn"],
                'stok' => $kategori_name["stok"],
            ]);
            return redirect()->to('/buku');
        }

        $check_same_image = $buku->where('image', $getimage->getName())->first();
        if ($check_same_image != null) {
            $buku->save([
                'id' => $kategori_name['id'],
                'judul_buku' => $kategori_name['judul_buku'],
                'id_kategori' => $kategori_name["id_kategori"],
                'pengarang' => $kategori_name["pengarang"],
                'penerbit' => $kategori_name["penerbit"],
                'tahun_terbit' => $kategori_name["tahun"],
                'isbn' => $kategori_name["isbn"],
                'stok' => $kategori_name["stok"],
                'image' => $getimage->getName()
            ]);
            $check_same_image_2 = $buku->where('image', $old_data_buku['image'])->first();
            if ($check_same_image_2 != null) {
                return redirect()->to('/buku');
            } else {
                unlink(ROOTPATH . 'public/' . $old_data_buku['image']);
                return redirect()->to('/buku');
            }
        } else {
            $buku->save([
                'id' => $kategori_name['id'],
                'judul_buku' => $kategori_name['judul_buku'],
                'id_kategori' => $kategori_name["id_kategori"],
                'pengarang' => $kategori_name["pengarang"],
                'penerbit' => $kategori_name["penerbit"],
                'tahun_terbit' => $kategori_name["tahun"],
                'isbn' => $kategori_name["isbn"],
                'stok' => $kategori_name["stok"],
                'image' => $getimage->getName()
            ]);
            $check_same_image_old = $buku->where('image', $old_data_buku['image'])->first();
            if ($check_same_image_old != null) {
                $getimage->move(ROOTPATH . 'public', $getimage->getName());
                return redirect()->to('/buku');
            } else {
                unlink(ROOTPATH . 'public/' . $old_data_buku['image']);
                $getimage->move(ROOTPATH . 'public', $getimage->getName());
                return redirect()->to('/buku');
            }
        }
    }

    public function deleteBuku($id = null) {
        $buku = new bukumodels();
        $image = $buku->where('id', $id)->first();
        $buku->delete($image);
        
        $check = $buku->where('image', $image['image'])->first(); 
        if ($check) {
            return redirect()->to('/buku');
        }else {
            unlink(ROOTPATH . 'public/' . $image['image']);
            return redirect()->to('/buku');
        }
    }
}
