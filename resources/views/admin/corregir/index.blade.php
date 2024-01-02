@extends('layouts.admin.body')
@section('titulo','Ano Lectivo')
@section('conteudo')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Anos Lectivos</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <table id="example" class="table
                                " style="width:100%">
                                        <thead>
                                            <th>ID</th>
                                            <th>Inicio</th>
                                            <th>Fim</th>
                                            <th>Acções</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($ano_lectivos as $ano_lectivo)
                                                    <tr>
                                                        <td>{{$ano_lectivo->id}}</td>
                                                        <td>{{$ano_lectivo->ya_inicio}}</td>
                                                        <td>{{$ano_lectivo->ya_fim}}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="uil uil-ellipsis-h"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="{{route('admin.ano_lectivo.edit',$ano_lectivo->id)}}">Editar</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.ano_lectivo.destroy',$ano_lectivo->id)}}">Eliminar</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.ano_lectivo.purge',$ano_lectivo->id)}}">Purgar</a></li>
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
                                            <th>Fim</th>
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

@if (session('ano_lectivo.destroy.success'))
    <script>
        Swal.fire(
            'Ano Lectivo Eliminado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('ano_lectivo.destroy.error'))
    <script>
        Swal.fire(
            'Erro ao Eliminar Ano Lectivo!',
            '',
            'error'
        )
    </script>
@endif
@if (session('ano_lectivo.purge.success'))
    <script>
        Swal.fire(
            'Ano Lectivo Purgado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('ano_lectivo.purge.error'))
    <script>
        Swal.fire(
            'Erro ao Purgar Ano Lectivo!',
            '',
            'error'
        )
    </script>
@endif
@endsection

