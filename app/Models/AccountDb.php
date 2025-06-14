<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountDb extends Model
{
    protected $table      = 'account';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'username', 'password', 'role', 'status', 'last_login'];
}
