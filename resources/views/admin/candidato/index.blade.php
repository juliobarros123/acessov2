@extends('layouts.admin.body')
@section('titulo','Candidatos')
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
            <th>Nome</th>
            <th>Idade</th>
            <th>Código</th>
            <th>Curso</th>
            <th>Acções</th>
        </thead>
         <tbody>

            @foreach ( $candidatos as $item )
                    <tr>
                        <td>
                            {{ $item->id }}
                        </td>
                        <td>{{ $item->vc_primeiro_nome }}</td>
                        <td>{{  $item->it_idade }}</td>
                        <td>{{  $item->vc_codigo }}</td>
                        <td>{{  $item->curso }}</td>
                        
                        <td>
                            <div class="dropdown">
                                <button class="btn bt n-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="uil uil-ellipsis-h"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{route('admin.candidato.edit',$item->id)}}">Editar</a></li>
                                    <li><a class="dropdown-item" href="{{route('admin.candidato.destroy',$item->id)}}">Eliminar</a></li>
                                    <li><a class="dropdown-item" href="{{route('admin.candidato.purge',$item->id)}}">Purgar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Código</th>
                <th>Curso</th>
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

@if (session('candidato.destroy.success'))
    <script>
        Swal.fire(
            'Candidato Eliminado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('candidato.destroy.error'))
    <script>
        Swal.fire(
            'Erro ao Eliminar Candidato!',
            '',
            'error'
        )
    </script>
@endif
@if (session('candidato.purge.success'))
    <script>
        Swal.fire(
            'Candidato Purgado com sucesso!',
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
            'success'
        )
    </script>
@endif
@endsection

