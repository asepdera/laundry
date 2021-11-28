/*
    Table of content
    1.Kumpulan fungsi pelengkap untuk component
    2.Gridphotos
    3.Toast
    4.Autocomplete
*/

/*
    Kumpulan fungsi
*/
//untuk membuat css rules di js
const componentStyles = (element, styles) => {
        const component = document.querySelectorAll(element);
        component.forEach(element => {
            for (let css in styles) element.style[css] = styles[css]
        })
    },
    hover = (element, enterStyles, leaveStyles) => {
        const elemen = document.querySelectorAll(element);
        elemen.forEach(v => {
            v.addEventListener("mouseenter", () => {
                componentStyles(`${element}`, enterStyles)
            })
        }), elemen.forEach(v => {
            v.addEventListener("mouseleave", () => {
                componentStyles(`${element}`, leaveStyles)
            })
        })
    },
    gelapTerang = warna => {
        let r, g, b, hsp;
        return warna.match(/^rgb/) ? (r = (warna = warna.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/))[1], g = warna[2], b = warna[3]) : (r = (warna = +("0x" + warna.slice(1).replace(warna.length < 5 && /./g, "$&$&"))) >> 16, g = warna >> 8 & 255, b = 225 & warna), hsp = Math.sqrt(r * r * .299 + g * g * .587 + b * b * .114), hsp > 127.5 ? "terang" : "gelap"
    },

    //membuat random karakter
    randomChar = (panjang = 1) => {
        let hasil = '';
        let karakter = 'akjsdhjkshpiehJFHAdiaksjfbKJFHBkahgfkFHsgdfjhdfkZKfdjsobvnZHDIuhSGvbLSSHDiausgfvkzJSbfcGSFiauGsvbLIZSGfikdsbvgklaSALFGuSHlgkvdgvGSVbdkzhbvclujGSUFclkSJHFoUGfvlGFozugsFOLSFbv';
        let panjangChar = karakter.length;
        for (let i = 0; i < panjang; i++) {
            hasil += karakter.charAt(Math.floor(Math.random() * panjangChar));
        }
        return hasil;
    },
    //untuk lighten dan darken
    lightDark = (warna, persen) => {
        let r = parseInt(warna.substring(1, 3), 16)
        let g = parseInt(warna.substring(3, 5), 16)
        let b = parseInt(warna.substring(5, 7), 16)
        r = parseInt(r * (100 + persen) / 100)
        g = parseInt(g * (100 + persen) / 100)
        b = parseInt(b * (100 + persen) / 100)

        r = (r < 255) ? r : 255
        g = (r < 255) ? g : 255
        b = (r < 255) ? b : 255

        let merah = ((r.toString(16).length == 1) ? `0${r.toString(16)}` : r.toString(16))
        let ijo = ((g.toString(16).length == 1) ? `0${g.toString(16)}` : g.toString(16))
        let biru = ((b.toString(16).length == 1) ? `0${b.toString(16)}` : b.toString(16))

        return "#" + merah + ijo + biru
    }

/*
    end kumpulan fungsi
*/

/*
    Gridphotos(ubah objek dalam filter nya siapa tau beda)
*/

