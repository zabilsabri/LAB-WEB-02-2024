// const readline = require('readline');

// const rl = readline.createInterface({
//   input: process.stdin,
//   output: process.stdout
// });

// function guessingGame() {
//     const target = Math.floor(Math.random() * 100) + 1;
//     let attempts = 0;

//     function askGuess() {
//         rl.question("Masukkan salah satu dari angka 1 sampai 100: ", (input) => {
//             const guess = parseInt(input);
//             attempts++;

//             console.log(`Masukkan salah satu dari angka 1 sampai 100: ${guess}`);

//             if (guess === target) {
//                 console.log(`Selamat! kamu berhasil menebak angka ${target} dengan benar.\nSebanyak ${attempts}x percobaan.`);
//                 rl.close();
//             } else {
//                 console.log(guess > target ? "Terlalu tinggi! Coba lagi." : "Terlalu rendah! Coba lagi.");
//                 askGuess();
//             }
//         });
//     }

//     askGuess();
// }

// guessingGame();

function guessingGame() {
    const target = Math.floor(Math.random() * 100) + 1;
    let attempts = 0;

    console.log("Masukkan salah satu dari angka 1 sampai 100:");

    process.stdin.on('data', (input) => {
        const guess = parseInt(input.toString().trim());
        attempts++;

        if (guess === target) {
            console.log(`Selamat! kamu berhasil menebak angka ${target} dengan benar.\nSebanyak ${attempts}x percobaan.`);
            process.exit();
        } else {
            console.log(guess > target ? "Terlalu tinggi! Coba lagi." : "Terlalu rendah! Coba lagi.");
            console.log("Masukkan salah satu dari angka 1 sampai 100:");
        }
    });
}

guessingGame();
