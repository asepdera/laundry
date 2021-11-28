<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aksi extends CI_Model
{
    public function masukan($tabel, $data)
    {
        $this->db->trans_begin();
        $this->db->insert($tabel, $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            $sess = array(
                'berhasil' => 'ya',
                'pesan' => 'Data berhasil dimasukan'
            );
            $this->session->set_flashdata($sess);
            $this->db->trans_commit();
        } else {
            $sess = array(
                'berhasil' => 'tidak',
                'pesan' => 'Ada yang error di query atau database nya'
            );
            $this->session->set_flashdata($sess);
            $this->db->trans_rollback();
        }
    }
    public function masukanBanyak($tabel, $data, $toast)
    {
        $this->db->trans_begin();
        $this->db->insert_batch($tabel, $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            if($toast === TRUE){
                $sess = array(
                    'berhasil' => 'ya',
                    'pesan' => 'Data berhasil dimasukan'
                );
                $this->session->set_flashdata($sess);
            } else {}
            $this->db->trans_commit();
        } else {
            if($toast === TRUE){
                $sess = array(
                    'berhasil' => 'tidak',
                    'pesan' => 'Ada yang error di query atau database nya'
                );
                $this->session->set_flashdata($sess);
            } else {}
            $this->db->trans_rollback();
        }
    }
    public function update($tabel, $data, $where)
    {
        $this->db->trans_begin();
        $this->db->update($tabel, $data, $where);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            $sess = array(
                'berhasil' => 'ya',
                'pesan' => 'Data berhasil diubah'
            );
            $this->session->set_flashdata($sess);
            $this->db->trans_commit();
        } else {
            $sess = array(
                'berhasil' => 'tidak',
                'pesan' => 'Ada yang error di query atau database nya'
            );
            $this->session->set_flashdata($sess);
            $this->db->trans_rollback();
        }
    }
}
