<?php
// Inicia a sessão
session_start();

// Inclui config.php apenas uma vez
require_once 'config.php';

// Protege a página: só acessa se estiver logado
if (!isset($_SESSION['usuario_id'])) {
    header("location: login.php");
    exit;
}

// Conexão com o banco
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    error_log("Erro na conexão: " . $conn->connect_error);
    die("<h1>Erro ao conectar ao banco de dados. Tente novamente mais tarde.</h1>");
}

// Busca a pontuação total


$pontuacao_total = 0;
if (isset($_SESSION['usuario_id'])) {
    $stmt = $conn->prepare("SELECT pontuacao_total FROM pontuacoes WHERE usuario_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $_SESSION['usuario_id']);
        $stmt->execute();
        $stmt->bind_result($pontuacao_total_db);
        if ($stmt->fetch()) {
            $pontuacao_total = $pontuacao_total_db;
        }
        $stmt->close();
    }
}

$nome_usuario = isset($_SESSION['nome_usuario']) ? htmlspecialchars($_SESSION['nome_usuario']) : 'Convidado';

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Quiz Conheça Angola</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-red: #D90429;
            --color-black: #1a1a1a;
            --color-yellow: #FFD700;
            --color-white: #ffffff;
            --color-gray: #030303;
        }
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            background: var(--color-gray);
            color: var(--color-black);
        }
        header.app-header {
            background: linear-gradient(135deg, var(--color-red), var(--color-black));
            color: var(--color-white);
            text-align: center;
            padding: 40px 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            position: relative;
        }
        header.app-header h1 {
            font-size: 2.5rem;
            margin: 0 0 10px 0;
            color: var(--color-yellow);
            animation: fadeInDown 0.6s ease-in-out;
        }
        header.app-header p {
            font-size: 1.2rem;
            margin-bottom: 20px;
            animation: fadeIn 1s ease-in-out;
        }
        nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        nav .btn {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s ease;
        }
        nav .btn.primary {
            background: var(--color-yellow);
            color: var(--color-black);
        }
        nav .btn.primary:hover {
            background: #ffec80;
        }
        nav .btn.secondary {
            background: var(--color-white);
            color: var(--color-black);
            border: 2px solid var(--color-yellow);
        }
        nav .btn.secondary:hover {
            background: var(--color-yellow);
            color: var(--color-black);
        }
        nav .btn.ghost {
            background: transparent;
            color: var(--color-white);
            border: 2px solid var(--color-white);
        }
        nav .btn.ghost:hover {
            background: var(--color-white);
            color: var(--color-black);
        }
        main.quiz-selection {
            padding: 50px 20px;
            text-align: center;
        }
        .quiz-selection h2 {
            font-size: 2rem;
            margin-bottom: 40px;
            color: var(--color-red);
        }
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            max-width: 1000px;
            margin: 0 auto;
        }
        .category-card {
            background: var(--color-white);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }
        .category-card h3 {
            margin-bottom: 20px;
            font-size: 1.3rem;
            color: var(--color-black);
        }
        .category-card a {
            text-decoration: none;
            padding: 8px 16px;
            background: var(--color-red);
            color: var(--color-white);
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s ease;
        }
        .category-card a:hover {
            background: #a4031f;
        }
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        footer {
            background: var(--color-black);
            color: var(--color-white);
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }
        /* Animações */
        @keyframes fadeInUp {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        @keyframes fadeInDown {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }
        .top-buttons-dashboard {
    position: absolute;
    top: 20px;
    right: 20px;
    display: flex;
    z-index: 10;
}

.perfil-btn {
    padding: 10px 18px;
    background: var(--color-yellow);
    color: var(--color-black);
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    transition: .3s ease;
}

.perfil-btn:hover {
    background: #ffbe00;
    transform: scale(1.05);
}

    </style>
</head>
<body>
    <header class="app-header">
        <h1>Bem-vindo, <?php echo $nome_usuario; ?>!</h1>
        <p>Sua pontuação total: <span class="score-display"><?php echo $pontuacao_total; ?></span></p>
        <nav>
            <a href="quiz.php" class="btn primary">Começar Quiz</a>
            <a href="ranking.php" class="btn secondary">Ranking Global</a>
            <a href="logout.php" class="btn ghost">Sair</a>
        </nav>
        <div class="top-buttons-dashboard">
    <a href="perfil.php" class="btn perfil-btn">Meu Perfil</a>
</div>

    </header>
 <button onclick="togglePerfil()" style="position:absolute; top:20px; right:20px; background:#eee; border:none; padding:10px; border-radius:5px;">
  Perfil
</button>

<script>
function togglePerfil() {
  const modal = document.getElementById("perfilModal");
  modal.style.display = modal.style.display === "none" ? "block" : "none";
}
</script>

<script>
function togglePerfil() {
  const modal = document.getElementById("perfilModal");
  modal.style.display = modal.style.display === "none" ? "block" : "none";
}
</script>


    <main class="quiz-selection">
        <h2>Escolha uma Categoria para Jogar</h2>
        <div class="categories-grid">
            <?php
            $sql = "SELECT id, nome_categoria FROM categorias ORDER BY nome_categoria";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="category-card">';
                    echo '<h3>' . htmlspecialchars($row['nome_categoria']) . '</h3>';
                    echo '<a href="quiz.php?categoria_id=' . htmlspecialchars($row['id']) . '">Jogar</a>';
                    echo '</div>';
                }
            } else {
                echo "<p>Nenhuma categoria disponível no momento.</p>";
            }
            $conn->close();
            ?>
        </div>

    </main>


    <footer>
        <p>&copy; <?php echo date("Y"); ?> Quiz Conheça Angola. Todos os direitos reservados.</p>
    </footer>

    <script>
        // Faz animação dos cards em cascata
        document.querySelectorAll('.category-card').forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
            }, index * 150);
        });
</body>
</html>
