<?php
session_start();
require_once 'config.php';

// Redirecionar se o usuário não estiver logado
if (!isset($_SESSION['usuario_id'])) {
    header("location: login.php");
    exit;
}

$categoria_id = isset($_GET['categoria_id']) ? intval($_GET['categoria_id']) : 0;
$categoria_nome = "Todas as Categorias";

if ($categoria_id > 0) {
    $stmt_cat = $conn->prepare("SELECT nome_categoria FROM categorias WHERE id = ?");
    $stmt_cat->bind_param("i", $categoria_id);
    $stmt_cat->execute();
    $stmt_cat->bind_result($cat_name);
    if ($stmt_cat->fetch()) {
        $categoria_nome = htmlspecialchars($cat_name);
    }
    $stmt_cat->close();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - <?php echo $categoria_nome; ?></title>
    <link rel="stylesheet" href="cssq/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        /* ====== CONTADOR ESTILIZADO ====== */
        .status-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1.5rem;
            margin-top: 10px;
            flex-wrap: wrap;
        }
/* ====== ESTILO GERAL ====== */
body {
    background: linear-gradient(180deg, #000000 0%, #2e2e2e 100%);
    color: #111010;
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
}

/* ====== TÍTULOS ====== */
h1, h2 {
    color: #ffcc00;
    text-align: center;
    margin-bottom: 20px;
}

/* ====== BOTÕES ====== */
.btn {
    background: #d32f2f;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}
.btn:hover {
    background: #b71c1c;
    box-shadow: 0 0 12px #ff4444;
}

/* ====== PERGUNTAS ====== */
.pergunta {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    opacity: 0;
    transform: translateX(50px) scale(0.9);
    transition: all 0.5s ease-in-out;
}
.pergunta.active {
    opacity: 1;
    transform: translateX(0) scale(1);
}

/* ====== OPÇÕES ====== */
.option-item {
    background: #000; /* preto intenso */
    color: #fff;
    border: 2px solid #ffcc00; /* contorno dourado elegante */
    border-radius: 12px;
    padding: 12px 18px;
    margin: 10px 0;
    cursor: pointer;
    font-weight: 500;
    box-shadow: 0 0 10px rgba(255, 204, 0, 0.1);
    transition: all 0.3s ease;
}

.option-item:hover {
    background: #111;
    border-color: #ffd700;
    transform: translateY(-2px);
    box-shadow: 0 0 15px #ffcc00, 0 0 25px rgba(255, 204, 0, 0.2);
}

/* resposta correta */
.option-item.correct {
    background: #008000 !important;
    border-color: #00ff7f !important;
    color: #fff !important;
    font-weight: bold;
    animation: correctPop 0.4s ease forwards;
}

/* resposta incorreta */
.option-item.incorrect {
    background: #b22222 !important;
    border-color: #ff6347 !important;
    color: #fff !important;
    font-weight: bold;
    animation: incorrectShake 0.4s ease forwards;
}

/* ====== CONTADOR ====== */
.status-bar {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1.5rem;
    margin-top: 10px;
    flex-wrap: wrap;
}

.status-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: linear-gradient(145deg, #1a1a1a, #2e2e2e);
    color: #fff;
    padding: 12px 20px;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
    min-width: 100px;
    transition: all 0.3s ease-in-out;
}

.status-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
}

.status-item .label {
    font-size: 0.8rem;
    text-transform: uppercase;
    color: #ccc;
}

.status-item .value {
    font-size: 1.8rem;
    font-weight: bold;
    color: #ffcc00;
    transition: color 0.3s, transform 0.2s;
}

.status-item .unit {
    font-size: 0.8rem;
    margin-top: -5px;
    color: #aaa;
}

/* cores do timer */
.timer-box .value {
    color: #4CAF50;
}

.timer-box.warning .value {
    color: #ffcc00;
}

.timer-box.critical .value {
    color: #ff3b3b;
    animation: pulse 0.8s infinite;
}

/* ====== ANIMAÇÕES ====== */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

@keyframes correctPop {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

@keyframes incorrectShake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    50% { transform: translateX(5px); }
    75% { transform: translateX(-5px); }
    100% { transform: translateX(0); }
}

/* ====== FOOTER ====== */
footer {
    text-align: center;
    margin-top: 30px;
    padding: 15px;
    border-top: 1px solid #444;
    font-size: 0.9rem;
    color: #ccc;
}

/* ====== RESPONSIVO ====== */
@media (max-width: 768px) {
    .status-bar {
        gap: 1rem;
    }
    .status-item {
        min-width: 80px;
        padding: 10px 12px;
    }
    .option-item {
        padding: 10px 14px;
        font-size: 0.9rem;
    }
    h1, h2 {
        font-size: 1.6rem;
    }
}

    </style>
</head>

<body>
    <header class="app-header">
        <div class="container" style="text-align:center;">
            <h1>Quiz: <?php echo $categoria_nome; ?></h1>

            <div class="status-bar">
                <div class="status-item score-box">
                    <span class="label">Pontuação</span>
                    <span id="current-score" class="value">0</span>
                </div>
                <div class="status-item correct-box">
                    <span class="label">Certas</span>
                    <span id="correct-count" class="value">0</span>
                </div>
                <div class="status-item timer-box">
                    <span class="label">Tempo</span>
                    <span id="timer" class="value">60</span>
                    <span class="unit">s</span>
                </div>
            </div>

            <nav style="margin-top:15px;">
                <a href="dashboard.php" class="btn ghost">Voltar ao Dashboard</a>
                <a href="logout.php" class="btn ghost">Sair</a>
            </nav>
            <br>
        </div>
    </header>

    <main class="container quiz-container">
        <div id="quiz-area">
            <div class="question-area">
                <h2 id="question-text">Carregando pergunta...</h2>
                <img id="question-image" src="" alt="Imagem da pergunta" style="max-width:100%; height:auto; margin-top:15px; display:none;">
                <audio id="question-audio" controls style="width:100%; margin-top:15px; display:none;">
                    <source src="" type="audio/mpeg">
                    Seu navegador não suporta o elemento de áudio.
                </audio>
            </div>

            <ul class="options-list" id="options-list"></ul>

            <div class="quiz-navigation">
                <button id="next-question-btn" disabled>Próxima Pergunta</button>
            </div>

            <div id="feedback-area" style="margin-top: 20px; font-weight: bold;"></div>
        </div>

        <div id="quiz-results" style="display:none; text-align:center;">
            <h2>Quiz Finalizado!</h2>
            <p>Sua pontuação nesta rodada: <span id="final-score">0</span></p>
            <p>Sua pontuação total acumulada: <span id="total-accumulated-score">0</span></p>
            <br>
            <a href="quiz.php?categoria_id=<?php echo $categoria_id; ?>" class="btn primary">Jogar Novamente</a>
            <a href="dashboard.php" class="btn secondary">Voltar ao Dashboard</a>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Quiz Conheça Angola. Todos os direitos reservados.</p>
    </footer>

    <script>
let currentQuestionIndex = 0;
let questions = [];
let score = 0;
let answeredQuestionsCount = 0;
let correctAnswersCount = 0;

const maxQuestions = 15;

// ⏱️ TEMPO GLOBAL (NÃO REINICIA)
let timeLeft = 60;
let timerInterval;
let paused = false;

// =========================
// TIMER (RODA UMA VEZ)
// =========================
function startTimer() {

    const timerBox = document.querySelector('.timer-box');

    timerInterval = setInterval(() => {

        if (answeredQuestionsCount >= maxQuestions) {
            clearInterval(timerInterval);
            return;
        }

        if (!paused) {

            timeLeft--;

            $('#timer').text(timeLeft);

            let percent = (timeLeft / 30) * 100;
            $('#barraTempo').css('width', percent + '%');

            timerBox.classList.remove('warning', 'critical');

            // ⚠️ 5 SEGUNDOS — ALERTA FORTE
            if (timeLeft <= 5 && timeLeft > 0) {
                timerBox.classList.add('critical');

                // opcional: piscar rápido
                $('#timer').css('animation', 'pulse 0.5s infinite');
            }

            // ⏰ TEMPO ACABOU
            if (timeLeft <= 0) {

                clearInterval(timerInterval);

                gameOverTime(); // 💀 FINALIZA QUIZ
            }
        }

    }, 1000);
}

// =========================
// CARREGAR PERGUNTA
// =========================
function loadQuestion() {
    if (answeredQuestionsCount >= maxQuestions) {
        showResults();
        return;
    }

    const categoryId = <?php echo $categoria_id; ?>;

    $.ajax({
        url: 'get_question.php',
        type: 'GET',
        data: { current_question_index: currentQuestionIndex, category_id: categoryId },
        dataType: 'json',

        success: function(response) {
            if (response.question) {
                questions.push(response.question);

                displayQuestion(response.question);

                $('#next-question-btn').prop('disabled', true);
                $('#feedback-area').text('');
            } else {
                showResults();
            }
        }
    });
}

// =========================
// MOSTRAR PERGUNTA
// =========================
function displayQuestion(questionData) {
    $('#question-text').text(questionData.pergunta_texto);
    $('#options-list').empty();

    $('#question-image').hide().attr('src', '');
    $('#question-audio').hide().attr('src', '');

    if (questionData.caminho_imagem) {
        $('#question-image')
            .attr('src', 'uploads/images/' + questionData.caminho_imagem)
            .show();
    }

    if (questionData.caminho_audio) {
        $('#question-audio source')
            .attr('src', 'uploads/audio/' + questionData.caminho_audio);
        $('#question-audio')[0].load();
        $('#question-audio').show();
    }

    questionData.opcoes.forEach(function(opcao) {
        const item = $('<li class="option-item" data-id="' + opcao.id + '">' + opcao.opcao_texto + '</li>');
        $('#options-list').append(item);
    });

    $('.option-item').off('click').on('click', handleOptionClick);
}

// =========================
// CLICK NA RESPOSTA
// =========================
function handleOptionClick() {
    paused = true; // ⏸️ pausa tempo

    $('.option-item').off('click');

    const selectedElement = $(this);
    const questionData = questions[answeredQuestionsCount];
    const selectedId = selectedElement.data('id');

    checkAnswer(selectedId, questionData.id, questionData.tipo_pergunta, selectedElement);
}

// =========================
// VERIFICAR RESPOSTA
// =========================
function checkAnswer(selectedOptionId, questionId, tipo_pergunta, selectedElement) {

    $.ajax({
        url: 'check_answer.php',
        type: 'POST',
        data: {
            question_id: questionId,
            selected_option_id: selectedOptionId,
            tipo_pergunta: tipo_pergunta
        },
        dataType: 'json',

        success: function(response) {
            answeredQuestionsCount++;

            if (response.is_correct) {
                score += 10;
                correctAnswersCount++;

                $('#correct-count').text(correctAnswersCount);
                $('#feedback-area').text('✔ Correto!').css('color', 'green');

                selectedElement.addClass('correct');
            } else {
                $('#feedback-area')
                    .text('✖ Incorreto! Resposta: ' + response.correct_answer_text)
                    .css('color', 'red');

                selectedElement.addClass('incorrect');
                $('.option-item[data-id="' + response.correct_answer_id + '"]').addClass('correct');
            }

            $('#current-score').text(score);
            $('#next-question-btn').prop('disabled', false);
        }
    });
}

// =========================
// TEMPO ESGOTADO
// =========================
function gameOverTime() {

    paused = true;

    $('.option-item').off('click');

    $('#feedback-area')
        .text('💀 TEMPO ESGOTADO! QUIZ FINALIZADO!')
        .css('color', 'red');

    $('#next-question-btn').prop('disabled', true);

    // trava total do jogo
    setTimeout(() => {
        showResults(); // 🏆 finaliza automaticamente
    }, 1500);
}

// =========================
// PRÓXIMA PERGUNTA
// =========================
$('#next-question-btn').on('click', function() {

    if (timeLeft <= 0) return; // 🔒 bloqueia se acabou tempo

    paused = false;
    currentQuestionIndex++;
    loadQuestion();
});


// =========================
// RESULTADO FINAL
// =========================
function showResults() {
    clearInterval(timerInterval);

    $('#quiz-area').hide();
    $('#quiz-results').show();

    $('#final-score').text(score);

    // 🔥 mensagem de parabéns/incentivo
    const finalMessage = getFinalMessage(score, correctAnswersCount);

    // cria ou atualiza mensagem
    if ($('#final-message').length === 0) {
        $('#quiz-results').prepend(`
            <h3 id="final-message" style="margin-bottom:15px; color:#ffcc00;"></h3>
        `);
    }

    $('#final-message').text(finalMessage);

    $.ajax({
        url: 'update_total_score.php',
        type: 'POST',
        data: { score_earned: score },
        dataType: 'json',

        success: function(response) {
            if (response.success) {
                $('#total-accumulated-score').text(response.new_total_score);
            }
        }
    });
}

// =========================
// INICIAR
// =========================
$(document).ready(function() {
    loadQuestion();
    startTimer(); // 🔥 começa uma única vez
});
function getFinalMessage(score, correct) {
    let msg = "";

    if (correct === 15) {
        msg = "🏆 INCRÍVEL! Acertaste todas as 15 perguntas! És um verdadeiro campeão!";
    } 
    else if (correct >= 12) {
        msg = "🔥 EXCELENTE! Quase perfeito! Continua assim!";
    } 
    else if (correct >= 8) {
        msg = "👏 BOM TRABALHO! Tens um bom conhecimento!";
    } 
    else if (correct >= 5) {
        msg = "🙂 NÃO FOI MAL! Mas podes melhorar com prática!";
    } 
    else {
        msg = "💪 NÃO DESISTAS! Continua a treinar e vais melhorar!";
    }

    return msg;
}

    </script>
</body>
</html>
