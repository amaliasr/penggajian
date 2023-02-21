<?php

class DataPresensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('id_akses') != '1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Anda belum Login!</strong> <button type="button" class="close" data-dismiss="alert" 
                    aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
    }

    public function index()
    {
        $data['title'] = "Data Presensi Pegawai";


        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }

        $data['presensi'] = $this->db->query("SELECT data_kehadiran.*,data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_pegawai.id_jabatan 
            FROM data_kehadiran 
            INNER JOIN data_pegawai ON data_kehadiran.nip=data_pegawai.nip
            INNER JOIN data_jabatan ON data_pegawai.id_jabatan = data_jabatan.id_jabatan
            WHERE data_kehadiran.bulan='$bulantahun'
            ORDER BY data_pegawai.nama_pegawai ASC")->result();

        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/datapresensi', $data);
        $this->load->view('templates_admin/footer');
    }

    public function inputPresensi()
    {
        if ($this->input->post('submit', TRUE) == 'submit') {
            $post = $this->input->post();

            foreach ($post['bulan'] as $key => $value) {
                if ($post['bulan'][$key] != '' || $post['nik'][$key] != '') {
                    $simpan[] = array(

                        'bulan'             => $post['bulan'][$key],
                        'nip'               => $post['nik'][$key],
                        'hadir'             => $post['hadir'][$key],
                        'izin'              => $post['izin'][$key],
                        'sakit'             => $post['sakit'][$key],
                        'alpha'             => $post['alpha'][$key],
                    );
                }
            }

            $this->penggajianModel->insert_batch('data_kehadiran', $simpan);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan!</strong> <button type="button" class="close" data-dismiss="alert" 
            aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/dataPresensi');
        }

        $data['title'] = "Form Input Data Presensi Pegawai";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }
        $data['input_presensi'] = $this->db->query("SELECT data_pegawai.*, data_jabatan.nama_jabatan FROM data_pegawai
        INNER JOIN data_jabatan ON data_pegawai.id_jabatan=data_jabatan.id_jabatan
        WHERE NOT EXISTS (SELECT * FROM data_kehadiran WHERE bulan='$bulantahun' AND data_pegawai.nip=data_kehadiran.nip)
        ORDER BY data_pegawai.nama_pegawai ASC")->result();

        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formInputPresensi', $data);
        $this->load->view('templates_admin/footer');
    }
    public function listPresensi()
    {
        $bulantahun = $this->input->post('bulantahun');
        $data = $this->db->query("SELECT data_kehadiran.*,data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_kehadiran.id_jabatan 
        FROM data_kehadiran 
        INNER JOIN data_pegawai ON data_kehadiran.nip=data_pegawai.nip
        LEFT JOIN data_jabatan ON data_kehadiran.id_jabatan = data_jabatan.id_jabatan
        WHERE data_kehadiran.bulan='$bulantahun'
        ORDER BY data_pegawai.nama_pegawai ASC")->result();
        echo json_encode($data);
    }
    public function newListPresensi()
    {
        $data = $this->db->query("SELECT a.nip, a.nama_pegawai,a.id_jabatan FROM data_pegawai a ORDER BY a.nama_pegawai ASC;")->result();
        echo json_encode($data);
    }
    public function insertPresensi()
    {
        $this->db->trans_start();
        $data = $this->input->post('data');
        if ($data[0]['id_kehadiran'] == 'undefined') {
            // insert
            foreach ($data as $value) {
                $dataInsert = array(
                    'hadir' => $value['hadir'],
                    'izin' =>  $value['izin'],
                    'sakit' =>  $value['sakit'],
                    'alpha' =>  $value['alpha'],
                    'nip' =>  $value['nip'],
                    'bulan' =>  $value['bulan'],
                    'id_jabatan' =>  $value['id_jabatan'],
                );
                $this->penggajianModel->insert_data($dataInsert, 'data_kehadiran');
            }
        } else {
            // edit
            foreach ($data as $value) {
                $dataInsert = array(
                    'hadir' => $value['hadir'],
                    'izin' =>  $value['izin'],
                    'sakit' =>  $value['sakit'],
                    'alpha' =>  $value['alpha'],
                );
                $dataId = array(
                    'id_kehadiran' => $value['id_kehadiran'],
                );
                $this->penggajianModel->update_data('data_kehadiran', $dataInsert, $dataId);
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Input"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Input"));
        }
    }
}
