@extends('layouts.admin.body')
@section('titulo', 'Vincular curso com disciplina')
@section('conteudo')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-h-100">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Vincular curso com disciplina</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('admin.cursos_disciplinas.store') }}" method="post">
                                        @csrf
                                        @include('forms._formCursoDisciplina.index')
                                        <div class="mt-4 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary w-md">Vincular</button>
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

    @if (session('sala.create.success'))
        <script>
            Swal.fire(
                'Sala cadastrada com sucesso!',
                '',
                'success'
            )
        </script>
    @endif
    @if (session('sala.create.error'))
        <script>
            Swal.fire(
                'Erro ao Cadastrar Sala!',
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
