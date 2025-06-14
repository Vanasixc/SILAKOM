<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class Account_table extends BaseController
{
    public function getIndex()
    {
        $data = [
            'title' => 'Manage Account',
        ];

        return view('pages/manage_account', $data);
    }

    public function postDatatable()
    {        
        $db = db_connect();
        $builder = $db->table('account')->select('id, name, username, role, status, last_login');
        return DataTable::of($builder)
            ->addNumbering('no')
            ->edit('status', function ($row) {
                if ($row->status == 'active') {
                    return '<span class="badge bg-success">Active</span>';
                } elseif ($row->status == 'inactive') {
                    return '<span class="badge bg-secondary">Inactive</span>';
                }
                return '<span class="badge bg-danger">Block</span>';
            })
            ->add('action', function ($row): string {
                $editBtn = '<button type="button" class="btn btn-primary btn-sm me-1 btn-edit" data-id="' . $row->id . '">Edit</button>';
                $deleteBtn = '<button type="button" class="btn btn-danger btn-sm me-1 btn-delete" data-id="' . $row->id . '">Hapus</button>';
                return $editBtn . $deleteBtn;
            })
            ->toJson(true);
    }
}
