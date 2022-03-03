class Question {
    constructor(id, text, choices, answer) {
        this.text = text;
        this.choices = choices;
        this.answer = answer;
        this.id =id;
    }
    isCorrectAnswer(choice) {
        return this.answer === choice;
    }
}

class Quiz {
    constructor() {
        this.score = 0;
        this.currentQuestionIndex = 0;
        this.currentQuestion = null;
        this.totalLength = 0;
        this.quizz = null;
    }

    init(quizzId, afterInit) {

        //Appel AJAX vers le serveur
        fetch(`http://localhost:8000/jeux/quizz/${quizzId}/details`)
        .then((response) => {
            return response.json();
        })

        //Récupération des données
        .then((data) => {
            this.quizz = data;
            this.totalLength = data.count;
            this.currentQuestion = new Question(data.question.id, data.question.text, data.question.choices, data.question.answer);
            
            //Fonction callback qui permet d'etre sûr que les requêtes AJAX se sont bien executées
            afterInit();
        });
    }

    getCurrentQuestion() {
        return this.currentQuestion;
    }

    guess(answer, afterGuess) {
        if (this.getCurrentQuestion().isCorrectAnswer(answer)) {
            this.score++;
        }
        //Appel AJAX vers le serveur
        fetch(`http://localhost:8000/jeux/quizz/${this.quizz.id}/questions/${this.currentQuestion.id}/next`)
        .then((response) => {
            return response.json();
        })

        //Récupération des données
        .then((data) => {
            this.currentQuestion = new Question(data.id, data.text, data.choices, data.answer);
            afterGuess();
        });
    }

    hasEnded() {
        return this.currentQuestionIndex >= this.totalLength;
    }
}

const display = {
    elementShown: function (id, text) {
        let element = document.getElementById(id);
        element.innerHTML = text;
    },
    endQuiz: function () {
        endQuizHTML = `
        <h1 class="h1-jeux text-center">Quizz <span class="m">Gé</span><span class="j">og</span><span class="b">ra</span><span class="r">ph</span><span class="m">ie</span>: <span class="j">Ca</span><span class="r">pi</span><span class="m">ta</span><span class="b">le</span> terminé !</h1>
        <h3 class="h3-jeux text-center"> Votre score est de : ${quiz.score} / ${quiz.totalLength}</h3>`;
        this.elementShown("quiz", endQuizHTML);
    },
    question: function () {
        this.elementShown("question", quiz.getCurrentQuestion().text);
    },
    choices: function () {
        let choices = quiz.getCurrentQuestion().choices;

        guessHandler = (id, guess) => {
            document.getElementById(id).onclick = function () {
                quiz.guess(guess, () => {
                    quizApp();
                });
            }
        }
        // affichage choix + prise en compte du choix
        for (let i = 0; i < choices.length; i++) {
            this.elementShown("choice" + i, choices[i]);
            guessHandler("guess" + i, choices[i]);
        }
    },
    progress: function () {
        let currentQuestionNumber = quiz.currentQuestionIndex + 1;
        this.elementShown("progress", "Question " + currentQuestionNumber + " sur " + quiz.totalLength);
    },
};

// Game logic
quizApp = () => {
    if (quiz.hasEnded()) {
        display.endQuiz();
    } else {
        display.question();
        display.choices();
        display.progress();
    }
}
// Create Quiz
let quiz = new Quiz();
quiz.init(1, () => {
    quizApp();
});
