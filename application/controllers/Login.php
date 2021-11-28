<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $this->load->view('login');
    }
    public function prosesLogin()
    {
        $username = $this->input->post('user');
        $password = $this->input->post('pass');

        $dataLogin = $this->db->select()->from('tb_user')->where('username', $username)->get()->result();
        if (count($dataLogin) > 0) {
            foreach ($dataLogin as $data) {
                if (password_verify($password, "$data->password")) {
                    if ($data->role == 'admin') {
                        $this->session->set_userdata(array(
                            'status' => 'Login',
                            'role' => $data->role,
                            'nama' => $data->nama,
                            'id_outlet' => $data->id_outlet,
                            'id' => $data->id,
                        ));
                        echo "<script>
                        alert('login berhasil'); window.location = '" . site_url('yangPunyaLoundry') . "'
                    </script>";
                    } else if ($data->role == 'owner') {
                        $this->session->set_userdata(array(
                            'status' => 'Login',
                            'role' => $data->role,
                            'nama' => $data->nama,
                            'id_outlet' => $data->id_outlet,
                            'id' => $data->id,
                        ));
                        echo "<script>
                        alert('login berhasil'); window.location = '" . site_url('yangJagaOutlet') . "'
                    </script>";
                    } else {
                        $this->session->set_userdata(array(
                            'status' => 'Login',
                            'role' => $data->role,
                            'nama' => $data->nama,
                            'id_outlet' => $data->id_outlet,
                            'id' => $data->id,
                        ));
                        echo "<script>
                        alert('login berhasil'); window.location = '" . site_url('yangJadiKasir') . "'
                    </script>";
                    }
                    echo 'berhasil';
                } else {
                    echo "<script>
                        alert('login gagal'); window.location = '" . site_url('') . "'
                    </script>";
                    echo 'gagal';
                }
            }
        } else {
            echo "<script>
                        alert('login gagal'); window.location = '" . site_url('') . "'
                    </script>";
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }
}
