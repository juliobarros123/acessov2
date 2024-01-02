@extends('layouts.admin.body')
@section('titulo','Folhas De Respostas')
@section('conteudo')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
 <div class="row">
                            <div class="col-xl-12">
                                <div class="card card-h-100">
                                    <div class="card-header justify-content-between d-flex align-items-center">
                                        <h4 class="card-title">Editar Folha De Respostas</h4>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div>
                                <form action="{{route('admin.folhaResposta.update',$folhaResposta->id)}}" method="post">
                                @csrf
                                @include('forms._formFolhaResposta.index')
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

@if (session('ano_lectivo.update.success'))
    <script>
        Swal.fire(
            'Ano Lectivo Editado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('ano_lectivo.update.error'))
    <script>
        Swal.fire(
            'Erro ao Editar Ano Lectivo!',
            '',
            'success'
        )
    </script>
@endif
@endsection
