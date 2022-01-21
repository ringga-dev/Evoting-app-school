<?php

namespace App\Models;

use CodeIgniter\Model;

class RestApiModel extends Model
{
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


    public function loginUsers($email, $password)
    {
        $dataUser = $this->db->table('user_app')->where(['email' => $email])->get()->getRowArray();
        if ($dataUser) {
            if ($dataUser['enable_login'] == 1) {
                if (password_verify($password, $dataUser['password'])) {
                    $pesan = [
                        'stts' => true,
                        'msg' => "Berhasil login...!",
                        'data' => $dataUser
                    ];
                } else {
                    $pesan = [
                        'stts' => false,
                        'msg' => "password salah...!",
                    ];
                }
            } else {
                $pesan = [
                    'stts' => false,
                    'msg' => "OPS..!, \n akses anda mungkin sudah di blok...!",
                ];
            }
        } else {
            $pesan = [
                'stts' => false,
                'msg' => "email tidak terdaftar di aplikasi...!",
            ];
        }
        return $pesan;
    }

    public function getPaslon()
    {
        return [
            'stts' => true,
            'msg' => "Data paslon...!",
            "data" =>  $this->db->table('paslon')->where("urutan != 0")->get()->getResultArray()
        ];
    }

    public function getPaslonAll()
    {
        return [
            'stts' => true,
            'msg' => "Data paslon...!",
            "data" =>  $this->db->table('paslon')->get()->getResultArray()
        ];
    }

    public function addPaslon($data)
    {
        $dataUser = $this->db->table('paslon')
            ->where('nim_presiden', $data['nim_presiden'])
            ->orWhere('nim_wakil', $data['nim_wakil'])
            ->get()->getRowArray();

        if (!$dataUser) {

            $presiden = $this->db->table('user_app')
                ->where('nim', $data['nim_presiden'])
                ->orWhere('nim', $data['nim_wakil'])
                ->get()->getResultArray();
            if (count($presiden) == 2) {
                $this->db->table('paslon')->insert($data);
                $pesan = [
                    'stts' => true,
                    'msg' => "data telah di daftarkan...!",
                ];
            } else {
                $pesan = [
                    'stts' => false,
                    'msg' => "User tidak terdaftar pada sistem...!",
                ];
            }
        } elseif ($dataUser['nim_presiden'] == $data['nim_presiden']) {
            $pesan = [
                'stts' => false,
                'msg' => "Presiden sudah terdaftar sebelumnya...!",
            ];
        } elseif ($dataUser['nim_wakil'] == $data['nim_wakil']) {
            $pesan = [
                'stts' => false,
                'msg' => "wakil telah sudah terdaftar sebelumnya...!",
            ];
        }
        return $pesan;
    }

    public function updateImage($id, $image)
    {
        $this->db->table('paslon')->where(['id' => $id])->update(["image" => $image, "stts" => "Pemeriksaan File"]);
        $pesan = [
            'stts' => false,
            'msg' => "Gambar telah di perbarui...!",
        ];

        return $pesan;
    }

    public function savePilihan($data1)
    {
        $dataUser = $this->db->table('voting')
            ->where('user_id', $data1['user_id'])
            ->get()->getRowArray();
        if (!$dataUser) {
            $this->db->table('voting')->insert($data1);
            $pesan = [
                'stts' => true,
                'msg' => "Pemilihan success...!",
            ];
        } else {
            $pesan = [
                'stts' => false,
                'msg' => "user Telah memilih...!",
            ];
        }
        return $pesan;
    }

    public function cekStta($nim)
    {
        $presiden = $this->db->table('paslon')
            ->where('nim_presiden', $nim)
            ->orWhere('nim_wakil', $nim)
            ->get()->getResultArray();

        if ($presiden) {
            $pesan = [
                'stts' => true,
                'msg' => "anda terdaftar sebagai calon...!",
            ];
        } else {
            $pesan = [
                'stts' => false,
                'msg' => "anda tidak terdaftar...!",
            ];
        }
        return $pesan;
    }

    public function getDataPaslon($nim)
    {
        $presiden = $this->db->table('paslon')
            ->where('nim_presiden', $nim)
            ->orWhere('nim_wakil', $nim)
            ->get()->getRowArray();

        if ($presiden) {
            $pesan = [
                'stts' => true,
                'msg' => "anda terdaftar sebagai calon...!",
                'data' => $presiden
            ];
        } else {
            $pesan = [
                'stts' => false,
                'msg' => "anda tidak terdaftar...!",
            ];
        }
        return $pesan;
    }

    public function getQuesStts()
    {
        $data = $this->db->table('ques_stts')
            ->select('ques_stts.*, paslon.nim_presiden, paslon.nama_presiden,paslon.nim_wakil,paslon.nama_wakil,paslon.urutan,paslon.image ')
            ->join("paslon", "paslon.id=ques_stts.id_paslon")
            ->where('ques_stts.stts', "true")
            ->get()->getResultArray();
        return [
            'stts' => true,
            'msg' => "data status Ques...!",
            "data" => $data
        ];
    }

    public function setQuesUser($data)
    {
        $this->db->table('ques')->insert($data);
        $pesan = [
            'stts' => true,
            'msg' => "data tersimpan...!",
        ];

        return $pesan;
    }

    public function getQues($paslon)
    {
        $data = $this->db->table('ques')
            ->select("ques.*, user_app.name,user_app.nim,user_app.prodi")
            ->join("user_app", "user_app.id = ques.id_user")
            ->where('ques.id_paslon', $paslon)
            ->get()->getResultArray();

        return [
            'stts' => true,
            'msg' => "data Ques...!",
            "data" => $data
        ];
    }

    public function getVoting()
    {
        return [
            'stts' => true,
            'msg' => "data Voting...!",
            "data" => $this->db->query("SELECT `paslon`.`nama_presiden`, `paslon`.`nama_wakil`, `paslon`.`urutan` ,
                        (SELECT COUNT(*) FROM `voting` WHERE `voting`.`nomor_calon` = `paslon`.`urutan`) 
                        AS `suara` from `paslon` WHERE `paslon`.`urutan` != 0")
                ->getResultArray()
        ];
    }

    public function getSttsVoting()
    {
        $data = $this->db->table('apps')->get()->getRowArray();
        if ($data['stts_voting'] == "true") {
            return [
                'stts' => true,
                'msg' => "Voting Berlangsung...!"
            ];
        } else {
            return [
                'stts' => false,
                'msg' => "Voting Belum Di Mulai...!",
            ];
        }
    }


    public function saveImage($data)
    {
        $this->db->table('file_paslon')->insertBatch($data);
        return [
            'stts' => true,
            'msg' => "file telah di upload...!"
        ];
    }

    public function getImage($id)
    {
        return $this->db->table('file_paslon')->where(['id_paslon' => $id])->get()->getResultArray();
    }

    public function deleteImage($id)
    {
        $this->db->table('file_paslon')->where(['id' => $id])->delete();
        return [
            'stts' => true,
            'msg' => "file telah di delete...!"
        ];
    }

    public function saveToken($data)
    {
        $cek = $this->db->table('token')->where(['nim' => $data['nim']])->get()->getRowArray();
        if ($cek) {
            $this->db->table('token')->where(['nim' => $data['nim']])->update(['token' => $data['token']]);
        } else {
            $this->db->table('token')->insert($data);
        }
    }

    public function getPenguman()
    {
        return [
            'stts' => true,
            'msg' => "data Voting...!",
            "data" => $this->db->table('pengumuman')->get()->getResultArray()
        ];
    }
}
