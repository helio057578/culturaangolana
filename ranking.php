<?php
session_start();
require_once 'config.php';

// Verifica a conexão com o banco de dados
if (!isset($conn) || $conn->connect_error) {
    http_response_code(500);
    echo "Erro na conexão com o banco de dados.";
    exit;
}

// ID do usuário logado (se houver)
$logged_in_user_id = isset($_SESSION['usuario_id']) ? intval($_SESSION['usuario_id']) : null;
$logged_in_user_name = null;
$logged_in_user_score = null;
$logged_in_user_position = null;

if ($logged_in_user_id) {
    // Busca nome e pontuação do usuário logado (se existir)
    $stmt = $conn->prepare(
        "SELECT u.nome_usuario, p.pontuacao_total
         FROM usuarios u
         LEFT JOIN pontuacoes p ON p.usuario_id = u.id
         WHERE u.id = ?"
    );

    if ($stmt) {
        $stmt->bind_param('i', $logged_in_user_id);
        $stmt->execute();
        $stmt->bind_result($logged_in_user_name, $logged_in_user_score);
        $stmt->fetch();
        $stmt->close();
    }

    // Se o usuário tiver uma pontuação, calcula a posição usando a mesma ordenação (pontuação desc, nome asc)
    if ($logged_in_user_score !== null) {
        $pos_stmt = $conn->prepare(
            "SELECT COUNT(*) + 1 AS pos
             FROM (
                 SELECT p.pontuacao_total, u.nome_usuario
                 FROM pontuacoes p
                 JOIN usuarios u ON p.usuario_id = u.id
             ) AS ranking
             WHERE (ranking.pontuacao_total > ?) OR (ranking.pontuacao_total = ? AND ranking.nome_usuario < ?)"
        );

        if ($pos_stmt) {
            $pos_stmt->bind_param('iis', $logged_in_user_score, $logged_in_user_score, $logged_in_user_name);
            $pos_stmt->execute();
            $pos_stmt->bind_result($logged_in_user_position);
            $pos_stmt->fetch();
            $pos_stmt->close();
        }
    }
}

// Busca top 20 jogadores
$top_stmt = $conn->prepare(
    "SELECT u.id, u.nome_usuario, p.pontuacao_total
     FROM pontuacoes p
     JOIN usuarios u ON p.usuario_id = u.id
     ORDER BY p.pontuacao_total DESC, u.nome_usuario ASC
     LIMIT 20"
);

$top_players = [];
if ($top_stmt) {
    $top_stmt->execute();
    $result = $top_stmt->get_result();
    if ($result) {
        $top_players = $result->fetch_all(MYSQLI_ASSOC);
    }
    $top_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ranking Global — Top jogadores do Quiz Conheça Angola. Veja as melhores pontuações e sua posição no ranking.">
    <title>Ranking Global - Quiz Conheça Angola</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="cssq/style.css">
    <style>
        /* Pequenas melhorias de responsividade local. Pode mover para css/style.css se preferir. */
        .table-responsive { overflow-x: auto; }
        .ranking-table { width: 100%; border-collapse: collapse; }
        .ranking-table th, .ranking-table td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #e6e6e6; }
        .ranking-table th { background: #0c0c0cff; }
        .highlight { background-color: #fff7e6; font-weight: 700; }
        @media (max-width: 600px) {
            .ranking-table th, .ranking-table td { font-size: 0.95rem; }
        }
        .user-position { margin-top: 1rem; padding: 0.75rem; border-radius: 6px; background: #f1f1f1; }
    </style>
</head>
<body>
    <header class="app-header">
        <div class="container">
            <h1>Ranking Global</h1>
            <nav>
                <a href="<?php echo isset($_SESSION['usuario_id']) ? 'dashboard.php' : 'index.php'; ?>" class="btn ghost">Voltar</a>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <a href="logout.php" class="btn ghost ">Sair</a>
                <?php else: ?>
                    <a href="login.php" class="btn ghost">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="container quiz-container">
        <h2>Top Jogadores do Quiz Conheça Angola</h2>

        <div class="table-responsive">
        <?php if (!empty($top_players)): ?>
            <table class="ranking-table" aria-describedby="ranking-desc">
                <thead>
                    <tr>
                        <th>Posição</th>
                        <th>Usuário</th>
                        <th>Pontuação Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $pos = 1; foreach ($top_players as $player): ?>
                        <?php $is_current = ($logged_in_user_id && isset($player['id']) && intval($player['id']) === intval($logged_in_user_id)); ?>
                        <tr class="<?php echo $is_current ? 'highlight' : ''; ?>">
                            <td><?php echo $pos++; ?>º</td>
                            <td><?php echo htmlspecialchars($player['nome_usuario'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo isset($player['pontuacao_total']) ? intval($player['pontuacao_total']) : 0; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum jogador no ranking ainda. Seja o primeiro a jogar!</p>
        <?php endif; ?>
        </div>

        <!-- Exibe a posição do usuário logado, mesmo que esteja fora do top 20 -->
        <?php if ($logged_in_user_id): ?>
            <div class="user-position" aria-live="polite">
                <?php if ($logged_in_user_score === null): ?>
                    <p>Você ainda não possui pontuação. Jogue para aparecer no ranking!</p>
                <?php else: ?>
                    <?php if ($logged_in_user_position !== null): ?>
                        <?php if ($logged_in_user_position <= 20): ?>
                            <p>Parabéns <strong><?php echo htmlspecialchars($logged_in_user_name, ENT_QUOTES, 'UTF-8'); ?></strong> — você está em <strong><?php echo intval($logged_in_user_position); ?>º</strong> no ranking com <strong><?php echo intval($logged_in_user_score); ?></strong> pontos.</p>
                        <?php else: ?>
                            <p><strong><?php echo htmlspecialchars($logged_in_user_name, ENT_QUOTES, 'UTF-8'); ?></strong>, sua posição atual é <strong><?php echo intval($logged_in_user_position); ?>º</strong> com <strong><?php echo intval($logged_in_user_score); ?></strong> pontos. Continue jogando para subir no ranking!</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>Não foi possível calcular sua posição no ranking no momento.</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>Faça <a href="login.php">login</a> para ver sua posição no ranking.</p>
        <?php endif; ?>

    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Quiz Conheça Angola. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
