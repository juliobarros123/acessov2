@extends('layouts.admin.body')
@section('titulo','Ano Lectivo')
@section('conteudo')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Cadastrar Ano Lectivo</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div>
                                <form action="{{route('admin.ano_lectivo.store')}}" method="post">
                                    @csrf
                                    @include('forms._formAnoLectivo.index')
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

@if (session('ano_lectivo.create.success'))
    <script>
        Swal.fire(
            'Ano Lectivo Cadastrado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('ano_lectivo.create.error'))
    <script>
        Swal.fire(
            'Erro ao Cadastrar Ano Lectivo!',
            '',
            'error'
        )
    </script>
@endif
@if (session('ano_mismatch'))
    <script>
        Swal.fire(
            'O ano de inicio não pode ser maior ou igual ao ano de termino!',
            '',
            'error'
        )
    </script>
@endif
@endsection

