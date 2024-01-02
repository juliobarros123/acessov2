@extends('layouts.site.app')
@section('titulo', 'Enunciado')
@section('conteudo')
    <div class="contentor  " style="background: white">
        <div class="cartao sombra-lg">
            <div class="corpo-do-cartao">
                <header class="espaco-3">
                    <div class="linha borda">
                        <div class="coluna-2 espaco-t-5 borda">
                            <img src="{{ 'assets/images/logo.png' }}" alt="" width="100%" height="100px">
                        </div>
                        <div class="coluna-8 borda">
                            <div class="imagem justify-content-center align-items-center d-flex">
                                <img src="{{ 'assets/images/insignia.png' }}" alt="" style="margin:0 auto"
                                    width="100px" height="100px">
                            </div>
                            <p class="texto-centro" id="text">
                                Republica De Angola <br>
                                MINISTÉRIO DAS TELECOMUNICAÇÕES, TECNOLOGIAS DE DE INFORMAÇÃO E COMUNICAÇÃO SOCIAL<br>
                                MINISTÉRIO DA EDUCAÇÃO <br>
                                INSTITUTO DE TELECOMUNICAÇÕES - Itel <br>
                                DEPARTAMENTO PEDAGÓGICO <br>
                            </p>
                        </div>
                        <div class="coluna-2 espaco-t-5 borda">
                            <p class="texto">09/05/2022</p>
                            <p class="texto">
                                DURAÇÃO:90 MIN
                            </p>
                            <p class="texto">
                                Cotação total:20V
                            </p>
                        </div>
                    </div>
                    <div class="linha borda">
                        <div class="coluna-4 borda">
                            <p class="texto-centro espaco-t-2">
                                Nome: Isa Solendo
                            </p>
                        </div>


                        <div class="coluna-2 borda">
                            <p class="texto-centro espaco-t-2">
                                Periodo:Tarde
                            </p>
                        </div>
                        <div class="coluna-3 borda">
                            <p class="texto-centro espaco-t-2">
                                Código:154876
                            </p>
                        </div>
                        <div class="coluna-3 borda">
                            <p class="texto-centro espaco-t-2">
                                Ano Lectivo:2023/2024
                            </p>
                        </div>
                    </div>
                </header>
                <section>
                    <div class="contentor">
                        <div class="linha">
                            <p class="espaco-cb-3">
                                Leia a prova com atenção, e responda as questões de uma forma clara
                            </p>
                        </div>
                        <div class="linha ">
                            <div class="contentor quest">
                                <strong>
                                    <h5 class="group margem-b-1">I-Grupo</h5>
                                </strong>
                                <p class="coluna-10 ">
                                    I.1 Um elemento químico da família dos halógénios apresenta 4 níveis energéticos na sua
                                    distribuição electronica. Determine o número atômico desse elemento.
                                </p>
                                <ul >
                                    <li>17</li>
                                    <li>89</li>
                                    <li>27</li>
                                </ul>
                                <p class="coluna-10 ">
                                    I.2 Um elemento químico da família dos halógénios apresenta 4 níveis energéticos na sua
                                    distribuição electronica. Determine o número atômico desse elemento.Um elemento químico
                                    da família dos halógénios apresenta 4 níveis energéticos na sua
                                    distribuição electronica. Determine o número atômico desse elemento.
                                </p>
                                <ul >
                                    <li>Alguma coisa</li>
                                    <li>Outra coisa</li>
                                    <li>O resto</li>
                                    <li>Mais algo</li>
                                </ul>
                                <strong>
                                    <h5 class="group margem-b-1">II-Grupo</h5>
                                </strong>
                                <p class="coluna-10 ">
                                    I.1 Um elemento químico da família dos halógénios apresenta 4 níveis.
                                </p>
                                <ul >
                                    <li>Alguma coisa</li>
                                    <li>Outra coisa</li>
                                    <li>O resto</li>
                                    <li>Mais algo</li>
                                </ul>
                                <p class="coluna-10 ">
                                    I.1 Um elemento químico da família dos halógénios apresenta 4 níveis energéticos na sua
                                    distribuição electronica. Determine o número atômico desse elemento.
                                </p>
                                <ul >
                                    <li>Alguma coisa</li>
                                    <li>O resto</li>
                                    <li>Mais algo</li>
                                </ul>
                                <p class="coluna-10 ">
                                    I.1 Um elemento químico da família dos halógénios apresenta 4 níveis energéticos na sua
                                    distribuição electronica. Determine o número atômico desse elemento.
                                </p>
                                <ul >
                                    <li>Alguma coisa </li>
                                    <li>Alguma coisa </li>
                                    <li>Outra coisa</li>
                                </ul>
                                <strong>
                                    <h5 class="group margem-b-1">III-Grupo</h5>
                                </strong>
                                <p class="coluna-10 ">
                                    I.1 Um elemento químico da família dos halógénios apresenta 4 níveis energéticos na sua
                                    distribuição electronica. Determine o número atômico desse elemento.
                                </p>
                                <ul >
                                    <li>Outra coisa</li>
                                    <li>O resto</li>
                                    <li>Mais algo</li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <hr class="texto-centro">
                            <p class="texto">Cotação: I.1 a)2v; b)3v; c)1.5v; d)4v; I.2 a)4v; b)6v; c)2v;</p>
                            <hr class="texto-centro">
                        </div>
                    </div>
                </section>
                <footer class="espaco-3 mt-5">
                    <p class="texto-centro" id="fim">
                        INSTITUTO DE TELECOMUNICAÇÕES, EM LUANDA, AOS 19 DE MAIO DE 2022
                    </p>
                    <p class="texto-centro" id="fim">
                        O(A) COORDENADOR(A)
                    </p>
                    <div class="coluna-12 p-2">
                        <hr class="texto-centro " style="margin: 0 auto;width:300px;colunaor: black">
                    </div>
                    <p class="texto-centro" id="fim">
                        JOSEFINA PAULO
                    </p>
                    <div class="linha">
                        <div class="coluna-3">
                            <div class="imagem ">
                                <img src="{{ 'assets/images/qrcode.jfif' }}" alt="" style="margin:0 auto"
                                    width="150px" height="150px">
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>


    <!-- Part css -->

@endsection