//menampilkan data gambar
const searchPhotos = (searchText, obj, nama) => {
    //menampilkan detail gambar
    const tampil = (id, detail, obj) => {
        let gambar = '';
        const detailContainer = document.querySelector(detail);
        const alamat = obj.filter(v => v.id == id);
        gambar += `
                <div class='modal'>
                    <span class='close'>X</span>
                    <div class="gambar"> <img src="${alamat[0].alamat}"> </div>
                    <span class='nama'>${alamat[0].nama}</span>
                    <div class='btn-wrap'>
                        <a class = 'download' href = "${alamat[0].alamat}"> Download </a>
                    </div>
                </div>
        `;
        detailContainer.innerHTML = gambar;
        const a = document.querySelector('.download');
        a.download = alamat[0].nama;

        document.querySelector(`${detail}`).addEventListener('click', () => {
            document.querySelector(`${detail}`).remove()
        });
    }
    //menampilkan gambar lewat searching
    let output = '';

    const imageCont = document.createElement('div');
    const detailCont = document.createElement('div');
    const errorCont = document.createElement('div');
    imageCont.classList.add('bungkus');
    detailCont.classList.add('bungkusDetail');
    errorCont.classList.add('bungkusError');

    const kelas = document.querySelector('.bungkus');
    if (!kelas) {
        document.body.appendChild(imageCont);
        document.body.appendChild(errorCont);
    }
    const text = document.querySelector(searchText);
    const imageWrapper = document.querySelector('.bungkus');
    const errorWrapper = document.querySelector('.bungkusError');
    if (output != '') {
        output = '';
    }
    // /[a]/g adalah regular expression untuk memilih semua karakter a
    let hasil = obj.filter(v => {
        const category = v.kategori;
        const kategori = category.replace(/[ |,. ]/gi, '');
        return kategori.includes(text.value.toLowerCase());
    });

    // console.log(hasil)
    if (hasil.length > 0 && text.value != '') {
        for (let i = 0; i < hasil.length; i++) {
            if (nama == true) {
                output +=
                    `<div class="grid-item">
                            <img src="${hasil[i].alamat}" id='${hasil[i].id}' class = 'gambar' >
                            <span class = "nama" > ${
                                hasil[i].nama
                            }</span>
                        </div>`;
            } else {
                output +=
                    `<div class="grid-item">
                            <img src="${hasil[i].alamat}" id='${hasil[i].id}' class = 'gambar' >
                        </div>`;
            }
            imageWrapper.innerHTML = output;
            let gambar = document.querySelectorAll(`.bungkus .gambar`);
            gambar.forEach(element => {
                element.addEventListener('click', (e) => {
                    document.body.appendChild(detailCont);
                    tampil(e.target.id, '.bungkusDetail', obj);
                });
            });
        }
        text.focus();
        $('.bungkusError').empty();
    } else {
        output +=
            `<img src="assets/gambar/undraw/web/undraw_page_not_found_su7k.png" width='200px' id='error' class='gambar'> <span>Kategori tidak ditemukan</span>`;
        errorWrapper.innerHTML = output;
        text.focus();
        $('.bungkus').empty();
    }
}
/*
    end Gridphotos
*/

