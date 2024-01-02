@extends('layouts.admin.body')
@section('titulo','Periodo')
@section('conteudo')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
 <div class="row">
                            <div class="col-xl-12">
                                <div class="card card-h-100">
                                    <div class="card-header justify-content-between d-flex align-items-center">
                                        <h4 class="card-title">Cadastrar Período</h4>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div>
<form action="{{route('admin.periodo.store')}}" method="post">
    @csrf
    @include('forms._formPeriodo.index')
    <div class="mt-4">
    <input type="submit" class="btn btn-primary w-md" value="Cadastrar">
    </div>
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

@if (session('periodo.create.success'))
    <script>
        Swal.fire(
            'Período Cadastrado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('periodo.create.error'))
    <script>
        Swal.fire(
            'Erro ao Cadastrar Período!',
            '',
            'error'
        )
    </script>
@endif

@endsection
