<?php
class LaporanPosisiKaryawan extends CI_Controller
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
        $data['title'] = "Laporan Posisi Karyawan";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/laporanPosisiKaryawan', $data);
        $this->load->view('templates_admin/footer');
    }
    public function dataPromosi()
    {
        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');
        $data = $this->penggajianModel->getDataPromosiDate($tanggal_awal, $tanggal_akhir);
        echo json_encode($data);
    }
    public function dataMutasi()
    {
        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');
        $data  = $this->penggajianModel->getDataMutasiDate($tanggal_awal, $tanggal_akhir);
        echo json_encode($data);
    }
    public function dataPHK()
    {
        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');
        $data  = $this->penggajianModel->getDataPHKDate($tanggal_awal, $tanggal_akhir);
        echo json_encode($data);
    }
    public function slipTHR($tgl_thr)
    {
        $data['title'] = 'Cetak Slip THR';
        $data['karyawan'] = $this->penggajianModel->listActiveKaryawan();
        $data['masaKaryawan'] = $this->penggajianModel->listMasaKaryawan($tgl_thr);
        $this->load->view('templates_admin/header', $data);
        $this->load->view('admin/cetakSlipTHR', $data);
    }
}
