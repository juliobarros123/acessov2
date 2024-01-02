@extends('layouts.admin.body')
@section('titulo','Usuário')
@section('conteudo')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Atualizar Usuário</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div>
                                <form action="{{route('admin.user.update',$user->id)}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    @include('forms._formUser.index')
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary w-md">Atualizar</button>
                                    </div>
                                </form><!-- end form -->
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->                          
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
@if (session('user.update.success'))
    <script>
        Swal.fire(
            'Usuário Atualizado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('password_mismatch'))
    <script>
        Swal.fire(
            'As senhas têm de ser identicas!',
            '',
            'error'
        )
    </script>
@endif
@if (session('user.update.error'))
    <script>
        Swal.fire(
            'Erro ao Atualizar Usuário!',
            '',
            'error'
        )
    </script>
@endif
@if (session('user.image.error'))
    <script>
        Swal.fire(
            'Erro ao Atualizar Imagem!',
            '',
            'error'
        )
    </script>
@endif
@endsection
