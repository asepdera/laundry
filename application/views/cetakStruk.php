<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk kasir</title>
    <style>
        h4,
        h5 {
            text-align: center;
            margin: 0;
            text-transform: uppercase;
        }

        p {
            text-align: center;
            margin: 5px 0;
        }

        .selesai p:nth-child(2) span {
            font-size: 14px;
        }

        @page {
            margin: 10px 40px;
            height: fit-content !important;
        }

        li {
            margin: 4px 0;
        }
    </style>
</head>

<body>
    <div class="head" style="border-bottom: 3px dashed #000; padding: 10px 0;">
        <h4 class="atas">Loundrie</h4>
        <h5 style="margin: 5px 0;">
            <?php
            $tanggal = $transaksi[0]->tgl;
            $tanggal = preg_replace('/[-]/', '/', $tanggal);
            $outlet = $this->db->select('nama,alamat,tlp')->from('tb_outlet')->where(array('id' => $this->session->userdata('id_outlet')))->get()->result();
            foreach ($outlet as $ot) :
                echo $ot->nama;
            ?>
        </h5>
        <h5 style="line-height: 17px;"><span><?= $ot->alamat ?> </span><span> <?= $ot->tlp ?></span></h5>
    <?php endforeach ?>
    </div>
    <div class="selesai" style="padding: 10px 0; border-bottom: 3px dashed #000;">
        <p>Selesai:</p>
        <h5><?= $transaksi[0]->batas_waktu ?></h5>
        <p><span><?= $transaksi[0]->kode_invoice ?> </span><span><?= $tanggal ?></span></p>
        <p style="text-transform: uppercase;">
            <?php
            $id_member = $transaksi[0]->id_member;
            $kode_invoice = $transaksi[0]->kode_invoice;
            $nama = $this->db->query("select tb_member.nama,tb_member.alamat,tb_member.telp from tb_member join tb_transaksi on tb_transaksi.id_member = tb_member.id and id_member='$id_member'")->result();
            echo $nama[0]->nama;
            ?>
        </p>
        <p>
            <span><?= $nama[0]->alamat ?> </span> <span><?= $nama[0]->telp ?></span>
        </p>
    </div>
    <div class="item" style="padding: 10px 0; border-bottom: 3px dashed #000;">
        <?php for ($i = 0; $i < count($detail); $i++) {
        ?>
            <p style="text-align: left; text-transform: capitalize;"><?= $nama_paket[$i]->nama_paket ?></p>
            <p>
                <span style="float: left;">@<?= number_format($detail[$i]->harga, 0) ?></span>
                <span style="text-align: center;"><?= $detail[$i]->qty ?></span>
                <span style="float: right;">
                    <?php $sum = $detail[$i]->harga * $detail[$i]->qty;
                    echo number_format($sum, 0); ?>
                </span>
            </p>
        <?php
        } ?>
    </div>
    <div class="lain-lain" style="padding: 10px 0;">
        <table width="100%">
            <tr>
                <td><span>Pajak : </span></td>
                <td style="margin-left: 10px; text-align: right;"><span><?= number_format($transaksi[0]->pajak, 0) ?></span></td>
            </tr>
            <tr>
                <td><span>Biaya Lain : </span></td>
                <td style="margin-left: 10px; text-align: right;"><span><?= number_format($transaksi[0]->biaya_tambahan, 0) ?></span></td>
            </tr>
            <tr>
                <td><span>Diskon : </span></td>
                <td style="margin-left: 10px; text-align: right;"><span><?= number_format($transaksi[0]->diskon, 0) ?></span></td>
            </tr>
            <tr>
                <td><span>Total : </span></td>
                <td style="margin-left: 10px; text-align: right;"><span><?= number_format($transaksi[0]->total, 0) ?></span></td>
            </tr>
        </table>
    </div>
    <p style="text-align: center; text-transform: uppercase;"><?= preg_replace('/_/', ' ', $transaksi[0]->dibayar) ?></p>
    <p style="text-transform: uppercase; background: #000; color: #eee; margin-top: 10px; padding: 4px 0;">perhatian</p>
    <ul style="list-style: none; padding: 0; width: 100%;">
        <li>
            <span style="width: 10%;">1.</span> 
            <span style="width: 90%;">Pengambilan pakaian harus disetai bon asli.</span>
        </li>
        <li>
            <span style="width: 10%;">2.</span> 
            <span style="width: 90%;">Setelah 3 bulan tidak di ambil kami tidak bertanggung jawab jika pakaian anda hilang.</span>
        </li>
        <li>
            <span style="width: 10%;">3.</span> 
            <span style="width: 90%;">Setiap konsumen dianggap setuju dengan pernyataan diatas.</span>
        </li>
    </ul>
</body>

</html>