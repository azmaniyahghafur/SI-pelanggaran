<?php

namespace Master;

use Config\Query_builder;

class siswa
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('siswa')->get()->resultArray();
        $res = '<a href="?target=siswa&act=tambah_siswa" class="btn btn-info btn-sm">Tambah siswa</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>nama siswa</th>
                    <th>nama kelas</th>
                    <th>nama jurusan</th>
                    <th>jenis kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="10">' . $no . '</td>
                <td width="100">' . $r['NIS'] . '</td>
                <td>' . $r['nama_siswa'] . '</td>
                <td>' . $r['nama_kelas'] . '</td>
                <td>' . $r['nama_jurusan'] . '</td>
                <td>' . $r['jenis_kelamin'] . '</td>
                <td width="150">
                    <a href="?target=siswa&act=edit_siswa&id=' . $r['nama_siswa'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=siswa&act=delete_siswa&id=' . $r['mana_siswa'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=siswa" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=siswa&act=simpan_siswa">
            <div class="mb-3">
                <label for="nama_siswa" class="form-label">NIS</label>
                <input type="text" class="form-control" id="nama_siwa" name="nama_siswa">
            </div>
            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas">
            </div>
            <div class="mb-3">
                <label for="nama_jurusan" class="form-label">jurusan</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan">
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">jenis kelamin</label>
                <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $NIS = $_POST['NIS'];
        $nama_siswa = $_POST['nama_siswa'];
        $nama_kelas = $_POST['nama_kelas'];
        $nama_jurusan = $_POST['nama_jurusan'];
        $jenis_kelamin = $_POST['jenis_kelamin'];

        $data = array(
            'NIS' => $NIS,
            'nama_siswa' => $nama_siswa,
            'nama_kelas' => $nama_kelas,
            'nama_jurusan' => $nama_jurusan,
            'jenis_kelamin' => $jenis_kelamin,
        );
        return $this->db->table('siswa')->insert($data);
    }
    public function edit($id)
    {
        // get data siswa
        $r = $this->db->table('siswa')->where("nama_siswa='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=siswa" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=siswa&act=update_siswa">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['nama_siswa'] . '">

            <div class="mb-3">
                <label for="nama_siswa" class="form-label">NIS</label>
                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="' . $r['nama_siswa'] . '">
            </div>
            <div class="mb-3">
                <label for="nama_kelas" class="form-label">nama_kelas</label>
                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="' . $r['nama_kelas'] . '">
            </div>
            <div class="mb-3">
                <label for="nama_jurusan" class="form-label">nama_jurusan</label>
                <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="' . $r['nama_jurusan'] . '">
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">jenis_kelamin</label>
                <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="' . $r['jenis_kelamin'] . '">
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
        $nama_siswa = $_POST['nama_siswa'];
        $nama_kelas = $_POST['nama_kelas'];
        $nama_jurusan = $_POST['nama_jurusan'];
        $jenis_kelamin= $_POST['jenis_kelamin'];

        $data = array(
            'nama_siswa' => $nama_siswa,
            'nama_kelas' => $nama_kelas,
            'nama_jurusan' => $nama_jurusan,
            'jenis_kelamin' => $jenis_kelamin,
        );
        return $this->db->table('siswa')->where("nama_siswa='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('siswa')->where("nama_siswa='$id'")->delete();
    }
}
