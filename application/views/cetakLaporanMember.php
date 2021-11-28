<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak laporan data member</title>
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
        <h5><?php foreach ($outlet_dimana as $ot) {
                echo $ot->alamat;
            } ?></h5>
        <h5><?php foreach ($outlet_dimana as $ot) {
                echo $ot->nama;
            } ?></h5>
        <h5><?php foreach ($outlet_dimana as $ot) {
                echo $ot->tlp;
            } ?></h5>
    </header>
    <div class="satu">
        <div>
            <h3>Laporan Data Member</h3>
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
    <table class="table table-striped" width='100%'>
        <thead>
            <tr>
                <th>No</th>
                <th>Id member</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($member as $ot) : $no++ ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $ot->id ?></td>
                    <td><?= $ot->nama ?></td>
                    <td><?= $ot->alamat ?></td>
                    <td><?= $ot->telp ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>