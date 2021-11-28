<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanMember extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('aksi');
        date_default_timezone_set('Asia/Jakarta');
        // require_once APPPATH.'third_party/dompdf/autoload.inc.php';
        $this->load->library('cetakpdf');
    }
    public function index()
    {
        $data['member'] = $this->db->select()->from('tb_member')->get()->result();
        $data['outlet_dimana'] = $this->db->select()->from('tb_outlet')->where(array('id' => $this->session->userdata('id_outlet')))->get()->result();
        $html = $this->load->view('cetakLaporanMember', $data, true);
        $this->cetakpdf->load_html($html);
        $this->cetakpdf->set_paper('A4', 'potrait');
        $this->cetakpdf->render();
        $this->cetakpdf->output();
        $this->cetakpdf->stream('laporan.pdf', array('Attachment' => false));
    }
    public function periode($dari,$sampai)
    {
        $data['member'] = $this->db->query("select * from tb_member where date(tgl_daftar) between date('$dari') and date('$sampai') order by date(tgl_daftar) desc")->result();
        $data['outlet_dimana'] = $this->db->select()->from('tb_outlet')->where(array('id' => $this->session->userdata('id_outlet')))->get()->result();
        $html = $this->load->view('cetakLaporanMember', $data, true);
        $this->cetakpdf->load_html($html);
        $this->cetakpdf->set_paper('A4', 'potrait');
        $this->cetakpdf->render();
        $this->cetakpdf->output();
        $this->cetakpdf->stream('laporan.pdf', array('Attachment' => false));
    }
}
