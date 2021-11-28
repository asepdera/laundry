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
    <link rel="stylesheet" href="<?= base_url() ?>assets/js/datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/js/chart/chart.min.css">
    <title>Laporan Pendapatan</title>
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
            <h2>Laporan Pendapatan</h2>
        </div>
        <div class="col-12 mt-2">
            <h4 class="text-center">Pilih periode waktu untuk lihat laporan</h4>
            <div class="card mt-3">
                <div class="card-body">
                    <div style="width:100%; overflow:auto">
                        <canvas id="bar" height="30px" width="100%"></canvas>
                    </div>
                    <h5 class="mt-3 text-center">Total omset keseluruhan</h5>
                    <h5 class="text-muted text-center" id="total"></h5>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body row">
                    <div class="col-12">
                        Pilih periode
                    </div>
                    <div class="col-md-3 mt-3">
                        <select name="" id="periode" class="form-control">
                            <option value="perhari">perhari</option>
                            <option value="perbulan">perbulan</option>
                        </select>
                    </div>
                    <div class="col-md-6 d-flex justify-content-space-around align-items-center mt-3">
                        <input type="text" class="form-control" id="dari" readonly>
                        <span class="mx-2">sampai</span>
                        <input type="text" class="form-control" id="sampai" readonly>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center align-items-center mt-3">
                        <button class="btn btn-primary mx-2 form-control" id="lihat">Lihat</button>
                        <a href="#" target="_blank" class="btn btn-primary mx-2 form-control" id="cetak">Cetak</a>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    rincian data transaksi laundry periode <span id="per"></span>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th>No</th>
                            <th style="text-align: center;">Hari/bulan</th>
                            <th style="text-align: center;">Pendapatan</th>
                        </tr>
                        <tbody id="detailPendapatan"></tbody>
                    </table>
                </div>
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
    <script src="<?php echo base_url() ?>assets/js/chart/Chart.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('#dari,#sampai').datepicker({
            format: 'yyyy-mm-dd'
        })
        const chart = new Chart($('#bar'), {
            type: 'bar'
        })
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
        let bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agutus', 'September', 'Oktober', 'November', 'Desember'];
        let hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
        let dataChart = [],
            pendapatan = [],
            dataBulan = [];
        $('#lihat').click(() => {
            $('#total').empty()
            $('#detailPendapatan').empty()
            $('#per').text('')
            $('#per').text(`${$('#dari').val().replace(/-/g,'/')} sampai ${$('#sampai').val().replace(/-/g,'/')}`)
            dataChart.splice(0, dataChart.length)
            dataBulan.splice(0, dataBulan.length)
            $.ajax({
                url: 'http://localhost/laundry/index.php/dataPendapatanAdmin',
                method: 'POST',
                data: {
                    dari: $('#dari').val(),
                    sampai: $('#sampai').val(),
                    periode: $('#periode').val()
                },
                dataType: 'JSON',
                success: data => {
                    console.log(data)
                    for (let i = 0; i < data.transaksi.length; i++) {
                        let tanggal = new Date(`${data.transaksi[i].tanggal}`)
                        let day = tanggal.getDay();
                        let month = tanggal.getMonth();
                        let pecah = data.transaksi[i].tanggal.split('-')
                        let periode = ''
                        dataChart.push(data.transaksi[i].pendapatan)
                        if (data.transaksi[i].tahun) {
                            dataBulan.push([bulan[data.transaksi[i].bulan - 1], data.transaksi[i].tahun])
                            periode = `${bulan[data.transaksi[i].bulan - 1]}, ${data.transaksi[i].tahun}`
                        } else {
                            dataBulan.push([hari[day], `${pecah[2]} - ${bulan[month]} - ${pecah[0]}`])
                            periode = `${hari[day]}, ${pecah[2]}/${bulan[month]}/${pecah[0]}`
                        }
                        pendapatan.push(parseInt(data.transaksi[i].pendapatan))
                        $('#detailPendapatan').append(`
                            <tr>
                                <td>${i + 1}</td>
                                <td style="text-align: center;">${periode}</td>
                                <td style="text-align: center;">${formatUang(data.transaksi[i].pendapatan)}</td>
                            </tr>
                        `)
                    }
                    const jumlah = pendapatan.reduce((a, b) => a + b, 0)
                    $('#total').append(`<span>${formatUang(`${jumlah}`,'Rp. ')}</span>`)
                    pendapatan.splice(0, pendapatan.length)
                    let tipe = (data.transaksi.length == 1) ? 'bar' : 'line'
                    chart.config = {
                        type: tipe,
                        data: {
                            labels: dataBulan,
                            datasets: [{
                                label: ['pendapatan'],
                                fill: false,
                                borderColor: randomWarna(),
                                backgroundColor: randomWarna(),
                                data: dataChart
                            }]
                        },
                    }
                    chart.options = {
                        responsive: true,
                        smooth: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    suggestedMin: 0,
                                    //biar label di kordinat y diubah ke format uang
                                    callback: (label) => {
                                        return formatUang(`${label}`)
                                    }
                                }
                            }]
                        },
                        tooltips: {
                            callbacks: {
                                label: (label) => {
                                    return label.xLabel + ': ' + formatUang(`${label.yLabel}`)
                                }
                            }
                        }
                    }
                    chart.update()
                }
            })
        })
        $('#cetak').click((e) => {
            const dari = $('#dari').val()
            const sampai = $('#sampai').val()
            const periode = $('#periode').val()
            if (dari == '' && sampai == '') {
                e.preventDefault()
            } else {
                window.location.href = `http://localhost/laundry/index.php/cetakLaporanPendapatanAdmin/${dari}/${sampai}/${periode}`
            }
        })
    </script>
</body>

</html>