<?php

namespace App\Controllers;

use \App\Models\userModels;

class auth extends BaseController
{
    public function login()
    {
        if (session()->has('user_id')) {
            session()->setFlashdata('error', 'udh login bang');
            return redirect()->to('/admin/dashboard');
        }

        $data = [
            'title' => 'Login',
        ];

        echo view('/template/aute_header', $data);
        echo view('/template/login');
        echo view('/template/aute_footer');
    }

    public function signin()
    {
        $user = new userModels();
        $username = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (empty($username) || empty($password)) {
            session()->setFlashdata('old_data', $this->request->getPost('email'));
            session()->setFlashdata('error', 'Username dan password harus diisi.');
            return redirect()->to('/auth');
        }

        $result = $user->where('email', $username)->first();

        if (empty($result)) {
            session()->setFlashdata('old_data', $this->request->getPost('email'));
            session()->setFlashdata('error', 'Username tidak ditemukan.');
            return redirect()->to('/auth');
        }

        if ($result['password'] == $password) {
            if ($result['role_id'] == 1) {
                session()->set('user_id', $result['id']);
                return redirect()->to('/admin/dashboard');
            } else {
                dd('user biasa wkwk ');
            }
        } else {
            session()->setFlashdata('old_data', $this->request->getPost('email'));
            session()->setFlashdata('error', 'Kesalahan pada password');
            return redirect()->to('/auth');
        }
    }

    public function register()
    {
        $data = [
            'title' => 'Register',
        ];
        echo view('/template/aute_header', $data);
        echo view('/template/register');
        echo view('/template/aute_footer');
    }

    public function signup()
    {
        $res = $this->request->getPost();
        $user = new userModels();
        $lengthmin = 3;

        if (empty($res['username']) || empty($res['email']) || empty($res['password'])) {
            session()->setFlashdata('old_data', $res['username']);
            session()->setFlashdata('old_data1', $res['email']);
            session()->setFlashdata('error', 'harus diisi semua field.');
            return redirect()->to('/auth/register');
        }

        if ($user->where('email', $res['email'])->first()) {
            session()->setFlashdata('old_data', $res['username']);
            session()->setFlashdata('old_data1', $res['email']);
            session()->setFlashdata('error', 'Email sudah terdaftar.');
            return redirect()->to('/auth/register');
        }

        $passlength = strlen($res['password']);

        if ($passlength < $lengthmin) {
            session()->setFlashdata('old_data', $res['username']);
            session()->setFlashdata('old_data1', $res['email']);
            session()->setFlashdata('error', 'Password minimal ' . $lengthmin . ' karakter.');
            return redirect()->to('/auth/register');
        }

        if ($res['password'] != $res['sec_password']) {
            session()->setFlashdata('old_data', $res['username']);
            session()->setFlashdata('old_data1', $res['email']);
            session()->setFlashdata('error', 'Password tidak sama.');
            return redirect()->to('/auth/register');
        }


        $user->save([
            'nama' => $res['username'],
            'email' => $res['email'],
            'image' => 'ayang.jpg',
            'password' => $res['password'],
            'role_id' => 1,
            'is_active' => 1,
            'tanggal_input' => time(),
        ]);

        session()->setFlashdata('error', 'Pendaftaran Berhasil.');

        return redirect()->to('/auth');

    }

    public function logout()
    {
        session()->remove('user_id');
        return redirect()->to('/auth');
    }
}
