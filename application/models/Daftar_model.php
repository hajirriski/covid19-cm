<?php

class Daftar_model extends CI_Model
{

  public function daftarPasien()
  {
    $data = [
      "NamaLengkap" => $this->input->post('namalengkap', true),
      "NomorHP" => $this->input->post('nomorhp', true),
      "TanggalLahir" => $this->input->post('tgllahir', true),
      "KartuIdentitas" => $this->input->post('kartuidentitas', true),
      "no_KartuIdentitas" => $this->input->post('no_kartuidentitas', true),
      "Alamat" => $this->input->post('alamat', true),
      "Kota" => $this->input->post('kota', true),
    ];
    $data2 = [
      "noHP_Pasien" => $this->input->post('nomorhp', true),
      "TipeCek" => $this->input->post('tipecek', true),
      "WaktuCek" => $this->input->post('waktucek', true),
      "NomorPesanan" => mt_rand(100000000, 999999999),
    ];

    $this->db->insert('tb_pasien', $data);
    $this->db->insert('tb_testrecord', $data2);
  }

  public function cariData($keyword = null)
  {
    $this->db->select('NomorHP');
    $this->db->from('tb_pasien');
    $this->db->like('NomorHP', $keyword);

    return $this->db->get()->result();

  }
}
