<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\AdminModel;


class Admin extends BaseController
{

    //memangil model dan session 
    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->sesi = session()->get('data');
    }


    public function menu()
    {
        //
    }

    //menampilkan user
    public function user()
    {
        $data = [
            'title' => 'Managemen User',
            'user' => $this->admin->getUser(),
        ];
        return view('conten/home/user', $data);
    }
    //delete user
    public function deleteUser($id)
    {
        $data = $this->admin->hapusUser($id);
        session()->setFlashdata('pesan', $data);
        return redirect()->to('/admin/user');
    }
    //blok akses user
    public function blok_akses()
    {
        $id = $this->request->getVar('nik');
        $data = $this->admin->aksesBlok($id);
        $this->send_message("e-voting", "akses $id telah " . $data['msg']);
        return json_encode($data);
    }

    public function voting_akses()
    {
        $data = $this->admin->aksesVoting();
        $this->send_message("e-voting", "sesi voting telah di " . $data['msg']);
        return json_encode($data);
    }

    public function blok_akses_userapp()
    {
        $id = $this->request->getVar('id');

        $data = $this->admin->aksesBlok_userApp($id);
        return json_encode($data);
    }
    // menampilkan user aplikasi
    public function user_app()
    {
        $data = [
            'title' => 'Managemen User App',
            'user' => $this->admin->getUserApp(),
        ];
        return view('conten/home/userApp', $data);
    }



    // delet user aplikasi
    public function deleteUserApp($id)
    {
        $data = $this->admin->hapusUserApp($id);
        session()->setFlashdata('pesan', $data);
        return redirect()->to('/admin/user_app');
    }

    //paslon data
    public function user_paslon()
    {
        $data = [
            'title' => 'Managemen Paslon',
            'paslon' => $this->admin->getPaslon(),
            'user' => $this->admin->getUserApp(),
        ];
        return view('conten/home/paslon', $data);
    }

    public function hasil()
    {
        $data = [
            'title' => 'Managemen Paslon',
            'paslon' => $this->admin->getPaslon(),
        ];
        return view('conten/home/hasil', $data);
    }

    public function stts_paslon()
    {
        $data = $this->admin->updateStts(
            $this->request->getVar('id'),
            $this->request->getVar('stts')
        );
        $this->send_message("e-voting", "ada paslon yang berubah");
        session()->setFlashdata('pesan', $data);
        return redirect()->to('/admin/user_paslon');
    }



    public function hapus_paslon($id)
    {
        $data = $this->admin->deletePaslon($id);
        session()->setFlashdata('pesan', $data);
        $this->send_message("e-voting", "ada paslon yang di hapus");
        return redirect()->to('/admin/user_paslon');
    }



    public function daftar_paslon()
    {
        $presiden = explode(":", $this->request->getPost('presiden'));
        $wakil = explode(":", $this->request->getPost('wakil'));
        $dataRegister = [
            'nim_presiden' => $presiden[1],
            'nama_presiden' =>  $presiden[0],
            'nim_wakil' => $wakil[1],
            'nama_wakil' => $wakil[0],
            'visi' => $this->request->getPost('visi'),
            'misi' => $this->request->getPost('misi'),
            'stts' => "Panding",
            'urutan' => 0,
            'create' => $this->request->getPost('nim_presiden') . " " . date("Y-M-d h:i:s A")
        ];
        $data = $this->admin->addPaslon($dataRegister);
        session()->setFlashdata('pesan', $data);
        $this->send_message("e-voting", $this->request->getPost('presiden') . "dan  " . $this->request->getPost('wakil') . "mendaftar");
        return redirect()->to('/admin/user_paslon');
    }

    public function upload_image_paslon()
    {
        if ($this->validate([
            'image' => [
                'rules'  => 'max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => '{field} ukuran foto kamu lebih dari 2 MB ...',
                    'is_image' => '{field} file kamu bukan gambar ...',
                    'mime_in' => '{field} file kamu bukan gambar...'
                ]
            ]
        ])) {
            $image = $this->request->getFile('image');
            $path = './assets/image/';
            $gambar = service('image');


            if ($image != null) {

                $nameFile = $image->getRandomName();
                $image->move($path, $nameFile);

                $gambar->withFile($path . '/' . $nameFile)
                    ->save($path . "/" . $nameFile);
                $data = $this->admin->updateImage(
                    $this->request->getVar('id'),
                    $nameFile
                );
                session()->setFlashdata('pesan', $data);
                return redirect()->to('/admin/user_paslon');
            } else {
                $pesan = [
                    'stts' => false,
                    'msg' => "OPS..!, \n Foto Masih Kosong...!",
                ];
                session()->setFlashdata('pesan', $pesan);
                return redirect()->to('/admin/user_paslon');
            }
        } else {
            $errors = \Config\Services::validation();
            $err = $errors->getError('image');
            $pesan = [
                'stts' => false,
                'msg' => "OPS..!, \n $err...!",
            ];
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/admin/user_paslon');
        }
    }


    public function ques_on()
    {
        $data = [
            'title' => 'Managemen Paslon',
            'paslon' => $this->admin->getPaslon(),
            'stts' => $this->admin->getQuesStts()
        ];
        return view('conten/home/ques_on', $data);
    }

    public function add_ques_on()
    {
        $id = $this->request->getPost('id');
        $data = $this->admin->addQuesActive($id);
        session()->setFlashdata('pesan', $data);
        $this->send_message("e-voting", "sesi tanya jawab" . $data['msg']);
        return redirect()->to('/admin/ques_on');
    }

    public function stts_ques()
    {
        $data = $this->admin->updateSttsQues(
            $this->request->getVar('id'),
            $this->request->getVar('stts')
        );
        session()->setFlashdata('pesan', $data);
        $this->send_message("e-voting", "sesi tanya jawab " . $data['msg']);
        return redirect()->to('/admin/ques_on');
    }

    public function delete_ques_on($id)
    {
        $data = $this->admin->deleteSttsQues($id);
        session()->setFlashdata('pesan', $data);
        return redirect()->to('/admin/ques_on');
    }

    public function file_paslon()
    {
        $data = [
            'title' => 'Managemen Paslon',
            'paslon' => $this->admin->getImage(),

        ];
        // dd($data);
        return view('conten/home/file_paslon', $data);
    }


    public function delete_image_paslon($id)
    {
        $data = $this->admin->deleteImage($id);
        session()->setFlashdata('pesan', $data);

        return redirect()->to('/admin/file_paslon');
    }



    private function send_message($title = null, $body = null)
    {
        $data = $this->admin->getToken();

        $listToken = [];
        foreach ($data as $d) {
            array_push($listToken, $d['token']);
        }

        $list = [
            'registration_ids' => $listToken,
            'notification' => [
                'title' => $title,
                'body' => $body
            ]
        ];


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($list),
            CURLOPT_HTTPHEADER => array(
                'Content-type: application/json',
                'Authorization: key=AAAArVarArA:APA91bHBY1RGXgSUezDK-TuTQHyZ_zy6QdjeN7lKePgtfIx5bFEDFFyXrQPhYK5_XRW7wTYQ-XhvCV1aGzhPEZ7y_7repKgXNaZGdb4aq9Hf1R5y2Uy5sl1iL3gF5wjo0-Fun2JaL4LA'
            ),
        ));

        curl_exec($curl);
        curl_close($curl);
    }



    public function upload_pengumuman()
    {

        $image = $this->request->getFile('pdf');
        $path = './assets/image/';
        $gambar = service('image');


        if ($image != null) {
            $nameFile = $image->getRandomName();
            $image->move($path, $nameFile);


            $data = $this->admin->savePdf(
                [
                    "title" => $this->request->getPost('title'),
                    "dec" => $this->request->getPost('dec'),
                    "file" => $nameFile
                ]
            );
            session()->setFlashdata('pesan', $data);

            return redirect()->to('/admin/user_app');
        } else {
            $pesan = [
                'stts' => false,
                'msg' => "OPS..!, \n file Masih Kosong...!",
            ];
            session()->setFlashdata('pesan', $pesan);

            return redirect()->to('/admin/user_app');
        }
    }
}
