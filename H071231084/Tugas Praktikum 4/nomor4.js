const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

const jawaban = Math.floor(Math.random() * 100) + 1;
let n = 0; 

function tebakAngka() {
    rl.question("Masukkan salah satu dari angka 1 sampai 100: ", (tebakan) => {
        tebakan = parseInt(tebakan); 
        n++; 
        if (isNaN(tebakan)) {
            console.log("Masukkan angka yang valid!");
            tebakAngka(); 
        } else if (tebakan > jawaban) {
            console.log("Terlalu tinggi! Coba lagi.");
            tebakAngka(); 
        } else if (tebakan < jawaban) {
            console.log("Terlalu rendah! Coba lagi.");
            tebakAngka(); 
        } else {
            console.log(`Selamat! Kamu berhasil menebak angka ${jawaban} dengan benar.`);
            console.log(`Sebanyak ${n}x percobaan.`);
            rl.close(); 
        }
    });
}

tebakAngka();