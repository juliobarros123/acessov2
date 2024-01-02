@extends('layouts.admin.body')
@section('titulo','Banco Pergunta')
@section('conteudo')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Banco Pergunta</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <table id="example" class="table
                    " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>

                                        <th>Pergunta</th>
                                        <th>Cotacao</th>
                                        <th>Disciplina</th>
                                        <th>Ano lectivo</th>
                                        <th>Acções</th>
                                    </tr>
                                <tbody>
                                    @foreach($lista as $banco_pergunta)
                                        <tr>

                                            <td>{{ $banco_pergunta->id }}</td>
                                            <td>{{ $banco_pergunta->vc_descricao_bp }}</td>
                                            <td>{{ $banco_pergunta->it_cotacao }}</td>
                                            <td>{{ $banco_pergunta->disciplina }}</td>
                                            <td>{{ $banco_pergunta->ya_inicio }} -- {{ $banco_pergunta->ya_fim }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="uil uil-ellipsis-h"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('admin.banco_alinea.add_alinea',$banco_pergunta->id) }}">Adicionar alínea</a>
                                                        </li>

                                                        <li><a class="dropdown-item"
                                                                href="{{ route('admin.banco_pergunta.edit',$banco_pergunta->id) }}">Editar</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('admin.banco_pergunta.destroy',$banco_pergunta->id) }}">Eliminar</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('admin.banco_pergunta.purge',$banco_pergunta->id) }}">Purgar</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cotacao</th>
                                        <th>Ano lectivo</th>
                                        <th>Acções</th>
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
    <!-- End Page-content -->



</div>




<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

@if(session('banco_pergunta.destroy.error'))
    <script>
        Swal.fire(
            'Erro ao Eliminar Banco Pergunta !',
            '',
            'error'
        )

    </script>
@endif
@if(session('banco_pergunta.destroy.success'))
    <script>
        Swal.fire(
            'Banco Pergunta  Eliminado com sucesso!',
            '',
            'success'
        )

    </script>
@endif
@if(session('banco_pergunta.purge.success'))
    <script>
        Swal.fire(
            'Banco Pergunta  Purgado com sucesso!',
            '',
            'success'
        )

    </script>
@endif
@if(session('banco_pergunta.purge.error'))
    <script>
        Swal.fire(
            'Erro ao Purgar Candidato!',
            '',
            'error'
        )

    </script>
@endif
@endsection
