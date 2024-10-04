/* Buatlah sebuah fungsi `countEvenNumbers` yang menerima parameter dua angka yakni, `start` dan `end`. 
    Dari fungsi tersebut hitunglah berapa banyak bilangan genap yang ada dalam interval tersebut, 
    termasuk `start` dan `end` jika mereka genap.*/
// console.log(countEvenNumbers(1,10))
// Output : 5 (2, 4, 6, 8, 10)

function countEvenNumbers(awal, akhir) {
    let total = 0;
    let angkaangka = [];
    for (let i = awal; i <= akhir; i++) {
        if (i % 2 == 0) {
            total++;
            angkaangka.push(i);
        }
    }
    alert(`${total} (${angkaangka.join(', ')})`);
}

function nomor1() {
    const iawal = parseInt(prompt("Masukkan input number sebagai angka awal: "));
    const iakhir = parseInt(prompt("Masukkan input number sebagai angka akhir: "));
    countEvenNumbers(iawal, iakhir);
}