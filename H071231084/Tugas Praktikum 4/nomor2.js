const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

function countDiscount() {
    rl.question("Masukkan Harga Barang: ", (harga) => {
        if (isNaN(harga) || harga <= 0) {
            console.log("Harga harus berupa angka positif yang valid!");
            countDiscount(); 
        }
        harga = parseFloat(harga)
        rl.question("Masukkan Jenis Barang (Elektronik, Pakaian, Makanan, Lainnya): ", (jenis) => {
            jenis = jenis.toLowerCase()

            let diskon
            switch (jenis) {
                case "elektronik":
                    diskon = 10
                    break
                case "pakaian":
                    diskon = 20
                    break
                case "makanan":
                    diskon = 5
                    break
                default :
                    diskon = 0
            }
        
            let hargaDiskon = harga - (harga * diskon / 100)
            console.log(`Harga awal: Rp${harga}`)
            console.log(`Diskon: ${diskon}%`);
            console.log(`Harga setelah diskon: Rp${hargaDiskon}`)            
            rl.close()
        });
    }); 
         
}

countDiscount()