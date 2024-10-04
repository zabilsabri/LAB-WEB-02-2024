const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

function mulai() {
    const angkaAcak = Math.floor(Math.random() * 100) + 1; 
    let jumlahTebakan = 0;

    console.log("Tebak angka antara 1 dan 100!");

    function mintaTebakan() {
        rl.question('Masukkan salah satu dari angka 1 sampai 100: ', (tebakan) => {
            jumlahTebakan++;
            const tebakanAngka = parseInt(tebakan, 10);

            if (isNaN(tebakanAngka)) {
                console.log("Masukkan angka yang valid.");
                mintaTebakan();
            } else if (tebakanAngka < angkaAcak) {
                console.log("Terlalu rendah!, coba lagi");
                mintaTebakan();
            } else if (tebakanAngka > angkaAcak) {
                console.log("Terlalu tinggi!, coba lagi");
                mintaTebakan();
            } else {
                console.log(`Selamat! Kamu berhasil menebak angka ${angkaAcak} dengan benar`);
                console.log(`Jumlah tebakan: ${jumlahTebakan}`);
                rl.close();
            }
        });
    }

    mintaTebakan();
}

mulai();