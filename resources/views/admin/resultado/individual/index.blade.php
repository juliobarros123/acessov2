@extends('layouts.admin.body')
@section('titulo','Ver resultado individual')
@section('conteudo')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-h-100">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Ver resultado individual</h4>
                            
                                {{-- <i class="fas fa-times"></i> --}}
                       
                            </div><!-- end card header -->
                            <div class="card-body">
                                <form action="{{route('admin.resultados.apresentar')}}" method="post">
                                    @csrf
                                    @include('forms._form-resultado-individual.index')
                                    <input type="submit" class="btn btn-primary mt-3" value="Visualizar">
                                    </form>
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

    @if (session('banco_pergunta.create.success'))
        <script>
        Swal.fire(
        'Banco Pergunta Cadastrado com sucesso!',
        '',
        'success'
        )
        </script>
    @endif
        @if (session('banco_pergunta.create.error'))
        <script>
        Swal.fire(
        'Erro ao Cadastrado Banco Pergunta!',
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

