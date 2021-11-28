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
    <title>Beranda admin</title>
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
            <h2>Selamat Datang di Menu Utama Aplikasi Laundrie</h2>
        </div>
        <div class="grid">
            <div class="grid-item">
                <div class="content">
                    <h4 id="member"></h4>
                    <span>Member</span>
                </div>
                <div class="icon">
                    <span class="fas fa-users"></span>
                </div>
            </div>
            <div class="grid-item">
                <div class="content">
                    <h4 id="user"></h4>
                    <span>User</span>
                </div>
                <div class="icon">
                    <span class="fas fa-user-tie"></span>
                </div>
            </div>
            <div class="grid-item">
                <div class="content">
                    <h4 id="a"></h4>
                    <span>Pendapatan Hari ini</span>
                </div>
                <div class="icon">
                    <span class="fas fa-money-bill"></span>
                </div>
            </div>
            <div class="grid-item">
                <div class="content">
                    <h4 id="trans"></h4>
                    <span>Transaksi Hari Ini</span>
                </div>
                <div class="icon">
                    <span class="fas fa-receipt"></span>
                </div>
            </div>
        </div>
        <div class="data">
            <div class="member-baru">
                <div class="judul">
                    <h5>Member baru</h5>
                    <a href="<?= site_url('memberAdmin') ?>" class="btn btn-primary btn-sm">Lihat semua <span class="fas fa-arrow-right"></span></a>
                </div>
                <div class="content" id="mbaru">
                    <div class="data-member">
                        <div class="icon">
                            <span class="fas fa-user"></span>
                        </div>
                        <div class="isi">
                            <span>Nama</span>
                            <small>Alamat</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="data-user-baru">
                <div class="judul">
                    <h5>User baru</h5>
                    <a href="<?= site_url('userAdmin') ?>" class="btn btn-primary btn-sm">Lihat semua <span class="fas fa-arrow-right"></span></a>
                </div>
                <div class="content" id="ubaru">
                    <div class="data-user">
                        <div class="icon">
                            <span class="fas fa-user-tie"></span>
                        </div>
                        <div class="isi">
                            <span>Nama</span>
                            <small>Role</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        asep dera purnama <?= date('Y') ?>
    </footer>
    <script src="<?= base_url() ?>assets/js/jquery.js"></script>
    <script src="<?= base_url() ?>assets/js/script.js"></script>
    <script>
        document.getElementById('a').textContent = formatUang('0', 'Rp. ')
        let pendapatan = [],
            pendHariIni
        <?php foreach ($pendapatan as $item) : ?>
            pendapatan.push(<?= $item->total ?>)
            pendHariIni = pendapatan.reduce((a, b) => a + b, 0)
            $('#a').text(`${formatUang(`${pendHariIni}`,'Rp. ')}`)
        <?php endforeach; ?>
        setInterval(() => {
            $.ajax({
                url: 'http://localhost/laundry/index.php/ambilDataMemberBaru',
                method: 'GET',
                dataType: 'JSON',
                success: (data) => {
                    $('#mbaru').empty()
                    for (let i = 0; i < data.length; i++) {
                        $('#mbaru').append(`
                            <div class="data-member">
                                <div class="icon">
                                    <span class="fas fa-user"></span>
                                </div>
                                <div class="isi text-capitalize">
                                    <span>${data[i].nama}</span>
                                    <small>${data[i].alamat}</small>
                                </div>
                            </div>
                        `)
                    }
                }
            })
            $.ajax({
                url: 'http://localhost/laundry/index.php/dataAdmin',
                method: 'GET',
                dataType: 'JSON',
                success: (data) => {
                    $('#ubaru').empty()
                    $('#user').text(data.pekerja)
                    $('#member').text(data.member)
                    $('#trans').text(data.transaksi)
                    for (let i = 0; i < data.userBaru.length; i++) {
                        $('#ubaru').append(`
                            <div class="data-user">
                                <div class="icon">
                                    <span class="fas fa-user-tie"></span>
                                </div>
                                <div class="isi">
                                    <span>${data.userBaru[i].nama}</span>
                                    <small>${data.userBaru[i].role}</small>
                                </div>
                            </div>
                        `)
                    }
                }
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
        }, 500)

        console.log(window.innerHeight)
    </script>
</body>

</html>