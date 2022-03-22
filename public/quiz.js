const startButton = document.getElementById('start-btn')
const nextButton = document.getElementById('next-btn')
const homeButton = document.getElementById('home-btn')

const questionContainerElement = document.getElementById('question-container')
const questionElement = document.getElementById('question')
const answerButtonsElement = document.getElementById('answer-buttons')

let shuffledQuestions, currentQuestionIndex

startButton.addEventListener('click', startGame)
nextButton.addEventListener('click', () => {
    currentQuestionIndex++
    setNextQuestion()
})

function startGame(){
    console.log('Started')
    startButton.classList.add('hide')
    shuffledQuestions = questions.sort(() => Math.random() - .5)
    currentQuestionIndex = 0
    questionContainerElement.classList.remove('hide')
    setNextQuestion()
}

function setNextQuestion(){
    resetState()
    showQuestion(shuffledQuestions[currentQuestionIndex])
}

function showQuestion(question) {
    questionElement.innerText = question.question
    question.answers.forEach(answer => {
      const button = document.createElement('button')
      button.innerText = answer.text
      button.classList.add('btn')
      if (answer.correct) {
        button.dataset.correct = answer.correct
      }
      button.addEventListener('click', selectAnswer)
      answerButtonsElement.appendChild(button)
    })
  }

function resetState(){
    nextButton.classList.add('hide')
    while (answerButtonsElement.firstChild){
        answerButtonsElement.removeChild
        (answerButtonsElement.firstChild)
    }
}

function selectAnswer(e){
    const selectedButton = e.target
    const correct = selectedButton.dataset.correct
    setStatusClass(document.body, correct)
    Array.from(answerButtonsElement.children).forEach(button => {
        setStatusClass(button, button.dataset.correct)
    })
    if (shuffledQuestions.length > currentQuestionIndex + 1){
        nextButton.classList.remove('hide')
    } else {
        startButton.innerText ='Restart'
        startButton.classList.remove('hide')
    }
}

function setStatusClass(element, correct){
    clearStatusClass(element)
    if(correct){
        element.classList.add('correct')
    } else{
        element.classList.add('wrong')}
}

function clearStatusClass(element){
    
    element.classList.remove('correct')

    element.classList.remove('wrong')
}

const questions  = [
    {
        question: 'Which team has won the most Premier League titles?',
        answers:[
            {text: 'Manchester United', correct: true},
            {text: 'Arsenal', correct: false},
            {text: 'Liverpool', correct: false},
            {text: 'Chelsea', correct: false},
        ]
    },
    {
        question: 'What is the most points a team have ever scored in a season?',
        answers:[
            {text: '99', correct: false},
            {text: '103', correct: false},
            {text: '100', correct: true},
            {text: '98', correct: false},
        ]
    },
    {
        question: 'Who has the record for the most goals scored in the Premier League era?',
        answers:[
            {text: 'Thierry Henry', correct: false},
            {text: 'Alan Shearer', correct: true},
            {text: 'Wayne Rooney', correct: false},
            {text: 'Sergio Agüero', correct: false},
        ]
    },
    {
        question: 'Which player has accumulated the most Premier League appearences?',
        answers:[
            {text: 'John Terry', correct: false},
            {text: 'Frank Lampard', correct: false},
            {text: 'Gareth Barry', correct: true},
            {text: 'Ryan Giggs', correct: false},
        ]
    },
    {
        question: 'How many games did Arsenal win in their invincible season?',
        answers:[
            {text: '26', correct: true},
            {text: '38', correct: false},
            {text: '32', correct: false},
            {text: '29', correct: false},
        ]
    },
    {
        question: 'Chelsea have the record for the least amount of goals conceded in a season, but how many was it?',
        answers:[
            {text: '10', correct: false},
            {text: '13', correct: false},
            {text: '16', correct: false},
            {text: '15', correct: true},
        ]
    },
    {
        question: 'In 2007/08 Derby reached the lowest points tally every in a Premier League season. How many did they score?',
        answers:[
            {text: '9', correct: false},
            {text: '11', correct: true},
            {text: '10', correct: false},
            {text: '15', correct: false},
        ]
    },
    {
        question: 'Which player has won the msot Premier League titles as captain?',
        answers:[
            {text: 'Roy Keane', correct: false},
            {text: 'John Terry', correct: true},
            {text: 'Vincent Kompany', correct: false},
            {text: 'Patrick Vieira', correct: false},
        ]
    },
    {
        question: 'Which player has scored the most Premier League hat-tricks?',
        answers:[
            {text: 'Haarry Kane', correct: false},
            {text: 'Thierry Henry', correct: false},
            {text: 'Alan Shearer', correct: false},
            {text: 'Sergio Agüero', correct: true},
        ]
    },
    {
        question: 'Which goalkeeper has kept the most clean sheets in the Premier League?',
        answers:[
            {text: 'Petr Cech', correct: true},
            {text: 'Brad Friedel', correct: false},
            {text: 'David James', correct: false},
            {text: 'Mark Schwarzer', correct: false},
        ]
    }

]