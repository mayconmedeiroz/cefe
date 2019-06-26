<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Home - CEFE</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top py-3">
        <a href="index.html" class="navbar-brand ">
            <img src="{{ asset('img/home/logo.png') }}" alt="Caravan" width="80px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                   <a class="nav-link" href="#"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="subpages/contato.html">Contato</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sobre</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Eventos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Modalidade</a>
                </li>
              </ul>
            </div>
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                      @auth
                          <a class="btn btn-outline-primary ml-md-3" href="{{ url('dashboard') }}">Dashboard</a>
                      @else
                          <a class="btn btn-outline-primary ml-md-3" href="{{ route('login') }}">Login</a>
                      @endauth
                  </li>
              </ul>
            </div>
    </nav>
    <!--END HEADER-->

    <!--START CAROUSEL-->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('img/home/educa.png') }}" class="d-block w-100 cefe" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('img/home/cefe1.jpeg') }}" class="d-block w-100 cefe" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('img/home/esportes-colegio-santo-antonio-34lzx13ldswnruljcpdds0.jpg') }}" class="d-block w-100 cefe" alt="...">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <!--END CAROUSEL-->

      <section class="banner py-2 bg-light">
        <div class="container py-5">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="top-banner-content">
                    <h2 class="title" id="titulo-p">
                       Centro Esportivo Faetec
                    </h2>
                    <p class="text">
                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                          when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                          It has survived not only five centuries, but also the leap into electronic typesetting,
                          remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                          sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus
                          PageMaker including
                    </p>
                    <div class="more text-right">
                        <a class="btn btn-outline-primary ml-md-3 more" href="#">Leia Mais</a>
                    </div>
                  </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-center">
                <div class="top-banner-img">
                  <img src="{{ asset('img/home/banner.jpg') }}" alt="">
                </div>
            </div>
           </div>
          </div>
      </section>
      <!-- END BANNER-->
      <!-- elementos do eventos-->
      <section class="lest-events">
        <div class="container">
          <div class="row">
              <div class="section-title text-center col-md-12">
                <h3 class="title">
                  <span class="inner"> Ultimos Eventos</span>
                </h3>
              </div>
          </div>
          <!-- elementos do eventos-->
          <div class="row justify-content-center">
              <div class="col-lg-3 col-md-6 col-sm-6 col-12 event">
                <div class="single-event">
                  <div class="img">
                    <img src="http://www.codetroopers-team.com/gmsms/assets/uploads/event/event-1518629487-sms.jpg" alt="">
                  </div>
                  <div class="content">
                    <h2 class="title text-center"><a href="#">Torneio Futebol</a></h2>
                      <ul class="list">
                        <li class="info"><span class="icon"><i class="fas fa-user pr-2"></i></span>Alunos</li>
                        <li class="info"><span class="icon"><i class="far fa-calendar-alt pr-2"></i></span>01/07/19</li>
                        <li class="info"><span class="icon"><i class="far fa-calendar-alt pr-2"></i></span>05/07/19</li>
                        <li class="info"><span class="icon"><i class="fas fa-map-marker-alt pr-2"></i></span>Campo Principal</li>
                      </ul>
                      <div class="more text-center">
                        <a href="#" class="btn btn-primary btn-sm mb-2">Leia Mais</a>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12 event">
                <div class="single-event">
                  <div class="img">
                    <img src="http://www.codetroopers-team.com/gmsms/assets/uploads/event/event-1518631935-sms.jpg" alt="">
                  </div>
                  <div class="content">
                    <h2 class="title text-center "><a href="#">Passeio</a></h2>
                      <ul class="list">
                        <li class="info"><span class="icon"><i class="fas fa-user pr-2"></i></span>Mauzinho</li>
                        <li class="info"><span class="icon"><i class="far fa-calendar-alt pr-2"></i></span>19/09/19</li>
                        <li class="info"><span class="icon"><i class="far fa-calendar-alt pr-2"></i></span>19/09/19</li>
                        <li class="info"><span class="icon"><i class="fas fa-map-marker-alt pr-2"></i></span>Endereço\Local</li>
                      </ul>
                      <div class="more text-center">
                          <a href="#" class="btn btn-primary btn-sm mb-2">Leia Mais</a>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12 event">
                <div class="single-event">
                    <img src="http://www.codetroopers-team.com/gmsms/assets/uploads/event/event-1523282168-sms.jpg" alt="">
                  <div class="content">
                    <h2 class="title text-center"><a href="#">Torneio Xadrez</a></h2>
                      <ul class="list">
                        <li class="info"><span class="icon"><i class="fas fa-user pr-2"></i></span>Alunos</li>
                        <li class="info"><span class="icon"><i class="far fa-calendar-alt pr-2"></i></span>20/05/19</li>
                        <li class="info"><span class="icon"><i class="far fa-calendar-alt pr-2"></i></span>20/05/19</li>
                        <li class="info"><span class="icon"><i class="fas fa-map-marker-alt pr-2"></i></span>Auditorio</li>
                      </ul>
                      <div class="more text-center">
                        <a href="#" class="btn btn-primary btn-sm mb-2">Leia Mais</a>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12 event">
                <div class="single-event">
                    <img src="http://www.codetroopers-team.com/gmsms/assets/uploads/event/event-1518630000-sms.jpg" alt="">
                  <div class="content">
                    <h2 class="title text-center"><a href="#">Baseball</a></h2>
                      <ul class="list">
                        <li class="info"><span class="icon"><i class="fas fa-user pr-2"></i></span>Alunos</li>
                        <li class="info"><span class="icon"><i class="far fa-calendar-alt pr-2"></i></span>20/10/19</li>
                        <li class="info"><span class="icon"><i class="far fa-calendar-alt pr-2"></i></span>30/10/19</li>
                        <li class="info"><span class="icon"><i class="fas fa-map-marker-alt pr-2"></i></span>Campus Soluer</li>
                      </ul>
                      <div class="more text-center">
                        <a href="#" class="btn btn-primary btn-sm mb-2">Leia Mais</a>
                      </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </section>
      <section  class="mt-5 p-md-5 achivement-area bg-with-black ">
          <blockquote class="blockquote text-center p-md-5 p-3">
            <p class="display-4 title">
              <em>
                "Na hora que você pegar na bola, se você não sabe o que fazer com ela, tente outro esporte."
              </em>
              </p>
          </blockquote>
      </section>
      <!-- carousel com os esportes disponiveis -->
    <div class="container-fluid bg-light">
      <div class="container pt-4">
        <h3 class="text-center">Modalidade disponiveis</h3>
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
           <div class="carousel-inner">
              <div class="carousel-item active">
                 <div class="row">
                    <div class="card col-md-3 bg-light">
                      <img class="card-img-top img-fluid" src="{{ asset('img/home/natacard.jpg') }}" alt="Card image cap">
                        <div class="card-body">
                          <h4 class="card-title">Natação</h4>
                          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                    <div class="card col-md-3 bg-light">
                      <img class="card-img-top img-fluid" src="{{ asset('img/home/xadrezcard.jpg') }}" alt="Card image cap">
                        <div class="card-body">
                          <h4 class="card-title">Xadrez</h4>
                          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                    <div class="card col-md-3 bg-light">
                      <img class="card-img-top img-fluid" src="{{ asset('img/home/alongacard.jpg') }}" alt="Card image cap">
                        <div class="card-body">
                          <h4 class="card-title">Alongamento</h4>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                    <div class="card col-md-3 bg-light">
                      <img class="card-img-top img-fluid" src="{{ asset('img/home/corridacard.jpg') }}" alt="Card image cap">
                        <div class="card-body">
                          <h4 class="card-title">Corrida</h4>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                 </div>
           </div>
          <div class="carousel-item">
            <div class="row">
              <div class="card col-md-3 bg-light">
                <img class="card-img-top img-fluid" src="{{ asset('img/home/futebol_card.jpg') }}" alt="Card image cap">
                  <div class="card-body">
                    <h4 class="card-title">Futebol</h4>
                      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  </div>
              </div>
                <div class="card col-md-3 bg-light">
                  <img class="card-img-top img-fluid" src="{{ asset('img/home/lutacard.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                      <h4 class="card-title">Luta</h4>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
                <div class="card col-md-3 bg-light">
                  <img class="card-img-top img-fluid" src="{{ asset('img/home/basquecard.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                      <h4 class="card-title">Basquete</h4>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
                <div class="card col-md-3 bg-light">
                  <img class="card-img-top img-fluid" src="{{ asset('img/home/basecard.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                     <h4 class="card-title">Baseball</h4>
                      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </div>
  </div>
