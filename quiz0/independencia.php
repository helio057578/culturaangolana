<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Independência de Angola</title>
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

nav a:hover {
    color:#000;
    background:#fcd116;
}

nav a.active {
    background:#fcd116;
    color:#000;
    font-weight:700;
    box-shadow: 0 2px 8px rgba(0,0,0,0.4);
}

.login-icon {
    padding:8px 12px;
    border-radius:50%;
    transition: all 0.3s ease;
}

.login-icon:hover {
    background:#fcd116;
    color:black;
}

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
    box-shadow: 0 6px 15px rgba(0,0,0,0.4);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.section:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.6);
}

.section h2 {
    color:#fcd116;
    margin-bottom:20px;
}

/* ITENS DESTAQUES */
.independencia-item {
    background:#000;
    padding:20px 25px;
    margin-bottom:20px;
    border-radius:10px;
    box-shadow:0 4px 12px rgba(0,0,0,0.4);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.independencia-item:hover {
    transform: translateY(-5px);
    box-shadow:0 8px 20px rgba(0,0,0,0.5);
}

.independencia-item h3 {
    margin-top:0;
    margin-bottom:12px;
    display:flex;
    align-items:center;
    gap:10px;
    font-size:1.4em;
    color:#fcd116;
}

.independencia-item p {
    font-size:1.1em;
    line-height:1.6;
}

/* FOOTER */
footer {
    text-align:center;
    padding:25px;
    background:#000;
    border-top:3px solid #fcd116;
    font-size:0.95em;
    letter-spacing:0.5px;
    box-shadow: 0 -4px 8px rgba(0,0,0,0.3);
}
</style>
</head>

<body>

<header>
<h1>Independência de Angola</h1>
<p>Conheça os eventos, protagonistas e impacto da independência do país</p>
</header>

<nav>
    <a href="index.php">Início</a>
    <a href="historia.php">História</a>
    <a href="luta-armada.php">Luta Armada</a>
    <a href="independencia.php" class="active">Independência</a>
    <a href="login.php" class="login-icon"><i class="fa-solid fa-user"></i></a>
</nav>

<div class="container">

<div class="section">
<h2>O Caminho para a Independência <i class="fa-solid fa-road"></i></h2>
<p>
A independência de Angola foi o resultado de décadas de luta armada e diplomática contra o colonialismo português. Os movimentos políticos e militares organizaram ações estratégicas que culminaram na proclamação da liberdade nacional.
</p>
</div>

<div class="section">
<h2>Proclamação da Independência <i class="fa-solid fa-flag"></i></h2>

<div class="independencia-item">
<h3><i class="fa-solid fa-calendar-check"></i> 11 de Novembro de 1975</h3>
<p>
Neste dia, Agostinho Neto proclamou a independência de Angola em Luanda, encerrando oficialmente o período colonial português e iniciando uma nova era de soberania.
</p>
</div>

<div class="independencia-item">
<h3><i class="fa-solid fa-user-tie"></i> Agostinho Neto</h3>
<p>
Primeiro Presidente de Angola, líder do MPLA e figura central na independência, Neto é lembrado pelo seu papel diplomático, político e inspirador para a nação.
</p>
</div>

</div>

<div class="section">
<h2>Impactos e Consequências <i class="fa-solid fa-chart-line"></i></h2>

<div class="independencia-item">
<h3><i class="fa-solid fa-people-group"></i> Sociedade Angolana</h3>
<p>
A independência trouxe liberdade política e a oportunidade de construir uma identidade nacional unificada. No entanto, também gerou desafios sociais e conflitos internos devido às divisões políticas e territoriais.
</p>
</div>

<div class="independencia-item">
<h3><i class="fa-solid fa-landmark"></i> Reconhecimento Internacional</h3>
<p>
O reconhecimento da independência fortaleceu Angola diplomaticamente, estabelecendo relações internacionais e abrindo portas para cooperação e desenvolvimento.
</p>
</div>
</div>

<div class="section">
<h2>Legado da Independência <i class="fa-solid fa-flag-checkered"></i></h2>
<p>
O legado da independência é visível na celebração do Dia da Independência, na preservação da memória histórica e no fortalecimento da identidade nacional. Monumentos, livros e programas educativos continuam a lembrar as gerações futuras do esforço e sacrifício de todos que lutaram pela liberdade.
</p>
</div>

</div>


<footer>
  <p>© 2026 Quiz Conheci Angola. Todos os direitos reservados.</p>
</footer>


</body>
</html>