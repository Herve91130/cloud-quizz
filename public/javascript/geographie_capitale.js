class Question {
    constructor(text, choices, answer) {
        this.text = text;
        this.choices = choices;
        this.answer = answer;
    }
    isCorrectAnswer(choice) {
        return this.answer === choice;
    }
}


let questions = [
    new Question("Quel est la capitale de la France ?", ["Paris", "Bruxelles", "Rome", "Londres"], "Paris"),
    new Question("Quel est la capitale du Brésil ?", ["Rio de Janeiro", "Caracas", "Brasilia", "Bogota"], "Brasilia"),
    new Question("Quel est la capitale de la Turquie ?", ["Jérusalem", "Ankara", "Beyrouth", "Athènes"], "Ankara"),
    new Question("Quel est la capitale de la Chine ?", ["Pékin", "Hanoï", "Tokyo", "Séoul"], "Pékin"),
    new Question("Quel est la capitale du Canada ?", ["Vancouver", "Wellington", "Cardiff", "Ottawa"], "Ottawa"),
    new Question("Quel est la capitale de l'Australie ?", ["Dublin", "Toronto", "Canberra", "New York"], "Canberra"),
    new Question("Quel est la capitale de l'Iran ?", ["Rabat", "Téhéran", "Le Caire", "Islamabad"], "Téhéran"),
];

class Quiz {
    constructor(questions) {
        this.score = 0;
        this.questions = questions;
        this.currentQuestionIndex = 0;
    }
    getCurrentQuestion() {
        return this.questions[this.currentQuestionIndex];
    }
    guess(answer) {
        if (this.getCurrentQuestion().isCorrectAnswer(answer)) {
            this.score++;
        }
        this.currentQuestionIndex++;
    }
    hasEnded() {
        return this.currentQuestionIndex >= this.questions.length;
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
        <h3 class="h3-jeux text-center"> Votre score est de : ${quiz.score} / ${quiz.questions.length}</h3>`;
        this.elementShown("quiz", endQuizHTML);
    },
    question: function () {
        this.elementShown("question", quiz.getCurrentQuestion().text);
    },
    choices: function () {
        let choices = quiz.getCurrentQuestion().choices;

        guessHandler = (id, guess) => {
            document.getElementById(id).onclick = function () {
                quiz.guess(guess);
                quizApp();
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
        this.elementShown("progress", "Question " + currentQuestionNumber + " sur " + quiz.questions.length);
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
let quiz = new Quiz(questions);
quizApp();