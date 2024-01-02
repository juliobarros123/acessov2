@extends('layouts.admin.body')
@section('titulo', 'Banco Pergunta')
@section('conteudo')
    @php
        $media = null;
    @endphp
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-h-100">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Filtrar resultado</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('admin.resultados.post_imprimir') }}" target="_blank" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-sm-6">

                                                <select required name="it_id_ano_lectivo" class="form-control">
                                                    @isset($id_ano_lectivo)
                                                        <option value="{{ $id_ano_lectivo }}" selected> {{ $ano_lectivo }}
                                                        </option>
                                                    @else
                                                        <option value="" selected disabled> Selecciona o ano lectivo
                                                        </option>
                                                    @endisset
                                                    @foreach ($anos as $d)
                                                        <option value="{{ isset($d->id) ? $d->id : '' }}">
                                                            {{ $d->ya_inicio }} - {{ $d->ya_fim }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('it_id_ano_lectivo'))
                                                    <small id="emailHelp" class="form-text text-danger">
                                                        {{ $errors->first('it_id_ano_lectivo') }}.</small>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-6">

                                                <select required name="it_id_curso" class="form-control">
                                                    @isset($id_curso)
                                                        <option value="{{ $id_curso }}" selected> {{ $curso }}
                                                        </option>
                                                    @else
                                                        <option value="" selected disabled> Selecciona o curso
                                                        </option>
                                                    @endisset
                                                    @foreach ($cursos as $curso)
                                                        <option value="{{ isset($curso->id) ? $curso->id : '' }}">
                                                            {{ $curso->vc_nome }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('it_id_ano_lectivo'))
                                                    <small id="emailHelp" class="form-text text-danger">
                                                        {{ $errors->first('it_id_ano_lectivo') }}.</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mt-4 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary w-md">Filtrar</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    @isset($tb)
                        
                  
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Lista de resultado no ano lectivo
                                    {{ isset($ano_lectivo) ? $ano_lectivo : '' }}</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <table id="example" class="table
                    " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nº Ordem</th>

                                            <th>Candidato</th>
                                            <th>Idade</th>
                                            <th>Gênero</th>
                                            @foreach ($disciplinas as $disciplina)
                                                <th>{{ $disciplina->vc_nome }}</th>
                                            @endforeach
                                            <th>Média</th>
                                            <th>Resultado</th>
                                            <th>Acções</th>
                                        </tr>
                                    <tbody>
                                        @foreach ($candidatos as $candidato)
                                            <tr>

                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $candidato->vc_primeiro_nome }} {{ $candidato->vc_ultimo_nome }}
                                                </td>

                                                <td>{{ $candidato->it_idade }}</td>
                                                <td>{{ $candidato->vc_genero }}</td>

                                                @foreach ($disciplinas as $disciplina)
                                                    @php
                                                        // dd($candidato->vc_codigo, $disciplina->id, $candidato->id_correcao);
                                                        $nota = notas($candidato->vc_codigo, $disciplina->id, $candidato->id_correcao)->sum('it_cotacao');
                                                        $media += $nota;
                                                    @endphp
                                                    <td style=" {{ $nota >= 10 ? 'color:green' : 'color:red' }}">
                                                        {{ $nota }}</td>
                                                @endforeach
                                                @php
                                                    $media = round($media / $disciplinas->count(), 0, PHP_ROUND_HALF_UP);
                                                @endphp
                                                <td style="{{ $media >= 10 ? 'color:green' : 'color:red' }}">
                                                    {{ $media }}
                                                </td>
                                                <td style="{{ $media >= 10 ? 'color:green' : 'color:red' }}">
                                                    @if ($media >= 10)
                                                        Apto
                                                    @else
                                                        Não apto
                                                    @endif
                                                    @php
                                                    $media=0;
                                                @endphp

                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="uil uil-ellipsis-h"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            {{-- <li><a class="dropdown-item" href="{{route('admin.candidato.edit',$candidato->id)}}">Editar</a></li>
                                    <li><a class="dropdown-item" href="{{route('admin.candidato.destroy',$candidato->id)}}">Eliminar</a></li>
                                    <li><a class="dropdown-item" href="{{route('admin.candidato.purge',$candidato->id)}}">Purgar</a></li> --}}
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>

                                            <th>Candidato</th>
                                            <th>Idade</th>
                                            <th>Gênero</th>
                                            @foreach ($disciplinas as $disciplina)
                                                <th>{{ $disciplina->vc_nome }}</th>
                                            @endforeach

                                            <th>Média</th>
                                            <th>Resultado</th>
                                            <th>Acções</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    @endisset
                    <!-- end col -->
                </div>
                <!-- end row -->



            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->



    </div>




    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    @if (session('candidato.destroy.error'))
        <script>
            Swal.fire(
                'Erro ao Eliminar Banco Pergunta !',
                '',
                'error'
            )
        </script>
    @endif
    @if (session('candidato.destroy.success'))
        <script>
            Swal.fire(
                'Banco Pergunta  Eliminado com sucesso!',
                '',
                'success'
            )
        </script>
    @endif
    @if (session('candidato.purge.success'))
        <script>
            Swal.fire(
                'Banco Pergunta  Purgado com sucesso!',
                '',
                'success'
            )
        </script>
    @endif
    @if (session('candidato.purge.error'))
        <script>
            Swal.fire(
                'Erro ao Purgar Candidato!',
                '',
                'error'
            )
        </script>
    @endif
@endsection
