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
                                        <h4 class="card-title">Editar Classe </h4>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div>
                                <form action="{{route('admin.classe.update',$classe->id)}}" method="post">
                                    @csrf
                                    @include('forms._formClasse.index')
                                     <div class="mt-4">
                                                    <button type="submit" class="btn btn-primary w-md">Actualizar</button>
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

@if (session('classe.update.success'))
    <script>
        Swal.fire(
            'Classe Editado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('classe.update.error'))
    <script>
        Swal.fire(
            'Erro ao Editar Classe!',
            '',
            'error'
        )
    </script>
@endif
@endsection
