const hari = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"];

let hariIni = prompt("Masukkan hari ini: ").toLowerCase();
let cekHari = prompt("Anda ingin mengetahui berapa hari kedepan? ");
let indexHari = hari.indexOf(hariIni);
let hariValid = false;

hariValid = true;
let cekHari2 = (parseInt(indexHari) + parseInt(cekHari)) % 7;          
console.log(cekHari + " hari kedepan adalah " + hari[cekHari2]);

if (!hariValid) {
    console.log("Hari " + hariIni + " bukan hari yang valid");
} 