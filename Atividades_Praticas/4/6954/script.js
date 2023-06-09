const cards = document.querySelectorAll('.memory-card');

let hasFlippedCard = false;
let firstCard = null, secondCard = null;
let lockBoard = false;

function flipCard() {
    if (lockBoard) return;
    if(this === firstCard) return;

    this.classList.add('flip');

    // Primeira Carta
    if (!hasFlippedCard) {
        hasFlippedCard = true;
        firstCard = this;

        return;
    }

    // Segunda Carta
    hasFlippedCard = false;
    secondCard = this;

    checkForMatch();
}

function checkForMatch() {
    let isMatch = firstCard.dataset.framework === secondCard.dataset.framework;

    isMatch ? disableCards() : unflipCard();

}

function disableCards() {
    firstCard.removeEventListener('click', flipCard);
    secondCard.removeEventListener('click', flipCard);

    resetBoard();
}

function unflipCard() {
    lockBoard = true;

    setTimeout(() => {
        firstCard.classList.remove('flip');
        secondCard.classList.remove('flip');

        lockBoard = false;
    }, 1500)

}

function resetBoard() {
    [hasFlippedCard, lockBoard] = [false, false];
    [firstCard, secondCard] = [null, null]
}

function shuffle(){
    cards.forEach((card)=>{
        let randomPos = Math.floor(Math.random() * 12);
        card.style.order = randomPos;
    })
}

shuffle();

cards.forEach((card) => {
    card.addEventListener('click', flipCard)
})

