<?php
class PenggajianModel extends CI_model
{
    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update_data($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }

    public function delete_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function insert_batch($table = null, $data = array())
    {
        $jumlah = count($data);
        if ($jumlah > 0) {
            $this->db->insert_batch($table, $data);
        }
    }

    public function auto_code($table, $where)
    {
        $this->db->select_max($table);
        $auto = $this->db->get($where);
        return $auto->result_array();
    }

    public function cek_login()
    {
        $username       = set_value('username');
        $password       = set_value('password');

        $result         = $this->db->where('username', $username)
            ->where('password', md5($password))
            ->limit(1)
            ->get('data_pegawai');

        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return FALSE;
        }
    }
    public function potonganCutiBulanTahun($bulantahun)
    {
        $query = $this->db->query("SELECT
                a.nip,
                b.nama_pegawai,
                c.nama_cuti,
                a.jumlah_hari,
                a.tanggal_pengajuan,
                a.tgl_mulai_cuti,
                a.tgl_akhir_cuti,
                d.col_jabatan,
                e.gaji_pokok,
                e.transport,
                e.uang_makan,                                       
                DATE_FORMAT(a.tgl_mulai_cuti,'%m%Y') as kode_mulai,
                DATE_FORMAT(a.tgl_akhir_cuti,'%m%Y') as kode_akhir
                FROM data_cuti a
                JOIN data_pegawai b ON a.nip = b.nip
                JOIN cuti c ON a.id_cuti = c.id
                JOIN relation_cuti_potongan d ON d.id_cuti = c.id
                JOIN data_jabatan e ON e.id_jabatan = a.id_jabatan
                WHERE a.status_approval = 'SUCCESS'
                AND (DATE_FORMAT(a.tgl_mulai_cuti,'%m%Y') = $bulantahun OR DATE_FORMAT(a.tgl_akhir_cuti,'%m%Y') = $bulantahun);
                            ")->result();
        return $query;
    }
    public function potonganCutiById($nip)
    {
        $query = $this->db->query("SELECT
                                a.nip,
                                b.nama_pegawai,
                                c.nama_cuti,
                                a.jumlah_hari,
                                a.tanggal_pengajuan,
                                a.tgl_mulai_cuti,
                                a.tgl_akhir_cuti,
                                d.col_jabatan,
                                e.gaji_pokok,
                                e.transport,
                                e.uang_makan,                                       
                                DATE_FORMAT(a.tgl_mulai_cuti,'%m%Y') as kode_mulai,
                                DATE_FORMAT(a.tgl_akhir_cuti,'%m%Y') as kode_akhir
                            FROM data_cuti a
                            JOIN data_pegawai b ON a.nip = b.nip
                            JOIN cuti c ON a.id_cuti = c.id
                            JOIN relation_cuti_potongan d ON d.id_cuti = c.id
                            JOIN data_jabatan e ON e.id_jabatan = a.id_jabatan
                            WHERE a.status_approval = 'SUCCESS'
                            AND a.nip = $nip;
                            ")->result();
        return $query;
    }
    public function getDataRelation($id)
    {
        $query = $this->db->query("SELECT * FROM relation_cuti_potongan WHERE id_cuti = $id")->result();
        return $query;
    }
    public function checkData($id)
    {
        $query = $this->db->query("SELECT * FROM data_cuti WHERE id_cuti = $id")->result();
        return $query;
    }
    public function checkDataPKP($id)
    {
        $query = $this->db->query("SELECT * FROM data_pph WHERE id = $id")->result();
        return $query;
    }
}
