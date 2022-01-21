<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\RestApiModel;
use CodeIgniter\HTTP\Response;

class UserApi extends ResourceController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->model = new RestApiModel();
        helper(['api', 'form', 'security']);
    }


    public function userada_ya()
    {
        return $this->respond("dada fafaf afefef", 200);
    }

    public function regiter_api()
    {
        $password = $this->request->getPost('password');
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $dataRegister = [
            'name' => $this->request->getPost('name'),
            'nim' => $this->request->getPost('nim'),
            'email' => $this->request->getPost('email'),
            'no_phone' => $this->request->getPost('no_phone'),
            'prodi' => $this->request->getPost('prodi'),
            'password' => $password_hash,
            'image' => 'user.png',
            'enable_login' => 2,
            'stts' => "mahasiswa",
            'created_by' => $this->request->getPost('name') . " " . date("Y-M-d h:i:s A")
        ];
        $data = $this->model->addUsers($dataRegister);
        return $this->respond($data, 200);
    }




    public function login_api()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = $this->model->loginUsers($email, $password);

        return $this->respond($data, 200);
    }

    public function list_paslon()
    {
        $data = $this->model->getPaslon();

        return $this->respond($data, 200);
    }

    public function list_all_paslon()
    {
        $data = $this->model->getPaslonAll();

        return $this->respond($data, 200);
    }

    public function daftar_paslon()
    {
        $dataRegister = [
            'nim_presiden' => $this->request->getPost('nim_presiden'),
            'nama_presiden' => $this->request->getPost('nama_presiden'),
            'nim_wakil' => $this->request->getPost('nim_wakil'),
            'nama_wakil' => $this->request->getPost('nama_wakil'),
            'visi' => $this->request->getPost('visi'),
            'misi' => $this->request->getPost('misi'),
            'stts' => "Panding",
            'urutan' => 0,
            'create' => $this->request->getPost('nim_presiden') . " " . date("Y-M-d h:i:s A")
        ];
        $data = $this->model->addPaslon($dataRegister);
        return $this->respond($data, 200);
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
                $data = $this->model->updateImage(
                    $this->request->getPost('id'),
                    $nameFile
                );
                return $this->respond($data, 200);
            } else {
                $pesan = [
                    'stts' => false,
                    'msg' => "OPS..!, \n Foto Masih Kosong...!",
                ];
                return $this->respond($pesan, 200);
            }
        } else {
            $errors = \Config\Services::validation();
            $err = $errors->getError('image');
            $pesan = [
                'stts' => false,
                'msg' => "OPS..!, \n $err...!",
            ];
            return $this->respond($pesan, 200);
        }
    }


    public function pemilihan()
    {
        $data1 = [
            'user_id' => $this->request->getVar('user_id'),
            'nomor_calon' => $this->request->getVar('nomor_calon'),
            'time' => date("Y-M-d h:i:s A"),
        ];

        $data = $this->model->savePilihan($data1);
        return $this->respond($data, 200);
    }


    public function get_stts()
    {
        $nim = $this->request->getVar('nim');
        $data = $this->model->cekStta($nim);
        return $this->respond($data, 200);
    }

    public function get_data_paslon()
    {
        $nim = $this->request->getVar('nim');
        $data = $this->model->getDataPaslon($nim);
        return $this->respond($data, 200);
    }

    public function get_ques_stts()
    {
        $data = $this->model->getQuesStts();
        return $this->respond($data, 200);
    }

    public function set_ques()
    {
        $data = [
            'id_paslon' => $this->request->getVar('id_paslon'),
            'id_user' => $this->request->getVar('id_user'),
            'soal' => $this->request->getVar('soal'),
            'stts' => 'false'
        ];

        $data = $this->model->setQuesUser($data);
        return $this->respond($data, 200);
    }

    public function get_ques()
    {
        $paslon = $this->request->getVar('id_paslon');

        $data = $this->model->getQues($paslon);
        return $this->respond($data, 200);
    }

    public function get_voting()
    {
        return $this->respond($this->model->getVoting(), 200);
    }

    public function voting_akses()
    {
        return $this->respond($this->model->getSttsVoting(), 200);
    }


    public function file_paslon()
    {



        $simpan =  [];
        $path = './assets/file';

        if ($imagefile = $this->request->getFiles()) {
            foreach ($imagefile['file'] as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $img->move($path, $newName);
                    $fileUpload = [
                        'id_paslon' => $this->request->getPost('id'),
                        'file_name' => $newName
                    ];
                    array_push($simpan, $fileUpload);
                }
            }

            $pesan = $this->model->saveImage($simpan);
            return $this->respond($pesan, 200);
        } else {
            return $this->respond([
                'stts' => false,
                'msg' => "image kosong...!",
            ], 200);
        }
    }

    public function image_paslon()
    {
        return $this->respond([
            'stts' => true,
            'msg' => "Image Paslon ...!",
            'data' => $this->model->getImage($this->request->getPost('id'))
        ], 200);
    }

    public function delete_image_paslon()
    {
        return $this->respond([$this->model->deleteImage($this->request->getPost('id'))], 200);
    }

    public function save_token()
    {
        $data = [
            'nim' => $this->request->getVar('nim'),
            'token' => $this->request->getVar('token')
        ];

        $this->model->saveToken($data);
        return $this->respond([
            'stts' => true,
            'msg' => "save...!",
        ], 200);
    }


    public function get_pengumuman_user()
    {
        return $this->respond($this->model->getPenguman(), 200);
    }
}
