<?php
require_once 'config.php';

// Melhor: definir cookie params antes do session_start (exemplo)
// session_set_cookie_params([ 'lifetime'=>0, 'path'=>'/', 'secure'=>true, 'httponly'=>true, 'samesite'=>'Lax' ]);
session_start();

if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_usuario = trim($_POST['nome_usuario'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($nome_usuario === '' || $senha === '') {
        $message = '<div class="message error">Por favor, preencha todos os campos.</div>';
    } else {
        // Verifica se a preparação da query teve sucesso
        $stmt = $conn->prepare("SELECT id, nome_usuario, senha, tipo_usuario FROM usuarios WHERE nome_usuario = ?");
        if ($stmt === false) {
            // Log do erro em arquivo / syslog (não mostrar ao usuário)
            error_log('Prepare failed: ' . $conn->error);
            $message = '<div class="message error">Ocorreu um erro. Tente novamente mais tarde.</div>';
        } else {
            $stmt->bind_param("s", $nome_usuario);
            if (!$stmt->execute()) {
                error_log('Execute failed: ' . $stmt->error);
                $message = '<div class="message error">Ocorreu um erro. Tente novamente mais tarde.</div>';
            } else {
                $stmt->store_result();
                if ($stmt->num_rows === 1) {
                    $stmt->bind_result($id, $nome_usuario_db, $senha_hashed, $tipo_usuario);
                    $stmt->fetch();

                    if (password_verify($senha, $senha_hashed)) {
                        // Proteção contra fixation
                        session_regenerate_id(true);

                        $_SESSION['usuario_id'] = $id;
                        $_SESSION['nome_usuario'] = $nome_usuario_db;
                        $_SESSION['tipo_usuario'] = $tipo_usuario;

                        // Redireciona dependendo do tipo
                        if ($tipo_usuario === 'admin') {
                            header("Location: admin/dashboard_admin.php");
                        } else {
                            header("Location: dashboard.php");
                        }
                        $stmt->close();
                        $conn->close();
                        exit;
                    } else {
                        $message = '<div class="message error">Nome de usuário ou senha inválidos.</div>';
                    }
                } else {
                    $message = '<div class="message error">Nome de usuário ou senha inválidos.</div>';
                }
            }
            $stmt->close();
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Quiz Conheça Angola</title>
    <link rel="stylesheet" href="cssq/style.css">
</head>
<body>
    <div class="form-container">
        <div class="form-box">
            <h2>Login</h2>
            <?php echo $message; ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="form-group">
                    <label for="nome_usuario">Nome de Usuário:</label>
                    <input type="text" id="nome_usuario" name="nome_usuario" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Entrar">
                </div>
            </form>

    <a href="cadastro.php" class="link">Criar conta</a>
    <a href="index.php" class="link">Voltar ao início</a>
    <a href="#" class="link" onclick="alert('Disponível em breve')">Esqueci a senha</a>
        </div>
    </div>

</body>
</html>
