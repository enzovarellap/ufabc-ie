<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>CarWise</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{asset('storage/logocarwise.jpeg')}}" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('css/landing.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: HeroBiz
  * Template URL: https://bootstrapmade.com/herobiz-bootstrap-business-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <!-- <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
         Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt="">
        <h1 class="sitename">CarWise</h1>
        <span>.</span>
      </a> -->

      <nav id="navmenu" class="navmenu">
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
        <img src={{asset('storage/logocarwise-semfundo.png')}} class="img-fluid animated" alt="">
        <h1>Bem vindo ao <span>CarWise</span></h1>
        <p>Controle total dos gastos com seu carro, na palma da sua mão</p>
        <div class="d-flex">
          <a href="/admin" class="btn-get-started">Login</a>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-activity icon"></i></div>
              <h4><a href="" class="stretched-link"> Controle de despesas </a></h4>
              <p>O nosso aplicativo te auxilia a prever gastos, facilitando a organização das suas finanças.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
              <h4><a href="" class="stretched-link">Manutenção contínua</a></h4>
              <p>Cuidar do carro com regularidade evita surpresas, reduz gastos e prolonga a vida útil do veículo.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
              <h4><a href="" class="stretched-link">Datas importantes</a></h4>
              <p>Te avisamos sobre o período ideal de trocar o óleo do seu carro e datas importantes como o vencimento do IPVA.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-broadcast icon"></i></div>
              <h4><a href="" class="stretched-link">Comunicação Eficiente</a></h4>
              <p>Sempre conectados com você! Nosso app oferece notificações inteligentes e uma comunicação clara para que você nunca perca prazos ou informações importantes sobre seu carro.</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Featured Services Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Sobre nós</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up">

        <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-5">
            <div class="about-img">
              <img src="{{asset('storage/sobrenos.svg')}}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-7">
            <h3 class="pt-0 pt-lg-5">O nosso maio objetivo é ajudar você a aproveitar melhor o seu dinheiro</h3>


            <!-- Tab Content -->
            <div class="tab-content">

              <div class="tab-pane fade show active" id="about-tab1">

                <p>Somos apaixonados por praticidade, organização e, acima de tudo, por ajudar você a cuidar melhor do seu dinheiro. Nosso aplicativo nasceu da necessidade real de controlar os gastos com um dos bens mais utilizados e, ao mesmo tempo, mais caros de manter: o carro.</p>

                <p>Seja abastecimento, manutenção, impostos, pedágios ou seguro, sabemos que essas despesas se acumulam e, muitas vezes, passam despercebidas no orçamento. Pensando nisso, criamos uma ferramenta simples, intuitiva e eficiente para que você tenha total controle sobre os custos do seu veículo particular.</p>

                <p>Nosso objetivo é transformar dados em decisões. Com relatórios claros, alertas inteligentes e uma visão completa dos gastos, você consegue planejar melhor, economizar mais e evitar surpresas.</p>

                <p>Mais do que um app, somos um aliado na sua jornada por uma vida financeira mais equilibrada e consciente. Seu carro continua rodando — e suas finanças também!</p>

              </div><!-- End Tab 1 Content -->

            </div>

          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Valores</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="pricing-item">

              <div class="pricing-header">
                <h3>Free</h3>
                <h4><sup>R$</sup>0<span> / mês</span></h4>
              </div>

              <ul>
                <li><i class="bi bi-dot"></i> <span>Alertas de datas importantes</span></li>
                <li><i class="bi bi-dot"></i> <span>Informações sobre manutenção</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Consulta de multas</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Relatório de despesas</span></li>
              </ul>

            </div>
          </div><!-- End Pricing Item -->

          <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="pricing-item featured">

              <div class="pricing-header">
                <h3>Plano Premium</h3>
                <h4><sup>R$</sup>15<span> / mês</span></h4>
              </div>

              <ul>
                <li><i class="bi bi-dot"></i> <span>Alertas de datas importantes</span></li>
                <li><i class="bi bi-dot"></i> <span>Informações sobre manutenção</span></li>
                <li><i class="bi bi-dot"></i> <span>Consulta de multas</span></li>
                <li><i class="bi bi-dot"></i> <span>Relatório de despesas</span></li>
              </ul>

            </div>
          </div><!-- End Pricing Item -->

        </div>

      </div>

    </section><!-- /Pricing Section -->


  </main>

  <footer id="footer" class="footer dark-background">

    <div class="copyright text-center">
      <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

        <div class="d-flex flex-column align-items-center align-items-lg-start">
          <div>
            © Copyright <strong><span>CarWise</span></strong>. All Rights Reserved
          </div>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
            Designed by <a href="">CarWise Team</a>
          </div>
        </div>

      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="{{asset('js/landing.js')}}"></script>

</body>

</html>
