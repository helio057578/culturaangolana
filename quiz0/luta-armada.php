<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Luta Armada de Libertação Nacional</title>
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
.luta-item {
    background:#000;
    padding:20px 25px;
    margin-bottom:20px;
    border-radius:10px;
    box-shadow:0 4px 12px rgba(0,0,0,0.4);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.luta-item:hover {
    transform: translateY(-5px);
    box-shadow:0 8px 20px rgba(0,0,0,0.5);
}

.luta-item h3 {
    margin-top:0;
    margin-bottom:12px;
    display:flex;
    align-items:center;
    gap:10px;
    font-size:1.4em;
    color:#fcd116;
}

.luta-item p {
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
<h1>Luta Armada de Libertação Nacional</h1>
<p>Descubra a história e os movimentos que lutaram pela independência de Angola</p>
</header>

<nav>
    <a href="index.php">Início</a>
    <a href="historia.php">História</a>
    <a href="luta-armada.php" class="active">Luta Armada</a>
    <a href="independencia.php">Independência</a>
    <a href="login.php" class="login-icon"><i class="fa-solid fa-user"></i></a>
</nav>

<div class="container">

<div class="section">
<h2>Contexto Histórico <i class="fa-solid fa-history"></i></h2>
<p>
A Luta Armada de Libertação Nacional em Angola começou em 1961, como reação ao domínio colonial português que durava séculos.
O movimento buscava a independência e o reconhecimento da soberania angolana. Durante este período, surgiram diferentes grupos políticos e militares que desempenharam papéis decisivos.
</p>
</div>

<div class="section">
<h2>Movimentos de Libertação <i class="fa-solid fa-users-gear"></i></h2>

<div class="luta-item">
<h3><i class="fa-solid fa-flag"></i> MPLA (Movimento Popular de Libertação de Angola)</h3>
<p>
Fundado em 1956, o MPLA lutou pelo socialismo e independência do país, contando com apoio de países africanos e aliados internacionais.
</p>
</div>

<div class="luta-item">
<h3><i class="fa-solid fa-flag"></i> FNLA (Frente Nacional de Libertação de Angola)</h3>
<p>
O FNLA, liderado por Holden Roberto, teve papel importante no início da luta armada e recebeu apoio externo de países vizinhos e dos Estados Unidos.
</p>
</div>

<div class="luta-item">
<h3><i class="fa-solid fa-flag"></i> UNITA (União Nacional para a Independência Total de Angola)</h3>
<p>
Criada por Jonas Savimbi, a UNITA tornou-se um dos principais movimentos militares durante a luta, especialmente no interior do país, e teve influência significativa durante o período pós-independência.
</p>
</div>

</div>

<div class="section">
<h2>Impactos e Sacrifícios <i class="fa-solid fa-heart-pulse"></i></h2>
<p>
A luta armada resultou em milhares de vidas perdidas e mudanças profundas na sociedade angolana. Muitas famílias sofreram com deslocamentos, mortes e destruição de comunidades.
O esforço coletivo, porém, consolidou a independência do país e moldou a identidade nacional de Angola.
</p>
</div>

<div class="section">
<h2>Legado da Luta Armada <i class="fa-solid fa-landmark"></i></h2>
<p>
O legado da Luta Armada permanece vivo na memória do povo angolano. Monumentos, feriados nacionais e o fortalecimento da soberania lembram diariamente o sacrifício daqueles que lutaram pela liberdade e pelo futuro do país.
</p>
</div>

</div>

<footer>
  <p>© 2026 Quiz Conheci Angola. Todos os direitos reservados.</p>
</footer>
</body>
</html>