@extends('layouts.admin.body')
@section('titulo', 'Sala')
@section('conteudo')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Salas</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <table id="example" class="table
                           " style="width:100%">
                                    <thead>
                                        <th>ID</th>
                                        <th>Sala</th>
                                        <th>Acções</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($sala as $sala)
                                            <tr>
                                                <td>{{ $sala->id }}</td>
                                                <td>{{ $sala->vc_nome }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="uil uil-ellipsis-h"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.prova.see', $sala->id) }}">Ver Provas</a>
                                                            </li>
                                                            {{-- <li><a class="dropdown-item"
                                                                    href="{{ route('admin.sala.destroy', $sala->id) }}">Eliminar</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.sala.purge', $sala->id) }}">Purgar</a>
                                                            </li> --}}
                                                        </ul>
                                                    </div>
                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Sala</th>
                                            <th>Acções</th>
                                        </tr>
                                    </tfoot> --}}
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
