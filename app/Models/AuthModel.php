<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    public function getUser($username, $password)
    {
        $query = $this->db->table('admin_web')->where(['username' => $username])->get()->getRowArray();

        if ($query != null) {
            if (password_verify($password, $query['password'])) {
                if ($query['enable_login'] == 1) {
                    $data = ['stts' => true, 'msg' => 'Login berhasill...!', 'data' => $query];
                } else {
                    $data = ['stts' => false, 'msg' => 'akses login anda telah di blok admin...!'];
                }
            } else {
                $data = ['stts' => false, 'msg' => 'password yang anda masukkan salah...!'];
            }
        } else {
            $data = ['stts' => false, 'msg' => 'user tidak di temukan...!'];
        }

        return $data;
    }


    public function addUser($data)
    {
        $cek = $this->db->table('admin_web')
            ->where(['username=' => $data['username']])
            ->orWhere(['nik' => $data['nik']])
            ->get()->getRowArray();

        if (!$cek) {
            $this->db->table('admin_web')->insert($data);
            return ['stts' => true, 'msg' => 'Proses berhasil...!'];
        } else {
            return ['stts' => false, 'msg' => 'Data ini sudah terdaftar...!'];
        }
    }

    public function addUsers($data)
    {
        $dataUser = $this->db->table('user_app')->where('nim', $data['nim'])
            ->orWhere('email', $data['email'])
            ->orWhere('no_phone', $data['no_phone'])
            ->get()->getRowArray();
        if (!$dataUser) {
            $this->db->table('user_app')->insert($data);
            $pesan = [
                'stts' => true,
                'msg' => "data telah terdaftar...!",
            ];
        } elseif ($dataUser['nim'] == $data['nim']) {
            $pesan = [
                'stts' => false,
                'msg' => "data id bet sudah terdaftar...!",
            ];
        } elseif ($dataUser['email'] == $data['email']) {
            $pesan = [
                'stts' => false,
                'msg' => "data email sudah terdaftar...!",
            ];
        } elseif ($dataUser['no_phone'] == $data['no_phone']) {
            $pesan = [
                'stts' => false,
                'msg' => "data number phone sudah terdaftar...!",
            ];
        }
        return $pesan;
    }
}
