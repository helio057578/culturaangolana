``php
<?php
session_start();
include 'conexao.php'; // tua conexão ao banco

id_usuario =_SESSION['id']; // ID do usuário logado

if (isset(_FILES['foto']))foto_nome = _FILES['foto']['name'];temp = _FILES['foto']['tmp_name'];pasta = "uploads/";

    move_uploaded_file(temp,pasta.foto_nome);caminho = pasta.foto_nome;
    sql = "UPDATE usuarios SET foto='caminho' WHERE id='id_usuarios'";
    mysqli_query(conn, sql);_SESSION['foto'] = caminho;
    header('Location: dashboard.php');

?>
“`
