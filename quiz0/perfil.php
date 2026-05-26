<?php
session_start();
require_once "config.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli($host, $user, $pass, $db);

// Busca os dados do usuário
$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT nome_usuario, email, foto_perfil FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->bind_result($nome_usuario, $email_usuario, $foto_perfil);
$stmt->fetch();
$stmt->close();

// PROCESSAR ATUALIZAÇÃO
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Atualizar nome
    if (!empty($_POST['nome_usuario'])) {
        $novo_nome = $_POST['nome_usuario'];
        $stmt = $conn->prepare("UPDATE usuarios SET nome_usuario = ? WHERE id = ?");
        $stmt->bind_param("si", $novo_nome, $usuario_id);
        $stmt->execute();
        $_SESSION['nome_usuario'] = $novo_nome;
        $stmt->close();
    }

    // Atualizar senha
    if (!empty($_POST['senha']) && !empty($_POST['senha_confirmar'])) {
        if ($_POST['senha'] === $_POST['senha_confirmar']) {
            $nova_senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
            $stmt->bind_param("si", $nova_senha, $usuario_id);
            $stmt->execute();
            $stmt->close();
        } else {
            $erro = "As senhas não coincidem!";
        }
    }

    // Upload da foto de perfil
    if (!empty($_FILES['foto']['name'])) {
        $imagem = "uploads/perfil_" . time() . "_" . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $imagem);
        $stmt = $conn->prepare("UPDATE usuarios SET foto_perfil = ? WHERE id = ?");
        $stmt->bind_param("si", $imagem, $usuario_id);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: perfil.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Perfil do Usuário</title>
<style>

/* FUNDO */
body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #0f0f0f, #1a1a1a);
    margin: 0;
    padding: 0;
    color: white;
}

/* CONTAINER */
.container {
    max-width: 520px;
    background: rgba(255,255,255,0.04);
    margin: 60px auto;
    padding: 35px;
    border-radius: 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.08);
    box-shadow: 0 15px 45px rgba(0,0,0,0.5);
    animation: fadeInUp 0.6s ease;
}

/* TÍTULO */
.container h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 1.8rem;
    background: linear-gradient(45deg, #FFD700, #ffae00);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* FOTO PERFIL */
.foto-perfil {
    text-align: center;
    margin-bottom: 25px;
}

.foto-perfil img {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(255,215,0,0.7);
    box-shadow: 0 0 25px rgba(255,215,0,0.35);
    transition: 0.3s ease;
}

.foto-perfil img:hover {
    transform: scale(1.05);
}

/* INPUTS */
input[type="text"],
input[type="password"],
input[type="file"] {
    width: 100%;
    padding: 12px 14px;
    margin: 10px 0;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.15);
    background: rgba(0,0,0,0.35);
    color: white;
    outline: none;
    transition: 0.3s ease;
    font-size: 0.95rem;
}

input:focus {
    border-color: rgba(255,215,0,0.6);
    box-shadow: 0 0 15px rgba(255,215,0,0.25);
}

/* BOTÃO */
button {
    width: 100%;
    padding: 13px;
    margin-top: 18px;
    background: linear-gradient(45deg, #FFD700, #ffbe00);
    color: black;
    font-size: 0.95rem;
    font-weight: 600;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    transition: 0.35s ease;
    box-shadow: 0 0 20px rgba(255,215,0,0.35);
}

button:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 5px 30px rgba(255,215,0,0.55);
}

/* BOTÃO VOLTAR */
.voltar {
    display: flex;
    justify-content: center;
    margin-top: 18px;
}

.voltar a {
    text-decoration: none;
    padding: 9px 18px;
    border-radius: 25px;
    background: rgba(255,255,255,0.08);
    color: rgba(255,255,255,0.75);
    border: 1px solid rgba(255,255,255,0.15);
    transition: 0.3s ease;
    font-size: 0.85rem;
}

.voltar a:hover {
    background: #D90429;
    color: white;
    box-shadow: 0 0 20px rgba(217,4,41,0.45);
}

/* RESPONSIVO */
@media (max-width: 600px) {
    .container {
        margin: 30px 15px;
        padding: 25px;
    }

    .foto-perfil img {
        width: 120px;
        height: 120px;
    }
}

/* ANIMAÇÃO */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>

</head>
<body>

<div class="container">
<h2>Meu Perfil</h2>

<div class="foto-perfil">
    <img src="<?php echo $foto_perfil ? $foto_perfil : 'default.png'; ?>" alt="Perfil">
</div>

<form method="POST" enctype="multipart/form-data">
    <label>Nome:</label>
    <input type="text" name="nome_usuario" value="<?php echo $nome_usuario; ?>">

    <label>Alterar Senha:</label>
    <input type="password" name="senha" placeholder="Nova senha">
    <input type="password" name="senha_confirmar" placeholder="Confirmar nova senha">

    <label>Foto de Perfil:</label>
    <input type="file" name="foto">

    <button type="submit">Salvar Alterações</button>
</form>

<div class="voltar">
    <a href="dashboard.php">⬅ Voltar</a>
</div>

</div>
</body>
</html>
