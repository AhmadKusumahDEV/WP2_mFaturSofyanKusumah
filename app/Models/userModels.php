<?php

namespace App\Models;

use CodeIgniter\Model;

class userModels extends Model
{
    protected $table = 'user';

    protected $allowedFields = ['nama', 'email', 'image', 'password', 'role_id', 'is_active', 'tanggal_input'];
}
