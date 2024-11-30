let totalBot = 0;    
let totalPemain = 0;

let jumlahKartuBotAS = 0;   
let jumlahKartuSayaAS = 0;

let kartu;             
let bisaAmbilKartu = true;  

const tombolMulaiPermainan = document.getElementById("startGame");
const tombolAmbilKartu = document.getElementById("takeCard");
const tombolTahanKartu = document.getElementById("holdCard");

const elemenTotalPemain = document.getElementsByClassName("userSums")[0];
const elemenKartuPemain = document.getElementsByClassName("userCards")[0];
let elemenUangPemain = document.getElementById("userMoney");
const inputUang = document.getElementsByTagName("input")[0];

const elemenTotalBot = document.getElementsByClassName("botSums")[0];
const elemenKartuBot = document.getElementsByClassName("botCards")[0];

const elemenHasil = document.getElementById("result");

window.onload = () => {
    buatKartuPemain();     
    acakKartu();     
    tombolAmbilKartu.setAttribute("disabled", true);
    tombolTahanKartu.setAttribute("disabled", true);
};

function buatKartuPemain() {
    let jenisKartu = ["H", "B", "S", "K"];
    let nilaiKartu = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "K", "Q", "J"];

    kartu = [];
    for (let i = 0; i < jenisKartu.length; i++) {          
        for (let j = 0; j < nilaiKartu.length; j++) {     
            kartu.push(nilaiKartu[j] + "-" + jenisKartu[i]);      
        }
    }
}

function acakKartu() {
    for (let i = 0; i < kartu.length; i++) {
        let nomorAcak = Math.floor(Math.random() * kartu.length);
        let a = kartu[i];
        kartu[i] = kartu[nomorAcak];
        kartu[nomorAcak] = a;
    }
}

tombolMulaiPermainan.addEventListener("click", function () {
    let uang = inputUang.value;
    if (uang === "" || isNaN(uang)) {
        alert("Atur taruhan Anda terlebih dahulu");
        return;
    } else if (uang < 100) {
        alert("Taruhan minimum adalah 100");
        return;
    } 
    else {
        if (elemenUangPemain.innerText == 0) {
            alert("Uang Anda Rp. 0, Silakan Tambahkan Uang Anda");
            return;
        } else if (uang > elemenUangPemain.innerText) {
            alert("Uang Anda kurang dari taruhan Anda");
            return;
        } 
    }
    
    if (tombolMulaiPermainan.textContent === "Try Again") {
        totalBot = 0;
        totalPemain = 0;
        jumlahKartuBotAS = 0;
        jumlahKartuSayaAS = 0;
        bisaAmbilKartu = true;


        const semuaGambarKartu = document.querySelectorAll("img");    
        for (let i = 0; i < semuaGambarKartu.length; i++) {           
            semuaGambarKartu[i].remove();   
        }

        let gambarKartu = document.createElement("img");
        gambarKartu.src = "assets/cards/BACK.png";
        gambarKartu.className = "hidden-card";
        elemenKartuBot.append(gambarKartu);                        

        buatKartuPemain();
        acakKartu();
    }

    tombolAmbilKartu.disabled = false;
    tombolTahanKartu.disabled = false;

    tombolMulaiPermainan.textContent = "Try Again";
    tombolMulaiPermainan.setAttribute("disabled", true);

    for (let i = 0; i < 2; i++) {
        let gambarKartu = document.createElement("img");
        let kartuDipilih = kartu.pop();                             
        gambarKartu.src = `assets/cards/${kartuDipilih}.png`;
        totalPemain += nilaiKartu(kartuDipilih);                     
        jumlahKartuSayaAS += cekKartuAS(kartuDipilih);                    
        elemenTotalPemain.textContent = totalPemain;                 
        elemenKartuPemain.append(gambarKartu);                     
    }
});

tombolAmbilKartu.addEventListener("click", function () {
    if (!bisaAmbilKartu) return;                         

    let gambarKartu = document.createElement("img");
    let kartuDipilih = kartu.pop();
    gambarKartu.src = `assets/cards/${kartuDipilih}.png`;
    totalPemain += nilaiKartu(kartuDipilih);
    jumlahKartuSayaAS += cekKartuAS(kartuDipilih);
    elemenTotalPemain.textContent = totalPemain;
    elemenKartuPemain.append(gambarKartu);

    if (kurangiNilaiKartuAS(totalPemain, jumlahKartuSayaAS) > 21) bisaAmbilKartu = false;

    if (totalPemain > 21) {
        tombolAmbilKartu.disabled = true;
        tombolTahanKartu.disabled = true;
        tombolMulaiPermainan.disabled = false;   
        alert("Yah Kalah");
        elemenUangPemain.textContent -= inputUang.value;
    }
});

tombolTahanKartu.addEventListener("click", function () {
    setTimeout(() => {
        document.getElementsByClassName("hidden-card")[0].remove();
    }, 1000);

    const tambahKartuBot = () => {
        setTimeout(() => {
            let gambarKartu = document.createElement("img");
            let kartuDipilih = kartu.pop();
            gambarKartu.src = `assets/cards/${kartuDipilih}.png`;
            totalBot += nilaiKartu(kartuDipilih);
            jumlahKartuBotAS += cekKartuAS(kartuDipilih);
            elemenKartuBot.append(gambarKartu);
            elemenTotalBot.textContent = totalBot;

            if (totalBot < 18) {
                tambahKartuBot();
            } else {
                totalBot = kurangiNilaiKartuAS(totalBot, jumlahKartuBotAS);
                totalPemain = kurangiNilaiKartuAS(totalPemain, jumlahKartuSayaAS);
                bisaAmbilKartu = false;

                setTimeout(() => {
                    let pesan = "";
                    let uang = parseInt(elemenUangPemain.textContent)
                    let uanginputan = inputUang.value
                    if (totalPemain > 21 || totalPemain % 22 < totalBot % 22) {
                        pesan = "KALAH!";
                        uang = parseInt(uang - uanginputan);
                        elemenUangPemain.textContent = uang;
                        console.log(uang);
                        console.log(totalBot);
                        console.log(totalPemain);
                        console.log(uang);
                    } else if (totalBot > 21 || totalPemain % 22 > totalBot % 22) {
                        pesan = "MENANG!!!";
                        uang = uang + ( parseInt(uanginputan) * 2);
                        elemenUangPemain.textContent = uang;
                        console.log(uang);
                        console.log(totalBot);
                        console.log(totalPemain);
                    } else if (totalPemain === totalBot){
                        pesan = "SERI";
                        elemenUangPemain.textContent = uang;
                    }
                        
                    console.log(uang);
                    
                    alert(pesan);
                    tombolMulaiPermainan.disabled = false;
                    tombolAmbilKartu.disabled = true;
                    tombolTahanKartu.disabled = true;
                }, 500);
            }
            
        }, 1000);
    };

    tambahKartuBot();
});

function hitungUang() {
    let uangmain = parseInt( elemenUangPemain.textContent)
    let dp = inputUang.value

    let hasil = uangmain - dp;
    elemenUangPemain.textContent= hasil
}

function nilaiKartu(kartu) {
    let rincianKartu = kartu.split("-");
    let nilai = rincianKartu[0];

    if (isNaN(nilai)) {
        if (nilai == "A") return 11;
        else return 10;
    }

    return parseInt(nilai);
}

function cekKartuAS(kartu) {
    if (kartu[0] == "A") return 11;
    else return 0;
}

function kurangiNilaiKartuAS(total, kartuAS) {
    while (total > 21 && kartuAS > 0) {
        total -= 10;
        kartuAS -= 1;
    }
    return total;
}