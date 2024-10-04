const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

function determineDay() {
    rl.question("Masukkan hari: ", (hari) => {   
        hari = hari.toLowerCase() 
        const arrayHari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']
        if (!arrayHari.includes(hari)) {
            console.log("Masukkan hari yang tepat!")
            determineDay()
        }
        rl.question("Masukkan jumlah hari ke depan yang ingin dihitung: ", (jumlah) => {
            if (isNaN(jumlah) || jumlah <= 0) {
                console.log("Jumlah harus berupa angka positif yang valid!");
                rl.close()
                return 
            }
        jumlah = parseInt(jumlah)

        const hariKe = arrayHari.indexOf(hari)
        const hariNanti = arrayHari[(hariKe + jumlah) % 7]

        console.log(`${jumlah} hari setelah hari ${hari} adalah hari ${hariNanti}`)
        rl.close()
        })
    })
}

determineDay()