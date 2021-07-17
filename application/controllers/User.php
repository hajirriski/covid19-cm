<?php

class User extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    
  }

  public function index()
  {
    $this->load->view('user/new-user-testing');
  }

  public function livetest()
  {
    $this->load->view('user/live-test-updates');
  }

  public function registered()
  {
    $this->load->view('user/registered-user-checking');
  }

  public function carilaporan()
  {
    $this->load->view('user/cari-laporan-cek');
  }

  public function laporanpasien()
  {
    $this->load->view('user/laporan-pasien');
  }

  public function laporanpasiendetail()
  {
    $this->load->view('user/laporan-pasien-detail');
  }


  
}
