<?php
function cek_akses($role_id, $menu_id)
{
    $db = \Config\Database::connect();

    $result = $db->table('tblweb_aksesmenu')->where(['privilege_id ' => $role_id, 'menu_id' => $menu_id])->get()->getRowArray();
    if ($result != null) {
        return "checked='checked'";
    }
}

function  cek_blok($nik)
{

    $db = \Config\Database::connect();

    $data = $db->table('admin_web')->where(['nik' => $nik])->get()->getRowArray();

    if ($data['enable_login'] == 1) {
        echo "checked";
    } else {
        echo "";
    }
}

function cek_stts_hadia($id)
{
    $db = \Config\Database::connect();

    $data =  $db->table('paslon')->where(['id' => $id])->get()->getRowArray();
    if ($data['urutan'] != 0) {
        echo "hidden";
    } else {
        echo "";
    }
}

function  cek_blok_userApp($id)
{

    $db = \Config\Database::connect();

    $data = $db->table('user_app')->where(['id' => $id])->get()->getRowArray();

    if ($data['enable_login'] == 1) {
        echo "checked";
    } else {
        echo "";
    }
}

function cek_Voting()
{
    $db = \Config\Database::connect();

    $data = $db->table('apps')->get()->getRowArray();

    if ($data['stts_voting'] == "true") {
        echo "checked";
    } else {
        echo "";
    }
}
