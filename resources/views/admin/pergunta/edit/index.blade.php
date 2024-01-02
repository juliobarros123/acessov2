@extends('layouts.admin.body')
@section('titulo','Pergunta-Edit')
@section('conteudo')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
 <div class="row">
                            <div class="col-xl-12">
                                <div class="card card-h-100">
                                    <div class="card-header justify-content-between d-flex align-items-center">
                                        <h4 class="card-title">Editar Pergunta </h4>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div>
                                            <form action="{{route('admin.pergunta.update',$pergunta->id)}}" method="post">
                                                @csrf
                                                @include('forms._formPergunta.index')
                                                <div class="mt-4">
                                                <input type="submit" class="btn btn-primary w-md" value="editar">
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

                        @if (session('pergunta.update.success'))
                            <script>
                                Swal.fire(
                                    'Pergunta Editado com sucesso!',
                                    '',
                                    'success'
                                )
                            </script>
                        @endif
                        @if (session('pergunta.update.error'))
                            <script>
                                Swal.fire(
                                    'Erro ao Editar Pergunta!',
                                    '',
                                    'success'
                                )
                            </script>
                        @endif
@endsection
