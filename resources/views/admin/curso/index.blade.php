@extends('layouts.admin.body')
@section('titulo', 'Cursos')
@section('conteudo')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title col-md-10">Cursos</h4>
                                <div class="col-md-2 d-flex justify-content-end"><a class="btn btn-primary" href="{{route('admin.cursos.create')}}"
                                        >Cadastrar </a></div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <table id="example" class="table
                           " style="width:100%">
                                    <thead>
                                        <th>ID</th>
                                        <th>CURSO</th>
                                        <th>ACÇÕES</th>
                                    </thead>
                                    {{-- @dump($cursos) --}}
                                    <tbody>
                                        @foreach ($cursos as $curso)
                                            <tr>
                                                <td>{{ $curso->id }}</td>
                                                <td>{{ $curso->vc_nome }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="uil uil-ellipsis-h"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item"
                                                                href="{{ route('admin.cursos_disciplinas.vincular', $curso->id) }}">Vincular com disciplina</a>
                                                        </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.cursos.edit', $curso->id) }}">Editar</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.cursos.destroy', $curso->id) }}">Eliminar</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.cursos.purge', $curso->id) }}">Purgar</a>
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
                                            <th>CURSO</th>
                                            <th>ACÇÕES</th>
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






    @if (session('sala.destroy.success'))
        <script>
            Swal.fire(
                'Sala Eliminado com sucesso!',
                '',
                'success'
            )
        </script>
    @endif
    @if (session('sala.destroy.error'))
        <script>
            Swal.fire(
                'Erro ao Eliminar Sala!',
                '',
                'error'
            )
        </script>
    @endif
    @if (session('sala.purge.success'))
        <script>
            Swal.fire(
                'Sala Purgado com sucesso!',
                '',
                'success'
            )
        </script>
    @endif
    @if (session('sala.purge.error'))
        <script>
            Swal.fire(
                'Erro ao Purgar Sala!',
                '',
                'success'
            )
        </script>
    @endif
@endsection
