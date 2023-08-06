<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';

    public function getAllUsers()
    {
        $users = DB::select('SELECT*FROM users ORDER BY create_at DESC');
        return $users;
    }
    public function addUser($data)
    {
        DB::insert('INSERT INTO  users ( fullname, email, create_at) values ( ?, ?, ?)', $data);
        // return $users;
    }
    public function  getDetail($id)
    {
        return DB::select('SELECT*FROM ' . $this->table . ' WHERE id =?', [$id]);
    }
    public function  updateUser($data, $id)
    {
        $data[] = $id;
        return DB::update('UPDATE' . $this->table . ' SET fullname=?, email=?, create_at=? where id =?', $data);
    }
    public function queryBuilder()
    {
        // DB::enableQueryBuilder();
        // lấy tất cả bản gghi 
        //   DB::table($this->table)

        // ->get();

        $list = DB::table('users')
            ->select('users.*', 'groups.name as group_name')
            ->rightJoin('groups', 'users.group_id', '=', 'groups.id')
            ->get();
        dd($list);
    }
}
