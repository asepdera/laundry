<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//default routes
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['prosesLogin'] = 'login/prosesLogin';
$route['yangPunyaLoundry'] = 'admin';
$route['yangJagaOutlet'] = 'owner';
$route['yangJadiKasir'] = 'kasir';

//route buat admin
$route['outletAdmin'] = 'admin/outlet';
$route['tambahOutletAdmin'] = 'admin/tambah_outlet';
$route['hapusOutletAdmin/(:any)'] = 'admin/hapus_outlet/$1';
$route['editOutletAdmin/(:any)'] = 'admin/edit_outlet/$1';
$route['aksiEditOutletAdmin'] = 'admin/aksi_edit_outlet';
$route['userAdmin'] = 'admin/user';
$route['tambahUserAdmin'] = 'admin/tambah_user';
$route['hapusUserAdmin/(:any)'] = 'admin/hapus_user/$1';
$route['editUserAdmin/(:any)'] = 'admin/edit_user/$1';
$route['aksiEditUserAdmin'] = 'admin/aksi_edit_user';
$route['memberAdmin'] = 'admin/member';
$route['tambahMemberAdmin'] = 'admin/tambah_member';
$route['hapusMemberAdmin/(:any)'] = 'admin/hapus_member/$1';
$route['editMemberAdmin/(:any)'] = 'admin/edit_member/$1';
$route['aksiEditMemberAdmin'] = 'admin/aksi_edit_member';
$route['paketAdmin'] = 'admin/paket';
$route['tambahPaketAdmin'] = 'admin/tambah_paket';
$route['editPaketAdmin/(:any)'] = 'admin/edit_paket/$1';
$route['aksiEditPaketAdmin'] = 'admin/aksi_edit_paket';
$route['hapusPaketAdmin/(:any)'] = 'admin/hapus_paket/$1';
$route['transaksiAdmin'] = 'admin/transaksi';
$route['lapPendapatanAdmin'] = 'admin/lapPendapatan';
$route['lapDataMemberAdmin'] = 'admin/lapDataMember';
$route['lapDataOutletAdmin'] = 'admin/lapDataOutlet';
$route['ambilDataMemberBaru'] = 'admin/ambil_data_member_baru';
$route['ambilDataMemberAdmin'] = 'admin/ambil_data_member';
$route['cariDataMemberAdmin/(:any)'] = 'admin/cari_data_member/$1';
$route['cariDataPaketAdmin/(:any)/(:any)'] = 'admin/cari_data_paket/$1/$2';
$route['masukanTransaksiAdmin'] = 'admin/aksiTransaksi';
$route['dataTransaksiAdmin'] = 'admin/dataTransaksi';
$route['dataTransaksi'] = 'admin/detailTransaksi';
$route['cariTransaksi/(:any)'] = 'admin/cariTransaksi/$1';
$route['dataAdmin'] = 'admin/data';
$route['ubahStatusAdmin'] = 'admin/ubahStatus';
$route['udahDibayarAdmin'] = 'admin/udahDibayar';
$route['dataPendapatanAdmin'] = 'admin/dataPendapatan';
$route['cetakLaporanPendapatanAdmin/(:any)/(:any)/(:any)'] = 'admin/laporanPendapatan/$1/$2/$3';
$route['cetakLaporanOutlet'] = 'admin/cetakLaporanOutlet';

//route buat owner
$route['lapPendapatanOwner'] = 'owner/lapPendapatan';
$route['lapDataMemberOwner'] = 'owner/lapDataMember';
$route['dataOwner'] = 'owner/data';
$route['ambilDataMemberBaruOwner'] = 'owner/ambil_data_member_baru';
$route['cetakLaporanPendapatanOwner/(:any)/(:any)/(:any)'] = 'owner/laporanPendapatan/$1/$2/$3';
$route['dataPendapatanOwner'] = 'owner/dataPendapatan';

//route buat kasir
$route['transaksiKasir'] = 'kasir/transaksi';
$route['lapPendapatanKasir'] = 'kasir/lapPendapatan';
$route['memberKasir'] = 'kasir/member';
$route['tambahMemberKasir'] = 'kasir/tambah_member';
$route['hapusMemberKasir/(:any)'] = 'kasir/hapus_member/$1';
$route['editMemberKasir/(:any)'] = 'kasir/edit_member/$1';
$route['aksiEditMemberKasir'] = 'kasir/aksi_edit_member';
$route['masukanTransaksiKasir'] = 'kasir/aksiTransaksi';
$route['ambilDataMemberKasir'] = 'kasir/ambil_data_member';
$route['dataKasir'] = 'kasir/data';
$route['ambilDataMemberBaruKasir'] = 'kasir/ambil_data_member_baru';
$route['cariDataMemberKasir/(:any)'] = 'kasir/cari_data_member/$1';
$route['ambilDataMemberKasir'] = 'kasir/ambil_data_member';
$route['cariDataPaketKasir/(:any)/(:any)'] = 'kasir/cari_data_paket/$1/$2';
$route['ubahStatusKasir'] = 'kasir/ubahStatus';
$route['udahDibayarKasir'] = 'kasir/udahDibayar';
$route['dataTransaksiKasir'] = 'kasir/dataTransaksi';
$route['dataPendapatanKasir'] = 'kasir/dataPendapatan';
$route['cetakLaporanPendapatanKasir/(:any)/(:any)/(:any)'] = 'kasir/laporanPendapatan/$1/$2/$3';

$route['cetakStruk/(:any)'] = 'struk/index/$1';
$route['cetakSemuaMember'] = 'laporanmember/index';
$route['cetakMember/(:any)/(:any)'] = 'laporanmember/periode/$1/$2';
$route['logout'] = 'login/logout';
$route['(.*)'] = 'error404';
