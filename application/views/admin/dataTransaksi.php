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
    <link rel="stylesheet" href="<?= base_url() ?>assets/js/datetimepicker/build/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/js/DataTables/datatables.min.css">
    <title>Data transaksi</title>
    <style>
        body {
            position: relative;
        }

        footer {
            position: relative;
            margin-bottom: 0;
            width: 100%;
            text-align: center;
            padding: 15px;
            background: #fff;
        }

        tr:hover {
            background: #aaa;
        }

        #cari-transaksi {
            padding: 3px;
        }

        .card {
            overflow: auto;
        }

        input[type="checkbox"] {
            cursor: pointer;
        }

        .dibawah {
            position: absolute;
            bottom: 0;
        }
    </style>
</head>

<body>
    <main class="main-content">
        <div class="info">
            <h2>Data transaksi</h2>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="mr-2">data transaksi</span>
                </div>
                <div class="card-body">
                    <table id="table" class="display table table-hover table-striped text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kode invoice</th>
                                <th>nama member</th>
                                <th>total bayar</th>
                                <th>baru</th>
                                <th>proses</th>
                                <th>selesai</th>
                                <th>dibayar</th>
                                <th>diambil</th>
                                <th>cetak</th>
                            </tr>
                        </thead>
                        <tbody id="data-transaksi">
                            <?php
                            $no = -1;
                            foreach ($nama_member as $name) {
                                $nama[] = $name->nama;
                            }
                            foreach ($transaksi as $trans) :
                                $no++;
                                $kode_selesai = 'selesai' . $no . '';
                                $kode_diambil = 'diambil' . $no . '';
                                $kode_print = 'print' . $no . '';
                                $kode_dibayar = 'dibayar' . $no . '';
                            ?>
                                <tr>
                                    <td><?= $trans->kode_invoice ?></td>
                                    <td><?= $nama[$no] ?></td>
                                    <td class="total"> <?= number_format($trans->total,0,'.',',') ?> </td>
                                    <td width="40px">
                                        <input type="checkbox" name="" id="" class="form-control" disabled checked>
                                    </td>
                                    <td width="40px">
                                        <input type="checkbox" name="proses" id="<?= $no ?>" onclick="centang(`${<?= $trans->kode_invoice ?>}`,this,'<?= $kode_selesai ?>','<?= $kode_diambil ?>','<?= $kode_print ?>')" data-kode="proses" <?php if ($trans->status == 'proses' || $trans->status == 'selesai' || $trans->status == 'diambil') echo 'checked' ?>>
                                    </td>
                                    <td width="40px">
                                        <input type="checkbox" name="selesai" id="<?= $kode_selesai ?>" onclick="centang('<?= $trans->kode_invoice ?>',this,'<?= $kode_selesai ?>','<?= $kode_diambil ?>','<?= $kode_print ?>')" data-kode="selesai" <?php if ($trans->status == 'selesai' || $trans->status == 'diambil') echo 'checked ';
                                                                                                                                                                                                                                                        else if ($trans->status == 'proses');
                                                                                                                                                                                                                                                        else echo 'disabled' ?>>
                                    </td>
                                    <td width="40px">
                                        <input type="checkbox" name="dibayar" id="<?= $kode_dibayar ?>" onclick="dibayar(this,'<?= $kode_diambil ?>','<?= $trans->kode_invoice ?>','<?= $kode_print ?>')" data-kode="dibayar" <?php if ($trans->dibayar == 'dibayar') echo 'checked' ?>>
                                    </td>
                                    <td width="40px">
                                        <input type="checkbox" name="diambil" id="<?= $kode_diambil ?>" onclick="centang('<?= $trans->kode_invoice ?>',this,'<?= $kode_selesai ?>','<?= $kode_diambil ?>','<?= $kode_print ?>')" data-kode="diambil" <?php if ($trans->dibayar == 'belum_dibayar') echo 'disabled ';
                                                                                                                                                                                                                                                        if ($trans->status == 'diambil') echo 'checked' ?>>
                                    </td>
                                    <td>
                                        <!-- <button class="btn btn-info btn-sm" onclick="tampilData(`${data.transaksi[i].kode_invoice}`)" data-toggle="modal" data-target="#modal_status"><span class="fas fa-pen"></span></button> -->
                                        <button class="btn btn-primary btn-sm" onclick="cetakStruk('<?= $trans->kode_invoice ?>')" id="<?= $kode_print ?>" <?php if ($trans->status != 'diambil') echo 'disabled ' ?>><span class="fas fa-print"></span></button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer>
        asep dera purnama <?= date('Y') ?>
    </footer>
    <script src="<?= base_url() ?>assets/js/jquery.js"></script>
    <script src="<?= base_url() ?>assets/js/script.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url() ?>assets/js/component.js"></script>
    <script src="<?= base_url() ?>assets/js/moment1.js"></script>
    <script src="<?= base_url() ?>assets/js/datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/DataTables/datatables.min.js"></script>
    <script>
        // setInterval(() => {}, 500)
        const centang = (kode, t, s, d, p) => {
            if (t.dataset.kode == 'proses') {
                if ($(t).is(':checked')) {
                    $.ajax({
                        url: `http://localhost/laundry/index.php/ubahStatusAdmin?kode=${kode}&status=proses`,
                        method: 'GET',
                        success: () => {}
                    })
                    $(`#${s}`).attr('disabled', false)
                } else {
                    $.ajax({
                        url: `http://localhost/laundry/index.php/ubahStatusAdmin?kode=${kode}&status=baru`,
                        method: 'GET',
                        success: () => {}
                    })
                    $(`#${s}`).attr('disabled', true).removeAttr('checked')
                }
            } else if (t.dataset.kode == 'selesai') {
                if ($(t).is(':checked')) {
                    $.ajax({
                        url: `http://localhost/laundry/index.php/ubahStatusAdmin?kode=${kode}&status=selesai`,
                        method: 'GET',
                        success: () => {}
                    })
                } else {
                    $.ajax({
                        url: `http://localhost/laundry/index.php/ubahStatusAdmin?kode=${kode}&status=proses`,
                        method: 'GET',
                        success: () => {}
                    })
                    $(`#${d}`).attr('disabled', true).removeAttr('checked')
                }
            } else if (t.dataset.kode == 'diambil') {
                if ($(t).is(':checked')) {
                    $.ajax({
                        url: `http://localhost/laundry/index.php/ubahStatusAdmin?kode=${kode}&status=diambil`,
                        method: 'GET',
                        success: () => {}
                    })
                    $(`#${p}`).attr('disabled', false)
                } else {
                    $.ajax({
                        url: `http://localhost/laundry/index.php/ubahStatusAdmin?kode=${kode}&status=selesai`,
                        method: 'GET',
                        success: () => {}
                    })
                    $(`#${p}`).attr('disabled', true)
                }
            }
        }
        const dibayar = (t, d, kode, p) => {
            if ($(t).is(':checked')) {
                $.ajax({
                    url: `http://localhost/laundry/index.php/udahDibayarAdmin?kode=${kode}&status=dibayar`,
                    method: 'GET',
                    success: () => {}
                })
                $(`#${d}`).attr('disabled', false)
            } else {
                $.ajax({
                    url: `http://localhost/laundry/index.php/udahDibayarAdmin?kode=${kode}&status=belum_dibayar`,
                    method: 'GET',
                    success: () => {}
                })
                $(`#${d}`).attr('disabled', true).removeAttr('checked')
                $(`#${p}`).attr('disabled', true)
            }
        }
        $('#table').DataTable({
            columnDefs: [{
                targets: [1, 2, 3, 4, 5, 6, 7, 8],
                searchable: false
            }],
            sort: false,
            language: {
                infoFiltered: 'dari _MAX_ data',
                infoEmpty: 'tidak ada data yang bisa ditampilkan',
                sInfo: "Menunjukan _END_ sampai _TOTAL_"
            }
        })
        $('input[type="search"]').keyup(() => {
            if ($('#data-transaksi tr').length < 3) {
                $('footer').addClass('dibawah')
            } else {
                $('footer').removeClass('dibawah')
            }
        })
        const cetakStruk = kodeInvoice => {
            window.location.href = `http://localhost/laundry/index.php/cetakStruk/${kodeInvoice}`
        }
        <?php if (count($transaksi) < 4) {
        ?>
            $('footer').css({
                'position': 'absolute',
                'bottom': '0'
            })
        <?php
        } else { ?>
            $('footer').css({
                'position': 'relative',
                'bottom': '0'
            })
        <?php } ?>
    </script>
</body>

</html>