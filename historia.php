<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>História de Angola</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="css/style.css">
<style>
/* CSS específico para esta página */
body {
    margin:0;
    font-family:'Segoe UI', Arial, sans-serif;
    background:#111;
    color:white;
    line-height:1.6;
}

/* HEADER */
header {
    background:linear-gradient(90deg,#c8102e,#000);
    padding:25px;
    text-align:center;
    border-bottom:4px solid #fcd116;
}

header h1 { margin:0; font-size:2.5em; letter-spacing:1px; }
header p { color:#fcd116; font-size:1.2em; margin-top:5px; }

/* MENU */
nav {
    background:#000;
    padding:12px 0;
    display:flex;
    justify-content:center;
    gap:30px;
    align-items:center;
    box-shadow: 0 2px 6px rgba(0,0,0,0.5);
}

nav a {
    color:white;
    text-decoration:none;
    font-weight:600;
    padding:6px 12px;
    border-radius:6px;
    transition: all 0.3s ease;
}

nav a:hover { color:#000; background:#fcd116; }
nav a.active { background:#fcd116; color:#000; font-weight:700; box-shadow:0 2px 8px rgba(0,0,0,0.4); }

.login-icon {
    padding:8px 12px;
    border-radius:50%;
    transition: all 0.3s ease;
}

.login-icon:hover { background:#fcd116; color:black; }

/* CONTAINER */
.container {
    width:90%;
    max-width:1100px;
    margin:auto;
    padding:30px 0;
}

/* SEÇÕES */
.section {
    background:#1b1b1b;
    padding:30px;
    border-radius:12px;
    margin-bottom:35px;
    border-left:6px solid #c8102e;
    box-shadow:0 6px 15px rgba(0,0,0,0.4);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.section:hover { transform: translateY(-5px); box-shadow:0 10px 20px rgba(0,0,0,0.6); }

.section h2 {
    color:#fcd116;
    margin-bottom:20px;
}

/* HISTÓRIA ITENS */
.historia-item {
    background:#000;
    padding:20px 25px;
    margin-bottom:20px;
    border-radius:10px;
    box-shadow:0 4px 12px rgba(0,0,0,0.4);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.historia-item:hover {
    transform: translateY(-5px);
    box-shadow:0 8px 20px rgba(0,0,0,0.5);
}

.historia-item h3 {
    margin-top:0;
    margin-bottom:12px;
    display:flex;
    align-items:center;
    gap:10px;
    font-size:1.4em;
    color:#fcd116;
}

.historia-item p {
    font-size:1.1em;
    line-height:1.6;
}

/* FOOTER */
footer {
    text-align:center;
    padding:15px 0;
    background:#111;
    color:#aaa;
    font-size:0.9em;
    letter-spacing:0.5px;
}
</style>
</head>

<body>

<header>
<h1>História de Angola</h1>
<p>Explore a rica história, cultura e acontecimentos marcantes do país</p>
</header>

<nav>
    <a href="index.php">Início</a>
    <a href="historia.php" class="active">História</a>
    <a href="luta-armada.php">Luta Armada</a>
    <a href="independencia.php">Independência</a>
    <a href="login.php" class="login-icon"><i class="fa-solid fa-user"></i></a>
</nav>

<div class="container">

<div class="section">
<h2>Primeiros Povos e Tradições <i class="fa-solid fa-people-group"></i></h2>
<div class="historia-item">
<h3><i class="fa-solid fa-tree"></i> Povos Indígenas</h3>
<p>
Antes da chegada dos colonizadores, Angola era habitada por diversos grupos étnicos, incluindo Kimbundu, Umbundu, Bakongo e Chokwe. Cada grupo possuía sua própria organização social, língua e tradições culturais.
</p>
</div>
<div class="historia-item">
<h3><i class="fa-solid fa-drum"></i> Cultura e Costumes</h3>
<p>
As práticas culturais incluíam rituais, dança, música, cerâmicas e agricultura tradicional, fortalecendo a identidade social e espiritual de cada comunidade.
</p>
</div>
</div>

<div class="section">
<h2>Colonização Portuguesa <i class="fa-solid fa-landmark"></i></h2>
<div class="historia-item">
<h3><i class="fa-solid fa-ship"></i> Chegada dos Portugueses</h3>
<p>
A presença portuguesa em Angola iniciou no século XV, com exploração do comércio de escravos e recursos naturais. Luanda tornou-se um ponto central da administração colonial.
</p>
</div>
<div class="historia-item">
<h3><i class="fa-solid fa-gavel"></i> Domínio Colonial</h3>
<p>
Durante séculos, os portugueses exerceram controle político, econômico e militar, alterando profundamente a sociedade, economia e organização das comunidades locais.
</p>
</div>
</div>

<div class="section">
<h2>Movimentos de Libertação <i class="fa-solid fa-flag"></i></h2>
<div class="historia-item">
<h3><i class="fa-solid fa-users-gear"></i> MPLA, FNLA e UNITA</h3>
<p>
Os movimentos políticos e militares surgiram para lutar contra o colonialismo e garantir a independência. Cada grupo teve sua própria estratégia, base de apoio e influência regional.
</p>
</div>
<div class="historia-item">
<h3><i class="fa-solid fa-fire"></i> Luta Armada</h3>
<p>
A luta armada iniciou em 1961, marcando o início de uma longa e decisiva batalha contra Portugal, que envolveria a população civil, líderes militares e alianças internacionais.
</p>
</div>
</div>

<div class="section">
<h2>Conquista da Independência <i class="fa-solid fa-flag-checkered"></i></h2>
<div class="historia-item">
<h3><i class="fa-solid fa-calendar-check"></i> 11 de Novembro de 1975</h3>
<p>
A independência foi proclamada oficialmente em Luanda por Agostinho Neto, encerrando o domínio colonial português e iniciando a construção de uma Angola soberana.
</p>
</div>
<div class="historia-item">
<h3><i class="fa-solid fa-landmark"></i> Legado</h3>
<p>
O legado histórico inclui a preservação cultural, a memória da luta pela liberdade e a valorização da identidade nacional angolana.
</p>
</div>
</div>

</div>

<footer>
<p>© 2026 Quiz Conheci Angola. Todos os direitos reservados.</p>
</footer>

</body>
</html>