@extends('layouts.admin.body')
@section('titulo', 'Banco Alinea')
@section('conteudo')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-h-100">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Editar Alínea </h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('admin.banco_alinea.update', $banco_alinea->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @include('forms._formBancoAlinea.index2')
                                        <br>
                                        <input type="submit" value="editar" class="btn btn-primary w-md">
                                    </form>
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

    @if (session('banco_alinea.update.success'))
        <script>
            Swal.fire(
                'Alínea Editada com sucesso!',
                '',
                'success'
            )
        </script>
    @endif

    @if (session('banco_alinea.update.error'))
        <script>
            Swal.fire(
                'Erro ao Editar Alínea!',
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
