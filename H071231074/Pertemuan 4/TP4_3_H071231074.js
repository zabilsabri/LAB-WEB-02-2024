/*
    Di sebuah dunia imajiner, kamu adalah seorang pengelola waktu yang bertugas 
    untuk membantu para penduduk menentukan hari apa yang akan datang setelah 
    sejumlah hari tertentu (mis. hari ini adalah hari Jum’at, maka 1000 hari 
    yang akan datang adalah hari Kamis). Namun, karena peralatan canggih kamu 
    sedang tidak berfungsi, kamu harus menggunakan metode manual tanpa menggunakan 
    objek `Date` atau kalender apa pun. Kamu hanya diberikan sebuah array yang 
    berisikan nama-nama hari dalam seminggu.
*/
function hitungHari(inputan, today) {
    const namaHari = ["Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Ahad"];
    const indexToday = namaHari.indexOf(today);
    const hari = (inputan + indexToday) % 7;
    alert(`Nama hari setelah ${inputan} hari berlalu adalah hari ${namaHari[hari]}`);
}

function nomor3() {
    const jumlahHari = parseInt(prompt("Masukkan jumlah hari: "));
    const hariIni = parseInt(prompt("Sekarang hari apa? "));
    hitungHari(jumlahHari, hariIni);
}