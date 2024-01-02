@extends('layouts.admin.body')
@section('titulo','Pergunta-List')
@section('conteudo')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Pergunta</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                           <table id="example" class="table
                           " style="width:100%">
                           <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pergunta</th>
                                <th>Cotacao</th>
                                <th>Codigo</th>
                                <th>Alinea</th>
                                <th>Numero</th>
                                <th>Acções</th>
                            </tr>
                        </thead>
         <tbody>
            @foreach ($perguntas as $pergunta)
            <tr>
                <td>{{$pergunta->id}}</td>
                <td>{{$pergunta->descricao}}</td>
                <td>{{$pergunta->it_cotacao}}</td>
                <td>{{$pergunta->codigo}}</td>
                <td>{{$pergunta->ch_alinea}}</td>
                <td>{{$pergunta->it_numero}}</td>
                 <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="uil uil-ellipsis-h"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="{{route('admin.pergunta.edit',$pergunta->id)}}">Editar</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.pergunta.destroy',$pergunta->id)}}">Eliminar</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.pergunta.purge',$pergunta->id)}}">Purgar</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
               
        
            </tr>
       @endforeach
    </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Pergunta</th>
                <th>Cotacao</th>
                <th>Codigo</th>
                <th>Alinea</th>
                <th>Numero</th>
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

@if (session('pergunta.destroy.success'))
    <script>
        Swal.fire(
            'Pergunta Eliminado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('pergunta.destroy.error'))
    <script>
        Swal.fire(
            'Erro ao Eliminar Pergunta!',
            '',
            'error'
        )
    </script>
@endif
@if (session('pergunta.purge.success'))
    <script>
        Swal.fire(
            'Pergunta Purgado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('pergunta.purge.error'))
    <script>
        Swal.fire(
            'Erro ao Purgar Pergunta!',
            '',
            'success'
        )
    </script>
@endif
@endsection