</div>
<footer class="bg-dark text-white">
    <div class="container py-4">
      <div class="row">
        <div class="col-md-3 col-6">
            <h4 class="h6">PAGINAS</h4>
            <ul class="list-unstyled">
              <li><a href="planos.html">Eventos</a></li>
              <li><a href="contato.html">Modalidades</a></li>
              <li><a href="inscricao.html">Contatos</a></li>
            </ul>
        </div>
        <div class="col-md-3 col-6">
          <h4 class="h6">Escolas</h4>
          <ul class="list-unstyled">
            <li><a href="local.html">Oscar Tenorio</a></li>
            <li><a href="local.html">Visconde de Maúa</a></li>
            <li><a href="local.html">Maúa fundamental</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h4 class="h6">DADOS DE CONTATO</h4>
          <ul class="list-unstyled text-secondary">
            <li>centroesportivo@gmail.com</li>
            <li>(21)2342-2232</li>
            <li>De <em>seg a sexta</em></li>
          </ul>
        </div>
        <div class="col-md-2">
          <h4 class="h6">REDES SOCIAS</h4>
          <ul class="list-unstyled text-secondary rede">
              <li><a class="btn btn-outline-secondary btn-block btn-sm" href="#">Facebook</a></li>
              <li><a class="btn btn-outline-secondary btn-block my-2 btn-sm" href="#">Instagram</a></li>
              <li><a class="btn btn-outline-secondary btn-block btn-sm" href="#">Twitter</a></li>
          </ul>
        </div>
      </div>
    </div>
        <div class="bg-primary text-center py-2">
          <p class="mb-0">Centro Esportivo © 2019. Alguns direitos reservados.</p>
       </div>
</footer>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>