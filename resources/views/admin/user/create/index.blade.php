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
                            <h4 class="card-title">Cadastrar Usuário</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div>
                                <form action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @include('forms._formUser.index')
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary w-md">Cadastrar</button>
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
@if (session('user.create.success'))
    <script>
        Swal.fire(
            'Usuário Cadastrado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('user.create.error'))
    <script>
        Swal.fire(
            'Erro ao Cadastrar Usuário!',
            '',
            'error'
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
@if (session('user.img.error'))
    <script>
        Swal.fire(
            'Imagem Invalida!',
            '',
            'error'
        )
    </script>
@endif
@endsection
