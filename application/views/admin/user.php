<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/icon.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/beranda.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/js/DataTables/datatables.min.css">
    <title>Data user</title>
    <style>
        footer {
            width: 100%;
            text-align: center;
            padding: 15px;
            background: #fff;
        }
    </style>
</head>

<body>
    <main class="main-content">
        <div class="info">
            <h2>Data User</h2>
        </div>
        <form action="<?= site_url('tambahUserAdmin') ?>" method="post">
            <div class="card">
                <div class="card-header">
                    Tambah Data User
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" id="i">
                    <div class="mt-3">
                        <label for="">Nama:</label>
                        <input type="text" name="nama" class="form-control" autocomplete="off" required></input>
                    </div>
                    <div class="mt-3">
                        <label for="">Username:</label>
                        <input type="text" name="username" class="form-control" autocomplete="off" required></input>
                    </div>
                    <div class="mt-3">
                        <label for="">Password:</label>
                        <input type="text" name="password" class="form-control" autocomplete="off" required></input>
                    </div>
                    <div class="mt-3">
                        <label for="">Id outlet:</label>
                        <select name="id_outlet" id="out" class="form-control" autocomplete="off"></select>
                    </div>
                    <div class="mt-3">
                        <label for="">Role:</label>
                        <select name="role" id="" class="form-control">
                            <option value="admin">admin</option>
                            <option value="owner">owner</option>
                            <option value="kasir">kasir</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="Tambah" class="btn btn-primary mr-3 float-right">
                </div>
            </div>
        </form>
        <div class="card mt-4" style="overflow: auto;">
            <div class="card-header">
                Data user
            </div>
            <div class="card-body">
                <table id="table" class="display table table-hover table-striped text-center" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>outlet</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; $i = -1;
                        $nama_outlet = $this->db->select('tb_outlet.nama')->from('tb_outlet')->join('tb_user','tb_outlet.id = tb_user.id_outlet')->get()->result();
                        foreach ($user as $item) : $no++; $i++?>

                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $item->nama ?></td>
                                <td><?= $item->username ?></td>
                                <td><?= $nama_outlet[$i]->nama ?></td>
                                <td><?= $item->role ?></td>
                                <td style="max-width: 137px !important;">
                                    <button class="btn btn-info mr-1" data-target="#edit_modal" data-toggle="modal" onclick="edit('<?= $item->id ?>')">
                                        <span class="fas fa-pen-square"></span>
                                    </button>
                                    <a href="<?php echo site_url("hapusUserAdmin/$item->id") ?>" class="btn btn-danger hapus" onclick="return confirm('anda yakin akan menghapus data ini? data yang telah dihapus tidak akan bisa dikembalikan!')">
                                        <span class="fas fa-trash"></span>
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer>
        asep dera purnama <?= date('Y') ?>
    </footer>
    <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <form action="<?php echo site_url('aksiEditUserAdmin') ?>" method="post" id="form-edit">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit data user</h5>
                        <button data-dismiss="modal" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group">
                        <input type="hidden" name="id" id="id">
                        <div class="mt-3">
                            <label>Nama:</label>
                            <input type="text" name="nama" class="form-control" id="edit_nama_user">
                        </div>
                        <div class="mt-3">
                            <label>Username:</label>
                            <input type="text" name="username" class="form-control" id="edit_username_user">
                        </div>
                        <div class="mt-3">
                            <label>Password:</label>
                            <input type="text" name="password" class="form-control" id="edit_password_user">
                        </div>
                        <div class="mt-3">
                            <label>Id outlet:</label>
                            <select name="id_outlet" id="edit_id_outlet" class="form-control"></select>
                        </div>
                        <div class="mt-3">
                            <label>Role:</label>
                            <select name="role" id="edit_role_user" class="form-control"></select>
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-secondary">Tutup</button>
                            <button type="submit" class="btn btn-primary" id="submit_edit">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?= base_url() ?>assets/js/jquery.js"></script>
    <script src="<?= base_url() ?>assets/js/script.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url() ?>assets/js/component.js"></script>
    <script src="<?php echo base_url() ?>assets/js/DataTables/datatables.min.js"></script>
    <script>
        $('#i').val(`USR${randomInt(9)}`)
        $('#table').DataTable({
            columnDefs: [{
                targets: [0],
                searchable: false
            }],
            sort: false,
            language: {
                infoFiltered: 'dari _MAX_ data',
                infoEmpty: 'tidak ada data yang bisa ditampilkan',
                sInfo: "Menunjukan _END_ sampai _TOTAL_"
            }
        });
        <?php if ($this->session->userdata('berhasil') == 'ya') {
        ?>
            toast({
                icon: 'fas fa-check',
                headerText: 'Berhasil',
                bodyText: '<?= $this->session->userdata('pesan') ?>',
                warna: 'green'
            })
        <?php } else if ($this->session->userdata('berhasil') == 'warning') { ?>
            toast({
                icon: 'fas fa-exclamation-circle',
                headerText: 'Perhatian',
                bodyText: '<?= $this->session->userdata('pesan') ?>',
                warna: 'orange'
            })
        <?php } else if ($this->session->userdata('berhasil') == 'tidak') { ?>
            toast({
                icon: 'fas fa-exclamation-triangle',
                headerText: 'Error',
                bodyText: '<?= $this->session->userdata('pesan') ?>',
                warna: 'red'
            })
        <?php }
        $this->session->unset_userdata(array('berhasil', 'pesan'));
        ?>
        const edit = (id) => {
            $.ajax({
                url: `http://localhost/laundry/index.php/editUserAdmin/${id}`,
                method: 'GET',
                dataType: 'JSON',
                success: (data) => {
                    for (var i = 0; i < data.length; i++) {
                        $('#id').val(data[i].id)
                        $('#edit_nama_user').val(data[i].nama)
                        $('#edit_username_user').val(data[i].username)
                        $('#edit_password_user').val(data[i].password)
                        $('#edit_id_outlet').val(data[i].id_outlet)
                        $('#edit_role_user').empty()
                        // $('#edit_role_user').val(data[i].role)
                        $('#edit_role_user').append(`
                            <option value="${data[i].role}">${data[i].role}</option>
                            <option value="admin">admin</option>
                            <option value="owner">owner</option>
                            <option value="kasir">kasir</option>
                        `)
                    }
                },
                error: (m) => {
                    alert('ada yang salah di controler nya')
                }
            })
        }
        $.ajax({
            url: 'http://localhost/laundry/index.php/dataAdmin',
            method: 'GET',
            dataType: 'JSON',
            success: data => {
                for (let i = 0; i < data.outlet.length; i++) {
                    $('#out').append(`<option value="${data.outlet[i].id}">${data.outlet[i].id} (${data.outlet[i].nama})</option>`)
                    $('#edit_id_outlet').append(`<option value="${data.outlet[i].id}">${data.outlet[i].id} (${data.outlet[i].nama})</option>`)
                }
            }
        })
    </script>
</body>

</html>