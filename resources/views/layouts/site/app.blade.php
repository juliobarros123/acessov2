<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="An impressive and flawless site template that includes various UI elements and countless features, attractive ready-made blocks and rich pages, basically everything you need to create a unique and professional website.">
    <meta name="keywords"
        content="bootstrap 5, business, corporate, creative, gulp, marketing, minimal, modern, multipurpose, one page, responsive, saas, sass, seo, startup, html5 template, site template">
    <meta name="author" content="elemis">

    <title>Sandbox - Modern & Multipurpose Bootstrap 5 Template</title>
    <link rel="shortcut icon" href="{{ asset('site/assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/colors/orange.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/prova.css') }}">
</head>

<body>
    <div class="content-wrapper">
        <header class="wrapper bg-soft-primary">
            <nav class="navbar navbar-expand-lg extended navbar-light navbar-bg-light caret-none">
                <div class="container flex-lg-column">
                    <div class="topbar d-flex flex-row w-100 justify-content-between align-items-center">
                        <div class="navbar-brand"><a href="index.html"><img
                                    src="{{ asset('site/assets/img/logo-dark.png') }}"
                                    srcset="{{ asset('site/assets/img/logo-dark@2x.png 2x') }}" alt=""></a>
                        </div>
                        <div class="navbar-other ms-auto">
                            <ul class="navbar-nav flex-row align-items-center">
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvas-info"><i class="uil uil-info-circle"></i></a></li>
                                <li class="nav-item dropdown language-select text-uppercase">
                                    <a class="nav-link dropdown-item dropdown-toggle" href="demo12.html#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        _msttexthash="17719" _msthash="155">Pt</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="dropdown-item" href="demo12.html#"
                                                _msttexthash="17719" _msthash="156">Pt</a></li>
                                        <li class="nav-item"><a class="dropdown-item" href="demo12.html#"
                                                _msttexthash="16692" _msthash="157">En</a></li>
                                        <li class="nav-item"><a class="dropdown-item" href="demo12.html#"
                                                _msttexthash="18239" _msthash="158">Es</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item d-lg-none">
                                    <button class="hamburger offcanvas-nav-btn"><span></span></button>
                                </li>
                            </ul>
                            <!-- /.navbar-nav -->
                        </div>
                        <!-- /.navbar-other -->
                    </div>
                    <!-- /.d-flex -->
                    <div class="navbar-collapse-wrapper bg-white d-flex flex-row align-items-center">
                        <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                            <div class="offcanvas-header d-lg-none" _msthidden="2">
                                <h3 class="text-white fs-30 mb-0" _msttexthash="95121" _msthidden="1" _msthash="159">
                                    Sandbox</h3>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                    aria-label="Close" _msthidden="A" _mstaria-label="59709" _msthash="160"></button>
                            </div>
                            <div class="offcanvas-body d-flex flex-column h-100">
                                <ul class="navbar-nav">

                                    <li class="nav-item ">
                                        <a class="nav-link " href="{{route('site.home.index')}}"
                                             _msttexthash="106678" _msthash="197">Pagina inicial</a>
                                    
                                    </li>
                                
                                    <li class="nav-item ">
                                        <a class="nav-link " href="{{route('site.provas.index')}}"
                                             _msttexthash="76102" _msthash="239">Provas</a>
                                      
                                    </li>
                                    
                                    <li class="nav-item ">
                                        <a class="nav-link " href="{{route('site.pautas.index')}}"
                                             _msttexthash="76102" _msthash="239">Pauta</a>
                                      
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link " href="{{route('site.agendas.index')}}"
                                             _msttexthash="76102" _msthash="239">Agenda</a>
                                      
                                                                        </li>
                                    @guest

                                    <li class="nav-item ">
                                        <a class="nav-link " href="/login"
                                             _msttexthash="76102" _msthash="239">Login</a>
                                      
                                    </li>
                                    @endguest
                                                                    @auth
    
                                                                    <li class="nav-item ">
                                                                        <a class="nav-link " href="/home"
                                                                             _msttexthash="76102" _msthash="239">Painel</a>
                                                                      
                                                                    </li>

                    <li class="nav-item">
                        <form action="/logout" method="POST">
                          @csrf
                          <a href="/logout" class="nav-link" onclick="event.preventDefault();
                          this.closest('form').submit();">Sair</a>
                      </form>
                      @endauth
                      </li>
                                </ul>
                                <!-- /.navbar-nav -->
                                <div class="offcanvas-footer d-lg-none" _msthidden="1">
                                    <div _msthidden="1">
                                        <font _mstmutation="1" _msttexthash="493428" _msthidden="1" _msthash="308">
                                            <a href="cdn-cgi/l/email-protection.html#5b3d3229282f75373a282f1b3e363a323775383436"
                                                class="link-inverse" _mstmutation="1">info@email.com</a>
                                            <br _mstmutation="1"> 00 (123) 456 78 90
                                        </font><br>
                                        <nav class="nav social social-white mt-4">
                                            <a href="demo12.html#"><i class="uil uil-twitter"></i></a>
                                            <a href="demo12.html#"><i class="uil uil-facebook-f"></i></a>
                                            <a href="demo12.html#"><i class="uil uil-dribbble"></i></a>
                                            <a href="demo12.html#"><i class="uil uil-instagram"></i></a>
                                            <a href="demo12.html#"><i class="uil uil-youtube"></i></a>
                                        </nav>
                                        <!-- /.social -->
                                    </div>
                                </div>
                                <!-- /.offcanvas-footer -->
                            </div>
                        </div>
                        <!-- /.navbar-collapse -->
                        <div class="navbar-other ms-auto w-100 d-none d-lg-block">
                            <nav class="nav social social-muted justify-content-end text-end">
                                <a href="demo12.html#"><i class="uil uil-twitter"></i></a>
                                <a href="demo12.html#"><i class="uil uil-facebook-f"></i></a>
                                <a href="demo12.html#"><i class="uil uil-dribbble"></i></a>
                                <a href="demo12.html#"><i class="uil uil-instagram"></i></a>
                            </nav>
                            <!-- /.social -->
                        </div>
                        <!-- /.navbar-other -->
                    </div>
                    <!-- /.navbar-collapse-wrapper -->
                </div>
                <!-- /.container -->
            </nav>
            <!-- /.navbar -->
            <div class="offcanvas offcanvas-end text-inverse" id="offcanvas-info" data-bs-scroll="true">
                <div class="offcanvas-header">
                    <h3 class="text-white fs-30 mb-0" _msttexthash="197405" _msthash="309">Caixa de areia</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Fechar" _mstaria-label="59709" _msthash="310"></button>
                </div>
                <div class="offcanvas-body pb-6">
                    <div class="widget mb-8">
                        <p _msttexthash="6296524" _msthash="311">Sandbox é um modelo HTML5 multiuso com vários layouts
                            que serão uma ótima solução para o seu negócio.</p>
                    </div>
                    <!-- /.widget -->
                    <div class="widget mb-8">
                        <h4 class="widget-title text-white mb-3" _msttexthash="498082" _msthash="312">Informações de
                            Contato</h4>
                        <address> Moonshine St. 14/05 <br> Light City, London </address>
                        <font _mstmutation="1" _msttexthash="493428" _msthash="313"><a
                                href="cdn-cgi/l/email-protection.html#3d5b544f4e4913515c4e497d58505c5451135e5250"
                                _mstmutation="1">info@email.com</a><br _mstmutation="1"> 00 (123) 456 78 90
                        </font>
                    </div>
                    <!-- /.widget -->
                    <div class="widget mb-8">
                        <h4 class="widget-title text-white mb-3" _msttexthash="126477" _msthash="314">Saiba Mais</h4>
                        <ul class="list-unstyled">
                            <li><a href="demo12.html#" _msttexthash="257712" _msthash="315">Nossa História</a></li>
                            <li><a href="demo12.html#" _msttexthash="179777" _msthash="316">Termos de Uso</a></li>
                            <li><a href="demo12.html#" _msttexthash="496340" _msthash="317">Política de
                                    privacidade</a></li>
                            <li><a href="demo12.html#" _msttexthash="175461" _msthash="318">Fale Conosco</a></li>
                        </ul>
                    </div>
                    <!-- /.widget -->
                    <div class="widget">
                        <h4 class="widget-title text-white mb-3" _msttexthash="106418" _msthash="319">Siga-nos</h4>
                        <nav class="nav social social-white">
                            <a href="demo12.html#"><i class="uil uil-twitter"></i></a>
                            <a href="demo12.html#"><i class="uil uil-facebook-f"></i></a>
                            <a href="demo12.html#"><i class="uil uil-dribbble"></i></a>
                            <a href="demo12.html#"><i class="uil uil-instagram"></i></a>
                            <a href="demo12.html#"><i class="uil uil-youtube"></i></a>
                        </nav>
                        <!-- /.social -->
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /.offcanvas-body -->
            </div>
            <!-- /.offcanvas -->
        </header>
        <!-- /header -->
        {{-- <div class="modal fade modal-popup" id="modal-02" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content text-center">
                    <div class="modal-body">
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <figure class="mb-6"><img src="{{ asset('site/assets/img/illustrations/i7.png') }}"
                                        srcset="{{ asset('site/assets/img/illustrations/i7@2x.png 2x') }}"
                                        alt="" /></figure>
                            </div>
                            <!-- /column -->
                        </div>
                        <!-- /.row -->
                        <h3>Join the mailing list and get %10 off</h3>
                        <p class="mb-6">Nullam quis risus eget urna mollis ornare vel eu leo. Donec ullamcorper nulla
                            non metus auctor fringilla.</p>
                        <div class="newsletter-wrapper">
                            <div class="row">
                                <div class="col-md-10 offset-md-1">
                                    <!-- Begin Mailchimp Signup Form -->
                                    <div id="mc_embed_signup">
                                        <form
                                            action="https://elemisfreebies.us20.list-manage.com/subscribe/post?u=aa4947f70a475ce162057838d&amp;id=b49ef47a9a"
                                            method="post" id="mc-embedded-subscribe-form"
                                            name="mc-embedded-subscribe-form" class="validate" target="_blank"
                                            novalidate>
                                            <div id="mc_embed_signup_scroll">
                                                <div class="mc-field-group input-group form-floating">
                                                    <input type="email" value="" name="EMAIL"
                                                        class="required email form-control"
                                                        placeholder="Email Address" id="mce-EMAIL">
                                                    <label for="mce-EMAIL">Email Address</label>
                                                    <input type="submit" value="Join" name="subscribe"
                                                        id="mc-embedded-subscribe" class="btn btn-primary">
                                                </div>
                                                <div id="mce-responses" class="clear">
                                                    <div class="response" id="mce-error-response"
                                                        style="display:none"></div>
                                                    <div class="response" id="mce-success-response"
                                                        style="display:none"></div>
                                                </div>
                                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                                    <input type="text"
                                                        name="b_ddc180777a163e0f9f66ee014_4b1bcfa0bc" tabindex="-1"
                                                        value=""></div>
                                                <div class="clear"></div>
                                            </div>
                                        </form>
                                    </div>
                                    <!--End mc_embed_signup-->
                                </div>
                                <!-- /.newsletter-wrapper -->
                            </div>
                            <!-- /column -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!--/.modal-body -->
                </div>
                <!--/.modal-content -->
            </div>
            <!--/.modal-dialog -->
        </div> --}}
        @yield('conteudo')
        <!-- /.content-wrapper -->
        <footer class="bg-light">
            <div class="container py-13 py-md-15">
                <div class="row gy-6 gy-lg-0">
                    <div class="col-md-4 col-lg-3">
                        <div class="widget">
                            <img class="mb-4" src="assets/img/logo-dark.png"
                                srcset="assets/img/logo-dark@2x.png 2x" alt="" />
                            <p class="mb-4">© 2023 Itel. <br class="d-none d-lg-block" />Todos os direitos reservados.</p>
                            <nav class="nav social ">
                                <a href="demo12.html#"><i class="uil uil-twitter"></i></a>
                                <a href="demo12.html#"><i class="uil uil-facebook-f"></i></a>
                                <a href="demo12.html#"><i class="uil uil-dribbble"></i></a>
                                <a href="demo12.html#"><i class="uil uil-instagram"></i></a>
                                <a href="demo12.html#"><i class="uil uil-youtube"></i></a>
                            </nav>
                            <!-- /.social -->
                        </div>
                        <!-- /.widget -->
                    </div>
                    <!-- /column -->
                    <div class="col-md-4 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title  mb-3">Entrar em contato</h4>
                            <address class="pe-xl-15 pe-xxl-17">Luanda, Distrito do Rangel, bairro CTT KM-7
                            </address>
                            <a href="cdn-cgi/l/email-protection.html#1f3c" class="link-body"><span
                                    class="__cf_email__"
                                    data-cfemail="e881868e87a88d85898184c68b8785"> secretariaitel@hotmail.com</span></a><br />
                           +244 931 313 333
                        </div>
                        <!-- /.widget -->
                    </div>
                    <!-- /column -->
                    <div class="col-md-4 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title  mb-3">Saiba Mais</h4>
                            <ul class="list-unstyled text-reset mb-0">
                                <li><a href="demo12.html#">Sobre Nós</a></li>
                                <li><a href="demo12.html#">Nossa História</a></li>
                                <li><a href="demo12.html#">Projetos</a></li>
                                <li><a href="demo12.html#">Termos De Uso</a></li>
                                <li><a href="demo12.html#">Política de Privacidade</a></li>
                            </ul>
                        </div>
                        <!-- /.widget -->
                    </div>
                    <!-- /column -->
                    <div class="col-md-12 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title  mb-3">Nosso boletim informativo</h4>
                            <p class="mb-5">Assine nosso site para receber nossas novidades.</p>
                            <div class="newsletter-wrapper">
                                <!-- Begin Mailchimp Signup Form -->
                                <div id="mc_embed_signup2">
                                    <form
                                        action="https://elemisfreebies.us20.list-manage.com/subscribe/post?u=aa4947f70a475ce162057838d&amp;id=b49ef47a9a"
                                        method="post" id="mc-embedded-subscribe-form2"
                                        name="mc-embedded-subscribe-form" class="validate " target="_blank"
                                        novalidate>
                                        <div id="mc_embed_signup_scroll2">
                                            <div class="mc-field-group input-group form-floating">
                                                <input type="email" value="" name="EMAIL"
                                                    class="required email form-control" placeholder="Email Address"
                                                    id="mce-EMAIL2">
                                                <label for="mce-EMAIL2">Endereço de Email</label>
                                                <input type="submit" value="Join" name="subscribe"
                                                    id="mc-embedded-subscribe2" class="btn btn-primary ">
                                            </div>
                                            <div id="mce-responses2" class="clear">
                                                <div class="response" id="mce-error-response2" style="display:none">
                                                </div>
                                                <div class="response" id="mce-success-response2"
                                                    style="display:none"></div>
                                            </div>
                                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input
                                                    type="text" name="b_ddc180777a163e0f9f66ee014_4b1bcfa0bc"
                                                    tabindex="-1" value=""></div>
                                            <div class="clear"></div>
                                        </div>
                                    </form>
                                </div>
                                <!--End mc_embed_signup-->
                            </div>
                            <!-- /.newsletter-wrapper -->
                        </div>
                        <!-- /.widget -->
                    </div>
                    <!-- /column -->
                </div>
                <!--/.row -->
            </div>
            <!-- /.container -->
        </footer>
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>
        <script data-cfasync="false" src="{{ asset('site/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}">
        </script>
        <script src="{{ asset('site/assets/js/plugins.js') }}"></script>
        <script src="{{ asset('site/assets/js/theme.js') }}"></script>
</body>

</html>
