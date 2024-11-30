/*
Kamu diminta untuk membuat permainan di mana komputer secara acak 
memilih sebuah angka antara 1 dan 100. Pemain harus menebak angka 
tersebut. Setiap kali pemain memberikan tebakan, komputer memberikan 
petunjuk apakah angka yang dipilih terlalu tinggi atau terlalu rendah. 
Permainan berlanjut sampai pemain menebak angka yang benar. Program 
harus menghitung jumlah tebakan yang diperlukan dan menampilkan hasilnya.
Contoh:
    Masukkan salah satu dari angka 1 sampai 100: 85
    Terlalu tinggi! Coba lagi.
    Masukkan salah satu dari angka 1 sampai 100: 72
    Terlalu tinggi! Coba lagi.
    Masukkan salah satu dari angka 1 sampai 100: 20
    Terlalu rendah! Coba lagi.
    Masukkan salah satu dari angka 1 sampai 100: 65
    Terlalu rendah! Coba lagi.
    Masukkan salah satu dari angka 1 sampai 100: 71
    Selamat! kamu berhasil menebak angka 71 dengan benar.
    Sebanyak 5x percobaan.
*/

function nomor4() {
    let angkaRandom = Math.floor(Math.random() * 100) + 1;
    let percobaan = 0;

    while (true) {
        percobaan++;
        let angka = parseInt(prompt("Masukkan salah satu dari angka 1 sampai 100: "));
        
        if (angka < 1 || angka > 100) {
            alert("Mohon masukkan angka yang valid (1-100)");
        } else if (angka === angkaRandom) {
            alert(`Selamat! Kamu berhasil menebak angka ${angka} dengan benar.\nSebanyak ${percobaan}x percobaan`);
            break;
        } else if (angka > angkaRandom) {
            alert("Terlalu tinggi! Coba lagi.");
        } else {
            alert("Terlalu rendah! Coba lagi.");
        }
    }
}