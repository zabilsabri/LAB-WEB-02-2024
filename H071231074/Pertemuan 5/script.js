const gambarKartu = {
    // Kartu Hati
    "2H": "https://deckofcardsapi.com/static/img/2H.png",
    "3H": "https://deckofcardsapi.com/static/img/3H.png",
    "4H": "https://deckofcardsapi.com/static/img/4H.png",
    "5H": "https://deckofcardsapi.com/static/img/5H.png",
    "6H": "https://deckofcardsapi.com/static/img/6H.png",
    "7H": "https://deckofcardsapi.com/static/img/7H.png",
    "8H": "https://deckofcardsapi.com/static/img/8H.png",
    "9H": "https://deckofcardsapi.com/static/img/9H.png",
    "0H": "https://deckofcardsapi.com/static/img/0H.png", 
    "JH": "https://deckofcardsapi.com/static/img/JH.png",
    "QH": "https://deckofcardsapi.com/static/img/QH.png",
    "KH": "https://deckofcardsapi.com/static/img/KH.png",
    "AH": "https://deckofcardsapi.com/static/img/AH.png",

    // Kartu Ciduk
    "2D": "https://deckofcardsapi.com/static/img/2D.png",
    "3D": "https://deckofcardsapi.com/static/img/3D.png",
    "4D": "https://deckofcardsapi.com/static/img/4D.png",
    "5D": "https://deckofcardsapi.com/static/img/5D.png",
    "6D": "https://deckofcardsapi.com/static/img/6D.png",
    "7D": "https://deckofcardsapi.com/static/img/7D.png",
    "8D": "https://deckofcardsapi.com/static/img/8D.png",
    "9D": "https://deckofcardsapi.com/static/img/9D.png",
    "0D": "https://deckofcardsapi.com/static/img/0D.png", 
    "JD": "https://deckofcardsapi.com/static/img/JD.png",
    "QD": "https://deckofcardsapi.com/static/img/QD.png",
    "KD": "https://deckofcardsapi.com/static/img/KD.png",
    "AD": "https://deckofcardsapi.com/static/img/AD.png",

    // Kartu Kelor
    "2C": "https://deckofcardsapi.com/static/img/2C.png",
    "3C": "https://deckofcardsapi.com/static/img/3C.png",
    "4C": "https://deckofcardsapi.com/static/img/4C.png",
    "5C": "https://deckofcardsapi.com/static/img/5C.png",
    "6C": "https://deckofcardsapi.com/static/img/6C.png",
    "7C": "https://deckofcardsapi.com/static/img/7C.png",
    "8C": "https://deckofcardsapi.com/static/img/8C.png",
    "9C": "https://deckofcardsapi.com/static/img/9C.png",
    "0C": "https://deckofcardsapi.com/static/img/0C.png", 
    "JC": "https://deckofcardsapi.com/static/img/JC.png",
    "QC": "https://deckofcardsapi.com/static/img/QC.png",
    "KC": "https://deckofcardsapi.com/static/img/KC.png",
    "AC": "https://deckofcardsapi.com/static/img/AC.png",

    // Kartu Sekop
    "2S": "https://deckofcardsapi.com/static/img/2S.png",
    "3S": "https://deckofcardsapi.com/static/img/3S.png",
    "4S": "https://deckofcardsapi.com/static/img/4S.png",
    "5S": "https://deckofcardsapi.com/static/img/5S.png",
    "6S": "https://deckofcardsapi.com/static/img/6S.png",
    "7S": "https://deckofcardsapi.com/static/img/7S.png",
    "8S": "https://deckofcardsapi.com/static/img/8S.png",
    "9S": "https://deckofcardsapi.com/static/img/9S.png",
    "0S": "https://deckofcardsapi.com/static/img/0S.png", 
    "JS": "https://deckofcardsapi.com/static/img/JS.png",
    "QS": "https://deckofcardsapi.com/static/img/QS.png",
    "KS": "https://deckofcardsapi.com/static/img/KS.png",
    "AS": "https://deckofcardsapi.com/static/img/AS.png",
};

// Variabel game
let saldo = 5000;
let taruhan;
let totalPemain = 0;
let totalBandar = 0;
let kartuPemain = [];
let kartuBandar = [];
let kartuHoleBandar;
let permainanBerakhir = false;
let bandarBust = false;

// mulai game
document.getElementById('mulaiGame').addEventListener('click', function() {
    taruhan = parseInt(document.getElementById('taruhan').value);
    if (taruhan < 100 || taruhan > saldo) {
        document.getElementById('taruhanError').style.display = 'block';
        return;
    }
    document.getElementById('taruhanError').style.display = 'none';

    saldo -= taruhan;
    document.getElementById('saldo').innerText = saldo;
    document.getElementById('gameBoard').classList.remove('d-none');
    document.getElementById('mulaiGame').classList.add('d-none');
    document.getElementById('taruhan').style.display = 'none'; // Sembunyikan input taruhan
    document.getElementById('taruhan').value = ''; // Kosongkan input taruhan
    mulaiPermainan();
});

