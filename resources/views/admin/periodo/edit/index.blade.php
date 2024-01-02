@extends('layouts.admin.body')
@section('titulo','Perioido')
@section('conteudo')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
 <div class="row">
                            <div class="col-xl-12">
                                <div class="card card-h-100">
                                    <div class="card-header justify-content-between d-flex align-items-center">
                                        <h4 class="card-title">Editar Período </h4>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div>
<form action="{{route('admin.periodo.update',$periodo->id)}}" method="post">
    @csrf
    @include('forms._formPeriodo.index')
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

@if (session('periodo.update.success'))
    <script>
        Swal.fire(
            'Erro ao Editar Período!',
            '',
            'success'
        )
    </script>
@endif
@if (session('periodo.update.error'))
    <script>
        Swal.fire(
            'Período Editado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@endsection