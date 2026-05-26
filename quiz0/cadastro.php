<?php
require_once 'config.php'; // Conexão com o banco de dados
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_usuario = trim($_POST['nome_usuario']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirm_senha = $_POST['confirm_senha'];

    // Validações
    if (empty($nome_usuario) || empty($email) || empty($senha) || empty($confirm_senha)) {
        $message = '<div class="message error">Por favor, preencha todos os campos.</div>';
    } elseif (!preg_match('/^[A-ZÁÉÍÓÚÃÕÇ]/u', $nome_usuario)) {
        $message = '<div class="message error">O nome de usuário deve começar com letra maiúscula.</div>';
    } elseif (preg_match('/\d/', $nome_usuario)) {
        $message = '<div class="message error">O nome de usuário não pode conter números.</div>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<div class="message error">Formato de e-mail inválido.</div>';
    } elseif (preg_match('/^\d+@/', $email)) {
        $message = '<div class="message error">O e-mail não pode começar apenas com números antes do "@".</div>';
    } elseif ($senha !== $confirm_senha) {
        $message = '<div class="message error">As senhas não coincidem.</div>';
    } elseif (strlen($senha) < 6) {
        $message = '<div class="message error">A senha deve ter no mínimo 6 caracteres.</div>';
    } else {
        // Verificar se o nome de usuário ou e-mail já existem
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE nome_usuario = ? OR email = ?");
        $stmt->bind_param("ss", $nome_usuario, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = '<div class="message error">Nome de usuário ou e-mail já cadastrado.</div>';
        } else {
            $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO usuarios (nome_usuario, email, senha) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome_usuario, $email, $senha_hashed);

            if ($stmt->execute()) {
                $message = '<div class="message success">Cadastro realizado com sucesso! Faça <a href="login.php">login</a>.</div>';
            } else {
                $message = '<div class="message error">Erro ao cadastrar. Tente novamente.</div>';
            }
        }
        $stmt->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Quiz Conheça Angola</title>
    <link rel="stylesheet" href="cssq/style.css">
</head>
<body>
    <div class="form-container">
        <div class="form-box">
            <h2>Cadastre-se</h2>
            <?php echo $message; ?>
            <form action="cadastro.php" method="POST">
                <div class="form-group">
                    <label for="nome_usuario">Nome de Usuário:</label>
                    <input type="text" id="nome_usuario" name="nome_usuario" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <div class="form-group">
                    <label for="confirm_senha">Confirmar Senha:</label>
                 <h1></h1>
                    <input type="password" id="confirm_senha" name="confirm_senha" required>
                   
                </div>
                <div class="form-group">
                    <input type="submit" value="Cadastrar">
                </div>
            </form>
            <a href="login.php" class="link">Já tem uma conta? Faça Login</a>
            <a href="index.php" class="link">Voltar para a Página Inicial</a>
        </div>
    </div>

    <!-- Validações no lado do cliente -->
    <script>
        const campoUsuario = document.getElementById('nome_usuario');
        const campoEmail = document.getElementById('email');

        campoUsuario.addEventListener('keypress', function (event) {
            const tecla = event.key;
            if (!isNaN(tecla) && tecla !== ' ') {
                event.preventDefault();
            }
        });

        campoUsuario.addEventListener('paste', function (event) {
            const texto = (event.clipboardData || window.clipboardData).getData('text');
            if (/\d/.test(texto)) {
                event.preventDefault();
            }
        });

        campoUsuario.addEventListener('blur', function () {
            const valor = campoUsuario.value;
            if (valor && valor.charAt(0) !== valor.charAt(0).toUpperCase()) {
                alert("O nome de usuário deve começar com letra maiúscula.");
            }
        });

        campoEmail.addEventListener('blur', function () {
            const valor = campoEmail.value;
            const parteLocal
<?php
require_once 'config.php'; // Conexão com o banco de dados
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_usuario = trim($_POST['nome_usuario']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirm_senha = $_POST['confirm_senha'];

    // Validações
    if (empty($nome_usuario) || empty($email) || empty($senha) || empty($confirm_senha)) {
        $message = '<div class="message error">Por favor, preencha todos os campos.</div>';
    } elseif (!preg_match('/^[A-ZÁÉÍÓÚÃÕÇ]/u', $nome_usuario)) {
        $message = '<div class="message error">O nome de usuário deve começar com letra maiúscula.</div>';
    } elseif (preg_match('/\d/', $nome_usuario)) {
        $message = '<div class="message error">O nome de usuário não pode conter números.</div>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<div class="message error">Formato de e-mail inválido.</div>';
    } elseif (preg_match('/^\d+@/', $email)) {
        $message = '<div class="message error">O e-mail não pode começar apenas com números antes do "@".</div>';
    } elseif ($senha !== $confirm_senha) {
        $message = '<div class="message error">As senhas não coincidem.</div>';
    } elseif (strlen($senha) < 6) {
        $message = '<div class="message error">A senha deve ter no mínimo 6 caracteres.</div>';
    } else {
        // Verificar se o nome de usuário ou e-mail já existem
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE nome_usuario = ? OR email = ?");
        $stmt->bind_param("ss", $nome_usuario, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = '<div class="message error">Nome de usuário ou e-mail já cadastrado.</div>';
        } else {
            $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO usuarios (nome_usuario, email, senha) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome_usuario, $email, $senha_hashed);

            if ($stmt->execute()) {
                $message = '<div class="message success">Cadastro realizado com sucesso! Faça <a href="login.php">login</a>.</div>';
            } else {
                $message = '<div class="message error">Erro ao cadastrar. Tente novamente.</div>';
            }
        }
        $stmt->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Quiz Conheça Angola</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <div class="form-box">
            <h2>Cadastre-se</h2>
            <?php echo $message; ?>
            <form action="cadastro.php" method="POST">
                 <video autoplay muted loop class="bg-video">
            <source src="50_anos_de_independencia.mp4" type="video/mp4">
            Seu navegador não suporta vídeos em HTML5.
        </video>
                <div class="form-group">
                    <label for="nome_usuario">Nome de Usuário:</label>
                    <input type="text" id="nome_usuario" name="nome_usuario" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <div class="form-group">
                    <label for="confirm_senha">Confirmar Senha:</label>
                    <input type="password" id="confirm_senha" name="confirm_senha" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Cadastrar">
                </div>
            
            </form>
            <a href="login.php" class="link">Já tem uma conta? Faça Login</a>
            <a href="index.php" class="link">Voltar para a Página Inicial</a>
            
        </div>
    </div>
        


    <!-- Validações no lado do cliente -->
    <script>
        const campoUsuario = document.getElementById('nome_usuario');
        const campoEmail = document.getElementById('email');

        campoUsuario.addEventListener('keypress', function (event) {
            const tecla = event.key;
            if (!isNaN(tecla) && tecla !== ' ') {
                event.preventDefault();
            }
        });

        campoUsuario.addEventListener('paste', function (event) {
            const texto = (event.clipboardData || window.clipboardData).getData('text');
            if (/\d/.test(texto)) {
                event.preventDefault();
            }
        });

        campoUsuario.addEventListener('blur', function () {
            const valor = campoUsuario.value;
            if (valor && valor.charAt(0) !== valor.charAt(0).toUpperCase()) {
                alert("O nome de usuário deve começar com letra maiúscula.");
            }
        });

        campoEmail.addEventListener('blur', function () {
            const valor = campoEmail.value;
            const parteLocal
    
