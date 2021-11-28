<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Owner extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $status = $this->session->userdata('status') == 'Login' && $this->session->userdata('role') == 'owner';
        if (!$status) {
            redirect('');
        }
        $this->load->library('cetakpdf');
    }
    public function index()
    {
        $tgl = date('Y-m-d');
        $data['pendapatan'] = $this->db->select('total')->from('tb_transaksi')->where(array('tgl' => $tgl, 'id_outlet' => $this->session->userdata('id_outlet')))->get()->result();
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('owner/beranda', $data);
    }
    public function lapDataMember()
    {
        $data['member'] = $this->db->select()->from('tb_member')->get()->result();
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('owner/lapDataMember',$data);
    }
    public function lapPendapatan()
    {
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('owner/lapPendapatan');
    }
    public function data()
    {
        $id_outlet = $this->input->get('id_outlet') ? $this->input->get('id_outlet') : null;
        $id = $this->input->get('id') ? $this->input->get('id') : null;
        $tgl = date('Y-m-d');
        $data['paket'] = $this->db->select('id,jenis,nama_paket,harga')->from('tb_paket')->where(array('id_outlet' => $id_outlet))->get()->result();
        $data['paketTransaksi'] = $this->db->select('id,jenis,nama_paket,harga')->from('tb_paket')->where(array('id' => $id))->get()->result();
        $data['outlet'] = $this->db->select('id,nama')->from('tb_outlet')->get()->result();
        $data['userBaru'] = $this->db->select()->from('tb_user')->order_by('tgl_daftar', 'DESC')->limit(10)->get()->result();
        $data['pekerja'] = count($this->db->select()->from('tb_user')->get()->result());
        $data['member'] = count($this->db->select('id')->from('tb_member')->get()->result());
        $data['transaksi'] = count($this->db->select('id')->from('tb_transaksi')->where(array('tgl' => $tgl))->get()->result());
        $data['transaksiPetugas'] = count($this->db->select('id')->from('tb_transaksi')->where(array('tgl' => $tgl, 'id_outlet' => $id_outlet))->get()->result());
        echo json_encode($data);
        // echo $id_outlet;
    }
    public function ambil_data_member_baru()
    {
        $data = $this->db->select()->from('tb_member')->order_by('tgl_daftar', 'DESC')->limit(10)->get()->result();
        echo json_encode($data);
    }
    public function laporanPendapatan($dari, $sampai, $periode)
    {
        $id_outlet = $this->session->userdata('id_outlet');
        $sql = '';
        if ($periode == 'perbulan') {
            $sql = "SELECT sum(total) as pendapatan,date_format(tgl,'%c') as bulan,date_format(tgl,'%Y') as tahun FROM tb_transaksi WHERE date_format(tgl,'%Y-%c') BETWEEN date_format('$dari','%Y-%c') and date_format('$sampai','%Y-%c') and id_outlet='$id_outlet' GROUP BY date_format(tgl,'%Y-%c')";
        } else {
            $sql = "SELECT sum(total) as pendapatan,tgl as bulan from tb_transaksi where tgl between '$dari' and '$sampai' and id_outlet='$id_outlet' group by tgl";
        }
        $data['transaksi'] = $this->db->query($sql)->result();
        $data['outlet'] = $this->db->select()->from('tb_outlet')->where(array('id' => $this->session->userdata('id_outlet')))->get()->result();
        $html = $this->load->view('cetakLaporanPendapatan', $data, true);
        $this->cetakpdf->load_html($html);
        $this->cetakpdf->set_paper('A4', 'potrait');
        $this->cetakpdf->render();
        $this->cetakpdf->output();
        $this->cetakpdf->stream('laporan.pdf', array('Attachment' => false));
    }
    public function dataPendapatan()
    {
        $dari = $this->input->post('dari');
        $sampai = $this->input->post('sampai');
        $periode = $this->input->post('periode');
        $id_outlet = $this->session->userdata('id_outlet');
        $sql = '';
        if ($periode == 'perbulan') {
            $sql = "SELECT sum(total) as pendapatan,date_format(tgl,'%c') as bulan,date_format(tgl,'%Y') as tahun,tgl as tanggal FROM tb_transaksi WHERE date_format(tgl,'%Y-%c') BETWEEN date_format('$dari','%Y-%c') and date_format('$sampai','%Y-%c') and id_outlet='$id_outlet' GROUP BY date_format(tgl,'%Y-%c')";
        } else {
            $sql = "SELECT sum(total) as pendapatan,tgl as tanggal from tb_transaksi where tgl between '$dari' and '$sampai' and id_outlet='$id_outlet' group by tgl";
        }
        $data['transaksi'] = $this->db->query($sql)->result();
        echo json_encode($data);
    }
}
