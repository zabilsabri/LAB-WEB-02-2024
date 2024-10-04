const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

const angkaTebakan = Math.floor(Math.random() * 100) + 1;
let jumlahTebakan = 0;

const mulaiTebakan = () => {
  rl.question('Masukkan salah satu dari angka 1 sampai 100: ', (input) => {
    const tebakan = parseInt(input);
    jumlahTebakan++;

    if (isNaN(tebakan) || tebakan < 1 || tebakan > 100) {
      console.log("Masukkan angka yang valid antara 1 sampai 100!");
      mulaiTebakan();
    } else if (tebakan < angkaTebakan) {
      console.log("Terlalu rendah! Coba lagi.");
      mulaiTebakan();
    } else if (tebakan > angkaTebakan) {
      console.log("Terlalu tinggi! Coba lagi.");
      mulaiTebakan();
    } else {
      console.log(`Selamat! Kamu berhasil menebak angka ${angkaTebakan} dengan benar.\nSebanyak ${jumlahTebakan}x percobaan.`);
      rl.close();
    }
  });
};

console.log("Selamat datang di permainan tebak angka!");
mulaiTebakan();