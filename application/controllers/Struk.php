<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Struk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $status = $this->session->userdata('status') == 'Login';
        if (!$status) {
            redirect('');
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('cetakpdf');
    }
    public function index($kode_invoice)
    {
        $dataStruk['transaksi'] = $this->db->select()->from('tb_transaksi')->where(array('kode_invoice' => $kode_invoice))->get()->result();
        $dataStruk['detail'] = $this->db->select()->from('tb_detail_transaksi')->where(array('id_transaksi' => $kode_invoice))->get()->result();
        $dataStruk['nama_paket'] = $this->db->query("select tb_paket.nama_paket from tb_paket join tb_detail_transaksi on tb_detail_transaksi.id_paket = tb_paket.id and tb_detail_transaksi.id_transaksi = '$kode_invoice'")->result();

        $html = $this->load->view('cetakStruk', $dataStruk, true);
        $this->cetakpdf->load_html($html);
        $this->cetakpdf->set_paper(array(0, 0, 302, 650), 'potrait');
        $this->cetakpdf->render();
        $this->cetakpdf->output();
        $this->cetakpdf->stream('struk.pdf', array('Attachment' => false));
    }
}
