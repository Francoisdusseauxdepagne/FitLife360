const questions = [
    { question: "Quel muscle est communément appelé 'l'abdominal' ?", answers: ["Grand droit de l'abdomen", "Biceps brachial", "Quadriceps", "Deltoides"], correctAnswer: "Grand droit de l'abdomen" },
    { question: "Quel est le principal muscle travaillé lors des flexions (ou 'pompes') ?", answers: ["Pectoraux", "Ischio-jambiers", "Trapèzes", "Fessiers"], correctAnswer: "Pectoraux" },
    { question: "Combien de calories environ brûle-t-on en moyenne en faisant du jogging pendant 30 minutes ?", answers: ["150", "300", "450", "600"], correctAnswer: "300" },
    { question: "Quel est l'exercice principal pour travailler les muscles du dos ?", answers: ["Soulevé de terre", "Curl biceps", "Extensions lombaires", "Développé couché"], correctAnswer: "Soulevé de terre" },
    { question: "Quel est le nom de l'exercice qui cible principalement les quadriceps ?", answers: ["Fentes", "Curl ischio-jambiers", "Élévation latérale", "Curl quadriceps"], correctAnswer: "Fentes" },
    { question: "Quel sport fait partie des Jeux Olympiques d'hiver mais pas des Jeux Olympiques d'été ?", answers: ["Biathlon", "Athlétisme", "Natation", "Gymnastique"], correctAnswer: "Biathlon" },
    { question: "Quel est l'objectif principal de l'entraînement en circuit ?", answers: ["Force", "Endurance", "Flexibilité", "Vitesse"], correctAnswer: "Endurance" },
    { question: "Combien de temps faut-il en moyenne pour compléter un marathon ?", answers: ["2 heures", "4 heures", "6 heures", "8 heures"], correctAnswer: "4 heures" },
    { question: "Quel est le nom de l'exercice pour renforcer les abdominaux en position allongée sur le dos ?", answers: ["Crunch", "Burpees", "Planche", "Mountain climbers"], correctAnswer: "Crunch" },
    { question: "Quelle est la fonction principale des protéines dans l'alimentation d'un sportif ?", answers: ["Énergie", "Construction musculaire", "Hydratation", "Protection des os"], correctAnswer: "Construction musculaire" },
    { question: "Quel est le principal muscle de la colonne vertebrale ?", answers: ["Pectoraux", "Ischio-jambiers", "Trapèzes", "Fessiers"], correctAnswer: "Trapèzes" },
];

let currentQuestionIndex = 0;
let score = 0;
const questionElement = document.querySelector('#question');
const answersContainer = document.querySelector('#answers');
const progressElement = document.querySelector('#progress');
const scoreElement = document.querySelector('#score');

// Affichage de la première question
displayQuestion();

// Fonction pour afficher la question actuelle
function displayQuestion() {
    const currentQuestion = questions[currentQuestionIndex];
    questionElement.textContent = `Question ${currentQuestionIndex + 1} : ${currentQuestion.question}`;
    progressElement.textContent = `Question ${currentQuestionIndex + 1} sur ${questions.length}`;
    scoreElement.textContent = `Score : ${score}`;
    
    // Supprimer les réponses précédentes
    answersContainer.innerHTML = '';
    
    // Ajouter les nouvelles réponses
    currentQuestion.answers.forEach(answer => {
        const button = document.createElement('button');
        button.className = 'answer btn btn-outline-secondary';
        button.setAttribute('data-answer', answer);
        button.textContent = answer;
        button.addEventListener('click', handleAnswerClick);
        answersContainer.appendChild(button);
    });
}

// Gestionnaire de clic sur une réponse
function handleAnswerClick() {
    const selectedAnswer = this.getAttribute('data-answer');
    const currentQuestion = questions[currentQuestionIndex];

    if (selectedAnswer === currentQuestion.correctAnswer) {
        score++; // Augmenter le score si la réponse est correcte
    }
    
    // Passer à la question suivante
    currentQuestionIndex++;
    
    if (currentQuestionIndex < questions.length) {
        // Afficher la prochaine question si elle existe
        displayQuestion();
    } else {
        // Toutes les questions ont été répondues
        endQuiz();
    }
}

// Fonction pour terminer le quiz
function endQuiz() {
    questionElement.textContent = "Félicitations ! Vous avez terminé le quiz.";
    progressElement.textContent = `Quiz terminé !`;
    scoreElement.textContent = `Score final : ${score} / ${questions.length}`; ;
    // Effacer les réponses après avoir terminé
    answersContainer.innerHTML = '';
}
