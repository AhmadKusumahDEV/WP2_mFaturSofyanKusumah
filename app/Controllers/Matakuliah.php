<?php

namespace App\Controllers;


class Matakuliah extends BaseController
{
    public function index()
    {
        return view('view-form-matakuliah');
    }
    public function cetak()
    {
        $sessionn = session();
        $validasion = \Config\Services::validation();

        $rules = [
            'kode' => [
                'label' => 'Kode_Matakuliah',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} Harus Diisi',
                    'min_length' => '{field} Terlalu Pendek',
                    'max_length' => '{field} Terlalu Panjang'
                ]
                ],
            'nama' => [
                'label' => 'Nama_Matakuliah',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} Harus Diisi',
                ]
            ]
        ];

        $validasion->setRules($rules);

        if ($validasion->withRequest($this->request)->run()) {
            $temp = $validasion->listErrors();
            dd($temp);
            $nama = $this->request->getPost('nama');
            $kode = $this->request->getPost('kode');
            $sks = $this->request->getPost('sks');
            $data = [
                'ama' => $nama,
                'kode' => $kode,
                'sks' => [
                    'Sks' => $sks
                ]
            ];
            return view('view-data-matakuliah', $data);
        } else {
            $temp = $validasion->listErrors();
            $sessionn->setFlashdata("error", $temp);
            return view('view-form-matakuliah');
        }
    }
}
