let playerMoney = 5000;
let bet = 100;
let deck = [];
let playerHand = [];
let dealerHand = [];

const suits = ['C', 'D', 'H', 'S'];
const values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

function createDeck() {
    deck = [];
    for (let suit of suits) {
        for (let value of values) {
            deck.push({ value, suit });
        }
    }
}

function shuffleDeck() {
    for (let i = deck.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [deck[i], deck[j]] = [deck[j], deck[i]];
    }
}

document.getElementById('bet-input').addEventListener('input', (e) => {
    bet = parseInt(e.target.value);
    document.getElementById('bet-display').innerText = `Your Bet: $${bet}`;
});

function resetCardsAndScores() {
    document.getElementById('player-cards').innerHTML = '';
    document.getElementById('dealer-cards').innerHTML = '';
    document.getElementById('player-score').innerText = '';
    document.getElementById('dealer-score').innerText = '';

    document.getElementById('player-hand-info').style.display = 'none';
    document.getElementById('dealer-hand-info').style.display = 'none';
}

function displayCards(hand, elementId, hideSecondCard = false) {
    const handContainer = document.getElementById(elementId);
    handContainer.innerHTML = '';

    hand.forEach((card, index) => {
        const cardImage = document.createElement('img');
        if (hideSecondCard && index === 1) {
            cardImage.src = 'assets/back.png'; // Ganti dengan path gambar kartu belakang
        } else {
            cardImage.src = `assets/${card.value}-${card.suit}.png`; // Ganti dengan path gambar kartu
        }

        cardImage.alt = `${card.value} of ${card.suit}`;
        cardImage.style.height = '130px';
        cardImage.classList.add('new-card');

        handContainer.appendChild(cardImage);
    });
}

function calculateScore(hand) {
    let score = 0;
    let aceCount = 0;

    hand.forEach(card => {
        if (card.value === 'A') {
            score += 11;
            aceCount++;
        } else if (['K', 'Q', 'J'].includes(card.value)) {
            score += 10;
        } else {
            score += parseInt(card.value);
        }
    });

    while (score > 21 && aceCount > 0) {
        score -= 10;
        aceCount--;
    }
    return score;
}

function updateScores() {
    const playerScore = calculateScore(playerHand);
    document.getElementById('player-score').innerText = `${playerScore}`;

    if (dealerHand.length > 0) {
        const dealerVisibleScore = calculateScore([dealerHand[0]]);
        const dealerScoreText = `${dealerVisibleScore}`;
        document.getElementById('dealer-score').innerText = dealerScoreText;
    }
}

function hit() {
    if (deck.length > 0) {
        const newCard = deck.pop();
        playerHand.push(newCard);
        displayCards(playerHand, 'player-cards');
        const playerScore = calculateScore(playerHand);
        updateScores();

        if (playerScore > 21) {
            const finalDealerScore = calculateScore(dealerHand);
            document.getElementById('dealer-score').innerText = `${finalDealerScore}`;
            endGame('Player busts! Dealer wins.');
        }
    } else {
        alert("No cards left in the deck.");
    }
}

function stay() {
    displayCards(dealerHand, 'dealer-cards', false);

    let dealerScore = calculateScore(dealerHand);
    while (dealerScore < 17 && deck.length > 0) {
        dealerHand.push(deck.pop());
        dealerScore = calculateScore(dealerHand);
        displayCards(dealerHand, 'dealer-cards');
    }
    updateScores();
    determineWinner();
}

function addBet() {
    const betInput = document.getElementById('bet-input');
    bet = parseInt(betInput.value);

    if (isNaN(bet) || bet < 100 || bet > playerMoney) {
        alert('Please enter a valid bet amount!');
        return;
    }

    createDeck();
    shuffleDeck();
    resetCardsAndScores();

    playerHand = [deck.pop(), deck.pop()];
    dealerHand = [deck.pop(), deck.pop()];

    displayCards(playerHand, 'player-cards');
    displayCards(dealerHand, 'dealer-cards', true);
    updateScores();

    document.getElementById('player-hand-info').style.display = 'block';
    document.getElementById('dealer-hand-info').style.display = 'block';

    document.getElementById('deal-button').disabled = true;
    betInput.disabled = true;

    document.getElementById('hit-button').disabled = false;
    document.getElementById('stay-button').disabled = false;
}

function showModal(result, message, delay) {
    document.getElementById('modal-result').innerText = result;
    document.getElementById('modal-message').innerText = message;
    setTimeout(() => {
        $('#resultModal').modal('show'); // Show the modal after the delay
    }, delay);
}

function closeModal() {
    resetCardsAndScores();
    $('#resultModal').modal('hide');
}

function determineWinner() {
    const playerScore = calculateScore(playerHand);
    const dealerScore = calculateScore(dealerHand);
    if (dealerScore > 21) {
        endGame('Dealer busts! Player wins.');
    } else if (playerScore > 21) {
        endGame('Player busts! Dealer wins.');
    } else if (playerScore > dealerScore) {
        endGame('Player wins!');
    } else if (playerScore < dealerScore) {
        endGame('Dealer wins.');
    } else {
        endGame('It\'s a draw.');
    }
}

function endGame(result) {
    displayCards(dealerHand, 'dealer-cards', false);

    const finalDealerScore = calculateScore(dealerHand);
    document.getElementById('dealer-score').innerText = `${finalDealerScore}`;

    if (result.includes('Player wins')) {
        playerMoney += bet * 2;
        if (result.includes('busts')) {
            showModal('Dealer busts! You Win! Congratulations!', `You've gained $${bet * 2}`, 1000);
        } else {
            showModal('You Win! Congratulations!', `You've gained $${bet * 2}`, 1000);
        }
    } else if (result.includes('Dealer wins')) {
        playerMoney -= bet;
        if (playerMoney < 100) {
            showModal('Game Over', 'You don’t have enough money left for the minimum bet. We\'re gonna reset the game', 1000);
            setTimeout(resetGame, 5000);
        } else if (result.includes('busts')) {
            showModal('You busts! Dealer Wins! Try Again!', `You've lose $${bet}`, 1000);
        } else { 
            showModal('Dealer Win! Try again!', `You've lose $${bet}`, 1000);           
        }  
    } else {
        showModal('It’s a Draw!', 'No money lost or won. Your bet is returned.', 1000);
    }

    document.getElementById('money-display').innerText = `Your Money: $${playerMoney}`;

    const betInput = document.getElementById('bet-input');
    betInput.disabled = false;
    betInput.value = bet;

    document.getElementById('deal-button').disabled = false;
    document.getElementById('stay-button').disabled = true;
    document.getElementById('hit-button').disabled = true;
}

function resetGame() {
    playerMoney = 5000;
    bet = 100;
    document.getElementById('money-display').innerText = `Your Money: $${playerMoney}`;
    document.getElementById('bet-display').innerText = `Your Bet: $${bet}`;

    resetCardsAndScores();

    document.getElementById('deal-button').disabled = false;

    document.getElementById('hit-button').disabled = true;
    document.getElementById('stay-button').disabled = true;
}

document.getElementById('hit-button').addEventListener('click', hit);
document.getElementById('stay-button').addEventListener('click', stay);
document.getElementById('deal-button').addEventListener('click', addBet);