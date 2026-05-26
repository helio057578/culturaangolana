
<?php
require_once "config.php";

$sql = "SELECT * FROM site_conteudo LIMIT 1";
$result = $conn->query($sql);
$site = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Quiz Conheço Angola</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

/* RESET */
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: #111;
  color: white;
}

html {
  scroll-behavior: smooth;
}

/* TOPO */
.topo {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 40px;
  background: white;
  color: black;
  position: sticky;
  top: 0;
  z-index: 1000;
}

.logo h2 {
  margin: 0;
}

/* MENU */
.menu a {
  margin: 0 15px;
  text-decoration: none;
  color: black;
  font-weight: bold;
  position: relative;
}

.menu a::after {
  content: "";
  width: 0%;
  height: 2px;
  background: #2563eb;
  position: absolute;
  left: 0;
  bottom: -5px;
  transition: 0.3s;
}

.menu a:hover::after {
  width: 100%;
}

/* BOTÃO ENTRAR */
.btn-login {
  background: #2563eb;
  color: white;
  padding: 10px 20px;
  border-radius: 20px;
  text-decoration: none;
}

.btn-login:hover {
  background: #1d4ed8;
}

/* BOTÃO QUIZ */
.btn-quiz {
  position: fixed;
  top: 80px;
  right: 20px;
  background: gold;
  color: black;
  padding: 10px 20px;
  border-radius: 20px;
  text-decoration: none;
  font-weight: bold;
  z-index: 1000;
}

.btn-quiz:hover {
  background: red;
  color: white;
}

/* HEADER */
header {
  text-align: center;
  padding: 50px 20px;
  background: red;
}

/* BOTÃO RANKING */
.btn-ranking {
  display: block;
  width: fit-content;
  margin: 30px auto;
  background: green;
  padding: 15px 25px;
  border-radius: 30px;
  text-decoration: none;
  color: white;
  font-weight: bold;
}

.btn-ranking:hover {
  background: limegreen;
}

/* SLIDER */
.slider {
  width: 100%;
  height: 500px;
  overflow: hidden;
}

.slides {
  display: flex;
  width: 400%;
  height: 100%;
  transition: 0.5s;
}

.slides img {
  width: 100%;
  height: 100%;

}

/* CONTEÚDO */
.container {
  padding: 40px;
}

/* GRID */
.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 25px;
}

