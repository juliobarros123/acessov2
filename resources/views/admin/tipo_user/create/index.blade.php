@extends('layouts.admin.body')
@section('titulo','Tipo De Usuário')
@section('conteudo')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Cadastrar Tipo De Usuário</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div>
                                <form action="{{route('admin.tipo_user.store')}}" method="post">
                                    @csrf
                                    @include('forms._formTipoUser.index')
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
@if (session('tipo_user.create.success'))
    <script>
        Swal.fire(
            'Tipo De Usuário Cadastrado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('tipo_user.create.error'))
    <script>
        Swal.fire(
            'Erro ao Cadastrar Tipo De Usuário!',
            '',
            'error'
        )
    </script>
@endif

@endsection
