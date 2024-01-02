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
                                    <div class="col-md-10">
                                        <h4 class="card-title">Enunciado</h4>
                                    </div>
                                    {{-- <div class="col-md-2"><a class="btn btn-primary" href="javascript:void(0);"
                                            data-toggle="modal" data-target="#gerarEnunciadoModal">Gerar </a></div> --}}
                                </div>

                            </div><!-- end card header -->
                            <div class="card-body">
                                <table id="example" class="table
                                " style="width:100%">
                                    <thead>
                                        <th>ID</th>
                                        <th>Código</th>
                                        <th>Sala</th>
                                        <th>Ano Lectivo</th>
                                        <th>Periodo</th>
                                        <th>Ações</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($enunciados as $enunciado)
                                            <tr>
                                                <td>{{ $enunciado->id }}</td>
                                                <td>{{ $enunciado->codigo }}</td>

                                                <td>{{ $enunciado->sala }}</td>
                                                <td>{{ $enunciado->ya_inicio }}--{{ $enunciado->ya_fim }}</td>
                                                <td>{{ $enunciado->periodo }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="uil uil-ellipsis-h"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            {{-- <li><a class="dropdown-item"
                                                                    href="{{ route('admin.enunciado.imprimir', $enunciado->id) }}"
                                                                    target="_blank">Imprimir</a></li>
                                                                    <li><a class="dropdown-item"
                                                                        href="{{ route('admin.enunciado.gabarito', $enunciado->id) }}"
                                                                        target="_blank">Folha de resposta</a></li> --}}

                                                            {{-- <li><a class="dropdown-item"
                                                                    href="{{ route('admin.enunciado.edit', $enunciado->id) }}">Editar</a>
                                                            </li> --}}
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.enunciado.destroy', $enunciado->id) }}">Eliminar</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.enunciado.purge', $enunciado->id) }}">Purgar</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="gerarFolhaderespostaModal{{ $enunciado->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabelgerarFolhaderesposta" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabelgerarFolhaderesposta">Gerar Folhaderesposta
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.enunciado.gabarito_post') }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                    
                                                            <div class="col-12">
                                    
                                                                <div class="row">
                                                                    <input type="text" name="id_enunciado" hidden value="{{ $enunciado->id }}" id="">
                                                                    <div class="form-group col-sm-12">
                                                                        <label for="" class="form-label">Candidato</label>
                                                                        <select required name="id_candidato" class="form-control">
                                                                        <option value="" selected disabled> Selecciona o candidato</option>
                                                                            @foreach ($candidatos as $candidato)
                                                                                <option value="{{ isset($candidato->id) ? $candidato->id : '' }}">{{ $candidato->vc_primeiro_nome }}
                                                                                    {{ $candidato->vc_ultimo_nome }}
                                                                                    
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                      
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
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Código</th>
                                            <th>Sala</th>

                                            <th>Ano Lectivo</th>
                                            <th>Periodo</th>
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
                    <form action="{{ route('admin.enunciado.gerar') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">

                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="" class="form-label">Ano Letivo</label>
                                    <select required name="it_id_ano_lectivo" class="form-control">
                                        @if (isset($data->it_cotacao))
                                            <option value="{{ $data->it_id_ano_lectivo }}" selected>{{ $data->ya_inicio }}
                                                - {{ $data->ya_fim }}
                                            </option>
                                        @endif
                                        @foreach ($ano as $d)
                                            <option value="{{ isset($d->id) ? $d->id : '' }}">{{ $d->ya_inicio }} -
                                                {{ $d->ya_fim }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('it_id_ano_lectivo'))
                                        <small id="emailHelp" class="form-text text-danger">
                                            {{ $errors->first('it_id_ano_lectivo') }}.</small>
                                    @endif
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="" class="form-label">Disciplina | Teste</label>
                                    <select required name="it_id_disciplina" class="form-control">
                                        @if (isset($data->it_cotacao))
                                            <option value="{{ $data->it_id_disciplina }}" selected>{{ $data->vc_nome }}
                                            </option>
                                        @endif
                                        @foreach ($disciplinas as $disciplina)
                                            <option value="{{ isset($disciplina->id) ? $disciplina->id : '' }}">
                                                {{ $disciplina->vc_nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('it_id_disciplina'))
                                        <small id="emailHelp" class="form-text text-danger">
                                            {{ $errors->first('it_id_disciplina') }}.</small>
                                    @endif
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="id_periodo" class="form-label">Sala</label>
                                    <select name="id_sala" id="id_sala" class="form-control">

                                        @if (isset($enunciado->sala))
                                            <option value="{{ $enunciado->id_sala }}" selected>{{ $enunciado->sala }}
                                            </option>
                                        @endif
                                        <option value="" selected disabled> Selecciona a sala</option>
                                        @foreach ($salas as $sala)
                                            <option value="{{ isset($sala->id) ? $sala->id : '' }}">{{ $sala->vc_nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group col-sm-6">
                                    <label for="id_periodo" class="form-label">Prova</label>
                                    <select name="id_prova" id="id_prova" class="form-control">

                                        @if (isset($enunciado->sala))
                                            <option value="{{ $enunciado->id_sala }}" selected>{{ $enunciado->sala }}
                                            </option>
                                        @endif
                                        <option value="" selected disabled> Selecciona a prova</option>
                                        @foreach ($provas as $prova)
                                            <option value="{{ isset($prova->id) ? $prova->id : '' }}">{{ $prova->vc_nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                
                                <div class="form-group col-sm-6">
                                    <label for="id_periodo" class="form-label">Periodo</label>
                                    <select name="id_periodo" id="id_periodo" class="form-control">

                                        @if(isset($enunciado->periodo))
                                            <option value="{{$enunciado->id_periodo}}" selected>{{$enunciado->periodo}}</option>
                                        @endif
                                        @foreach ($periodos as $periodo)
                                            <option value="{{isset($periodo->id) ? $periodo->id : ''}}">{{$periodo->vc_nome}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="">Nº de enunciados</label>
                                    <input type="text" required placeholder="Digite o nº de enunciados"
                                        class="form-control" name="n_enunciados" min="1"
                                        max="100"value="">
                                    @if ($errors->has('vc_descricao_bp'))
                                        <small id="emailHelp" class="form-text text-danger">
                                            {{ $errors->first('vc_descricao_bp') }}.</small>
                                    @endif
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="id_periodo" class="form-label">Sala</label>
                                    <select name="id_sala" id="id_sala" class="form-control">

                                        @if (isset($enunciado->sala))
                                            <option value="{{ $enunciado->id_sala }}" selected>{{ $enunciado->sala }}
                                            </option>
                                        @endif
                                        <option value="" selected disabled> Selecciona a sala</option>
                                        @foreach ($salas as $sala)
                                            <option value="{{ isset($sala->id) ? $sala->id : '' }}">{{ $sala->vc_nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group col-sm-12">
                                    <label for="">Cotação por pergunta</label>
                                    <input type="number" required placeholder="Digite a cotação por pergunta"
                                        class="form-control" name="it_cotacao" min="1"
                                        max="100"value="">
                                    @if ($errors->has('vc_descricao_bp'))
                                        <small id="emailHelp" class="form-text text-danger">
                                            {{ $errors->first('vc_descricao_bp') }}.</small>
                                    @endif
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="">Nº de perguntas</label>
                                    <input type="number" required placeholder="Digite o nº de perguntas"
                                        class="form-control" name="it_n_pergunta" min="1"
                                        max="100"value="">
                                    @if ($errors->has('it_n_pergunta'))
                                        <small id="emailHelp" class="form-text text-danger">
                                            {{ $errors->first('it_n_pergunta') }}.</small>
                                    @endif
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="">Coordernador(a)</label>
                                    <input type="text" required placeholder="Digite o nome do(a) coordenador(a)"
                                        class="form-control" name="coordenador" >

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
