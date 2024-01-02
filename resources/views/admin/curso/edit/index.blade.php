@extends('layouts.admin.body')
@section('titulo', 'Curso')
@section('conteudo')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-h-100">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Editar curso </h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('admin.cursos.update', $curso->id) }}" method="post">
                                        @csrf
                                        @include('forms._formCurso.index')
                                        <div class="mt-4 d-flex justify-content-center">
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
@endsection
