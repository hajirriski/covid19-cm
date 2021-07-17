<?php

class Admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    
  }

  public function index()
  {
    $this->load->view('admin/admin-login');
  }

  public function login()
  {
    $this->load->view('admin/login');
  }

  public function logout()
  {
    $this->load->view('admin/logout');
  }

  public function profil()
  {
    $this->load->view('admin/profil');
  }

  public function dashboard()
  {

    $this->load->view('topbaradmin/topbaradmin');
    $this->load->view('admin/dashboard');
  }

  public function tambahparamedis()
  {
    $this->load->view('topbaradmin/topbaradmin');
    $this->load->view('admin/tambah-paramedis');
  }

  public function kelolaparamedis()
  {
    $this->load->view('topbaradmin/topbaradmin');
    $this->load->view('admin/kelola-paramedis');
  }

  public function cekbaru()
  {
    $this->load->view('topbaradmin/topbaradmin');
    $this->load->view('admin/cek-baru');
  }

  public function cekditugaskan()
  {
    $this->load->view('topbaradmin/topbaradmin');
    $this->load->view('admin/cek-ditugaskan');
  }

  public function cekprosespengumpulan()
  {
    $this->load->view('topbaradmin/topbaradmin');
    $this->load->view('admin/cek-proses-pengumpulan');
  }

  public function cekdikumpulkan()
  {
    $this->load->view('topbaradmin/topbaradmin');
    $this->load->view('admin/cek-dikumpulkan');
  }

  public function cekdikirimkelab()
  {
    $this->load->view('topbaradmin/topbaradmin');
    $this->load->view('admin/cek-dikirim-ke-lab');
  }

  public function cekterkirim()
  {
    $this->load->view('topbaradmin/topbaradmin');
    $this->load->view('admin/cek-terkirim');
  }

  public function semualaporan()
  {
    $this->load->view('topbaradmin/topbaradmin');
    $this->load->view('admin/semua-laporan');
  }

  public function carilaporan()
  {
    $this->load->view('topbaradmin/topbaradmin');
    $this->load->view('admin/admin-cari-laporan');
  }

  public function hasilcarilaporan()
  {
    $this->load->view('topbaradmin/topbaradmin');
    $this->load->view('admin/admin-hasilcari-laporan');
  }

  public function laporandetail()
  {
    $this->load->view('topbaradmin/topbaradmin');
    $this->load->view('admin/admin-laporan-pasien-detail');
  }

  public function download($data)
  {
    $file = file_get_contents(base_url()."filelaporan/$data");
    $name = "file_laporan.pdf";
    force_download($name, $file);
  }

  

}