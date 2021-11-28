<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $status = $this->session->userdata('status') == 'Login' && $this->session->userdata('role') == 'kasir';
        if (!$status) {
            redirect('');
        }
        $this->load->model('aksi');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('cetakpdf');
    }
    public function index()
    {
        $tgl = date('Y-m-d');
        $data['pendapatan'] = $this->db->select('total')->from('tb_transaksi')->where(array('tgl' => $tgl, 'id_outlet' => $this->session->userdata('id_outlet')))->get()->result();
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('kasir/beranda', $data);
    }
    public function member()
    {
        $data['member'] = $this->db->select()->from('tb_member')->get()->result();
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('kasir/member', $data);
    }
    public function transaksi()
    {
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('kasir/transaksi');
    }
    public function dataTransaksi()
    {
        $data['transaksi'] = $this->db->select('kode_invoice,id_member,total,status,dibayar')->from('tb_transaksi')->get()->result();
        $data['nama_member'] = $this->db->query('select nama from tb_member inner join tb_transaksi on tb_transaksi.id_member = tb_member.id')->result();
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('kasir/dataTransaksi', $data);
    }
    public function lapPendapatan()
    {
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('kasir/lapPendapatan');
    }
    public function tambah_member()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $telp = $this->input->post('telp');
        $tgl = date('Y-m-d H:i:s');
        $data = array(
            'id' => $id,
            'nama' => $nama,
            'alamat' => $alamat,
            'jenis_kelamin' => $jenis_kelamin,
            'tgl_daftar' => $tgl,
            'telp' => $telp
        );
        if (empty($nama) && empty($alamat) && strlen($telp) > 13) {
            $sess = array(
                'berhasil' => 'warning',
                'pesan' => 'Isi semua data'
            );
            $this->session->set_flashdata($sess);
        } else {
           $this->aksi->masukan('tb_member', $data);
        }
        redirect('memberKasir');
    }
    public function aksi_edit_member()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $telp = $this->input->post('telp');
        $data = array(
            'id' => $id,
            'nama' => $nama,
            'alamat' => $alamat,
            'jenis_kelamin' => $jenis_kelamin,
            'telp' => $telp,
        );
        if (empty($nama) && empty($alamat) && empty($jenis_kelamin) && empty($telp)) {
            $sess = array(
                'berhasil' => 'warning',
                'pesan' => 'Isi semua data'
            );
            $this->session->set_flashdata($sess);
        } else {
            $this->aksi->update('tb_member', $data, array('id' => $id));
        }
        redirect('memberKasir');
    }
    public function edit_member($id)
    {
        $data = $this->db->select()->from('tb_member')->where('id', $id)->get()->result();
        echo json_encode($data);
    }
    public function hapus_member($id)
    {
        $delete = $this->db->delete('tb_member', array('id' => $id));
        if ($delete) {
            $success = array(
                'berhasil' => 'ya',
                'pesan' => 'Data berhasil dihapus'
            );
            $this->session->set_flashdata($success);
        }
        redirect('memberKasir');
    }
    public function aksiTransaksi()
    {
        $kode_invoice = $this->input->post('kode_invoice');
        $id_user = $this->input->post('user_id');
        $id_member = $this->input->post('id_member');
        $id_outlet = $this->input->post('id_outlet');
        $qty = $this->input->post('qty'); //array
        $keterangan = $this->input->post('keterangan'); //array
        $status = $this->input->post('status');
        $dibayar = $this->input->post('dibayar');
        $batas_waktu = $this->input->post('batas_waktu');
        $pajak = preg_replace("/[^0-9]/", '', $this->input->post('pajak'));
        $biaya_lain = preg_replace('/[^0-9]/', '', $this->input->post('biaya_lain'));
        $subtotal = preg_replace('/[^0-9]/', '', $this->input->post('subtotal'));
        $diskon = preg_replace('/[^0-9]/', '', $this->input->post('diskon'));
        $id_paket = $this->input->post('id_paket'); //array
        $harga = $this->input->post('harga'); //array
        $total = (int)$subtotal + (int)$pajak + (int)$biaya_lain - (int)$diskon;
        for ($i = 0; $i < count($qty); $i++) {
            $dataDetail[] = array(
                'id_transaksi' => $kode_invoice,
                'id_paket' => $id_paket[$i],
                'qty' => (int)$qty[$i],
                'harga' => (int)$harga[$i],
                'keterangan' => $keterangan[$i],
            );
        }
        $dataTransaksi = array(
            'kode_invoice' => $kode_invoice,
            'id_member' => $id_member,
            'id_outlet' => $id_outlet,
            'tgl' => date('Y-m-d'),
            'batas_waktu' => $batas_waktu,
            'tgl_bayar' => ($dibayar == 'dibayar') ? date('Y-m-d H:i:s') : '0000-00-00 00:00',
            'biaya_tambahan' => $biaya_lain,
            'diskon' => $diskon,
            'pajak' => $pajak,
            'status' => $status,
            'dibayar' => $dibayar,
            'id_user' => $id_user,
            'total' => $total
        );

        $this->aksi->masukanBanyak('tb_detail_transaksi', $dataDetail, FALSE);
        $this->aksi->masukan('tb_transaksi', $dataTransaksi);

        redirect('cetakStruk/'.$kode_invoice);
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
    public function ambil_data_member()
    {
        $data = $this->db->select()->from('tb_member')->get()->result();
        echo json_encode($data);
    }
    public function cari_data_member($key)
    {
        $data = $this->db->select()->from('tb_member')->like('nama', $key)->get()->result();
        echo json_encode($data);
    }
    public function cari_data_paket($nama, $id_outlet)
    {
        $data = $this->db->select('id,jenis,nama_paket,harga')->from('tb_paket')->where(array('id_outlet' => $id_outlet))->like('nama_paket', $nama)->get()->result();
        echo json_encode($data);
    }
    public function ubahStatus()
    {
        $kode = $this->input->get('kode');
        $status = $this->input->get('status');
        $data = array(
            'status' => $status
        );
        $this->db->update('tb_transaksi', $data, array('kode_invoice' => $kode));
    }
    public function udahDibayar()
    {
        $kode = $this->input->get('kode');
        $status = $this->input->get('status');
        $tgl = ($status == 'dibayar') ? date('Y-m-d H:i:s') : '0000-00-00 00:00:00';
        $data = array(
            'dibayar' => $status,
            'tgl_bayar' => $tgl
        );
        $this->db->update('tb_transaksi', $data, array('kode_invoice' => $kode));
    }
}
