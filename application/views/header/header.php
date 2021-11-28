<header class="d-flex justfy-content-space-between align-items-center">
    <h5 style="margin: 0 !important;">Laundrie</h5>
    <div class="userIcon toggle">
        <span class="fas fa-user"></span>
    </div>
    <div class="userbox">
        <div class="userIcon mb-2">
            <span class="fas fa-user"></span>
        </div>
        <span class="nama text-capitalize"><?= $this->session->userdata('nama') ?></span>
        <span class="mb-2 text-capitalize"><?= $this->session->userdata('role') ?></span>
        <div class="btnlogout">
            <a href="<?= site_url('logout') ?>">Logout</a>
        </div>
    </div>
</header>
<div class="header-menu">
    <div class="menu" onclick="pindah('<?= $this->session->userdata('role') ?>')">
        <span class="fas fa-home"></span>
        <span>Beranda</span>
    </div>
    <?php
    if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'kasir') {
    ?>
        <div class="menu">
            <span class="fas fa-database"></span>
            <span>Data</span>
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
        <div class="menu">
            <span class="fas fa-balance-scale"></span>
            <span>Transaksi</span>
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
    <div class="menu">
        <span class="fas fa-receipt"></span>
        <span>Laporan</span>
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
    <div class="mobile-menu-toggle">
        <span class="fas fa-bars"></span>
    </div>
    <div class="mobile-menu">
        <div class="list-menu" onclick="pindah('<?= $this->session->userdata('role') ?>')" style="cursor: pointer;">
            <h5><span class="fas fa-home" style="margin-right: 12px;"></span>Beranda</h5>
        </div>
        <?php
        if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'kasir') {
        ?>
            <div class="list-menu">
                <h5><span class="fas fa-database" style="margin-right: 12px;"></span>Data</h5>
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
            <div class="list-menu">
                <div class="hoverMenu">
                    <h5><span class="fas fa-balance-scale" style="margin-right: 12px;"></span>Transaksi</h5>
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
        <div class="list-menu">
            <div class="hoverMenu">
                <h5><span class="fas fa-receipt" style="margin-right: 12px;"></span>Laporan</h5>
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
    document.querySelector('.mobile-menu-toggle').addEventListener('click', () => {
        document.querySelector('.mobile-menu').classList.toggle('bla')
    })
</script>