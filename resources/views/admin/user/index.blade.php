@extends('layouts.admin.body')
@section('titulo','Usuário')
@section('conteudo')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Usuários</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <table id="example" class="table
                                " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>tipo</th>
                                                <th>Numero do BI</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->id }}</td>
                                                        <td>{{ $user->vc_primeiro_nome }} {{ $user->vc_nome_meio }} {{ $user->vc_ultimo_nome }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->tipo }}</td>
                                                        <td>{{ $user->numero_bi }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="uil uil-ellipsis-h"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="{{route('admin.user.edit',$user->id)}}">Editar</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.user.destroy',$user->id)}}">Eliminar</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.user.purge',$user->id)}}">Purgar</a></li>
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
                                                <th>Email</th>
                                                <th>Numero do BI</th>
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
    
    </div>
    <!-- End Page-content -->
</div>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
@if (session('user.destroy.success'))
    <script>
        Swal.fire(
            'Usuário Eliminado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('user.destroy.error'))
    <script>
        Swal.fire(
            'Erro ao Eliminar Usuário!',
            '',
            'error'
        )
    </script>
@endif
@if (session('user.purge.success'))
    <script>
        Swal.fire(
            'Usuário Purgado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('user.purge.error'))
    <script>
        Swal.fire(
            'Erro ao Purgar Usuário!',
            '',
            'success'
        )
    </script>
@endif
@endsection