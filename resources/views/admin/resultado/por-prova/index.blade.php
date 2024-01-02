@extends('layouts.admin.body')
@section('titulo', 'Banco Pergunta')
@section('conteudo')
    @php
        $media = null;
    @endphp
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-h-100">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Filtrar resultado por prova</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('admin.resultados.por_prova_imprimir') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="">Ano lectivo:</label>
                                                <select required name="it_id_ano_lectivo"  id="it_id_ano_lectivo" class="form-control">

                                                    <option value="" selected disabled> Selecciona o ano lectivo
                                                    </option>

                                                    @foreach ($anos_lectivo as $d)
                                                        <option value="{{ isset($d->id) ? $d->id : '' }}">
                                                            {{ $d->ya_inicio }} - {{ $d->ya_fim }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('it_id_ano_lectivo'))
                                                    <small id="emailHelp" class="form-text text-danger">
                                                        {{ $errors->first('it_id_ano_lectivo') }}.</small>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="">Prova:</label>
                                                <select required name="it_id_prova" class="form-control" id="it_id_prova">

                                                    <option value="" selected disabled> Selecciona a prova
                                                    </option>


                                                </select>
                                                @if ($errors->has('it_id_prova'))
                                                    <small id="emailHelp" class="form-text text-danger">
                                                        {{ $errors->first('it_id_prova') }}.</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mt-4 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary w-md">Imprimir</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- end col -->
                </div>
                <!-- end row -->



            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->



    </div>




    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    @if (session('candidato.destroy.error'))
        <script>
            Swal.fire(
                'Erro ao Eliminar Banco Pergunta !',
                '',
                'error'
            )
        </script>
    @endif
    @if (session('candidato.destroy.success'))
        <script>
            Swal.fire(
                'Banco Pergunta  Eliminado com sucesso!',
                '',
                'success'
            )
        </script>
    @endif
    @if (session('candidato.purge.success'))
        <script>
            Swal.fire(
                'Banco Pergunta  Purgado com sucesso!',
                '',
                'success'
            )
        </script>
    @endif
    @if (session('candidato.purge.error'))
        <script>
            Swal.fire(
                'Erro ao Purgar Candidato!',
                '',
                'error'
            )
        </script>
    @endif
@endsection
