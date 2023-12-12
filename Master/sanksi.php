<?php

namespace Master;

use Config\Query_builder;

class sanksi
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('sanksi')->get()->resultArray();
        $res = '<a href="?target=sanksi&act=tambah_sanksi" class="btn btn-info btn-sm">Tambah sanksi</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>no_sanksi</th>
                    <th>rentang</th>
                    <th>tindakan_sekolah</th>
                    <th>sanksi</th>
                    <th>pelaksanaan</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="10">' . $no . '</td>
                <td>' . $r['no_sanksi'] . '</td>
                <td>' . $r['rentang'] . '</td>
                <td>' . $r['tindakan_sekolah'] . '</td>
                <td>' . $r['sanksi'] . '</td>
                <td>' . $r['pelaksanaan'] . '</td>
                <td width="150">
                    <a href="?target=sanksi&act=edit_sanksi&id=' . $r['no_sanksi'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=sanksi&act=delete_sanksi&id=' . $r['no_sanksi'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=sanksi" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=sanksi&act=simpan_sanksi">
            <div class="mb-3">
                <label for="no_sanksi" class="form-label">no_sanksi</label>
                <input type="text" class="form-control" id="no_sanksi" name="no_sanksi">
            </div>
            <div class="mb-3">
                <label for="rentang" class="form-label">rentang</label>
                <input type="text" class="form-control" id="rentang" name="rentang">
            </div>
            <div class="mb-3">
                <label for="tindakan_sekolah" class="form-label">tindakan_sekolah</label>
                <input type="text" class="form-control" id="tindakan_sekolah" name="tindakan_sekolah">
            </div>
            <div class="mb-3">
                <label for="sanksi" class="form-label">sanksi</label>
                <input type="text" class="form-control" id="sanksi" name="sanksi">
            </div>
            <div class="mb-3">
                <label for="pelaksanaan" class="form-label">pelaksanaan</label>
                <input type="text" class="form-control" id="pelaksanaan" name="pelaksanaan">
            </div>


            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $no_sanksi = $_POST['no_sanksi'];
        $rentang = $_POST['rentang'];
        $tindakan_sekolah = $_POST['tindakan_sekolah'];
        $sanksi = $_POST['sanksi'];
        $pelaksanaan = $_POST['pelaksanaan'];

        $data = array(
            'no_sanksi' => $no_sanksi,
            'rentang' => $rentang,
            'tindakan_sekolah' => $tindakan_sekolah,
            'sanksi' => $sanksi,
            'pelaksanaan' => $pelaksanaan,

        );
        return $this->db->table('sanksi')->insert($data);
    }
    public function edit($id)
    {
        // get data sanksi
        $r = $this->db->table('sanksi')->where("no_sanksi='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=sanksi" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=sanksi&act=update_sanksi">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['no_sanksi'] . '">

            <div class="mb-3">
                <label for="no_sanksi" class="form-label">no_sanksi</label>
                <input type="text" class="form-control" id="no_sanksi" name="no_sanksi" value="' . $r['no_sanksi'] . '">
            </div>
            <div class="mb-3">
                <label for="rentang" class="form-label">rentang</label>
                <input type="text" class="form-control" id="rentang" name="rentang" value="' . $r['rentang'] . '">
            </div>
            <div class="mb-3">
                <label for="tindakan_sekolah" class="form-label">tindakan_sekolah</label>
                <input type="text" class="form-control" id="tindakan_sekolah" name="tindakan_sekolah" value="' . $r['tindakan_sekolah'] . '">
            </div>
            <div class="mb-3">
                <label for="sanksi" class="form-label">sanksi</label>
                <input type="text" class="form-control" id="sanksi" name="sanksi" value="' . $r['sanksi'] . '">
            </div>
            <div class="mb-3">
                <label for="pelaksanaan" class="form-label">pelaksanaan</label>
                <input type="text" class="form-control" id="pelaksanaan" name="pelaksanaan" value="' . $r['pelaksanaan'] . '">
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
        $no_sanksi = $_POST['no_sanksi'];
        $rentang = $_POST['rentang'];
        $tindakan_sekolah = $_POST['tindakan_sekolah'];
        $sanksi = $_POST['sanksi'];
        $pelaksanaan = $_POST['pelaksanaan'];

        $data = array(
            'no_sanksi' => $no_sanksi,
            'rentang' => $rentang,
            'tindakan_sekolah' => $tindakan_sekolah,
            'sanksi' => $sanksi,
            'pelaksanaan' => $pelaksanaan,
        );
        return $this->db->table('sanksi')->where("no_sanksi='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('sanksi')->where("no_sanksi='$id'")->delete();
    }
}
