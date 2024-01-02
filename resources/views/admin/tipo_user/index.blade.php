@extends('layouts.admin.body')
@section('titulo','Tipo De Usuário')
@section('conteudo')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Tipo De Usuários</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <table id="example" class="table
                                " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Acções</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tipo_users as $tipo_user)
                                                    <tr>
                                                        <td>{{ $tipo_user->id }}</td>
                                                        <td>{{ $tipo_user->nome }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="uil uil-ellipsis-h"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="{{route('admin.tipo_user.edit', $tipo_user->id)}}">Editar</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.tipo_user.destroy', $tipo_user->id)}}">Eliminar</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.tipo_user.purge', $tipo_user->id)}}">Purgar</a></li>
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
@if (session('tipo_user.destroy.success'))
    <script>
        Swal.fire(
            'Tipo De Usuário Eliminado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('tipo_user.destroy.error'))
    <script>
        Swal.fire(
            'Erro ao Eliminar Tipo De Usuário!',
            '',
            'error'
        )
    </script>
@endif
@if (session('tipo_user.purge.success'))
    <script>
        Swal.fire(
            'Tipo De Usuário Purgado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('tipo_user.purge.error'))
    <script>
        Swal.fire(
            'Erro ao Purgar Tipo De Usuário!',
            '',
            'success'
        )
    </script>
@endif
@endsection