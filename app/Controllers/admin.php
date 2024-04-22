<?php

namespace App\Controllers;

use \App\Models\userModels;
use \App\Models\bukumodels;

class admin extends BaseController
{
    public function dashboard()
    {
        if (!session()->has('user_id')) {
            session()->setFlashdata('error', 'Akses ditolak. Anda belum login!!');
            return redirect()->to('/auth');
        }

        $user = new userModels();
        $buku = new bukumodels();
        $getuser = $user->findAll();
        $getbuku = $buku->findAll();
        $dateAndTime = date('Y', $getuser[0]['tanggal_input']);
        $totalStock = $buku->selectSum('stok')->findAll();
        $totalbooking = $buku->selectSum('dibooking')->findAll();
        $totalpinjam = $buku->selectSum('dipinjam')->findAll();
        $jumlahtotalpinjam = $totalpinjam[0]['dipinjam'];
        $jumlahtotalbooking = $totalbooking[0]['dibooking'];
        $jumlahtotalstock = $totalStock[0]['stok'];
        $getoneuser = $user->where('id', session()->get('user_id'))->first();
        $data = [
            'judul' => 'Dashboard',
            'user' => $user->countAll(),
            'stok' => $jumlahtotalstock,
            'pinjam' => $jumlahtotalpinjam,
            'booking' => $jumlahtotalbooking,
            'dateAndTime' => $dateAndTime,
            'anggota' => $getoneuser,
            'anggotaAll' => $getuser,
            'buku' => $getbuku
        ];

        echo view('admin/header', $data);
        echo view('admin/sidebar', $data);
        echo view('admin/topbar', $data);
        echo view('admin/index', $data);
        echo view('admin/footer');
    }

    public function myprofil()
    {
        if (!session()->has('user_id')) {
            session()->setFlashdata('error', 'Akses ditolak. Anda belum login!!');
            return redirect()->to('/auth');
        }
        $user = new userModels();

        $getid = session()->get('user_id');
        $res = $user->where('id', $getid)->first();
        $data = [
            'judul' => 'My Profile',
            'anggota' => $res
        ];

        echo view('admin/header', $data);
        echo view('admin/sidebar', $data);
        echo view('admin/topbar', $data);
        echo view('user/index', $data);
        echo view('admin/footer');
    }

    public function ubahprofil()
    {
        if (!session()->has('user_id')) {
            session()->setFlashdata('error', 'Akses ditolak. Anda belum login!!');
            return redirect()->to('/auth');
        }


        $user = new userModels();
        $getid = session()->get('user_id');
        $res = $user->where('id', $getid)->first();

        $data = [
            'judul' => 'Ubah Profil',
            'anggota' => $res
        ];

        echo view('admin/header', $data);
        echo view('admin/sidebar', $data);
        echo view('admin/topbar', $data);
        echo view('user/ubah-profile', $data);
        echo view('admin/footer');
    }

    public function saveubah()
    {
        $user = new userModels();
        $getpost = $this->request->getPost();
        $getimage = $this->request->getFile('image');
        $getid = session()->get('user_id');

        if (empty($getimage->getName())) {
            $user->save([
                'id' => $getid,
                'nama' => $getpost['nama'],
                'email' => $getpost['email'],
            ]);
            // $getimage->move(ROOTPATH . 'public', $getimage->getName());
            return redirect()->to('/admin/myprofil');
        }

        $res = $user->where('id', $getid)->first();
        $getusersameimagecopy = $user->where('image', $getimage->getName())->first();

        $user->save([
            'id' => $getid,
            'nama' => $getpost['nama'],
            'email' => $getpost['email'],
            'image' => $getimage->getName()
        ]);

        $getusersameimage = $user->where('image', $res['image'])->first();


        if (!$getusersameimage) {
            unlink(ROOTPATH . 'public/' . $res['image']);
        }

        if (!$getusersameimagecopy) {
            $getimage->move(ROOTPATH . 'public', $getimage->getName());
        }

        return redirect()->to('/admin/myprofil');
    }

    public function anggota()
    {
        if (!session()->has('user_id')) {
            session()->setFlashdata('error', 'Akses ditolak. Anda belum login!!');
            return redirect()->to('/auth');
        }

        $user = new userModels();
        $res = $user->findAll();

        $getoneuser = $user->where('id', session()->get('user_id'))->first();

        $data = [
            'anggota' => $getoneuser,
            'judul' => "Data Anggota",
            'anggotaAll' => $res
        ];

        echo view('admin/header', $data);
        echo view('admin/sidebar', $data);
        echo view('admin/topbar', $data);
        echo view('admin/anggota', $data);
        echo view('admin/footer');
    }

    public function dataBuku()
    {

        if (!session()->has('user_id')) {
            session()->setFlashdata('error', 'Akses ditolak. Anda belum login!!');
            return redirect()->to('/auth');
        }

        $user = new userModels();
        $buku = new bukumodels();
        $getoneuser = $user->where('id', session()->get('user_id'))->first();
        $getbuku = $buku->findAll();

        $data = [
            'judul' => "Data Buku",
            'anggota' => $getoneuser,
            'buku' => $getbuku
        ];
    }
}
