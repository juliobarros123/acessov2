@extends('layouts.admin.body')
@section('titulo','Classe')
@section('conteudo')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
 <div class="row">
                            <div class="col-xl-12">
                                <div class="card card-h-100">
                                    <div class="card-header justify-content-between d-flex align-items-center">
                                        <h4 class="card-title">Cadastrar Classe</h4>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div>
                                            <form action="{{route('admin.classe.store')}}" method="post">
                                               @csrf
                                               @include('forms._formClasse.index')
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

@if (session('classe.create.success'))
    <script>
        Swal.fire(
            'Classe Cadastrada com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('classe.create.error'))
    <script>
        Swal.fire(
            'Erro ao Cadastrar Classe!',
            '',
            'error'
        )
    </script>
@endif

@endsection
{{-- <form action="{{route('admin.classe.store')}}" method="post">
    @csrf
    @include('forms._formAnoLectivo.index')
    <input type="submit" value="Cadastrar">
</form> --}}
