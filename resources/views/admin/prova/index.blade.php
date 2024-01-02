@extends('layouts.admin.body')
@section('titulo', 'Provas')
@section('conteudo')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Prova</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <table id="example" class="table
                           " style="width:100%">
                                    <thead>
                                        <th>ID</th>
                                        <th>Prova</th>
                                        <th>Sala</th>
                                        <th>Capacidade Usada</th>
                                        <th>Periodo</th>
                                        <th>Horário</th>
                                        <th> Curso </th>
                                        <th> Data da prova </th>
                                        <th> Tópicos </th>
                                        <th>Capacidade Total</th>
                                        <th>Acções</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($provas as $prova)
                                            <tr>
                                                <td>{{ $prova->id }}</td>
                                                <td>{{ $prova->vc_nome }}</td>
                                                <td>{{ $prova->sala }}</td>
                                                <td>{{ $prova->capacidade_usada }}</td>
                                                <td>{{ $prova->periodo }}</td>
                                                <td>{{ $prova->inicio_prova }} -- {{ $prova->termino_prova }}
                                                <td>{{ $prova->curso }}</td>
                                          
                                                <td>{{ $prova->dt_data_prova }}</td>
                                                <td > <small data-toggle="modal" class="text-primary"
                                                        data-target="#signupModal{{ $prova->id }}">
                                                        Visualizar
                                                    </small></td>
                                                    

                                                <td>{{ $prova->capacidade_total }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="uil uil-ellipsis-h"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.enunciado.sala.enunciado.index', [$prova->id, $prova->it_id_sala]) }}">Ver
                                                                    enunciados</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.prova.resultados', $prova->id) }}">Resultados</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.prova.edit', $prova->id) }}">Editar</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.prova.destroy', $prova->id) }}">Eliminar</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.prova.purge', $prova->id) }}">Purgar</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                {{-- <div class="modal modal-sign-up fade" id="signupModal{{$prova->id }}"
                                                    tabindex="-1" aria-labelledby="signupModalLabel{{$prova->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                                        <div class="modal-content border-0">
                                                            <div class="modal-body px-4">
                                                                <h5 class="font-weight-bold text-secondary text-center">
    
                                                                    {{ $prova->vc_nome }}
                                                                </h5>
    
                                                                <div
                                                                    class="description-15 font-weight-light text-secondary text-center h6 my-4">
                                                                    <?php echo $prova->topicos; ?>
                                                                </div>
    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </tr>
                                          
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Prova</th>
                                            <th>Sala</th>
                                            <th>Capacidade Usada</th>
                                            <th>Periodo</th>
                                            <th>Horário</th>
                                            <th> Curso </th>
                                            <th> Data da prova </th>
                                            <th> Tópicos </th>
                                            <th>Capacidade Total</th>
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
