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
    <title>Transaksi</title>
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

        .col-lg-9,
        .col-lg-3 {
            padding: 0 !important;
        }

        #p,
        #m {
            min-height: 472px;
        }
    </style>
</head>

<body>
    <main class="main-content">
        <div class="info">
            <h2>Transaksi</h2>
        </div>
        <form action="<?= site_url('masukanTransaksiAdmin') ?>" method="post" id="formTransaksi">
            <input type="hidden" value="<?= $this->session->userdata('id') ?>" name="user_id">
            <input type="hidden" value="<?= $this->session->userdata('id_outlet') ?>" name="id_outlet">
            <input type="hidden" name="kode_invoice">
            <input type="hidden" name="subtotal" id="Klop">
            <div class="row">
                <div class="col-lg-3 mt-3">
                    <div class="card" id="m" style="max-height: 500px">
                        <div class="card-header">
                            <button class="btn btn-primary btn-sm" type="button" data-target="#modal_member" data-toggle="modal">Cari member</button>
                        </div>
                        <div class="card-body" id="data-user">
                            <h5>Pilih data member</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 mt-3">
                    <div class="card" id="p" style="overflow: auto;max-height: 500px;">
                        <div class="card-header">
                            <button class="btn btn-primary btn-sm" id="btn-paket" type="button" data-target="#modal_paket" data-toggle="modal">Cari paket</button>
                            <div class="total float-right">
                                <h5 style="display: inline; margin: 0 !important;">Total: </h5>
                                <h5 style="display: inline; margin: 0 !important;" class="total">Rp. 0</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <label for="">Kode transaksi</label>
                                    <h6 id="kode-invoice"></h6>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="">Status</label>
                                    <input type="text" name="status" id="" class="form-control" value="baru" readonly>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="">Dibayar</label>
                                    <select name="dibayar" id="dibayar" class="form-control">
                                        <option value="belum_dibayar">belum dibayar</option>
                                        <option value="dibayar">dibayar</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <label for="">Batas Waktu</label>
                                    <input type="text" name="batas_waktu" id='batas-waktu' class="form-control">
                                </div>
                                <div class="col-12 mt-3">
                                    <table class="table table-hover text-center trans">
                                        <tr>
                                            <th>Kode paket</th>
                                            <th>Nama paket</th>
                                            <th>Jenis</th>
                                            <th>Keterangan</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                        <tbody id="data-transaksi"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3 p-3" style="background: #fff;">
                    <div class="mt-3">
                        <input type="text" class="form-control angka" placeholder="Subtotal" readonly>
                    </div>
                    <div class="mt-3">
                        <input type="text" name="pajak" class="form-control angka" placeholder="Pajak" autocomplete="off">
                    </div>
                    <div class="mt-3">
                        <input type="text" name="biaya_lain" class="form-control angka" placeholder="Biaya lain" autocomplete="off">
                    </div>
                    <div class="mt-3">
                        <input type="text" name="diskon" class="form-control angka" id="diskon" placeholder="Diskon" autocomplete="off">
                    </div>
                    <button type="submit" value="selesai" class="btn btn-primary mt-3" id="submit">Selesai</button>
                </div>
            </div>

        </form>
    </main>
    <footer>
        asep dera purnama <?= date('Y') ?>
    </footer>
    <div class="modal fade" id="modal_member" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <input type="text" class="form-control" id="cari-member" placeholder="Cari member">
                    <button data-dismiss="modal" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-group p-0">
                    <table class="table" style="cursor: pointer;">
                        <tr>
                            <th>Id member</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                        </tr>
                        <tbody id="isi-data-member"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_paket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <input type="text" class="form-control" id="cari-paket" placeholder="Cari paket">
                    <button data-dismiss="modal" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-group p-0">
                    <table class="table" style="cursor: pointer;">
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                        </tr>
                        <tbody id="isi-data-paket"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url() ?>assets/js/jquery.js"></script>
    <script src="<?= base_url() ?>assets/js/script.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url() ?>assets/js/component.js"></script>
    <script src="<?= base_url() ?>assets/js/moment1.js"></script>
    <script src="<?= base_url() ?>assets/js/datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        //pengaturan icon untuk datetimepicker.js
        $.extend(true, $.fn.datetimepicker.defaults, {
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-calendar-check',
                clear: 'far fa-trash-alt',
                close: 'far fa-times-circle'
            }
        });

        document.querySelectorAll('.angka').forEach(v => {
            v.addEventListener('keyup', e => {
                const nilai = e.target.value.replace(/[^\d]/g, '')
                e.target.value = formatUang(nilai)
            })
        })
        $('#batas-waktu').datetimepicker({
            format: 'YYYY-MM-DD H:m'
        })
        const kode = `<?= date('Ymd') ?>${randomInt(4)}`
        $('#kode-invoice').text(`${kode}`)
        $('input[name="kode_invoice"]').val(`${kode}`)
        $('#btn-paket').attr('disabled', true)
        $('#submit').attr('disabled', true)
        setInterval(() => {
            $('#p').height(`${$('#m').height()}`)
        }, 500)
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
        $.ajax({
            url: 'http://localhost/laundry/index.php/ambilDataMemberAdmin',
            method: 'GET',
            dataType: 'JSON',
            success: data => {
                for (let i = 0; i < data.length; i++) {
                    $('#isi-data-member').append(`
                            <tr onclick="dapetinDataMember('${data[i].id}')" data-dismiss="modal">
                                <td>${data[i].id}</td>
                                <td>${data[i].nama}</td>
                                <td>${data[i].telp}</td>
                            </tr>
                        `)
                }
            }
        })
        $.ajax({
            url: `http://localhost/laundry/index.php/dataAdmin?id_outlet=<?= $this->session->userdata('id_outlet') ?>`,
            method: 'GET',
            dataType: 'JSON',
            success: data => {
                for (let i = 0; i < data.paket.length; i++) {
                    $('#isi-data-paket').append(`
                            <tr onclick="dapetinDataPaket('${data.paket[i].id}')" data-dismiss="modal">
                                <td>${data.paket[i].id}</td>
                                <td>${data.paket[i].nama_paket}</td>
                                <td>${data.paket[i].jenis}</td>
                                <td>${formatUang(data.paket[i].harga,'Rp. ')}</td>
                            </tr>
                        `)
                }
            }
        })
        $('#cari-member').keyup(e => {
            $('#isi-data-member').empty()
            if (e.target.value == '') {
                $.ajax({
                    url: 'http://localhost/laundry/index.php/ambilDataMemberAdmin',
                    method: 'GET',
                    dataType: 'JSON',
                    success: data => {
                        for (let i = 0; i < data.length; i++) {
                            $('#isi-data-member').append(`
                                    <tr onclick="dapetinDataMember('${data[i].id}')" data-dismiss="modal">
                                        <td>${data[i].id}</td>
                                        <td>${data[i].nama}</td>
                                        <td>${data[i].telp}</td>
                                    </tr>
                                `)
                        }
                    }
                })
            } else {
                $.ajax({
                    url: `http://localhost/laundry/index.php/cariDataMemberAdmin/${e.target.value}`,
                    method: 'GET',
                    dataType: 'JSON',
                    success: data => {
                        for (let i = 0; i < data.length; i++) {
                            $('#isi-data-member').append(`
                                    <tr onclick="dapetinDataMember('${data[i].id}')" data-dismiss="modal">
                                        <td>${data[i].id}</td>
                                        <td>${data[i].nama}</td>
                                        <td>${data[i].telp}</td>
                                    </tr>
                                `)
                        }
                    }
                })
            }
        })
        $('#cari-paket').keyup(e => {
            $('#submit').attr('disabled', false)
            $('#isi-data-paket').empty()
            if (e.target.value == '') {
                $.ajax({
                    url: `http://localhost/laundry/index.php/dataAdmin?id_outlet=<?= $this->session->userdata('id_outlet') ?>`,
                    method: 'GET',
                    dataType: 'JSON',
                    success: data => {
                        for (let i = 0; i < data.paket.length; i++) {
                            $('#isi-data-paket').append(`
                            <tr onclick="dapetinDataPaket('${data.paket[i].id}')" data-dismiss="modal">
                                <td>${data.paket[i].id}</td>
                                <td>${data.paket[i].nama_paket}</td>
                                <td>${data.paket[i].jenis}</td>
                                <td>${formatUang(data.paket[i].harga,'Rp. ')}</td>
                            </tr>
                        `)
                        }
                    }
                })
            } else {
                $.ajax({
                    url: `http://localhost/laundry/index.php/cariDataPaketAdmin/${e.target.value}/${'<?= $this->session->userdata('id_outlet') ?>'}`,
                    method: 'GET',
                    dataType: 'JSON',
                    success: data => {
                        for (let i = 0; i < data.length; i++) {
                            $('#isi-data-paket').append(`
                                <tr onclick="dapetinDataPaket('${data[i].id}')" data-dismiss="modal">
                                    <td>${data[i].id}</td>
                                    <td>${data[i].nama_paket}</td>
                                    <td>${data[i].jenis}</td>
                                    <td>${formatUang(data[i].harga,'Rp. ')}</td>
                                </tr>
                            `)
                        }
                    }
                })
            }
        })
        const dapetinDataMember = id => {
            $('#data-user').empty()
            $.ajax({
                url: `http://localhost/laundry/index.php/editMemberAdmin/${id}`,
                method: 'GET',
                dataType: 'JSON',
                success: data => {
                    for (let i = 0; i < data.length; i++) {
                        $('#btn-paket').attr('disabled', false)
                        $('#data-user').append(`
                            <input type="hidden" name="id_member" id="isiMember" value="${data[i].id}">
                            <div class="info-pengguna">
                                <div class="d-flex justify-content-center">
                                    <div class="icon">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                <div class="data-pengguna">
                                    <div class="m-3">
                                        <h6>ID Member</h6>
                                        <span>${data[i].id}</span>
                                    </div>
                                    <div class="m-3">
                                        <h6>Nama</h6>
                                        <span>${data[i].nama}</span>
                                    </div>
                                    <div class="m-3">
                                        <h6>Telepon</h6>
                                        <span>${data[i].telp}</span>
                                    </div>
                                    <div class="m-3">
                                        <h6>Alamat</h6>
                                        <span>${data[i].alamat}</span>
                                    </div>
                                </div>
                            </div>
                        `)
                    }
                    if ($('[name="batas_waktu"]').val() != '') {
                        $('#submit').attr('disabled', false)
                    }
                }
            })
        }
        let total, jumlah;
        let arrayKosong = [];
        const dapetinDataPaket = id => {
            $.ajax({
                url: `http://localhost/laundry/index.php/dataAdmin?id=${id}`,
                method: 'GET',
                dataType: 'JSON',
                success: data => {
                    for (let i = 0; i < data.paketTransaksi.length; i++) {
                        let id_subtot = randomChar(4)
                        let id_jum = randomChar(4)
                        let id_kurang = randomChar(4)
                        //kondisi jika id paket udah dipilih maka tambahin aja jumlahnya jangan ditambah dikeranjang
                        if ($(`#${id}`).length > 0) {
                            $(`.${id}`).click()
                            $('#modal_paket').modal('hide')
                        } else {
                            $('#data-transaksi').append(`
                            <tr>
                                <td><input class="form-control id-paket" type="hidden" value="${data.paketTransaksi[i].id}" name="id_paket[]">${data.paketTransaksi[i].id}</td>
                                <td>${data.paketTransaksi[i].nama_paket}</td>
                                <td>${data.paketTransaksi[i].jenis}</td>
                                <td><input name="keterangan[]" class="form-control" type="text"></td>
                                <td><input name="harga[]" value="${data.paketTransaksi[i].harga}" type="hidden" class="form-control">${formatUang(data.paketTransaksi[i].harga)}</td>
                                <td class="jum" width="160px">
                                    <span class="fas fa-minus" id="${id_kurang}" onclick="berkurang(${data.paketTransaksi[i].harga}, ${id}, ${id_subtot},this)"></span>
                                    <input name="qty[]" class="form-control qty" value="1" readonly type="text" id="${id}">
                                    <span class="fas fa-plus ${id}" onclick="bertambah(${data.paketTransaksi[i].harga}, ${id}, ${id_subtot},${id_kurang})"></span>
                                </td>
                                <td width="123px" class="sub"><input class="form-control subtotal" id="${id_subtot}" value="${formatUang(data.paketTransaksi[i].harga)}" disabled></td>
                                <td style="display: flex; justify-content= center; align-items: center; cursor: pointer" class="tutup-item" onclick="hapusItem(this.id,${id_subtot})" id="${randomChar(4)}"><span class="fas fa-times" style="color : red;"></span></td>
                            </tr>
                        `)
                            const harga = parseInt(data.paketTransaksi[i].harga)
                            //masukan harga paket ke array setiap pilih paket
                            arrayKosong.push(harga)
                            //lalu jumlahkan semua element yang ada di array
                            total = arrayKosong.reduce((a, b) => a + b, 0)
                            //tampilkan total
                            $('.total').text(`Total : ${formatUang(`${total}`)}`)
                            $('[placeholder="Subtotal"]').val(`${formatUang(`${total}`)}`)
                            $('#Klop').val(`${total}`)
                        }
                    }
                }
            })
        }
        const tampilTotal = total => {
            $('.total').text(`Total : ${formatUang(`${total}`)}`)
            $('[placeholder="Subtotal"]').val(`${formatUang(`${total}`)}`)
            $('#Klop').val(`${total}`)
        }
        //aksi button tambah
        const bertambah = (h, e, i, ik) => {
            //jadikan nilai dari input qty integer
            let nilai = parseInt(e.value)
            //increment
            nilai++
            e.value = nilai
            //harga * qty
            jumlah = h * nilai
            const valSub = document.querySelector(`#${i.id}`).value.replace(/[^\d]/g, '')
            const keInt = parseInt(jumlah)
            total += parseInt(h)
            //buat dapetin index dari element array sesuai subtotal
            const index = arrayKosong.indexOf(parseInt(valSub))
            //jika element tidak ada maka masukan element kedalam array
            //tapi kalau udah ada ya.... tinggal ubah aja sesuai subtotal
            if (index === -1) {
                arrayKosong.push(keInt)
            } else {
                arrayKosong[index] = keInt
            }
            //tampilkan total
            tampilTotal(total)
            $(`#${i.id}`).val(formatUang(`${keInt}`))
            //tambah attribute onclick ke button kurang karena jika nilai qty 0 maka attribute onclick akan dihapus dari btn kurang
            //tapi saat btn tambah ditekan tambahkan lagi attribute onclick nya
            $(`#${ik.id}`).attr('onclick', `berkurang(${h}, ${e.id}, ${i.id},this)`)
        }
        //aksi button kurang
        const berkurang = (h, e, i, t) => {
            //decrement qty
            e.value -= 1
            //hilangkan dulu karakter selain angka di input
            const valSub = document.querySelector(`#${i.id}`).value.replace(/[^\d]/g, '')
            //kondisi jika nilai dari qty 0,decrement akan terhenti di angka 0
            if (e.value == 0) {
                e.value = 0
                jumlah = h * parseInt(e.value)
                total -= parseInt(h)
                //jika nilai 0,hapus element yang ada di array agar tidak ikut dijumlahkan saat menambah paket baru
                //seperti biasa dihapus sesuai subtotal
                for (let i = 0; i < arrayKosong.length; i++) {
                    if (arrayKosong[i] == valSub) {
                        arrayKosong.splice(i, 1)
                    }
                }
                //tampilkan total
                tampilTotal(total)
                $(`#${i.id}`).val(formatUang(`0`))
                //agar setelah nilai qty 0 tombol kurang tidak bisa dipencet lagi
                $(t).removeAttr('onclick')
            } else {
                jumlah = h * parseInt(e.value)
                total -= parseInt(h)
                const keInt = parseInt(jumlah)
                //mengubah nilai dari element array berdasarkan value
                const index = arrayKosong.indexOf(parseInt(valSub))
                //ganti element dengan total terbaru
                if (index !== -1) {
                    arrayKosong[index] = keInt
                }
                //lalu hapus element array yang lama
                for (let i = 0; i < arrayKosong.length; i++) {
                    if (arrayKosong[i] == valSub) {
                        arrayKosong.splice(i, 1)
                    }
                }
                //tampilkan total
                tampilTotal(total)
                $(`#${i.id}`).val(formatUang(`${keInt}`))
            }
        }
        const hapusItem = (e, i) => {
            const subtot = document.querySelector(`#${i.id}`)
            const subtotValue = subtot.value.replace(/[^\d]/g, '')
            const keInt = parseInt(subtotValue)
            //hapus tag tr dari table body
            document.querySelector('#data-transaksi').removeChild(document.querySelector(`#${e}`).parentNode)
            //setelah tag terhapus kurangi total dengan subtotal
            total -= keInt
            //hapus juga element yang ada di array sesuai subtotal
            for (let i = 0; i < arrayKosong.length; i++) {
                if (arrayKosong[i] == subtotValue) {
                    arrayKosong.splice(i, 1)
                }
            }
            //jika element di tabel kosong alias habis hapus semua data yang ada di array
            if (document.querySelectorAll('#data-transaksi tr').length == 0) {
                arrayKosong.length = 0
            }
            //tampilkan total
            tampilTotal(total)
        }
        //oh iya hampir lupa diskon nggak boleh lebih dari 20% total
        //kan nanti kalo ada diskon lebih dari atau sama dengan total kan gak lucu
        $('#diskon').keyup(e => {
            const dis = e.target.value.replace(/[^\d]/g, '')
            const diskon = parseInt(dis)
            // console.log(dis)
            if (diskon > total / 5) {
                $('#diskon').val(formatUang(`${total / 5}`))
                alert('diskon maksimal 20% dari total laundry')
            }
        })
        //saat batas waktu focus maka btn submit bisa ditekan
        $('[name="batas_waktu"]').focus(e => {
            if (document.querySelector('#isiMember')) {
                $('#submit').attr('disabled', false)
            }
        })
    </script>
</body>

</html>