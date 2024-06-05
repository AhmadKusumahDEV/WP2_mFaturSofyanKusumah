<?php

namespace App\Controllers;


class BioDataKu extends BaseController {
    public function vieww() {
        return view('view-biodata');
    }

    public function cetakbio() {
        $nim = $this->request->getPost('nim');
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $hobby = $this->request->getPost('hobby');
        $email = $this->request->getPost('email');

        $data = [
            'nim' => $nim,
            'nama' => $nama,
            'alamat' => $alamat,
            'hobby' => $hobby,
            'email' => $email
        ];

        return view('biodata_view', $data);
    }
}