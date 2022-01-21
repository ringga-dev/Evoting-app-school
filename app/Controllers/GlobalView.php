<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class GlobalView extends BaseController
{
    public function __construct()
    {
        $this->admin = new AdminModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Undian',
            'user' => $this->admin->getUserUrut(),
        ];
        // dd($data);
        return view('conten/undian/undian', $data);
    }


    public function get_number()
    {
        for ($i = 0; $i < 1000; $i++) {
            $num = $this->get();
            if ($this->admin->getUserUrutCek($num) == null) {
                echo json_encode($num);
                break;
            }
        }
    }

    private function get()
    {
        $data = $this->admin->getUserUrut();
        $arr = [];
        $i = 1;
        foreach ($data as $d) {
            array_push($arr, $i);
            $i++;
        }
        $k = array_rand($arr);
        return $arr[$k];
    }

    public function save_urutan()
    {
        $id = $this->request->getVar('id_user');
        $urutan = $this->request->getVar('urutan');

        $data = $this->admin->saveUrutan($id, $urutan);
        echo json_encode($data);
    }


    public function hasil()
    {
        $data = [
            'title' => 'Undian',
            'user' => $this->admin->getUserUrut(),
            'voting' => $this->admin->getVoting(),
        ];
        // dd($data);
        return view('conten/absen/hasil', $data);
    }

    public function get_voting()
    {
        echo json_encode($this->admin->getVoting());
    }
}
