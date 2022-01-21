<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Home extends BaseController
{
    //fungsi untuk mendapatkan model dari agar bisa di pakai
    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->code = service('encrypter');
    }

    //tampilan awal setelah login
    public function index()
    {
        $data = [
            'title' => "Home"
        ];
        return view('conten/home/base_user', $data);
    }

    //fungsi edit user
    public function edit_profile()
    {
        $data = [
            'title' => "Home",
            'data' => session()->get('data')
        ];
        // dd(session()->get('data'));
        return view('conten/home/editprofile', $data);
    }

    //fungsi edit password user
    public function edit_password()
    {
        $data = [
            'title' => "Home",

        ];
        // dd(session()->get('data'));
        return view('conten/home/editpassword', $data);
    }
}
