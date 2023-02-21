<?php

class DataGaji extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('id_akses') != '2') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Anda belum Login!</strong> <button type="button" class="close" data-dismiss="alert" 
                    aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
    }

    public function index()
    {
        $data['title'] = "Data Gaji";
        $nip = $this->session->userdata('nip');
        $data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();
        $data['gaji'] = $this->db->query("SELECT data_pegawai.nama_pegawai, data_pegawai.nip, 
        data_jabatan.gaji_pokok, data_jabatan.transport,data_jabatan.uang_makan, data_kehadiran.alpha, 
        data_kehadiran.bulan, data_kehadiran.id_kehadiran
            FROM data_pegawai
                INNER JOIN data_kehadiran ON data_kehadiran.nip=data_pegawai.nip
                INNER JOIN data_jabatan ON data_jabatan.id_jabatan=data_kehadiran.id_jabatan
                WHERE data_kehadiran.nip='$nip'
                ORDER BY data_kehadiran.bulan DESC")->result();
        $data['potongan_cuti'] = $this->db->query("SELECT
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
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar');
        $this->load->view('pegawai/dataGaji', $data);
        $this->load->view('templates_pegawai/footer');
    }

    public function cetakSlip($id)
    {
        $nip = $this->session->userdata('nip');
        $data['title'] = "Cetak Slip Gaji";
        $data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();

        $data['print_slip'] = $this->db->query("SELECT data_pegawai.nip, data_pegawai.nama_pegawai, data_jabatan.nama_jabatan, 
                        data_jabatan.gaji_pokok,data_jabatan.transport, data_jabatan.uang_makan, data_kehadiran.alpha, data_kehadiran.bulan
        FROM data_pegawai
            INNER JOIN data_kehadiran ON data_kehadiran.nip=data_pegawai.nip
            INNER JOIN data_jabatan ON data_jabatan.id_jabatan=data_kehadiran.id_jabatan
            WHERE data_kehadiran.id_kehadiran='$id'")->result();
        $data['potongan_cuti'] = $this->db->query("SELECT
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
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('pegawai/cetakSlipGaji', $data);
    }
}
