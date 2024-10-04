function countEvenNumber(angka1, angka2) {
    let jumlah = 0;
    let angkaGenap = [];
    
    if (angka1 > angka2) {
        return { jumlah: 0, angkaGenap: ["angka start lebih besar dari angka end"] };
    } else {
        for (let i = angka1; i <= angka2; i++) {
            if (i % 2 === 1) {
                angkaGenap.push(i);
                jumlah += 1;
            }
        }
    }
    return { jumlah, angkaGenap };
}

let hasil = countEvenNumber(-2, 10);
console.log(`Output: ${hasil.jumlah} (${hasil.angkaGenap.join(', ')})`);
