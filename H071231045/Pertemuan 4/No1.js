function hitunggenap(start, end) {
    let hitung = 0;
    let genap = [];
    for (let i = start; i <= end; i++) { 
        if (i % 2 == 0) {
            hitung++;
            genap.push(i); 
        }
    }
    console.log(`Output : ${hitung} (${genap.join(', ')})`);
    return hitung;
}

hitunggenap(1, 10);