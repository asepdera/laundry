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
    <title>Laporan Data Outlet</title>
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
            <h2>Laporan Data Outlet</h2>
        </div>
        <div class="card">
            <div class="card-header">
                Data Outlet
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Outlet</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($outlet as $ot) : $no++ ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $ot->nama ?></td>
                                <td><?= $ot->alamat ?></td>
                                <td><?= $ot->tlp ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary float-right" id="cetak">Cetak</button>
            </div>
        </div>
    </main>
    <footer>
        asep dera purnama <?= date('Y') ?>
    </footer>
    <script src="<?= base_url() ?>assets/js/jquery.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url() ?>assets/js/script.js"></script>
    <script src="<?= base_url() ?>assets/js/component.js"></script>
    <script src="<?php echo base_url() ?>assets/js/DataTables/datatables.min.js"></script>
    <script>
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
        $('#cetak').click(()=>{
            window.location.href = 'http://localhost/laundry/index.php/cetakLaporanOutlet'
        })
        if (window.innerHeight > 657) {
                $('footer').css({
                    'position': 'absolute',
                    'bottom': '0'
                })
            } else {
                $('footer').css({
                    'position': 'realtive',
                    // 'bottom': '0'
                })
            }
    </script>
</body>

</html>