@extends('layouts.admin.body')
@section('titulo','Horário')
@section('conteudo')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Horários</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <table id="example" class="table
                                " style="width:100%">
                                        <thead>
                                            <th>ID</th>
                                            <th>Inicio</th>
                                            <th>Periodo</th>
                                            <th>Fim</th>
                                            <th>Acções</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($horarios as $horario)
                                                    <tr>
                                                        <td>{{$horario->id}}</td>
                                                        <td>{{$horario->inicio_prova}}</td>
                                                        <td>{{$horario->termino_prova}}</td>
                                                        <td>{{$horario->periodo}}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="uil uil-ellipsis-h"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="{{route('admin.horario.edit',$horario->id)}}">Editar</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.horario.destroy',$horario->id)}}">Eliminar</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.horario.purge',$horario->id)}}">Purgar</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>                       
                                                    </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>ID</th>
                                            <th>Inicio</th>

<th>Periodo</th>                                            <th>Fim</th>
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
    
    </div>
    <!-- End Page-content -->

</div>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

@if (session('horario.destroy.success'))
    <script>
        Swal.fire(
            'Horário Eliminado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('horario.destroy.error'))
    <script>
        Swal.fire(
            'Erro ao Eliminar Horário!',
            '',
            'error'
        )
    </script>
@endif
@if (session('horario.purge.success'))
    <script>
        Swal.fire(
            'Horário Purgado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('horario.purge.error'))
    <script>
        Swal.fire(
            'Erro ao Purgar Horário!',
            '',
            'error'
        )
    </script>
@endif
@endsection

