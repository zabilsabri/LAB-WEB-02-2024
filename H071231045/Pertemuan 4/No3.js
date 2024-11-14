const { log } = require("console");

function masaDepan(hariIni, jumlahHari){
    const namaHari = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']

    const indeksHariIni = namaHari.indexOf(hariIni);

    if (indeksHariIni === -1) {
        return'Hari Tidak Valid';
    }

    const indeksMasaDepan = (indeksHariIni + jumlahHari) % 7;
    return namaHari[indeksMasaDepan];
}

const hariIni = 'Sabtu';
const jumlahHari = 1;
const yangAkanDatang = masaDepan(hariIni, jumlahHari);
console.log(`Hari ini adalah ${hariIni}, dan ${jumlahHari} hari yang akan datang adalah ${yangAkanDatang}`);
