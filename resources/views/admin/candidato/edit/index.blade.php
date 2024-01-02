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
                                    <h4 class="card-title">Editar Candidato</h4>
                                </div><!-- end card header -->
                                                        <div class="card-body">

                                    <form action="{{ route('admin.candidato.update', $candidato->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @include('forms._formCandidato.index')
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-primary" type="submit">Actualizar</button>
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

        @if (session('candidato.update.success'))
            <script>
            Swal.fire(
            'Cadidato editado com sucesso!',
            '',
            'success'
            )
            </script>
        @endif
        @if (session('candidato.update.error'))
            <script>
            Swal.fire(
            'Erro ao editar Cadidato!',
            '',
            'error'
            )
            </script>
        @endif

    @endsection

