const formatUang = (text, prefix) => {
	let string_angka = text.replace(/[^,\d]/g, '').toString()
	let split = string_angka.split(',')
	let sisa = split[0].length % 3
	let rupiah = split[0].substr(0, sisa)
	let ribuan = split[0].substr(sisa).match(/\d{1,3}/gi)

	if (ribuan) {
		pemisah = sisa ? ',' : ''
		rupiah += pemisah + ribuan.join(',')
	}

	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
}
//memindahkan element array
// const pindahElementArray = (arr, posLama, posBaru) => {
//     if (posBaru >= arr.length) {
//         let pin = posBaru - arr.length + 1
//         while (pin--) {
//             arr.push(undefined)
//         }
//     }
//     arr.splice(posBaru, 0, arr.splice(posLama, 1)[0])
// }
$('*').addClass('text-capitalize')
$('.daftarMenu:first-child .menuIcon').click(() => {
	$('.menu .daftarMenu:not(:first-child)').toggleClass('turun')
	$('.daftarMenu:first-child .menuIcon span:first-child').toggleClass('fas fa-times')
	$('.daftarMenu:first-child .menuIcon span:first-child').toggleClass('fas fa-bars')
	$('.daftarMenu:first-child .menuIcon span:nth-child(2)').text('Close')
	if(document.querySelector('.menu .daftarMenu:not(:first-child)').classList.contains('turun')){
		$('.daftarMenu:first-child .menuIcon span:nth-child(2)').text('Close')
	} else {
		$('.daftarMenu:first-child .menuIcon span:nth-child(2)').text('Menu')
	}
})
const diam = (e) => {
	$(`#${e.id} + .hoverMenu`).toggleClass('muncul')
}
document.onclick = (e) => {
	if (e.target.id != 'transaksi' && e.target.id != 'data' && e.target.id != 'laporan') {
		$('.hoverMenu').removeClass('muncul')
	}
}
$('.userIcon.toggle').click(() => {
	$('.userbox').toggleClass('muncul')
})
randomInt = (panjang = 1) => {
	let hasil = '';
	let karakter = '434409353457867974834143847300056456345345345680000023203920932093020';
	let panjangChar = karakter.length;
	for (let i = 0; i < panjang; i++) {
		hasil += karakter.charAt(Math.floor(Math.random() * panjangChar));
	}
	return hasil;
},
randomWarna = () => {
	let letter = '0123456789ABCDEF'
	let warna = '#'
	for (let index = 0; index < 6; index++) {
		warna += letter[Math.floor(Math.random() * letter.length)]
	}
	return warna
}
$('input').attr('autocomplete','off')