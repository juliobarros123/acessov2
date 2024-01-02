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
                                <h4 class="card-title">Cadastrar Candidato</h4>
                            </div><!-- end card header -->
                                                    <div class="card-body">
                                <form action="{{ route('admin.candidato.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @include('forms._formCandidato.index')
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary" type="submit">Cadastrar</button>
                                    </div>
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

    @if (session('candidato.create.success'))
        <script>
        Swal.fire(
        'Cadidato Cadastrado com sucesso!',
        '',
        'success'
        )
        </script>
    @endif
    @if (session('candidato.create.error'))
        <script>
        Swal.fire(
        'Erro ao Cadastrar Cadidato!',
        '',
        'error'
        )
        </script>
    @endif
  
@endsection

