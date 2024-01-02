@extends('layouts.admin.body')
@section('titulo','Priodo')
@section('conteudo')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Período</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                           <table id="example" class="table
                           " style="width:100%">
{{-- <table> --}}
    <thead>
        <tr>
            <th>ID</th>
            <th>Período</th>
            <th>Acções</th>
            {{-- <th><a href="{{route('admin.periodo.create')}}">Create</a></th> --}}
        </tr>
    </thead>
    <tbody>
       @foreach ($periodos as $periodo)
            <tr>
                <td>{{$periodo->id}}</td>
                <td>{{$periodo->vc_nome}}</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="uil uil-ellipsis-h"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{route('admin.periodo.edit',$periodo->id)}}">Editar</a></li>
                            <li><a class="dropdown-item" href="{{route('admin.periodo.destroy',$periodo->id)}}">Eliminar</a></li>
                            <li><a class="dropdown-item" href="{{route('admin.periodo.purge',$periodo->id)}}">Purgar</a></li>
                        </ul>
                    </div>
                    </td>
            </tr>
       @endforeach
    </tbody>
    <tfoot>
        <tr>
           <th>ID</th>
           <th>Período</th>
           <th>Acções</th>
        </tr>
    </tfoot>
</table>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

         

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>



<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

@if (session('periodo.destroy.success'))
    <script>
        Swal.fire(
            'Período Eliminado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('periodo.destroy.error'))
    <script>
        Swal.fire(
            'Erro ao Eliminar Período!',
            '',
            'error'
        )
    </script>
@endif
@if (session('periodo.purge.success'))
    <script>
        Swal.fire(
            'Período Purgado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('periodo.purge.error'))
    <script>
        Swal.fire(
            'Erro ao Purgar Período!',
            '',
            'success'
        )
    </script>
@endif
@endsection
