@extends('layouts.admin.body')
@section('titulo', 'Enunciado')
@section('conteudo')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header justify-content-between ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="card-title">Enunciado</h4>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                      
                                        <a class="btn btn-primary m-1" href="javascript:void(0);" data-toggle="modal"
                                            data-target="#CarregarChave">Carregar
                                            Chave</a>
                                        <a class="btn btn-primary m-1" href="javascript:void(0);" data-toggle="modal"
                                            data-target="#gerarEnunciadoModal">Gerar </a>
                                        <a class="btn btn-primary  m-1" target="_blank"
                                            href="{{ route('admin.enunciado.sala.enunciado.imprimir_fr_massa', $it_id_prova) }}">Imprimir
                                            folhas </a><a class="btn btn-primary  m-1" target="_blank"
                                            href="{{ route('admin.enunciado.sala.enunciado.imprimir_enunciados_massa', $it_id_prova) }}">Imprimir
                                            Enunciados </a>
                                            <a class="btn btn-primary  m-1" target="_blank"
                                            href="{{ route('admin.enunciado.sala.enunciado.corregir_massa_geral', ['id_prova' => $it_id_prova]) }}">Corrigir
                                            em massa </a>
                                    </div>
                                    <div class="modal fade" id="CarregarChave" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabelCarregarChave" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabelCarregarChave">
                                                        Carregar Chave
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('admin.enunciado.sala.enunciado.carregar_chave_geral') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="form-group col-sm-12">
                                                                <label for="it_id_prova" class="form-label">Prova</label>

                                                                <select readonly required name="it_id_prova"
                                                                    class="form-control" id="it_id_prova">
                                                                    {{-- <option disabled selected >Selecciona a prova</option> --}}
                                                                    <option value="{{ $it_id_prova }}">
                                                                        {{ $prova->vc_nome }}
                                                                    </option>

                                                                </select>

                                                            </div>
                                                            <div class="form-group col-sm-12">
                                                                <label for="">Chave</label>
                                                                <input type="file" name="chave" class="form-control">
                                                            </div>

                                                        </div>

                                                        <div
                                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                                                            <button type="submit" class="btn btn-primary">Carregar</button>
                                                        </div>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-2"><a class="btn btn-primary" "
                                                
                                                href="javascript:void(0);"
                                            data-toggle="modal" data-target="#ImprimirEnunciadoModal"
                                               >Imprimir
                                                folhas </a></div> --}}

                                </div>

                            </div><!-- end card header -->
                            <div class="card-body">
                                <table id="example" class="table
                                " style="width:100%">
                                    <thead>
                                        <th>ID</th>
                                        <th>Código</th>
                                        <th>Ano Lectivo</th>
                                        <th>Periodo</th>
                                        <th>Disciplina</th>
                                        <th>Sala</th>
                                        <th>Ações</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($enunciados as $enunciado)
                                            {{-- @dump($enunciado) --}}
                                            <tr>
                                                <td>{{ $enunciado->id }}</td>
                                                <td>{{ $enunciado->codigo }}</td>
                                                <td>{{ $enunciado->ya_inicio }}--{{ $enunciado->ya_fim }}</td>
                                                <td>{{ $enunciado->periodo }}</td>
                                                <td>{{ $enunciado->disciplina }}</td>
                                                <td>{{ $enunciado->sala }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="uil uil-ellipsis-h"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            {{-- <li><a class="dropdown-item"
                                                                    href="{{ route('admin.enunciado.sala.enunciado.imprimir', $enunciado->id) }}"
                                                                    target="_blank">Imprimir</a></li> --}}
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.enunciado.sala.folha-resposta', $enunciado->id) }}"
                                                                    target="_blank">Folha resposta</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.enunciado.sala.imprimir_enunciado', $enunciado->id) }}"
                                                                    target="_blank">Imprimir Inunciado</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.enunciado.sala.enunciado.gabarito', $enunciado->id) }}"
                                                                    target="_blank">Gabarito</a></li>
                                                            {{-- <li><a class="dropdown-item" target="_blank"
                                                                    href="{{ route('admin.enunciado.sala.enunciado.folha_correcao', $enunciado->id) }}">Folha
                                                                    de Correção</a>
                                                            </li> --}}
                                                            {{-- <li><a class="dropdown-item" href="javascript:void(0);"
                                                                    data-toggle="modal"
                                                                    data-target="#CarregarChave{{ $enunciado->id }}">Carregar
                                                                    Chave</a></li> --}}
                                                            {{-- <li><a class="dropdown-item" href="javascript:void(0);"
                                                                        data-toggle="modal"
                                                                        data-target="#CorrigirProva{{ $enunciado->id }}">Corrigir Prova
                                                                        </a></li> --}}
                                                            {{-- <li><a class="dropdown-item" href="javascript:void(0);"
                                                                    data-toggle="modal"
                                                                    data-target="#CarregarChave{{ $enunciado->id }}">Carregar
                                                                    Chave</a></li> --}}
                                                                {{-- <li><a target="_blank" class="dropdown-item"
                                                                        href="{{ route('admin.enunciado.sala.enunciado.corregir_massa', ['id_enunciado' => $enunciado->id]) }}">Corrigir
                                                                        em massa</a></li> --}}

                                                            {{-- <li><a class="dropdown-item" href="javascript:void(0);"
                                                                        data-toggle="modal"
                                                                        data-target="#gerarFolhaderespostaModal{{ $enunciado->id }}">Folha
                                                                        de
                                                                        respostas</a></li> --}}
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.enunciado.sala.enunciado.edit', $enunciado->id) }}">Editar</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.enunciado.sala.enunciado.destroy', $enunciado->id) }}">Eliminar</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.enunciado.sala.enunciado.purge', $enunciado->id) }}">Purgar</a>
                                                            </li>


                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="CarregarChave{{ $enunciado->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabelCarregarChave" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabelCarregarChave">
                                                                Carregar Chave
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('admin.enunciado.sala.enunciado.carregar_chave') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="text" name="id_enunciado"
                                                                    value="{{ $enunciado->id }}" id="" hidden>
                                                                <div class="col-12">

                                                                    <div class="row">
                                                                        <div class="form-group col-sm-12">
                                                                            <label for="">Chave</label>
                                                                            <input type="file" name="chave">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Carregar</button>
                                                                </div>

                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="CorrigirProva{{ $enunciado->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="CorrigirProva"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="CorrigirProva">
                                                                Corrigir Prova
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('admin.enunciado.sala.enunciado.corrigir_prova') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="text" name="id_enunciado"
                                                                    value="{{ $enunciado->id }}" id="" hidden>
                                                                <div class="col-12">

                                                                    <div class="row">
                                                                        <div class="form-group col-sm-12">
                                                                            <label for="">Prova</label>
                                                                            <input type="file" name="prova">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Corrigir</button>
                                                                </div>

                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="gerarFolhaderespostaModal{{ $enunciado->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabelgerarFolhaderesposta"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="exampleModalLabelgerarFolhaderesposta">Gerar
                                                                Folhaderesposta
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('admin.enunciado.sala.enunciado.gabarito_post') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf

                                                                <div class="col-12">

                                                                    <div class="row">
                                                                        <input type="text" name="id_enunciado" hidden
                                                                            value="{{ $enunciado->id }}" id="">
                                                                        <div class="form-group col-sm-12">
                                                                            <label for=""
                                                                                class="form-label">Candidato</label>
                                                                            <select required name="id_candidato"
                                                                                class="form-control">
                                                                                <option value="" selected disabled>
                                                                                    Selecciona o candidato</option>
                                                                                @foreach ($candidatos as $candidato)
                                                                                    <option
                                                                                        value="{{ isset($candidato->id) ? $candidato->id : '' }}">
                                                                                        {{ $candidato->vc_primeiro_nome }}
                                                                                        {{ $candidato->vc_ultimo_nome }}

                                                                                    </option>
                                                                                @endforeach
                                                                            </select>

                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Gerar</button>
                                                                </div>

                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Código</th>
                                            <th>Ano Lectivo</th>
                                            <th>Periodo</th>
                                            <th>Disciplina</th>
                                            <th>Sala</th>
                                            <th>Ações</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>

    </div>
    <!-- End Page-content -->
    <div class="modal fade" id="gerarEnunciadoModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabelgerarEnunciado" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelgerarEnunciado">Gerar enunciado
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.enunciado.sala.enunciado.gerar') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">

                            <div class="row">

                                <div class="form-group col-sm-12">
                                    <label for="it_id_prova" class="form-label">Prova</label>
                                    <select readonly required name="it_id_prova" class="form-control" id="it_id_prova">
                                        {{-- <option disabled selected >Selecciona a prova</option> --}}
                                        <option value="{{ $it_id_prova }}">{{ $prova->vc_nome }}
                                        </option>

                                    </select>
                                    @if ($errors->has('it_id_prova'))
                                        <small id="emailHelp" class="form-text text-danger">
                                            {{ $errors->first('it_id_prova') }}.</small>
                                    @endif
                                </div>



                                <div class="form-group col-sm-12">
                                    <label for="">Nº de enunciados</label>
                                    <input type="text" required placeholder="Digite o nº de enunciados"
                                        class="form-control" value="{{ $prova->vc_n_candidatos }}" name="n_enunciados"
                                        readonly id="n_enunciados" min="1" max="100"value="">
                                    @if ($errors->has('vc_descricao_bp'))
                                        <small id="emailHelp" class="form-text text-danger">
                                            {{ $errors->first('vc_descricao_bp') }}.</small>
                                    @endif
                                </div>


                                <div class="form-group col-sm-12">
                                    <label for="" class="form-label">Disciplina | Teste</label>
                                    <select required name="it_id_disciplina" id="it_id_disciplina" class="form-control">
                                        <option selected disabled>Selecciona a disciplina</option>
                                        @foreach ($disciplinas as $item)
                                            <option value="{{ $item->id }}">{{ $item->vc_nome }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('it_id_disciplina'))
                                        <small id="emailHelp" class="form-text text-danger">
                                            {{ $errors->first('it_id_disciplina') }}.</small>
                                    @endif
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="">Nº de perguntas</label>
                                    <input type="number" required placeholder="Digite o nº de perguntas"
                                        class="form-control" name="it_n_pergunta" min="1" id="it_n_pergunta"
                                        max="100"value="">
                                    @if ($errors->has('it_n_pergunta'))
                                        <small id="emailHelp" class="form-text text-danger">
                                            {{ $errors->first('it_n_pergunta') }}.</small>
                                    @endif
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="">Cotação por pergunta</label>
                                    <input type="number" required placeholder="Digite a cotação por pergunta"
                                        class="form-control" readonly name="it_cotacao" min="1" id="it_cotacao"
                                        step="any" max="20"value="">
                                    @if ($errors->has('it_cotacao'))
                                        <small id="emailHelp" class="form-text text-danger">
                                            {{ $errors->first('it_cotacao') }}.</small>
                                    @endif
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="">Coordernador(a)</label>
                                    <input type="text" required placeholder="Digite o nome do(a) coordenador(a)"
                                        class="form-control" name="coordenador">

                                </div>

                            </div>
                        </div>

                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary">Gerar</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>














    <div class="modal fade" id="ImprimirEnunciadoModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabelImprimirEnunciado" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelImprimirEnunciado">Imprimir enunciado
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.enunciado.sala.enunciado.gerar') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">

                            <div class="row">






                                <div class="form-group col-sm-12">
                                    <label for="" class="form-label">Disciplina | Teste</label>
                                    <select required name="it_id_disciplina" id="it_id_disciplina" class="form-control">
                                        <option selected disabled>Selecciona a disciplina</option>
                                        @foreach ($disciplinas as $item)
                                            <option value="{{ $item->id }}">{{ $item->vc_nome }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('it_id_disciplina'))
                                        <small id="emailHelp" class="form-text text-danger">
                                            {{ $errors->first('it_id_disciplina') }}.</small>
                                    @endif
                                </div>


                            </div>
                        </div>

                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary">Gerar</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>

    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    @if (session('enunciado.destroy.success'))
        <script>
            Swal.fire(
                'Enunciado Eliminado com sucesso!',
                '',
                'success'
            )
        </script>
    @endif
    @if (session('enunciado.destroy.error'))
        <script>
            Swal.fire(
                'Erro ao Eliminar Enunciado!',
                '',
                'error'
            )
        </script>
    @endif
    @if (session('enunciado.purge.success'))
        <script>
            Swal.fire(
                'Enunciado Purgado com sucesso!',
                '',
                'success'
            )
        </script>
    @endif
    @if (session('enunciado.purge.error'))
        <script>
            Swal.fire(
                'Erro ao Purgar Enunciado!',
                '',
                'error'
            )
        </script>
    @endif
@endsection
