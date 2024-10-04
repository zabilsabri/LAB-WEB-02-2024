function countEvenNumbersRecursive(start, end, evenNumbers = []) {
    if (start > end) {
        return {
            count: evenNumbers.length,
            numbers: evenNumbers
        };
    }
    
    if (start % 2 === 1) {
        evenNumbers.push(start);
    }
    
    return countEvenNumbersRecursive(start + 1, end, evenNumbers);
}

const result = countEvenNumbersRecursive(1, 10);
console.log(`${result.count} (${result.numbers.join(', ')})`);