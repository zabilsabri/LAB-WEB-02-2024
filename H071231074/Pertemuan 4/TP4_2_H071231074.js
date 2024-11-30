/*
Buatlah sebuah program JavaScript yang menerima input harga barang dan jenis barang dari pengguna, kemudian 
menghitung harga akhir setelah menerapkan diskon. Diskon yang diberikan berbeda-beda tergantung pada jenis barang:
    - Elektronik: Diskon 10%
    - Pakaian: Diskon 20%
    - Makanan: Diskon 5%
    - Lainnya: Tidak ada diskon
Setelah menghitung harga akhir, program harus menampilkan harga awal, besaran diskon, dan harga akhir setelah diskon.
Contoh Input:
    Masukkan harga barang: 10000
    Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya): makanan
Contoh Output:
    Harga awal: Rp10000
    Diskon: 5%
    Harga setelah diskon: Rp9500
*/
function hitungBarang(hargabarang, jenisbarang) {
    let diskon = 0;

    if (jenisbarang.toLowerCase() === "elektronik") {
        diskon = 0.9;
    } else if (jenisbarang.toLowerCase() === "pakaian") {
        diskon = 0.8;
    } else if (jenisbarang.toLowerCase() === "makanan") {
        diskon = 0.95;
    }

    alert(`Harga awal: ${hargabarang}\nDiskon: ${diskon}%\nHarga setelah diskon: ${hargabarang * diskon}`)
}

function nomor2() {
    const hargabarang = parseFloat(prompt("Masukkan harga barang: "));
    const jenisbarang = prompt("Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya) : ");
    hitungBarang(hargabarang, jenisbarang);
}