function mulaiPermainan() {
    totalPemain = 0;
    totalBandar = 0;
    kartuPemain = [];
    kartuBandar = [];
    permainanBerakhir = false;
    bandarBust = false;

    kartuPemain.push(ambilKartuRandom());
    kartuPemain.push(ambilKartuRandom());
    kartuBandar.push(ambilKartuRandom()); // Kartu upcard
    kartuHoleBandar = ambilKartuRandom(); // Kartu hole

    tampilkanKartuPemain();
    tampilkanKartuBandar();
}

function ambilKartuRandom() {
    const kodeKartu = Object.keys(gambarKartu)[Math.floor(Math.random() * Object.keys(gambarKartu).length)];
    return kodeKartu;
}

function tampilkanKartuPemain() {
    const areaKartuPemain = document.getElementById('kartuPemain');
    areaKartuPemain.innerHTML = ''; 
    totalPemain = 0;

    kartuPemain.forEach(kartu => {
        const img = document.createElement('img');
        img.src = gambarKartu[kartu];
        img.classList.add('kartu');
        areaKartuPemain.appendChild(img);

        totalPemain += hitungNilaiKartu(kartu);
    });

    document.getElementById('totalPemain').innerText = totalPemain;

    if (totalPemain > 21) {
        selesaiPermainan("Bust! Anda kalah.");
    }
}

function tampilkanKartuBandar(showAll = false) {
    const areaKartuBandar = document.getElementById('kartuBandar');
    areaKartuBandar.innerHTML = ''; // Kosongkan area kartu
    totalBandar = 0;

    kartuBandar.forEach(kartu => {
        const img = document.createElement('img');
        img.src = gambarKartu[kartu];
        img.classList.add('kartu');
        areaKartuBandar.appendChild(img);

        totalBandar += hitungNilaiKartu(kartu);
    });

    if (showAll) {
        const img = document.createElement('img');
        img.src = gambarKartu[kartuHoleBandar];
        img.classList.add('kartu');
        areaKartuBandar.appendChild(img);
        totalBandar += hitungNilaiKartu(kartuHoleBandar);
    } else {
        const img = document.createElement('img');
        img.src = "https://deckofcardsapi.com/static/img/back.png"; // Kartu tertutup
        img.classList.add('kartu');
        areaKartuBandar.appendChild(img);
    }

    document.getElementById('totalBandar').innerText = showAll ? totalBandar : "?";
}

function hitungNilaiKartu(kartu) {
    const nilai = kartu[0]; // karakter pertama

    if (nilai === 'A') return 11; 
    if (['K', 'Q', 'J', '0'].includes(nilai)) return 10; // Kartu wajah bernilai 10
    return parseInt(nilai); // Nilai untuk kartu 2-9
}

document.getElementById('ambilKartu').addEventListener('click', function() {
    kartuPemain.push(ambilKartuRandom());
    tampilkanKartuPemain();
});

document.getElementById('berhentiAmbil').addEventListener('click', function() {
    tampilkanKartuBandar(true);
    giliranBandar();
});

function giliranBandar() {
    while (totalBandar < 17) {
        kartuBandar.push(ambilKartuRandom());
        tampilkanKartuBandar(true);
    }

    if (totalBandar > 21) {
        bandarBust = true;
        selesaiPermainan("Bandar Bust! Anda menang.");
    } else {
        tentukanPemenang();
    }
}

function tentukanPemenang() {
    if (totalPemain > totalBandar) {
        selesaiPermainan("Selamat! Anda menang.");
    } else if (totalPemain < totalBandar) {
        selesaiPermainan("Anda kalah.");
    } else {
        selesaiPermainan("Seri!");
    }
}

// function selesaiPermainan(pesan) {
//     permainanBerakhir = true;
//     document.getElementById('pesanAkhir').innerText = pesan;
//     document.getElementById('gameOverMessage').style.display = 'block';
//     document.getElementById('gameBoard').classList.add('d-none');

//     if (pesan.includes("menang")) {
//         saldo += taruhan * 2;
//         document.getElementById('saldo').innerText = saldo;
//     }
// }

function selesaiPermainan(pesan) {
    permainanBerakhir = true;

    tampilkanKartuBandar(true);
    
    setTimeout(() => {
        document.getElementById('pesanAkhir').innerText = pesan;
        document.getElementById('gameOverMessage').style.display = 'block';
        document.getElementById('gameBoard').classList.add('d-none');

        if (pesan.includes("menang")) {
            saldo += taruhan * 2;
            document.getElementById('saldo').innerText = saldo;
        }
    }, 2000);
}


document.getElementById('resetGame').addEventListener('click', function() {
    if (saldo <= 99) {
        alert("Game Over! Saldo Anda habis.");
        location.reload();
    } else {
        document.getElementById('gameOverMessage').style.display = 'none';
        document.getElementById('mulaiGame').classList.remove('d-none');
        document.getElementById('taruhan').style.display = 'block'; // Tampilkan kembali input taruhan
        document.getElementById('taruhan').value = '';
        document.getElementById('kartuPemain').innerHTML = '';
        document.getElementById('kartuBandar').innerHTML = '';
        document.getElementById('totalPemain').innerText = '0';
        document.getElementById('totalBandar').innerText = '?';
    }
});
