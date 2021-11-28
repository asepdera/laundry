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
        footer {
            position: relative;
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
                                <th>Aksi</th>
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
                                    <td data-total="<?= $trans->total ?>" class="total"></td>
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
    <div class="modal fade" id="modal_status" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    Data Transaksi
                    <button data-dismiss="modal" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-group">
                    <div>
                        <label for="">Kode invoice:</label>
                        <label for="" class="form-control" id="kode-invoice">blblb</label>
                    </div>
                    <div class="mt-3">
                        <label for="">Nama member:</label>
                        <label for="" class="form-control" id="nama-member">vxcvxcvxcv</label>
                    </div>
                    <div class="mt-3">
                        <label for="">Total:</label>
                        <label for="" class="form-control" id="total">vxcvxcvxcv</label>
                    </div>
                    <div class="mt-3">
                        <label for="">Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="baru">baru</option>
                            <option value="proses">proses</option>
                            <option value="selesai">selesai</option>
                            <option value="diambil">diambil</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="">Dibayar:</label>
                        <select name="dibayar" id="dibayar" class="form-control" onchange="">
                            <option value="belum_dibayar">belum dibayar</option>
                            <option value="dibayar">dibayar</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        url: `http://localhost/laundry/index.php/ubahStatusKasir?kode=${kode}&status=proses`,
                        method: 'GET',
                        success: () => {}
                    })
                    $(`#${s}`).attr('disabled', false)
                } else {
                    $.ajax({
                        url: `http://localhost/laundry/index.php/ubahStatusKasir?kode=${kode}&status=baru`,
                        method: 'GET',
                        success: () => {}
                    })
                    $(`#${s}`).attr('disabled', true).removeAttr('checked')
                }
            } else if (t.dataset.kode == 'selesai') {
                if ($(t).is(':checked')) {
                    $.ajax({
                        url: `http://localhost/laundry/index.php/ubahStatusKasir?kode=${kode}&status=selesai`,
                        method: 'GET',
                        success: () => {}
                    })
                } else {
                    $.ajax({
                        url: `http://localhost/laundry/index.php/ubahStatusKasir?kode=${kode}&status=proses`,
                        method: 'GET',
                        success: () => {}
                    })
                    $(`#${d}`).attr('disabled', true).removeAttr('checked')
                }
            } else {
                if ($(t).is(':checked')) {
                    $.ajax({
                        url: `http://localhost/laundry/index.php/ubahStatusKasir?kode=${kode}&status=diambil`,
                        method: 'GET',
                        success: () => {}
                    })
                    $(`#${p}`).attr('disabled', false)
                } else {
                    $.ajax({
                        url: `http://localhost/laundry/index.php/ubahStatusKasir?kode=${kode}&status=selesai`,
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
                    url: `http://localhost/laundry/index.php/udahDibayarKasir?kode=${kode}&status=dibayar`,
                    method: 'GET',
                    success: () => {}
                })
                $(`#${d}`).attr('disabled', false)
            } else {
                $.ajax({
                    url: `http://localhost/laundry/index.php/udahDibayarKasir?kode=${kode}&status=belum_dibayar`,
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
        document.querySelectorAll('.total').forEach(v => {
            v.textContent = formatUang(`${v.dataset.total}`)
        })
        const cetakStruk = kodeInvoice => {
            window.location.href = `http://localhost/laundry/index.php/cetakStruk/${kodeInvoice}`
        }
    </script>
</body>

</html>