<?php

namespace Master;

use Config\Query_builder;

class user 
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('user')->get()->resultArray();
        $res = '<a href="?target=user&act=tambah_user" class="btn btn-info btn-sm">Tambah user</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>id_akun</th>
                    <th>nama_pengguna</th>
                    <th>username</th>
                    <th>password</th>
                    <th>role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="10">' . $no . '</td>
                <td width="100">' . $r['id_akun'] . '</td>
                <td>' . $r['nama_pengguna'] . '</td>
                <td>' . $r['username'] . '</td>
                <td>' . $r['password'] . '</td>
                <td>' . $r['role'] . '</td>
                <td width="150">
                    <a href="?target=user&act=edit_user&id=' . $r['id_akun'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=user&act=delete_user&id=' . $r['id_akun'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=user" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=user&act=simpan_user">
            <div class="mb-3">
                <label for="id_user" class="form-label">id_akun</label>
                <input type="text" class="form-control" id="id_akun" name="id_akun">
            </div>
            <div class="mb-3">
                <label for="nama_pengguna" class="form-label">nama_pengguna</label>
                <input type="text" class="form-control" id="nama_pengguna" name="id_akun">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Nama</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">role</label>
                <input type="text" class="form-control" id="role" name="role">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $id_akun = $_POST['id_akun'];
        $nama_pengguana = $_POST['nama_pengguna'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $data = array(
            'id_akun' => $id_akun,
            'nama_pengguna' => $nama_pengguna,
            'username' => $username,
            'password' => $password,
            'role' => $role,
        );
        return $this->db->table('user')->insert($data);
    }
    public function edit($id)
    {
        // get data user
        $r = $this->db->table('user')->where("id_akun='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=user" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=user&act=update_user">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id_akun'] . '">
            <div class="mb-3">
                <label for="id_akun" class="form-label">ID</label>
                <input type="text" class="form-control" id="id_akun" name="id_akun" value="' . $r['id_akun'] . '">
            </div>
            <div class="mb-3">
                <label for="nama_pengguna" class="form-label">No</label>
                <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="' . $r['nama_pengguna'] . '">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Nama</label>
                <input type="text" class="form-control" id="username" name="username" value="' . $r['username'] . '">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="password" name="password" value="' . $r['password'] . '">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="role" name="role" value="' . $r['role'] . '">
            </div>


            <button type="submit" class="btn btn-primary">Ubah</button>
        </form>';
        return $res;
    }

    public function cekRadio($val, $val2)
    {
        if ($val == $val2) {
            return "checked";
        }
        return "";
    }

    public function update()
    {
        $param = $_POST['param'];
        $id_akun = $_POST['id_akun'];
        $nama_pengguana = $_POST['nama_pengguna'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $data = array(
            'id_akun' => $id_akun,
            'nama_pengguna' => $nama_pengguana,
            'username' => $username,
            'password' => $password,
            'role' => $role,
        );
        return $this->db->table('user')->where("id_akun='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('user')->where("id_akun='$id'")->delete();
    }
}
