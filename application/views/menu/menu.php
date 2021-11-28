<div class="menu">
    <div class="daftarMenu" id="toggle">
        <div class="menuIcon">
            <span class="fas fa-bars"></span>
            <span>Menu</span>
        </div>
    </div>
    <div class="daftarMenu" id="satu">
        <div class="menuIcon" id="home" data-menu="1" onclick="pindah('<?= $this->session->userdata('role') ?>')">
            <span class="fas fa-home"></span>
            <span>Home</span>
        </div>
    </div>
    <?php
    if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'kasir') {
    ?>
        <div class="daftarMenu" id="dua">
            <div class="menuIcon" onclick="diam(this)" id="data" data-menu="2">
                <span class="fas fa-database"></span>
                <span>Data</span>
            </div>
            <div class="hoverMenu">
                <h5>Data</h5>
                <ul>
                    <?php if ($this->session->userdata('role') == 'admin') { ?>
                        <a href="<?= site_url('outletAdmin') ?>" data-hover-menu="1">
                            <li>Data outlet</li>
                        </a>
                        <a href="<?= site_url('userAdmin') ?>" data-hover-menu="2">
                            <li>Data user</li>
                        </a>
                        <a href="<?= site_url('paketAdmin') ?>" data-hover-menu="3">
                            <li>Data paket</li>
                        </a>
                        <a href="<?= site_url('memberAdmin') ?>" data-hover-menu="4">
                            <li>Data member</li>
                        </a>
                    <?php } else if ($this->session->userdata('role') == 'kasir') { ?>
                        <a href="<?= site_url('memberKasir') ?>" data-hover-menu="5">
                            <li>Data member</li>
                        </a>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="daftarMenu" id="tiga">
            <div class="menuIcon" onclick="diam(this)" id="transaksi" data-menu="3">
                <span class="fas fa-balance-scale"></span>
                <span>Transaksi</span>
            </div>
            <div class="hoverMenu">
                <h5>Transaksi</h5>
                <ul>
                    <?php if ($this->session->userdata('role') == 'admin') { ?>
                        <a href="<?= site_url('transaksiAdmin') ?>" data-hover-menu="4">
                            <li>Transaksi laundry</li>
                        </a>
                        <a href="<?= site_url('dataTransaksiAdmin') ?>" data-hover-menu="4">
                            <li>Data Transaksi laundry</li>
                        </a>
                    <?php } else if ($this->session->userdata('role') == 'kasir') { ?>
                        <a href="<?= site_url('transaksiKasir') ?>" data-hover-menu="5">
                            <li>Transaksi laundry</li>
                        </a>
                        <a href="<?= site_url('dataTransaksiKasir') ?>" data-hover-menu="4">
                            <li>Data Transaksi laundry</li>
                        </a>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>
    <div class="daftarMenu" id="<?php if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'kasir') echo 'empat';
                                else echo 'dua' ?>">
        <div class="menuIcon" onclick="diam(this)" id="laporan" data-menu="4">
            <span class="fas fa-receipt"></span>
            <span>Laporan</span>
        </div>
        <div class="hoverMenu">
            <h5>Laporan</h5>
            <ul>
                <?php if ($this->session->userdata('role') == 'admin') { ?>
                    <a href="<?= site_url('lapPendapatanAdmin') ?>" data-hover-menu="6">
                        <li>Laporan pendapatan</li>
                    </a>
                    <a href="<?= site_url('lapDataOutletAdmin') ?>" data-hover-menu="7">
                        <li>Laporan data outlet</li>
                    </a>
                    <a href="<?= site_url('lapDataMemberAdmin') ?>" data-hover-menu="8">
                        <li>Laporan data member</li>
                    </a>
                <?php } else if ($this->session->userdata('role') == 'kasir') { ?>
                    <a href="<?= site_url('lapPendapatanKasir') ?>" data-hover-menu="9">
                        <li>Laporan pendapatan</li>
                    </a>
                <?php } else { ?>
                    <a href="<?= site_url('lapPendapatanOwner') ?>" data-hover-menu="10">
                        <li>Laporan pendapatan</li>
                    </a>
                    <a href="<?= site_url('lapDataMemberOwner') ?>" data-hover-menu="11">
                        <li>Laporan data member</li>
                    </a>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<script>
    const pindah = role => {
        if (role == 'admin') {
            window.location = '<?= site_url('yangPunyaLoundry') ?>'
        } else if (role == 'kasir') {
            window.location = '<?= site_url('yangJadiKasir') ?>'
        } else {
            window.location = '<?= site_url('yangJagaOutlet') ?>'
        }
    }
</script>