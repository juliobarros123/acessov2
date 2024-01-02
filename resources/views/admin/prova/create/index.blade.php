@extends('layouts.admin.body')
@section('titulo','Adicionar Prova')
@section('conteudo')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
 <div class="row">
                            <div class="col-xl-12">
                                <div class="card card-h-100">
                                    <div class="card-header justify-content-between d-flex align-items-center">
                                        <h4 class="card-title">Cadastrar Prova</h4>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div>
                                           <form action="{{route('admin.prova.store')}}" method="post" >
                                                @csrf
                                                @include('forms._formProva.index')
                                                <br>
                                                <button type="submit" class="btn btn-primary w-md">Cadastrar</button>
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

@if (session('prova.create.success'))
    <script>
        Swal.fire(
            'Prova Cadastrada com sucesso!',
            '',
            'success'
        )
    </script>
@endif

@if (session('prova.create.error'))
    <script>
        Swal.fire(
            'Erro ao Cadastrar Prova!',
            '',
            'error'
        )
    </script>
@endif
@if (session('prova.duplicate.error'))
    <script>
        Swal.fire(
            'Já existe uma prova cadastrada para esse horário nesta sala',
            '',
            'error'
        )
    </script>
@endif
@if (session('chave.error'))
    <script>
        Swal.fire(
            'Essa pergunta já possui uma alinea verdadeira!',
            '',
            'error'
        )
    </script>
@endif

@endsection
{{-- <form action="{{route('admin.prova.store')}}" method="post">
    @csrf
    @include('forms._formABancoAlinea.index')
    <input type="submit" value="Cadastrar">
</form> --}}


