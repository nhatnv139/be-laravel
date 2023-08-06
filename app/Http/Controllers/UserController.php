<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Users;

class UserController extends Controller
{
    private $users;
    public function __construct()
    {
        $this->users = new Users();
        // echo "test";
        // dd($users);
    }
    public function index()
    {
        $title = "Danh sach nguoi dung";
        $usersList = $this->users->queryBuilder();
        // $users = new Users();
        // $usersList =  $this->users->getAllUsers();
        // dd($usersList);
        return view('clients.users.lists', compact('title', 'usersList'));
    }
    public function add()
    {
        $title = "Add user";
        // $users = new Users();
        // $usersList = $users->getAllUsers();
        // dd($usersList);
        return view('clients.users.add', compact('title'));
    }
    public function postAdd(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:users'
        ], [
            'fullname.required' => 'fullname is required',
            'fullname.min' => 'fullname must from :min systact up',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not the rule',
            'email.unique' => 'Email is exit',

        ]);
        $dataInsert = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->users->addUser($dataInsert);
        return redirect()->route('users.index')->with('msg', 'add user success');
    }
    public function getEdit(Request $request, $id = 0)
    {
        $title = "Update user";
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
                $request->session()->put('id', $id);
                $userDetail = $userDetail[0];
            } else {
                return redirect()->route('users.index')->with('msg', 'nguoi dung ko ton tai');
            }
        } else {
            return redirect()->route('users.index')->with('msg', 'user ko exxit');
        }
        return view('clients.users.edit', compact('title', 'userDetail'));
    }
    public function postEdit(Request $request)
    {
        // dd(session('id'));
        $id = session('id');
        if (empty($id)) {
            return back()->with('msg', 'lien ket ko ton tai');
        }
        $request->validate([
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:users,email,' . $id
        ], [
            'fullname.required' => 'fullname is required',
            'fullname.min' => 'fullname must from :min systact up',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not the rule',
            // 'email.unique' => 'Email is exit',

        ]);
        $dataUpdate = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->users->updateUser($dataUpdate, $id);
        return back()->with('msg', 'update user');
    }
}