/*
    Toast
*/
const toast = (opt) => {
    const bungkus = document.createElement('div');
    bungkus.classList.add('toastWrapper');
    //set tampilan toast
    toastStyle = (opt, id) => {
        const element = document.querySelector(`.toastWrapper .toast#${id}`);
        const position = (opt.position == 'left' || opt.position == 'right') ? opt.position : 'right';
        const bg = opt.background ? opt.background : '#fff';
        const kecerahan = gelapTerang(bg);
        const warna = opt.warna ? opt.warna : '#121122';
        const t = document.querySelectorAll(`.toastWrapper .toast`)
        let tinggi = 0;

        if (t.length > 1) {
            t.forEach(v => {
                tinggi += v.offsetHeight + 10;
            })
        }

        (position == 'left') ? element.style.left = '20px': element.style.right = '20px';

        componentStyles(`.toastWrapper`, {
            position: 'fixed',
            top: '20px',
            'z-index': '34',
            opacity: 1,
            padding: '20px',
            width: '100%',
        });
        componentStyles(`.toastWrapper .toast#${id}`, {
            background: bg,
            top: tinggi + 'px',
            padding: '20px 15px 20px 20px',
            'border-radius': '10px',
            display: 'flex',
            'align-items': 'center',
            'justify-content': 'space-between',
            width: 'fit-content',
            'min-width': '300px',
            'max-width': '550px',
            'box-shadow': '1px 7px 14px -5px rgba(0,0,0,.3)',
            'border-left': `5px solid ${warna}`,
            position: 'absolute',
            'margin-bottom': '5px',
        });

        componentStyles(`.toastWrapper .toast#${id} .content`, {
            display: 'flex',
            'align-items': 'center',
            'word-wrap': 'break-word'
        });

        componentStyles(`.toastWrapper .toast#${id} .content .iconWrapper`, {
            background: warna,
            'border-radius': '50%',
            padding: '10px'
        });

        componentStyles(`.toastWrapper .toast#${id} .content .detail`, {
            padding: '0 14px 0 14px'
        });

        componentStyles(`.toastWrapper .toast#${id} .content .detail span`, {
            'font-weight': '700',
            'font-size': '18px',
            'margin-bottom': '6px'
        });

        componentStyles(`.toastWrapper .toast#${id} .content .detail p`, {
            color: '#878787'
        });

        componentStyles(`.toastWrapper .close.${id}`, {
            cursor: 'pointer',
            'font-weight': 700,
            color: '#ccc'
        });

        (kecerahan == 'gelap') ? document.querySelector(`.toastWrapper .toast#${id}`).style.color = '#fff': document.querySelector(`.toastWrapper .toast#${id}`).style.color = '#000';

        if (gelapTerang(warna) == 'gelap' || warna == 'red' || warna == 'rgb(255,0,0)' || warna == '#ff0000' || warna == 'yellow') {
            document.querySelector(`.toastWrapper .toast#${id} .content .iconWrapper i`).style.color = '#fff';
        } else {
            document.querySelector(`.toastWrapper .toast#${id} .content .iconWrapper i`).style.color = '#000';
        }

        document.querySelectorAll(`.toastWrapper .close`).forEach(v => {
            v.addEventListener('click', (e) => {
                const id = e.target.parentNode.id;
                if (position == 'left') {
                    componentStyles(`.toastWrapper #${id}`, {
                        transition: '.3s',
                        left: '-300px',
                        opacity: 0
                    });
                } else {
                    componentStyles(`.toastWrapper #${id}`, {
                        transition: '.3s',
                        right: '-300px',
                        opacity: 0
                    });
                }
                setTimeout(() => {
                    document.querySelector('.toastWrapper').removeChild(e.target.parentNode)
                }, 360)
            });
        })

        const durasi = opt.durasi ? opt.durasi : 6000;
        setTimeout(() => {
            if (position == 'left') {
                componentStyles(`.toastWrapper .toast#${id}`, {
                    transition: '.3s',
                    left: '-300px',
                    opacity: 0
                });
            } else {
                componentStyles(`.toastWrapper .toast#${id}`, {
                    transition: '.3s',
                    right: '-300px',
                    opacity: 0
                });
            }
            setTimeout(() => {
                document.querySelector('.toastWrapper').removeChild(document.querySelector(`#${id}`))
            }, 360)
        }, durasi)
    }
    //buat element untuk toast
    if (document.querySelector('.toastWrapper')) {
        let id = randomChar(6);
        //buat element toast nya dulu
        document.querySelector('.toastWrapper').innerHTML += `
        <div class = 'toast' id = '${id}' >
            <div class='content'>
                <div class='iconWrapper'><i></i></div>
                <div class='detail'>
                    <span></span>
                    <p></p>
                </div>
            </div>
            <div class='close ${id}' onmouseover="masuk(this)" onmouseout = "keluar(this)">X</div>
        </div>
    `;
        document.querySelector(`.toastWrapper .toast#${id} .iconWrapper i`).className = '';
        document.querySelector(`.toastWrapper .toast#${id} .iconWrapper i`).className += opt.icon ? opt.icon : '';
        document.querySelector(`.toastWrapper .toast#${id} .detail span`).innerText = opt.headerText ? opt.headerText : 'Header';
        document.querySelector(`.toastWrapper .toast#${id} .detail p`).innerText = opt.bodyText ? opt.bodyText : 'Body';
        //baru kasih style
        toastStyle(opt, id)
    } else {
        let id = randomChar(6);
        document.body.appendChild(bungkus);
        bungkus.innerHTML += `
        <div class='toast' id = '${id}' >
            <div class='content'>
                <div class='iconWrapper'><i class='${opt.icon ? opt.icon : ''}'></i></div>
                <div class='detail'>
                    <span>${opt.headerText ? opt.headerText : 'Header'}</span>
                    <p>${opt.bodyText ? opt.bodyText : 'Body'}</p>
                </div>
            </div>
            <div class='close ${id}' onmouseover="masuk(this)" onmouseout = "keluar(this)">X</div>
        </div>
    `;
        toastStyle(opt, id)
    }
    masuk = e => {
        e.style.color = 'red'
        e.style.transition = '.3s'
    }
    keluar = e => {
        e.style.color = '#ccc'
        e.style.transition = '.3s'
    }
}
/*
    End Toast
*/

