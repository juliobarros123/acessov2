@extends('layouts.admin.body')
@section('titulo', 'Turmas sge')
@section('conteudo')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Turmas sge</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <table id="example" class="table
                           " style="width:100%">
                                    <thead>
                                        <th>Id</th>
                                        <th>Turma</th>
                                        <th>Classe</th>
                                        <th>Turno</th>
                                        <th>Curso</th>
                                        <th>Alunos Matriculados</th>
                                        <th>Ano lectivo</th>
                                        <th>Ações</th>
                                    </thead>
                                    <tbody>
                                        {{-- @dump($turmas)  --}}

                                        @foreach ($turmas as $row)
                                            <tr >
                                                <td>{{ $row['id'] }}</td>
                                                <td>{{ $row['vc_nomedaTurma'] }}</td>
                                                <td>{{ $row['vc_classeTurma'] }}ª</td>
                                                <td>{{ $row['vc_cursoTurma'] }}ª</td>

                                                <td>
                                                    @if ($row['vc_turnoTurma'] == 'DIURNO')
                                                        <b class="bg-warning">DIURNO</b>
                                                    @elseif($row['vc_turnoTurma'] == 'NOITE')
                                                        <b class="bg-dark">NOITE</b>
                                                    @elseif($row['vc_turnoTurma'] == 'MANHÃ')
                                                        <b class="bg-info">MANHÃ</b>
                                                    @elseif($row['vc_turnoTurma'] == 'TARDE')
                                                        <b class="bg-primary">TARDE</b>
                                                    @elseif($row['vc_turnoTurma'] == 'Sabática')
                                                        <b class="bg-secondary">Sabática</b>
                                                    @else
                                                        <b>{{ $row['vc_turnoTurma'] }}</b>
                                                    @endif
                                                </td>

                                                <td>{{ $row['it_qtMatriculados'] }}</td>


                                                <td>{{ $row['vc_anoLectivo'] }}</td>

                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="uil uil-ellipsis-h"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.turmas.alunos_sge_download', $row['id']) }}">Download alunos</a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Turma</th>
                                            <th>Classe</th>
                                            <th>Turno</th>
                                            <th>Curso</th>
                                            <th>Alunos Matriculados</th>
                                            <th>Ano lectivo</th>
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
        <!-- End Page-content -->



    </div>




    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    @if (session('prova.destroy.success'))
        <script>
            Swal.fire(
                'Prova Eliminada com sucesso!',
                '',
                'success'
            )
        </script>
    @endif
    @if (session('prova.destroy.error'))
        <script>
            Swal.fire(
                'Erro ao Eliminar Prova!',
                '',
                'error'
            )
        </script>
    @endif
    @if (session('prova.purge.success'))
        <script>
            Swal.fire(
                'Prova Purgado com sucesso!',
                '',
                'success'
            )
        </script>
    @endif
    @if (session('prova.purge.error'))
        <script>
            Swal.fire(
                'Erro ao Purgar Prova!',
                '',
                'success'
            )
        </script>
    @endif
@endsection
