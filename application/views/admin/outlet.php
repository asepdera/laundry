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
    <title>Data outlet</title>
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
            <h2>Data Outlet</h2>
        </div>
        <form action="<?= site_url('tambahOutletAdmin') ?>" method="post">
            <div class="card" data-menu-hover="satu">
                <div class="card-header">
                    Tambah Data Outlet
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" id="i">
                    <div class="mt-3">
                        <label for="">Nama Outlet:</label>
                        <input type="text" name="namaOutlet" class="form-control" autocomplete="off"></input>
                    </div>
                    <div class="mt-3">
                        <label for="">Alamat Lengkap Outlet:</label>
                        <input type="text" name="alamatOutlet" class="form-control" autocomplete="off"></input>
                    </div>
                    <div class="mt-3">
                        <label for="">Telepon Outlet:</label>
                        <input type="number" name="teleponOutlet" class="form-control telp" id="angka" required></input>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="Tambah" class="btn btn-primary mr-3 float-right">
                </div>
            </div>
        </form>
        <div class="card mt-4">
            <div class="card-header">
                Data outlet
            </div>
            <div class="card-body">
                <table id="table" class="display table table-hover table-striped text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($outlet as $item) : $no++; ?>

                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $item->nama ?></td>
                                <td><?= $item->alamat ?></td>
                                <td><?= $item->tlp ?></td>
                                <td>
                                    <button class="btn btn-info mr-1" data-target="#edit_modal" data-toggle="modal" onclick="edit('<?= $item->id ?>')">
                                        <span class="fas fa-pen-square"></span>
                                    </button>
                                    <a href="<?php echo site_url("hapusOutletAdmin/$item->id") ?>" class="btn btn-danger hapus" onclick="return confirm('anda yakin akan menghapus data ini? data yang telah dihapus tidak akan bisa dikembalikan!')">
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
                <form action="<?php echo site_url('aksiEditOutletAdmin') ?>" method="post" id="form-edit">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit data outlet</h5>
                        <button data-dismiss="modal" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group">
                        <input type="hidden" name="id" id="id">
                        <div class="mt-3">
                            <label>Nama Outlet:</label>
                            <input type="text" name="namaOutlet" class="form-control" id="edit_nama_outlet">
                        </div>
                        <div class="mt-3">
                            <label>Alamat Lengkap Outlet:</label>
                            <input type="text" name="alamatOutlet" class="form-control" id="edit_alamat_outlet">
                        </div>
                        <div class="mt-3">
                            <label>Telepon Outlet:</label>
                            <input type="number" name="teleponOutlet" class="form-control telp" id="edit_telepon_outlet">
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
        $('.telp').keyup(e => {
        // e.target.value = e.target.value.replace(/[a-z,A-Z]/,'')
        // console.log(e)
        if(e.target.value.length > 13){
            alert('no telepon jangan lebih dari 13 nomor')
            $('.telp').val(e.target.value)
        }
     })
        $('#i').val(`OT${randomInt(9)}`)
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
                url: `http://localhost/laundry/index.php/editOutletAdmin/${id}`,
                method: 'GET',
                dataType: 'JSON',
                success: (data) => {
                    for (var i = 0; i < data.length; i++) {
                        $('#id').val(data[i].id)
                        $('#edit_nama_outlet').val(data[i].nama)
                        $('#edit_alamat_outlet').val(data[i].alamat)
                        $('#edit_telepon_outlet').val(data[i].tlp)
                    }
                },
                error: (m) => {
                    alert('ada yang salah di controler nya')
                }
            })
        }
    </script>
</body>

</html>