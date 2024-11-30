let playerBalance = 5000;
let playerHand = [];
let dealerHand = [];
let deck = [];
let betAmount = 0;

function startGame() {
    const betInput = document.getElementById('bet-amount');
    betAmount = parseInt(betInput.value);

    if (isNaN(betAmount) || betAmount < 100) {
        alert("Bet must be at least $100!");
        return;
    }

    if (betAmount > playerBalance) {
        alert("You don't have enough balance!");
        return;
    }

    playerHand = [];
    dealerHand = [];
    deck = generateDeck();
    shuffleDeck(deck);
    
    playerHand.push(deck.pop(), deck.pop());
    dealerHand.push(deck.pop(), deck.pop());

    updateUI();
}

function hit() {
    playerHand.push(deck.pop());
    updateUI();

    if (calculateHand(playerHand) > 21) {
        endGame('lose');
    }
}

function stay() {
    while (calculateHand(dealerHand) < 17) {
        dealerHand.push(deck.pop());
    }
    
    if (calculateHand(dealerHand) > 21) {
        endGame('win');
    } else {
        checkWinner();
    }
}

function checkWinner() {
    const playerTotal = calculateHand(playerHand);
    const dealerTotal = calculateHand(dealerHand);

    if (playerTotal > dealerTotal) {
        endGame('win');
    } else if (playerTotal < dealerTotal) {
        endGame('lose');
    } else {
        endGame('push');
    }
}

function endGame(result) {
    if (result === 'win') {
        playerBalance += betAmount * 2;
        document.getElementById('game-over-message').textContent = 'You Win!';
    } else if (result === 'lose') {
        playerBalance -= betAmount;
        document.getElementById('game-over-message').textContent = 'You Lose!';
    } else {
        document.getElementById('game-over-message').textContent = 'Push!';
    }

    if (playerBalance <= 0) {
        document.getElementById('game-over-message').textContent = 'Game Over! You are out of money!';
        document.querySelector('button').disabled = true;
    }

    updateUI();
}

function calculateHand(hand) {
    let total = 0;
    let aceCount = 0;

    hand.forEach(card => {
        if (card.value === 'A') {
            aceCount++;
            total += 11;
        } else if (['J', 'Q', 'K'].includes(card.value)) {
            total += 10;
        } else {
            total += parseInt(card.value);
        }
    });

    while (total > 21 && aceCount > 0) {
        total -= 10;
        aceCount--;
    }

    return total;
}

function generateDeck() {
    const suits = ['C', 'D', 'H', 'S']; // Clubs, Diamonds, Hearts, Spades
    const values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
    const deck = [];

    for (let suit of suits) {
        for (let value of values) {
            deck.push({ value, suit });
        }
    }

    return deck;
}

function shuffleDeck(deck) {
    for (let i = deck.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [deck[i], deck[j]] = [deck[j], deck[i]];
    }
}

function updateUI() {
    document.getElementById('player-balance').textContent = `Balance: $${playerBalance}`;
    
    const playerCardsDiv = document.getElementById('player-cards');
    const dealerCardsDiv = document.getElementById('dealer-cards');

    // Hapus gambar kartu sebelumnya
    playerCardsDiv.innerHTML = '';
    dealerCardsDiv.innerHTML = '';

    // Tambahkan gambar kartu untuk pemain
    playerHand.forEach(card => {
        const cardImg = document.createElement('img');
        cardImg.src = `cards/cards/${card.value}-${card.suit}.png`;
        playerCardsDiv.appendChild(cardImg);
    });

    // Tambahkan gambar kartu untuk dealer
    dealerHand.forEach(card => {
        const cardImg = document.createElement('img');
        cardImg.src = `cards/cards/${card.value}-${card.suit}.png`;
        dealerCardsDiv.appendChild(cardImg);
    });
}
