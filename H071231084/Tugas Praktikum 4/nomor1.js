function countEvenNumbers(start, end) {
    if (start > end) {
        console.log("Nilai awal tidak boleh lebih besar dari nilai akhir.")
        return
    }
    let array = []
    if (start % 2 != 0) start++
    for (i = start; i <= end; i += 2) {
        array.push(i)
    }
    let output = `(${array.join(', ')})`
    console.log("Output = " + array.length + output)
}

countEvenNumbers(1, 10)