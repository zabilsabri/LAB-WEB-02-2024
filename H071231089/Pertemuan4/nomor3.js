function findFutureDay(currentDay, daysAfter) {
    const daysOfWeek = {
        Minggu: 0,
        Senin: 1,
        Selasa: 2,
        Rabu: 3,
        Kamis: 4,
        Jumat: 5,
        Sabtu: 6
    };

    const reverseDaysOfWeek = Object.fromEntries(
        Object.entries(daysOfWeek).map(([key, value]) => [value, key])
    );

    if (!(currentDay in daysOfWeek)) {
        return "Hari yang dimasukkan tidak valid.";
    }

    const currentDayNumber = daysOfWeek[currentDay];
    const futureDayNumber = (currentDayNumber + daysAfter)% 7;

    return reverseDaysOfWeek[futureDayNumber];
}

console.log(findFutureDay("Jumat", 100)); 

