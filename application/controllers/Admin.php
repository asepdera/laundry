<?php

// use Domcetakpdf\Domcetakpdf;

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        //$status = $this->session->userdata('status') == 'Login' && $this->session->userdata('role') == 'admin';
        //if (!$status) {
            //redirect('');
        //}
        $this->load->model('aksi');
        date_default_timezone_set('Asia/Jakarta');
        // require_once APPPATH.'third_party/domcetakpdf/autoload.inc.php';
        $this->load->library('cetakpdf');
    }
    public function index()
    {
        $tgl = date('Y-m-d');
        $data['pendapatan'] = $this->db->select('total')->from('tb_transaksi')->where(array('tgl' => $tgl))->get()->result();
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('admin/beranda', $data);
    }
    public function member()
    {
        $data['member'] = $this->db->select()->from('tb_member')->get()->result();
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('admin/member', $data);
    }
    public function outlet()
    {
        $data['outlet'] = $this->db->select()->from('tb_outlet')->get()->result();
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('admin/outlet', $data);
    }
    public function user()
    {
        $data['user'] = $this->db->select()->from('tb_user')->get()->result();
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('admin/user', $data);
    }
    public function paket()
    {
        $data['paket'] = $this->db->select()->from('tb_paket')->get()->result();
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('admin/paket', $data);
    }
    public function transaksi()
    {
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('admin/transaksi');
    }
    public function dataTransaksi()
    {
        $data['transaksi'] = $this->db->select('kode_invoice,id_member,total,status,dibayar')->from('tb_transaksi')->get()->result();
        $data['nama_member'] = $this->db->query('select nama from tb_member inner join tb_transaksi on tb_transaksi.id_member = tb_member.id')->result();
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('admin/dataTransaksi', $data);
    }
    public function lapPendapatan()
    {
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('admin/lapPendapatan');
    }
    public function lapDataOutlet()
    {
        $data['outlet'] = $this->db->select('nama,alamat,tlp')->from('tb_outlet')->get()->result();
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('admin/lapDataOutlet', $data);
    }
    public function lapDataMember()
    {
        $data['member'] = $this->db->select()->from('tb_member')->get()->result();
        $this->load->view('header/header');
        // $this->load->view('menu/menu');
        $this->load->view('admin/lapDataMember', $data);
    }
    public function hapus_outlet($id)
    {
        $delete = $this->db->delete('tb_outlet', array('id' => $id));
        if ($delete) {
            $success = array(
                'berhasil' => 'ya',
                'pesan' => 'Data berhasil dihapus'
            );
            $this->session->set_flashdata($success);
        }
        redirect('outletAdmin');
    }
    public function aksi_edit_outlet()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('namaOutlet');
        $alamat = $this->input->post('alamatOutlet');
        $tlp = $this->input->post('teleponOutlet');
        $data = array(
            'id' => $id,
            'nama' => $nama,
            'alamat' => $alamat,
            'tlp' => $tlp
        );
        if (empty($nama) && empty($alamat) && empty($tlp)) {
            $sess = array(
                'berhasil' => 'warning',
                'pesan' => 'Isi semua data'
            );
            $this->session->set_flashdata($sess);
        } else {
            $this->aksi->update('tb_outlet', $data, array('id' => $id));
        }
        redirect('outletAdmin');
    }
    public function tambah_outlet()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('namaOutlet');
        $alamat = $this->input->post('alamatOutlet');
        $tlp = $this->input->post('teleponOutlet');
        $data = array(
            'id' => $id,
            'nama' => $nama,
            'alamat' => $alamat,
            'tlp' => $tlp
        );
        if (empty($nama) && empty($alamat) && empty($tlp)) {
            $sess = array(
                'berhasil' => 'warning',
                'pesan' => 'Isi semua data'
            );
            $this->session->set_flashdata($sess);
        } else {
            $this->aksi->masukan('tb_outlet', $data);
        }
        redirect('outletAdmin');
    }
    public function tambah_member()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $tgl = date('Y-m-d H:i:s');
        $telp = $this->input->post('telp');
        $data = array(
            'id' => $id,
            'nama' => $nama,
            'alamat' => $alamat,
            'jenis_kelamin' => $jenis_kelamin,
            'tgl_daftar' => $tgl,
            'telp' => $telp,
        );
        if (empty($nama) && empty($alamat) && empty($telp)) {
            $sess = array(
                'berhasil' => 'warning',
                'pesan' => 'Isi semua data'
            );
            $this->session->set_flashdata($sess);
        } else {
            $this->aksi->masukan('tb_member', $data);
        }
        redirect('memberAdmin');
    }
    public function tambah_paket()
    {
        $id = $this->input->post('id');
        $nama_paket = $this->input->post('nama_paket');
        $id_outlet = $this->input->post('id_outlet');
        $jenis = $this->input->post('jenis');
        $harga = $this->input->post('harga');
        $hasil = preg_replace("/[^0-9]/", "", $harga);
        $data = array(
            'id' => $id,
            'nama_paket' => $nama_paket,
            'id_outlet' => $id_outlet,
            'jenis' => $jenis,
            'harga' => $hasil,
        );
        if (empty($nama_paket) && empty($hasil) && empty($id_outlet)) {
            $sess = array(
                'berhasil' => 'warning',
                'pesan' => 'Isi semua data'
            );
            $this->session->set_flashdata($sess);
        } else {
            $this->aksi->masukan('tb_paket', $data);
        }
        redirect('paketAdmin');
    }
    public function tambah_user()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT)/*$this->input->post('password')*/;
        $id_outlet = $this->input->post('id_outlet');
        $role = $this->input->post('role');
        $tgl = date('Y-m-d H:i:s');
        $data = array(
            'id' => $id,
            'nama' => $nama,
            'username' => $username,
            'password' => $password,
            'id_outlet' => $id_outlet,
            'tgl_daftar' => $tgl,
            'role' => $role
        );
        if (empty($nama) && empty($username) && empty($password) && empty($id_outlet)) {
            $sess = array(
                'berhasil' => 'warning',
                'pesan' => 'Isi semua data'
            );
            $this->session->set_flashdata($sess);
        } else {
            $this->aksi->masukan('tb_user', $data);
        }
        redirect('userAdmin');
    }
    public function aksi_edit_user()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT)/*$this->input->post('password')*/;
        $id_outlet = $this->input->post('id_outlet');
        $role = $this->input->post('role');
        $data = array(
            'id' => $id,
            'nama' => $nama,
            'username' => $username,
            'password' => $password,
            'id_outlet' => $id_outlet,
            'role' => $role
        );
        if (empty($nama) && empty($username) && empty($password) && empty($id_outlet)) {
            $sess = array(
                'berhasil' => 'warning',
                'pesan' => 'Isi semua data'
            );
            $this->session->set_flashdata($sess);
        } else {
            $this->aksi->update('tb_user', $data, array('id' => $id));
        }
        redirect('userAdmin');
    }
    public function aksi_edit_paket()
    {
        $id = $this->input->post('id');
        $nama_paket = $this->input->post('nama_paket');
        $id_outlet = $this->input->post('id_outlet');
        $jenis = $this->input->post('jenis');
        $harga = $this->input->post('harga');
        $hasil = preg_replace("/[^0-9]/", "", $harga);
        $data = array(
            'id' => $id,
            'nama_paket' => $nama_paket,
            'id_outlet' => $id_outlet,
            'jenis' => $jenis,
            'harga' => $hasil,
        );
        if (empty($nama_paket) && empty($harga) && empty($jenis) && empty($id_outlet)) {
            $sess = array(
                'berhasil' => 'warning',
                'pesan' => 'Isi semua data'
            );
            $this->session->set_flashdata($sess);
        } else {
            $this->aksi->update('tb_paket', $data, array('id' => $id));
        }
        redirect('paketAdmin');
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
        if (empty($nama) && empty($alamat) && empty($jenis_kelamin) && strlen($telp) > 13) {
            $sess = array(
                'berhasil' => 'warning',
                'pesan' => 'Isi semua data'
            );
            $this->session->set_flashdata($sess);
        } else {
            $this->aksi->update('tb_member', $data, array('id' => $id));
        }
        redirect('memberAdmin');
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
        redirect('memberAdmin');
    }
    public function hapus_user($id)
    {
        $delete = $this->db->delete('tb_user', array('id' => $id));
        if ($delete) {
            $success = array(
                'berhasil' => 'ya',
                'pesan' => 'Data berhasil dihapus'
            );
            $this->session->set_flashdata($success);
        }
        redirect('userAdmin');
    }
    public function hapus_paket($id)
    {
        $delete = $this->db->delete('tb_paket', array('id' => $id));
        if ($delete) {
            $success = array(
                'berhasil' => 'ya',
                'pesan' => 'Data berhasil dihapus'
            );
            $this->session->set_flashdata($success);
        }
        redirect('paketAdmin');
    }
    public function edit_outlet($id)
    {
        $data = $this->db->select()->from('tb_outlet')->where('id', $id)->get()->result();
        echo json_encode($data);
    }
    public function edit_user($id)
    {
        $data = $this->db->select()->from('tb_user')->where('id', $id)->get()->result();
        echo json_encode($data);
    }
    public function edit_paket($id)
    {
        $data = $this->db->select()->from('tb_paket')->where('id', $id)->get()->result();
        echo json_encode($data);
    }
    public function edit_member($id)
    {
        $data = $this->db->select()->from('tb_member')->where('id', $id)->get()->result();
        echo json_encode($data);
    }
    public function ambil_data_member_baru()
    {
        $data = $this->db->select()->from('tb_member')->order_by('tgl_daftar', 'DESC')->limit(10)->get()->result();
        echo json_encode($data);
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
        for ($i = 0; $i < count($id_paket); $i++) {
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

        redirect('cetakStruk/' . $kode_invoice);
    }

    public function detailTransaksi()
    {
        $data['transaksi'] = $this->db->select()->from('tb_transaksi')->get()->result();
        $data['nama_member'] = $this->db->query('select nama from tb_member inner join tb_transaksi on tb_transaksi.id_member = tb_member.id')->result();
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
    public function dataPendapatan()
    {
        $dari = $this->input->post('dari');
        $sampai = $this->input->post('sampai');
        $periode = $this->input->post('periode');
        $sql = '';
        if ($periode == 'perbulan') {
            $sql = "SELECT sum(total) as pendapatan,date_format(tgl,'%c') as bulan,date_format(tgl,'%Y') as tahun,tgl as tanggal FROM tb_transaksi WHERE date_format(tgl,'%Y-%c') BETWEEN date_format('$dari','%Y-%c') and date_format('$sampai','%Y-%c') GROUP BY date_format(tgl,'%Y-%c')";
        } else {
            $sql = "SELECT sum(total) as pendapatan,tgl as tanggal from tb_transaksi where tgl between '$dari' and '$sampai' group by tgl";
        }
        $data['transaksi'] = $this->db->query($sql)->result();
        echo json_encode($data);
    }
    public function laporanPendapatan($dari, $sampai, $periode)
    {
        $sql = '';
        if ($periode == 'perbulan') {
            $sql = "SELECT sum(total) as pendapatan,date_format(tgl,'%c') as bulan,date_format(tgl,'%Y') as tahun FROM tb_transaksi WHERE date_format(tgl,'%Y-%c') BETWEEN date_format('$dari','%Y-%c') and date_format('$sampai','%Y-%c') GROUP BY date_format(tgl,'%Y-%c')";
        } else {
            $sql = "SELECT sum(total) as pendapatan,tgl as bulan from tb_transaksi where tgl between '$dari' and '$sampai' group by tgl";
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
    public function cetakLaporanOutlet()
    {
        $data['outlet'] = $this->db->select()->from('tb_outlet')->get()->result();
        $data['outlet_dimana'] = $this->db->select()->from('tb_outlet')->where(array('id' => $this->session->userdata('id_outlet')))->get()->result();
        $html = $this->load->view('cetakLaporanOutlet', $data, true);
        $this->cetakpdf->load_html($html);
        $this->cetakpdf->set_paper('A4', 'potrait');
        $this->cetakpdf->render();
        $this->cetakpdf->output();
        $this->cetakpdf->stream('laporan.pdf', array('Attachment' => false));
    }
}
