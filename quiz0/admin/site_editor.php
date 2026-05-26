<?php
session_start();
require_once '../config.php';

// PROTEÇÃO ADMIN
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header("location: ../login.php");
    exit;
}

// BUSCAR CONTEÚDO ATUAL
$sql = "SELECT * FROM site_conteudo WHERE id = 1 LIMIT 1";
$result = $conn->query($sql);
$site = $result->fetch_assoc();

// CRIAR REGISTRO SE NÃO EXISTIR
if (!$site) {
    $conn->query("INSERT INTO site_conteudo (id, titulo, descricao, email, telefone) VALUES (1,'Quiz Angola','Descrição inicial','email@email.com','000000000')");
    $site = [
        'titulo' => '',
        'descricao' => '',
        'email' => '',
        'telefone' => '',
        'imagem1' => '',
        'imagem2' => '',
        'imagem3' => '',
        'imagem4' => ''
    ];
}

// PASTA UPLOAD
$uploadDir = "../uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// FUNÇÃO UPLOAD
function uploadImage($file, $uploadDir) {
    if (!isset($file) || $file['error'] != 0) return null;

    $name = time() . '_' . basename($file['name']);
    $path = $uploadDir . $name;

    move_uploaded_file($file['tmp_name'], $path);
    return $name;
}

// SALVAR ALTERAÇÕES
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $footer_text = $_POST['footer_text'];

    // UPLOAD IMAGENS
    $img1 = uploadImage($_FILES['imagem1'], $uploadDir) ?? $site['imagem1'];
    $img2 = uploadImage($_FILES['imagem2'], $uploadDir) ?? $site['imagem2'];
    $img3 = uploadImage($_FILES['imagem3'], $uploadDir) ?? $site['imagem3'];
    $img4 = uploadImage($_FILES['imagem4'], $uploadDir) ?? $site['imagem4'];

    $sql = "UPDATE site_conteudo SET 
        titulo='$titulo',
        descricao='$descricao',
        email='$email',
        telefone='$telefone',
        footer_text='$footer_text',
        imagem1='$img1',
        imagem2='$img2',
        imagem3='$img3',
        imagem4='$img4'
        WHERE id=1";

    if ($conn->query($sql)) {
        echo "<script>alert('Atualizado com sucesso!');</script>";
        header("Refresh:0");
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Admin - Conteúdo Site</title>
<style>
body{
background: linear-gradient(135deg,#0f172a,#1e293b);
font-family: 'Poppins', sans-serif;
color:white;
margin:0;
padding:30px;
}

.container{
max-width:1000px;
margin:auto;
background: rgba(255,255,255,0.05);
backdrop-filter: blur(15px);
padding:30px;
border-radius:20px;
box-shadow:0 8px 30px rgba(0,0,0,0.5);
}

h2{
font-size:32px;
margin-bottom:20px;
background: linear-gradient(to right,gold,orange);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

input,textarea{
width:100%;
padding:14px;
margin-top:8px;
margin-bottom:20px;
border:none;
border-radius:12px;
background:#1e293b;
color:white;
font-size:15px;
}

input:focus,textarea:focus{
outline:none;
box-shadow:0 0 10px gold;
}

button{
background: linear-gradient(to right,gold,orange);
border:none;
padding:15px 25px;
border-radius:12px;
font-weight:bold;
font-size:16px;
cursor:pointer;
transition:0.3s;
}

button:hover{
transform:scale(1.05);
}

.preview{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
gap:20px;
margin-top:20px;
}

.preview img{
width:100%;
height:160px;
object-fit:cover;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,0.5);
transition:0.3s;
}

.preview img:hover{
transform:scale(1.05);
}
</style>
</head>
<body>

<div class="container">
<h2>Painel Admin - Editar Página Inicial</h2>

<form method="POST" enctype="multipart/form-data">

<label>Título do Site</label>
<input type="text" name="titulo" value="<?php echo $site['titulo']; ?>">

<label>Descrição</label>
<textarea name="descricao"><?php echo $site['descricao']; ?></textarea>

<label>Email</label>
<input type="email" name="email" value="<?php echo $site['email']; ?>">

<label>Telefone</label>
<input type="text" name="telefone" value="<?php echo $site['telefone']; ?>">

<label>Texto do Footer</label>
<input type="text" name="footer_text"
value="<?php echo $site['footer_text']; ?>">

<hr>
<h3>Imagens do Slider</h3>

<label>Imagem 1</label>
<input type="file" name="imagem1">

<label>Imagem 2</label>
<input type="file" name="imagem2">

<label>Imagem 3</label>
<input type="file" name="imagem3">

<label>Imagem 4</label>
<input type="file" name="imagem4">

<br><br>
<button type="submit">Guardar Alterações</button>

</form>

<h3>Pré-visualização</h3>
<div class="preview">
<img src="../uploads/<?php echo $site['imagem1']; ?>">
<img src="../uploads/<?php echo $site['imagem2']; ?>">
<img src="../uploads/<?php echo $site['imagem3']; ?>">
<img src="../uploads/<?php echo $site['imagem4']; ?>">
</div>

</div>


<!-- NOVA OPÇÃO (ADICIONADA SEM REMOVER NADA) -->
<section class="admin-section" style="margin-top:30px;">
  <h3>Gerir Página Inicial do Site</h3>
  <p>Agora podes editar o conteúdo da página inicial sem mexer no sistema do quiz.</p>
  
  <a href="site_editor.php" class="btn primary" style="display:block; width:fit-content; padding:5px 15px; background:gold; color:black; text-decoration:none; border-radius:15px; font-weight:bold; margin-bottom:10px;">
    Editar Conteúdo da Página Inicial
  </a>

  <a href="dashboard_admin.php" class="btn primary" style="display:block; width:fit-content; padding:5px 15px; background:gold; color:black; text-decoration:none; border-radius:15px; font-weight:bold;">
    Voltar ao Dashboard
  </a>
</section>

</body>
</html>
