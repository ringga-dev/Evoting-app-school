<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    public function getUser()
    {
        return $this->db->table('admin_web')->get()->getResultArray();
    }

    public function hapusUser($id)
    {
        $this->db->table('admin_web')->where(['id' => $id])->delete();
        return ['stts' => true, 'msg' => 'Proses berhasil...!'];
    }

    public function aksesBlok($nik)
    {
        $data = $this->db->table('admin_web')->where(['nik' => $nik])->get()->getRowArray();
        if ($data['enable_login'] == 1) {
            $this->db->table('admin_web')->where(['nik' => $nik])->update(['enable_login' => 2]);
            return ['stts' => false, 'msg' => 'Akses di blok...!'];
        } else {
            $this->db->table('admin_web')->where(['nik' => $nik])->update(['enable_login' => 1]);
            return ['stts' => true, 'msg' => 'Akses di berikan...!'];
        }
    }

    public function aksesVoting()
    {
        $data = $this->db->table('apps')->get()->getRowArray();
        if ($data['stts_voting'] == "true") {
            $this->db->table('apps')->update(['stts_voting' => "false"]);
            return ['stts' => false, 'msg' => 'Akses di blok...!'];
        } else {
            $this->db->table('apps')->update(['stts_voting' => "true"]);
            return ['stts_voting' => true, 'msg' => 'Akses di berikan...!'];
        }
    }

    public function aksesBlok_userApp($id)
    {
        $data = $this->db->table('user_app')->where(['id' => $id])->get()->getRowArray();
        if ($data['enable_login'] == 1) {
            $this->db->table('user_app')->where(['id' => $id])->update(['enable_login' => 2]);
            return ['stts' => false, 'msg' => 'Akses di blok...!'];
        } else {
            $this->db->table('user_app')->where(['id' => $id])->update(['enable_login' => 1]);
            return ['stts' => true, 'msg' => 'Akses di berikan...!'];
        }
    }

    public function getUserApp()
    {
        return $this->db->table('user_app')->get()->getResultArray();
    }

    public function deleteUser($nik)
    {
        $this->db->table('user_app')->where(['nik' => $nik])->delete();
        return ['stts' => true, 'msg' => 'Proses berhasil...!'];
    }

    public function hapusUserApp($id)
    {
        $this->db->table('user_app')->where(['id' => $id])->delete();
        return ['stts' => true, 'msg' => 'Proses berhasil...!'];
    }

    public function getPaslon()
    {
        return $this->db->table('paslon')->get()->getResultArray();
    }


    public function updateStts($id, $stts)
    {
        $this->db->table('paslon')->where(['id' => $id])->update(['stts' => $stts]);
        return ['stts' => true, 'msg' => 'perbaruan setatus paslon...!'];
    }


    public function deletePaslon($id)
    {
        $this->db->table('paslon')->where(['id' => $id])->delete();
        return ['stts' => true, 'msg' => 'Paslon di hapus...!'];
    }

    public function getUserUrut()
    {
        return $this->db->table('paslon')->where(["stts" => "DI Terima"])->get()->getResultArray();
    }
    public function getUserUrutCek($number)
    {
        return $this->db->table('paslon')->where(["urutan" => $number, "stts" => "DI Terima"])->get()->getResultArray();
    }

    public function saveUrutan($id, $urutan)
    {
        $data = $this->db->table('paslon')->where(["id" => $id])->get()->getRowArray();
        if ($data['urutan'] == 0) {
            $this->db->table('paslon')->where(['id' => $id])->update(['urutan' => $urutan]);
            return ['stts' => true, 'msg' => 'Proses berhasil...!'];
        } else {
            return ['stts' => false, 'msg' => 'Sudah di miliki...!'];
        }
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
            'stts' => true,
            'msg' => "Gambar telah di perbarui...!",
        ];

        return $pesan;
    }

    public function getQuesStts()
    {
        return $this->db->table('ques_stts')
            ->select('ques_stts.*, paslon.nim_presiden, paslon.nama_presiden,paslon.nim_wakil,paslon.nama_wakil,paslon.urutan,paslon.image ')
            ->join("paslon", "paslon.id=ques_stts.id_paslon")
            ->get()->getResultArray();
    }

    public function updateSttsQues($id, $stts)
    {
        $this->db->table('ques_stts')->where(['id' => $id])->update(['stts' => $stts]);
        return ['stts' => true, 'msg' => 'sesi tanya jawab terlah di mulai...!'];
    }

    public function addQuesActive($id)
    {
        if ($this->db->table('ques_stts')->where("id_paslon", $id)->get()->getRowArray() == null) {
            $this->db->table('ques_stts')->insert(['id_paslon' => $id, 'stts' => 'false']);
            $pesan = [
                'stts' => true,
                'msg' => "Perbaruan sesi tanya jawab...!",
            ];
        } else {

            $pesan = [
                'stts' => false,
                'msg' => "data telah di daftarkan sebelumnya",
            ];
        }
        return $pesan;
    }

    public function deleteSttsQues($id)
    {
        $this->db->table('ques_stts')->where(['id' => $id])->delete();
        return ['stts' => true, 'msg' => 'Proses berhasil...!'];
    }

    public function getVoting()
    {
        return $this->db->query("SELECT `paslon`.`nama_presiden`, `paslon`.`nama_wakil`, `paslon`.`urutan` ,(SELECT COUNT(*) FROM `voting` WHERE `voting`.`nomor_calon` = `paslon`.`urutan`) AS `suara` from `paslon`")
            ->getResultArray();
    }


    public function getImage()
    {
        $paslon = $this->db->table('paslon')->get()->getResultArray();
        $data = [];
        foreach ($paslon as $p) {
            $image = $this->db->table('file_paslon')->where(['id_paslon' => $p['id']])->get()->getResultArray();
            array_push($data, [
                'id' => $p['id'],
                'nim_presiden' => $p['nim_presiden'],
                'nama_presiden' => $p['nama_presiden'],
                'nim_wakil' => $p['nim_wakil'],
                'nama_wakil' => $p['nama_wakil'],
                'image' => $p['image'],
                'stts' => $p['stts'],
                'nim_presiden' => $p['nim_presiden'],
                'imagefile' => $image
            ]);
        }
        return $data;
    }

    public function deleteImage($id)
    {
        $this->db->table('file_paslon')->where(['id' => $id])->delete();
        return [
            'stts' => true,
            'msg' => "file telah di delete...!"
        ];
    }
    public function getToken()
    {
        return $this->db->table('token')->select('token.token')->get()->getResultArray();
    }

    public function getPenguman()
    {
        return $this->db->table('pengumuman')->get()->getResultArray();
    }

    public function savePdf($data)
    {
        $this->db->table('pengumuman')->insert($data);
        return [
            'stts' => true,
            'msg' => "file telah di upload...!"
        ];
    }
}
