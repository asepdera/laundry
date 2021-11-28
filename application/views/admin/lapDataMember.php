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
    <link rel="stylesheet" href="<?= base_url() ?>assets/js/datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/js/DataTables/datatables.min.css">
    <title>Laporan Data Member</title>
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
            <h2>Laporan Data Member</h2>
        </div>
        <div class="card">
            <div class="card-header">
                Pilih periode bergabung
            </div>
            <div class="card-body d-flex justify-content-space-around align-items-center">
                <input type="text" class="form-control" id="dari" readonly>
                <span class="mx-2">sampai</span>
                <input type="text" class="form-control" id="sampai" readonly>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary float-right" id="cetak">Cetak</button>
                <button class="btn btn-info float-right mr-2" id="cetakSemua">Cetak semua data member</button>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                Data Member
            </div>
            <div class="card-body">
                <table id="table" class="table table-striped table-hover">
                    <thead>
                        <th>No</th>
                        <th>Id member</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($member as $orang) { $no++
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $orang->id ?></td>
                                <td><?= $orang->nama ?></td>
                                <td><?= $orang->alamat ?></td>
                                <td><?= $orang->telp ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
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
    <script src="<?php echo base_url() ?>assets/js/datepicker/js/bootstrap-datepicker.min.js"></script>

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
        $('#dari,#sampai').datepicker({
            format: 'yyyy-mm-dd'
        })
        $('#cetakSemua').click(() => {
            window.location.href = 'http://localhost/laundry/index.php/cetakSemuaMember'
        })
        $('#cetak').click((e) => {
            let dari = $('#dari').val()
            let sampai = $('#sampai').val()
            if(dari == '' && sampai == ''){
                e.preventDefault()
            } else {
                window.location.href = `http://localhost/laundry/index.php/cetakMember/${dari}/${sampai}`
            }
        })
    </script>
</body>

</html>