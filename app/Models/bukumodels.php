<?php

namespace App\Models;

use CodeIgniter\Model;

class bukumodels extends Model
{
    protected $table = 'buku';

    protected $allowedFields = ['judul_buku', 'id_kategori', 'pengarang', 'penerbit', 'tahun_terbit' , 'isbn' , 'stok' , 'dipinjam', 'dibooking', 'image' ];

    protected $primaryKey = 'id';
}