/*
    Autocomplete
*/
const autocomplete = (opt) => {
    if (document.querySelector(opt.container)) {
        document.querySelector(`${opt.container}`).innerHTML += `
            <div class = 'fkFFkSGK' >
                <input type='text' class='GkHfhSvG' placeholder='type to search'>
                <div class = 'SdoLUsgG'></div>
            </div>
        `
    } else {
        console.error('container not found')
    }
    terpilih = e => {
        document.querySelector('.fkFFkSGK input').value = e.textContent
    }
    const width = opt.width ? opt.width : '450px'
    const bg = opt.background ? opt.background : '#fff'
    const gt = gelapTerang(bg)
    let nilai = 0
    let m = ''
    let k = ''
    if (gt == 'gelap') {
        document.querySelector(`${opt.container}`).style.color = '#fff'
        document.querySelector('.fkFFkSGK .GkHfhSvG').style.color = '#fff'
        nilai = 247
        c = '#121122'
        k = '#fff'
    } else {
        document.querySelector(`${opt.container}`).style.color = '#000'
        document.querySelector('.fkFFkSGK .GkHfhSvG').style.color = '#000'
        nilai = -40
        c = '#fff'
        k = '#121122'
    }
    componentStyles(`${opt.container}`, {
        position: 'relative',
        width: '100%',
        display: 'flex',
        'justify-content': 'center',
        'align-items': 'center',
        padding: '30px'
    })

    componentStyles('.fkFFkSGK', {
        width: width,
        background: bg,
        'border-radius': '5px',
        'box-shadow': '0px 1px 5px 3px rgba(0,0,0,.5)'
    })

    componentStyles('.fkFFkSGK input', {
        'box-shadow': '0px 1px 5px rgba(0,0,0,.5)',
        height: '44px',
        background: bg,
        width: '100%',
        outline: 'none',
        'border-radius': '5px',
        border: 'none',
        padding: '0px 15px',
        'font-size': '18px'
    })
    // componentStyles('.SdoLUsgG', {
    //     padding: '8px 10px',
    //     // opacity: 1
    // })
    // componentStyles('.SdoLUsgG li', {
    //     padding: '7px 10px',
    //     margin: '3px 0',
    //     'list-style': 'none',
    //     cursor: 'pointer',
    //     'border-radius': '2px',
    //     display: 'block'
    // })

    masuk = e => {
        e.style.transition = '.1s'
        e.style.background = lightDark(bg, nilai)
        e.style.color = m
    }
    keluar = e => {
        e.style.transition = '.1s'
        e.style.background = bg
        e.style.color = k
    }
    const listWrap = document.querySelector(opt.container + ' .fkFFkSGK')
    document.querySelector('.fkFFkSGK input').onkeyup = e => {
        let value = e.target.value
        let arrayKosong = []
        if (value) {
            arrayKosong = opt.src.filter(v => {
                return v.toLowerCase().startsWith(value.toLowerCase())
            })

            arrayKosong = arrayKosong.map(v => {
                return v = `<li onmouseover="masuk(this)" onmouseout = "keluar(this)" onclick = "terpilih(this)">${v}</li>`
            })
            listWrap.classList.add('adaan')
        } else {
            listWrap.classList.remove('adaan')
        }

        tampilkanAutocomplete(arrayKosong)
    }

    tampilkanAutocomplete = list => {
        let dataList;
        if (!list.length) {
            inputdata = document.querySelector('.fkFFkSGK input').value
            dataList = `<li onmouseover="masuk(this)" onmouseout = "keluar(this)" onclick = "terpilih(this)">${inputdata}</li>`
        } else {
            dataList = list.join('')
        }
        document.querySelector('.fkFFkSGK .SdoLUsgG').innerHTML = dataList
    }
}
/*
    End Autocomplete
*/