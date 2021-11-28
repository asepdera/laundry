<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css"> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h5,
        h3,
        h4 {
            text-transform: uppercase;
        }

        h5,
        h4 {
            margin: 5px 0;
        }

        h3 {
            margin: 10px 0;
        }

        h2 {
            margin: 10px 0;
        }

        header {
            text-align: center;
            border-bottom: 1px solid #000;
        }

        .satu {
            position: relative !important;
            margin-bottom: 0;
        }

        .satu div {
            text-align: center;
        }

        .satu span {
            position: absolute;
            top: 5%;
            right: 20px;
        }

        table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border: 1px solid #dee2e6;
            text-transform: capitalize;
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05)
        }

        .data-diri {
            margin: 10px 0;
            text-transform: capitalize;
            font-weight: 700;
        }

        .data-diri table {
            border: none
        }
    </style>
</head>

<body>
    <header>
        <h4>Penyedia jasa Laundry</h4>
        <h3>Laundrie</h3>
        <h5><?php foreach ($outlet as $ot) {
                echo $ot->alamat;
            } ?></h5>
        <h5><?php foreach ($outlet as $ot) {
                echo $ot->nama;
            } ?></h5>
        <h5><?php foreach ($outlet as $ot) {
                echo $ot->tlp;
            } ?></h5>
    </header>
    <div class="satu">
        <div>
            <h3>Laporan transaksi Laundry</h3>
            <h3><?= $this->uri->segment(4) ?></h3>
        </div>
        <span><?= date('d-m-Y   H:i') ?></span>
    </div>
    <div class="data-diri">
        <?php $user = $this->db->select('id,nama,role')->from('tb_user')->where(array('id' => $this->session->userdata('id')))->get()->result();
        foreach ($user as $data) :
        ?>
            <table>
                <tr>
                    <td>Id user</td>
                    <td>: <?= $data->id ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: <?= $data->nama ?></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>: <?= $data->role ?></td>
                </tr>
            </table>
        <?php endforeach ?>
    </div>
    <table class="table table-striped" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>
                    <?php
                    if ($this->uri->segment(4) == 'perhari') echo 'Hari';
                    else echo 'Bulan'
                    ?>
                </th>
                <th>pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            $pendapatan = array();
            $hari = array(
                'Sunday' => 'minggu',
                'Monday' => 'senin',
                'Tuesday' => 'selasa',
                'Wednesday' => 'rabu',
                'Thursday' => 'kamis',
                'Friday' => 'jumat',
                'Saturday' => 'sabtu',
            );
            $bulan = array('januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember');
            foreach ($transaksi as $item) : $no++ ?>
                <tr>
                    <td style="text-align: center;"><?= $no ?></td>
                    <td style="text-align: center; text-transform: capitalize;">
                        <?php
                        if (isset($item->tahun)) {
                            echo $bulan[$item->bulan - 1] . ', ' . $item->tahun;
                        } else {
                            $namahari = date('l', strtotime($item->bulan));
                            $formatTanggal = date('d-m-Y', strtotime($item->bulan));
                            echo $hari[$namahari] . ', ' . $formatTanggal;
                        }
                        ?>
                    </td>
                    <td style="text-align: right;"><?= number_format($item->pendapatan, 0, '.', ',') ?></td>
                </tr>
            <?php array_push($pendapatan, $item->pendapatan);
            endforeach; ?>
        </tbody>
    </table>
    <div style="margin-top: 10px;">
        <span>Total Pendapatan : <?= number_format(array_sum($pendapatan), 0, '.', ',') ?></span>
    </div>
</body>

</html>