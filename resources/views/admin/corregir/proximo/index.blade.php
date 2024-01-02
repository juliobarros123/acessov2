@extends('layouts.admin.body')
@section('titulo', 'Classe')
@section('conteudo')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <form action="{{ route('admin.correcoes.finalizar') }}" target="_blank" method="post">
                        @csrf
                        <div class="card shadow-lg">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Correção da prova</h4>
                            </div>
                            <div class="card-body">
                                <header class="p-3">
                                    <div class="row border">
                                        <div class="col-2 pt-5 border">
                                            <img src="{{ asset('assets/images/logo.png') }}" alt="" width="100%"
                                                height="100px">
                                        </div>
                                        <div class="col-8 border">
                                            <div class="img justify-content-center align-items-center d-flex">
                                                <img src="{{ asset('assets/images/insignia.png') }}" alt=""
                                                    style="margin:0 auto" width="100px" height="100px">
                                            </div>
                                            <p class="text-center" id="text">
                                                REPÚBLICA DE ANGOLA <br>
                                                MINISTÉRIO DAS TELECOMUNICAÇÕES DE INFORMAÇÃO E COMUNICAÇÃO SOCIAL <br>
                                                MINISTÉRIO DA EDUCAÇÃO <br>
                                                INSTITUTO DE TELECOMUNICAÇÕES - ITEL <br>
                                                DEPARTAMENTO PEDAGÓGICO <br>
                                            </p>
                                        </div>
                                        <div class="col-2 pt-5 border">
                                            <p class="text">09/05/2022</p>
                                            <p class="text">
                                                DURAÇÃO:90 MIN
                                            </p>
                                            <p class="text">
                                                Cotação total:20V
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row border">
                                        <div class="col-4 border">
                                            <p class="text pt-2">
                                                Nome:
                                            </p>
                                        </div>


                                        <div class="col-2 border">
                                            <p class="text-center pt-2">
                                                Período:{{ $enunciado->periodo }}
                                            </p>
                                        </div>
                                        <div class="col-3 border">
                                            <p class="text-center pt-2">
                                                Código:{{ $enunciado->codigo }}
                                            </p>
                                        </div>
                                        <div class="col-3 border">
                                            <p class="text pt-2">
                                                Ano Lectivo:{{ $enunciado->ya_inicio }}/{{ $enunciado->ya_fim }}
                                            </p>
                                        </div>
                                    </div>
                                </header>
                                <section>
                                    @php
                                        $nota = 0;
                                        $cot = 0;
                                    @endphp
                                    <div class="container">
                                        <div class="row">
                                            <p class="py-3">
                                                Leia a prova com atenção, e responda as questões de uma forma clara
                                            </p>
                                        </div>
                                        <div class="row ">
                                            <div class="container quest">
                                                <strong>
                                                    {{-- <h5 class="group mb-1">I-Grupo</h5> --}}
                                                </strong>
                                                @foreach (perguntas()->where('perguntas.it_id_enunciado', $enunciado->id)->get() as $pergunta)
                                                    {{-- @dump(perguntas()->where('perguntas.it_id_enunciado',$enunciado->id)->get()) --}}
                                                    <p class="col-10 ">
                                                        I.{{ $pergunta->it_numero }}
                                                        @if (in_array($pergunta->id, $  ))
                                                             <i class="fas fa-thumbs-up text-success"></i>
                                                        @else
                                                        <i class="fas fa-times text-danger"></i>
                                                        @endif
                                                    </p>
                                                    {{-- @dump(alineas_geradas()) --}}
                                                    {{-- @dump(alineas_geradas()->where('alinea_geradas.it_id_pergunta',9)->get(),"ol") --}}
                                                    {{-- @dump(alineas_geradas()->where('perguntas.id',$pergunta->id)->where('perguntas.it_id_enunciado',$enunciado->id)->get()) --}}
                                                    <ol type="a">
                                                        @foreach (alineas_geradas()->where('alinea_geradas.it_id_pergunta', $pergunta->id)->get() as $alinea)
                                                            <li> {{ $alinea->alinea }}) @if (in_array($pergunta->id . '_' . banco_alinea($alinea->it_id_banco_alinea)->id, $respostas))
                                                                    @php
                                                                        $nota += $pergunta->it_cotacao;

                                                                    @endphp
                                                                        <i class="fas fa-thumbs-up text-success"></i>
                                                                <input type="checkbox" hidden name="{{$pergunta->id}}_{{banco_alinea($alinea->it_id_banco_alinea)->id}}" checked>

                                                                @else
                                                                    {{-- Errada --}}
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div>
                                            <hr class="text-center">
                                            <p class="text">Cotação:
                                                @foreach (perguntas()->where('perguntas.it_id_enunciado', $enunciado->id)->get() as $pergunta)
                                                    {{ $pergunta->it_numero }}) {{ $pergunta->it_cotacao }}v;
                                                @endforeach
                                            </p>
                                            <hr class="text-center">
                                        </div>
                                        <div>
                                            <hr class="text-center">
                                            <p class="text">Cotação acarretada:
                                                @foreach (perguntas()->where('perguntas.it_id_enunciado', $enunciado->id)->get() as $pergunta)
                                                    @php
                                                        $cot += $pergunta->it_cotacao;
                                                    @endphp
                                                @endforeach
                                                <span
                                                    style="color:{{ $nota >= 10 ? 'green' : 'red' }}">{{ $nota }}</span>
                                                de <span style="color:green">{{ $cot }}</span> v
                                            </p>
                                            <hr class="text-center">
                                        </div>

                                    </div>
                                </section>
                                <footer class="p-3 mt-5">
                                    <p class="text-center" id="fim">
                                        INSTITUTO DE TELECOMUNICAÇÕES, EM LUANDA, AOS {{ hoje_extenso() }}
                                    </p>
                                    <p class="text-center" id="fim">
                                        O(A) COORDENADOR(A)
                                    </p>
                                    <div class="col-12 p-2">
                                        <hr class="text-center " style="margin: 0 auto;width:300px;color: black">
                                    </div>
                                    <p class="text-center" id="fim">
                                        {{ $enunciado->vc_coordenador }}
                                    </p>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="img ">
                                                <img src="{{ asset('assets/images/qrcode.jfif') }}" alt=""
                                                    style="margin:0 auto" width="150px" height="150px">
                                            </div>
                                        </div>
                                    </div>
                                </footer>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="" class="form-label">O código do enunciado</label>
                                <input type="text" class="form-control" value="{{ $enunciado->codigo}}" placeholder="Digite o código do enunciado" name="vc_codigo_enunciado">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="" class="form-label">O código do estudante</label>
                                <input type="text" class="form-control" placeholder="Digite o código do estudande" required name="vc_codigo_estudande">
                            </div>

                            <div class="mt-4 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary w-md">Finalizar correção</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end row -->



            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->



    </div>

    <style type="text/css">
        #text {
            font-size: small;
        }

        .text {
            text-align: center;
        }

        .quest {
            margin-left: 5rem;
            margin-right: 5rem;
        }

        .group {
            padding-left: 50px;
            padding-bottom: 5px;
        }

        #fim {
            font-size: small;
            text-transform: uppercase;
        }

        hr {
            margin-left: 23%;
            width: 600px;
        }
    </style>


@endsection
