<?php

namespace App\Controllers;
use \App\Models\userModels;

class user extends BaseController
{
    public function find()
    {
        $kategori = new userModels();
        $result = $kategori->findAll();
        dd($result);
    }
}