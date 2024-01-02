@extends('layouts.admin.body')
@section('titulo','Banco Pergunta')
@section('conteudo')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Editar Banco Pergunta</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                        <form action="{{route('admin.banco_pergunta.update',$data->id)}}" method="post">
                            @csrf
                            @include('forms._formBancoPergunta.index')
                            <input type="submit" value="Actualizar" class="btn btn-primary mt-3">
                        </form>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
    </div>
</div>
</div>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

@if (session('banco_pergunta.update.success'))
    <script>
        Swal.fire(
            'Banco Pergunta Editado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('banco_pergunta.update.error'))
    <script>
        Swal.fire(
            'Erro ao Editar Banco Pergunta!',
            '',
            'error'
        )
    </script>
@endif
@if (session('bp.existe_pergunta.warning'))
    <script>
    Swal.fire(
    'Esta Pergunta já existe no Banco!',
    '',
    'warning'
    )
    </script>
@endif

@endsection