/* CARDS */
.card {
  padding: 25px;
  border-radius: 12px;
  color: #333;
  background: #f5f5f5;
  transition: 0.3s;
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.card:hover {
  transform: translateY(-8px);
}

/* CORES */
.card:nth-child(1) { background: #dbeafe; }
.card:nth-child(2) { background: #dcfce7; }
.card:nth-child(3) { background: #fee2e2; }
.card:nth-child(4) { background: #fef9c3; }
.card:nth-child(5) { background: #e0e7ff; }

.card h2 {
  margin-bottom: 10px;
  color: #111;
}

/* ANIMAÇÃO */
.reveal {
  opacity: 0;
  transform: translateY(50px);
  transition: 0.8s;
}

.reveal.active {
  opacity: 1;
  transform: translateY(0);
}

.contacto {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 30px; /* espaço entre eles */
  flex-wrap: wrap; /* importante para responsividade */
  background: #111;
  padding: 20px;
  border-radius: 10px;
}

.item {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #fff;
  font-size: 18px;
}

.item i {
  color: #c8102e; /* vermelho 🇦🇴 */
  font-size: 20px;
  hover 
}
.item a {
  color: #fff;
  text-decoration: none;
  margin: 0 5px;
}

.item a:hover {
  color: #c8102e;
}
.item i.fab.fa-whatsapp {
  color: #25D366; /* verde clássico WhatsApp */
}

.item:hover i.fab.fa-whatsapp {
  color: white;
}




/* FOOTER */
footer {
  text-align: center;
  padding: 20px;
  background: black;
}

/* ========================= */
/* 📱 RESPONSIVIDADE MOBILE */
/* ========================= */
@media (max-width: 768px) {

  /* TOPO */
  .topo {
    flex-direction: column;
    padding: 10px;
    text-align: center;
  }

  .menu {
    margin-top: 10px;
  }

  .menu a {
    display: inline-block;
    margin: 5px;
  }

  /* BOTÃO QUIZ */
  .btn-quiz {
    top: 70px;
    right: 10px;
    padding: 8px 15px;
    font-size: 14px;
  }

  /* HEADER */
  header {
    padding: 30px 10px;
  }

  header h1 {
    font-size: 22px;
  }

  header p {
    font-size: 14px;
  }

  /* SLIDER */
  .slider {
    height: 250px;
  }

  .slides img {
    object-fit: cover;
  }

  /* CONTEÚDO */
  .container {
    padding: 20px;
  }

  /* GRID */
  .grid {
    grid-template-columns: 1fr;
  }

  /* CARDS */
  .card {
    padding: 15px;
  }

  .card h2 {
    font-size: 18px;
  }

  .card p {
    font-size: 14px;
  }

  /* CONTACTOS */
  .contacto {
    flex-direction: column;
    gap: 15px;
  }

  .item {
    font-size: 16px;
  }

  /* BOTÃO RANKING */
  .btn-ranking {
    width: 90%;
    text-align: center;
  }
}

</style>

</head>
<body>
<!-- BOTÃO QUIZ -->
<a href="quiz.php" class="btn-quiz">
  <i class="fa-solid fa-gamepad"></i> Acessar o Quiz
</a>

<!-- HEADER -->
<header>
<h1><?php echo $site['titulo']; ?></h1>
<p><?php echo $site['descricao']; ?></p>
</header>

<!-- SLIDER -->
<div class="slider">
  <div class="slides">
    <img src="uploads/<?php echo $site['imagem1']; ?>">
    <img src="uploads/<?php echo $site['imagem2']; ?>">
    <img src="uploads/<?php echo $site['imagem3']; ?>">
    <img src="uploads/<?php echo $site['imagem4']; ?>">
  </div>
</div>

<!-- CONTEÚDO -->
<div class="container" id="sobre">

<h1 style="text-align:center; margin-bottom:30px;">Sobre Angola</h1>

<div class="grid">

<div class="card reveal" id="inicio">
<h2>Início</h2>
<p>Angola é um país localizado na costa ocidental da África Austral, conhecido pela sua diversidade cultural, riqueza em recursos naturais e uma história marcada por resistência e superação. Antes da colonização europeia, o território era habitado por vários povos organizados em reinos, como o Reino do Kongo e o Ndongo.</p>
</div>

<div class="card reveal">
<h2>História</h2>
<p>A história de Angola é marcada pela colonização portuguesa, que começou no século XV com a chegada dos navegadores portugueses. Durante séculos, o país foi explorado economicamente, principalmente através do comércio de escravos. A presença colonial influenciou profundamente a língua, cultura e organização social do país.</p>
</div>

<div class="card reveal">
<h2>Luta Armada</h2>
<p>A luta armada em Angola teve início na década de 1960, como forma de resistência contra o domínio colonial português. Movimentos como o MPLA, FNLA e UNITA lideraram a luta pela libertação. Foi um período de grande sofrimento, mas também de coragem e determinação do povo angolano na busca pela liberdade.</p>
</div>

<div class="card reveal">
<h2>Independência</h2>
<p>Angola conquistou a sua independência no dia 11 de novembro de 1975. Este marco histórico representou o fim do domínio colonial português e o início de uma nova fase para o país. No entanto, logo após a independência, Angola enfrentou uma guerra civil que durou vários anos, afetando o seu desenvolvimento.</p>
</div>

<div class="card reveal">
<h2>Cultura</h2>
<p>A cultura angolana é extremamente rica e diversificada, influenciada pelas tradições africanas e pela herança portuguesa. A música (como o semba e kuduro), a dança, a culinária e as línguas nacionais são elementos importantes da identidade do país. Angola também é conhecida pela sua hospitalidade e forte espírito comunitário.</p>
</div>

</div>
</div>

<h1 style="text-align:center; margin-bottom:30px;">CONTACTOS</h1>
<div class="contacto">

<!-- Link direto para o Gmail Web -->
<div class="item">
    <i class="fas fa-envelope"></i>
    <span>
        <a href="https://google.com<?php echo $site['email']; ?>" target="_blank">
            Gmail
        </a>
    </span>
</div>

  <!-- Telefone -->
  <div class="item">
    <i class="fas fa-phone"></i>
    <span>
    <a href="tel:<?php echo $site['telefone']; ?>">
    <?php echo $site['telefone']; ?>
    </a>
    </span>
  </div>

   <!-- WhatsApp -->
  <div class="item">
    <i class="fab fa-whatsapp"></i>
    <span>
      <a href="https://wa.me/244927522645" target="_blank">WhatsApp</a>
    </span>
  </div>

  <!-- Localização -->
  <div class="item">
    <i class="fas fa-map-marker-alt"></i>
    <span>
      <a href="https://www.google.com/maps/place/Angola/@-11.1667044,12.4705664,1965537m/data=!3m2!1e3!4b1!4m6!3m5!1s0x1a51f24ecaad8b27:0x590a289d0d4a4e3d!8m2!3d-11.202692!4d17.873887!16zL20vMGo0Yg!5m1!1e1?authuser=0&entry=ttu&g_ep=EgoyMDI2MDQyNy4wIKXMDSoASAFQAw%3D%3D" target="_blank">
      ANGOLA
      </a>
    </span>
  </div>

</div>



    <footer>
<p><?php echo $site['footer_text']; ?></p>
    </footer>
<script>

/* SLIDER */
let index = 0;
const slides = document.querySelector('.slides');
const total = slides.children.length;

function showSlide() {
  index++;
  if (index >= total) index = 0;
  slides.style.marginLeft = `-${index * 100}%`;
}

setInterval(showSlide, 4000);

/* ANIMAÇÃO */
function reveal() {
  let reveals = document.querySelectorAll(".reveal");

  reveals.forEach(el => {
    let windowHeight = window.innerHeight;
    let elementTop = el.getBoundingClientRect().top;

    if (elementTop < windowHeight - 100) {
      el.classList.add("active");
    }
  });
}

window.addEventListener("scroll", reveal);

</script>

</body>
</html>
