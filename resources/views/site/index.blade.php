@extends('layouts.site.app')
@section('titulo',' Folha Prova')
@section('conteudo')
 <!--/.modal -->
    <section class="wrapper bg-soft-primary">
      <div class="container pt-10 pb-15 pt-md-14 pb-md-20">
        <div class="row gx-lg-8 gx-xl-12 gy-10 mb-5 align-items-center">
          <div class="col-md-10 offset-md-1 offset-lg-0 col-lg-5 text-center text-lg-start order-2 order-lg-0" data-cues="slideInDown" data-group="page-title" data-delay="600">
            <h1 class="display-1 mb-5 mx-md-n5 mx-lg-0">Testes De Admissão Itel </h1>
            <p class="lead fs-lg mb-7">Tenha A Oportunidade se Inscrever Na Melhor Escola Tecnológica de Angola. Instituto de Telecomunicações-Itel, aposte na melhor formação que poderia desejar.</p>
            <div class="d-flex justify-content-center justify-content-lg-start" data-cues="slideInDown" data-group="page-title-buttons" data-delay="900">
              <span><a class="btn btn-primary rounded me-2">Ver projetos</a></span>
              <span><a class="btn btn-yellow rounded">Saiba Mais</a></span>
            </div>
          </div>
          <!-- /column -->
          <div class="col-lg-7" data-cue="slideInDown">
            <figure><img class="w-auto" src="{{asset('site/assets/img/illustrations/i6.png')}}" srcset="{{asset('site/assets/img/illustrations/i6@2x.png 2x')}}" alt="" /></figure>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light">
      <div class="container py-14 py-md-16 pb-md-17">
        <div class="row gx-md-5 gy-5 mt-n18 mt-md-n21 mb-14 mb-md-17">
          <div class="col-md-6 col-xl-3">
            <div class="card shadow-lg card-border-bottom border-soft-yellow">
              <div class="card-body">
                <img src="{{asset('site/assets/img/icons/lineal/browser.svg')}}" class="svg-inject icon-svg icon-svg-md text-yellow mb-3" alt="" />
                <h4>Testes De Admissão</h4>
                <p class="mb-2">Somos o órgão responsável pela efetuação de testes/provas, para avaliar as habilidades e conhecimento dos candidatos à Instituição</p>
                <!-- <a href="demo12.html#" class="more hover link-yellow">Learn More</a> -->
              </div>
              <!--/.card-body -->
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-6 col-xl-3">
            <div class="card shadow-lg card-border-bottom border-soft-green">
              <div class="card-body">
                <img src="{{asset('site/assets/img/icons/lineal/chat-2.svg')}}" class="svg-inject icon-svg icon-svg-md text-green mb-3" alt="" />
                <h4>Testes De Admissão</h4>
                <p class="mb-2">Ajuda os canditatos na preparação dos testes para o qual se preparam, visualização de quais disciplínas/sumários irão testar e permite a visualização das notas individuais, assim como o resultado final.</p>
                <!-- <a href="demo12.html#" class="more hover link-green">Learn More</a> -->
              </div>
              <!--/.card-body -->
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-6 col-xl-3">
            <div class="card shadow-lg card-border-bottom border-soft-orange">
              <div class="card-body">
                <img src="{{asset('site/assets/img/icons/lineal/id-card.svg')}}" class="svg-inject icon-svg icon-svg-md text-orange mb-3" alt="" />
                <h4>Abrangência Dos Testes</h4>
                <p class="mb-2">Indepente do curso escolhido pelo candidato, as disciplínas/sumários de teste são os mesmos, não tendo especificidades em termos de cursos.</p>
                <!-- <a href="demo12.html#" class="more hover link-orange">Learn More</a> -->
              </div>
              <!--/.card-body -->
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-6 col-xl-3">
            <div class="card shadow-lg card-border-bottom border-soft-blue">
              <div class="card-body">
                <img src="{{asset('site/assets/img/icons/lineal/gift.svg')}}" class="svg-inject icon-svg icon-svg-md text-blue mb-3" alt="" />
                <h4>Perfil do usuário</h4>
                <p class="mb-2">Apresentamos um layout (disposição/organização do site) simples e claro para facilitar a navegabilidade e orientação do usuário.</p>
                <!-- <a href="demo12.html#" class="more hover link-blue">Learn More</a> -->
              </div>
              <!--/.card-body -->
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
        <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-17 align-items-center">
          <div class="col-lg-7">
            <figure><img class="w-auto" src="{{asset('site/assets/img/illustrations/i8.png')}}" srcset="{{asset('site/assets/img/illustrations/i8@2x.png 2x')}}" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col-lg-5">
            <h3 class="display-4 mb-7">Nossos cursos ministrados.</h3>
            <div class="d-flex flex-row mb-6">
              <div>
                <span class="icon btn btn-circle btn-soft-primary pe-none me-5"><span class="number fs-18">1</span></span>
              </div>
              <div>
                <h4 class="mb-1">Técnico De Informática</h4>
                <p class="mb-0">
                  Este curso tem como objetivo, proporcionar ao aluno uma formação profissional técnica de nível médio, na área das tecnologias de informação e comunicação afim de desenvolver programas de computador, conhecer, identificar, instalar e configurar recursos de hardware e software, organizar computadores em rede local e realizar implementações adequadas de programas que operem em ambientes de rede, operacionalizar programação e configuração de banco de dados.</p>
            </div>
            </div>
            <div class="d-flex flex-row mb-6">
              <div>
                <span class="icon btn btn-circle btn-soft-primary pe-none me-5"><span class="number fs-18">2</span></span>
              </div>
              <div>
                <h4 class="mb-1">Técnico De Informática E Sistemas Multimédia</h4>
                <p class="mb-0">Este curso é dirigido a jovens criativos e amantes da inovação com aptidões em adquirir competências na área de Informática, na sua vertente de Desenvolvimento de Sistemas Multimédia. Isto é, desenvolver habilidade em cinematografia, sonoplastia, programação ( web e Desktop), Design gráfico, Gestão de Mídias Sociais, Web Design, Jogos, Tipografia, Modelagem 3D, Vectorização, Realidade Virtual, Realidade Aumentada, Fotografia Digital e muito mais.</p>
              </div>
            </div>
            <div class="d-flex flex-row">
              <div>
                <span class="icon btn btn-circle btn-soft-primary pe-none me-5"><span class="number fs-18">3</span></span>
              </div>
              <div>
                <h4 class="mb-1">Electrónica E Telecomunicações</h4>
                <p class="mb-0">Este curso tem como objetivo formar técnicos a nível médio, capazes de desempenhar funções de planeamento e projeto nos domínios dos Sistemas Eletrónicos(analógicos e digitais), sistemas de automatização, Instrumentação, Controlo, análise e processamento de sinais e sistemas de Telecomunicações.</p>
              </div>
            </div>
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
        <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
          <div class="col-lg-7 order-lg-2">
            <figure><img class="w-auto" src="{{asset('site/assets/img/illustrations/i2.png')}}" srcset="{{asset('site/assets/img/illustrations/i2@2x.png 2x')}}" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col-lg-5">
            <h3 class="display-4 mb-7 mt-lg-10">Algumas Funcionalidades Oferecidas Pela Nossa plataforma:</h3>
            <div class="accordion accordion-wrapper" id="accordionExample">
              <div class="card plain accordion-item">
                <div class="card-header" id="headingOne">
                  <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Acesso Às Disciplínas/Sumários </button>
                </div>
                <!--/.card-header -->
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="card-body">
                    <p>Disponibilizamos quais disciplínas/sumários serão usadas para os testes, assim como meios de preparação para as mesmas.</p>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.accordion-collapse -->
              </div>
              <!--/.accordion-item -->
              <div class="card plain accordion-item">
                <div class="card-header" id="headingTwo">
                  <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> Acesso Aos Resultados</button>
                </div>
                <!--/.card-header -->
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="card-body">
                    <p>Funcionalidade de apresentação das notas de cada prova e o resultado final, sou seja, se está apto ou não apto.</p>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.accordion-collapse -->
              </div>
              <!--/.accordion-item -->
              <div class="card plain accordion-item">
                <div class="card-header" id="headingThree">
                  <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Acesso À Agenda De Testes</button>
                </div>
                <!--/.card-header -->
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="card-body">
                    <p>Possibilidade de visualização da data em que deverá dirigir-se ao local apropriado e efetuar os testes.</p>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.accordion-collapse -->
              </div>
              <!--/.accordion-item -->
            </div>
            <!--/.accordion -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-soft-primary">
      <div class="container py-14 pt-md-17 pb-md-20">
        <div class="row gx-lg-8 gx-xl-12 gy-10 gy-lg-0">
          <div class="col-lg-4 text-center text-lg-start">
            <h3 class="display-4 mb-3 pe-xl-15">Temos Orgulho De Nossos Trabalhos</h3>
            <p class="lead fs-lg mb-0 pe-xxl-10">Poucos, Mas Bons.</p>
          </div>
          <!-- /column -->
          <div class="col-lg-8 mt-lg-2">
            <div class="row align-items-center counter-wrapper gy-6 text-center">
              <div class="col-md-4">
                <img src="{{asset('site/assets/img/icons/lineal/check.svg')}}" class="svg-inject icon-svg icon-svg-md text-primary mb-3" alt="" />
                <h3 class="counter">7518</h3>
                <p>Projetos completos</p>
              </div>
              <!--/column -->
              <div class="col-md-4">
                <img src="{{asset('site/assets/img/icons/lineal/user.svg')}}" class="svg-inject icon-svg icon-svg-md text-primary mb-3" alt="" />
                <h3 class="counter">3472</h3>
                <p>Alunos Satisfeitos</p>
              </div>
              <!--/column -->
              <div class="col-md-4">
                <img src="{{asset('site/assets/img/icons/lineal/briefcase-2.svg')}}" class="svg-inject icon-svg icon-svg-md text-primary mb-3" alt="" />
                <h3 class="counter">2184</h3>
                <p>Funcionários Especialistas</p>
              </div>
              <!--/column -->
            </div>
            <!--/.row -->
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light">
      <div class="container py-14 py-md-16 pb-md-17">
        <div class="grid mb-14 mb-md-18 mt-3">
          <div class="row isotope gy-6 mt-n19 mt-md-n22">
            <div class="item col-md-6 col-xl-3">
              <div class="card shadow-lg card-border-bottom border-soft-primary">
                <div class="card-body">
                  <span class="ratings five mb-3"></span>
                  <blockquote class="icon mb-0">
                    <p>Equipa qualificada que contribui para o controle e funcionamento do Sistema.</p>
                  </blockquote>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!--/column -->
            <div class="item col-md-6 col-xl-3">
              <div class="card shadow-lg card-border-bottom border-soft-primary">
                <div class="card-body">
                  <span class="ratings five mb-3"></span>
                  <blockquote class="icon mb-0">
                    <p>Recursos para constante manutenção e prevenção de possíveis erros.</p>
                  </blockquote>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!--/column -->
            <div class="item col-md-6 col-xl-3">
              <div class="card shadow-lg card-border-bottom border-soft-primary">
                <div class="card-body">
                  <span class="ratings five mb-3"></span>
                  <blockquote class="icon mb-0">
                    <p>Segurança na arquivação dos dados específicos dos usuários.</p>
                  </blockquote>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!--/column -->
            <div class="item col-md-6 col-xl-3">
              <div class="card shadow-lg card-border-bottom border-soft-primary">
                <div class="card-body">
                  <span class="ratings five mb-3"></span>
                  <blockquote class="icon mb-0">
                    <p>Informações rigorosamente credíveis e compatíveis com os resultaods reais.</p>
                  </blockquote>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!--/column -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.grid-view -->
        <div class="projects-tiles">
          <div class="project grid grid-view">
            <div class="row gx-md-8 gx-xl-12 gy-10 gy-md-12 isotope">
              <div class="item col-md-6 mt-md-7 mt-lg-15">
                <div class="project-details d-flex justify-content-center align-self-end flex-column ps-0 pb-0">
                  <div class="post-header">
                    <h2 class="display-4 mb-4 pe-xxl-15">Confira Algum Dos Nossos Projetos.</h2>
                    <p class="lead fs-lg mb-0">Apoiamos Iniciativas Produtivas Dos Nossos Alunos.</p>
                  </div>
                  <!-- /.post-header -->
                </div>
                <!-- /.project-details -->
              </div>
              <!-- /.item -->
              <div class="item col-md-6">
                <figure class="lift rounded mb-6"><a href="single-project3.html"> <img src="{{asset('site/assets/img/photos/rp1.jpg')}}" srcset="{{asset('site/assets/img/photos/rp1@2x.jpg 2x')}}" alt="" /></a></figure>
                <div class="post-category text-line mb-2 text-violet">Stationary</div>
                <h2 class="post-title h3">Ipsum Ultricies Cursus</h2>
              </div>
              <!-- /.item -->
              <div class="item col-md-6">
                <figure class="lift rounded mb-6"><a href="single-project2.html"> <img src="{{asset('site/assets/img/photos/rp2.jpg')}}" srcset="{{asset('site/assets/img/photos/rp2@2x.jpg 2x')}}" alt="" /></a></figure>
                <div class="post-category text-line mb-2 text-leaf">Invitation</div>
                <h2 class="post-title h3">Mollis Ipsum Mattis</h2>
              </div>
              <!-- /.item -->
              <div class="item col-md-6">
                <figure class="lift rounded mb-6"><a href="single-project.html"> <img src="{{asset('site/assets/img/photos/rp3.jpg')}}" srcset="{{asset('site/assets/img/photos/rp3@2x.jpg 2x')}}" alt="" /></a></figure>
                <div class="post-category text-line mb-2 text-purple">Notebook</div>
                <h2 class="post-title h3">Magna Tristique Inceptos</h2>
              </div>
              <!-- /.item -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.project -->
        </div>
        <!-- /.projects-tiles -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-soft-primary">
      <div class="container py-14 py-md-17">
        <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
          <div class="col-lg-7">
            <figure><img class="w-auto" src="{{asset('site/assets/img/illustrations/i5.png')}}" srcset="{{asset('site/assets/img/illustrations/i5@2x.png 2x')}}" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col-lg-5">
            <h3 class="display-4 mb-7">Tem Alguma Dúvida? Não Hesite Em Contactar-nos.</h3>
            <div class="d-flex flex-row">
              <div>
                <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-location-pin-alt"></i> </div>
              </div>
              <div>
                <h5 class="mb-1">Endereço</h5>
                <address> Luanda, Distrito do Rangel, bairro CTT KM-7</address>
              </div>
            </div>
            <div class="d-flex flex-row">
              <div>
                <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-phone-volume"></i> </div>
              </div>
              <div>
                <h5 class="mb-1">Terminal</h5>
                <p>Telefone I: +244 931 313 333</p>
                <p>Telefone II: +244 997 788 768</p>
                <p>Telefone III: +244 222 381 640</p>
              </div>
            </div>
            <div class="d-flex flex-row">
              <div>
                <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-envelope"></i> </div>
              </div>
              <div>
                <h5 class="mb-1">E-mail</h5>
                <p>Email I: secretariaitel@hotmail.com</p>
                <p>Email II: geral@itel.gov.ao</p>
              </div>
            </div>
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
  </div>

@endsection