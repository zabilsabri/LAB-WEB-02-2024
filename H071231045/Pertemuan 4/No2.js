const readline = require('readline');
const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

function hitungHargaAkhir(harga, jenisBarang) {
    let tingkatDiskon = 0;

    switch (jenisBarang.toLowerCase()) {
        case 'elektronik':
            tingkatDiskon = 0.10;
            break;
        case 'pakaian':
            tingkatDiskon = 0.20;
            break;
        case 'makanan':
            tingkatDiskon = 0.05;
            break;
        default:
            tingkatDiskon = 0;
            break;
    }

    const jumlahDiskon = harga * tingkatDiskon;
    const hargaAkhir = harga - jumlahDiskon;
    const persentaseDiskon = tingkatDiskon * 100;

    // Menampilkan hasil
    console.log(`Harga Awal: Rp${harga}`);
    console.log(`Diskon: ${persentaseDiskon}%`);
    console.log(`Harga Setelah Diskon: Rp${hargaAkhir}`);
}

rl.question('Masukkan harga barang: ', (hargaBarang) => {
    rl.question('Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya): ', (jenisBarang) => {
        hitungHargaAkhir(parseFloat(hargaBarang), jenisBarang);
        rl.close(); 
    });
});