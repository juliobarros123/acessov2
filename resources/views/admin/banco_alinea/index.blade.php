@extends('layouts.admin.body')
@section('titulo','banco_alinea')
@section('conteudo')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Alínea</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                           <table id="example" class="table
                           " style="width:100%">
                                <thead>
                                    <th>ID</th>
                                    <th>Pergunta</th>
                                    <th>Alínea</th>
                                    <th>Chave</th>
                                    <th>Imagem</th>
                                    <th>Acções</th>
                                </thead>
                                <tbody>
                                  @foreach ($banco_alineas as $banco_alinea)
                                <tr>
                                    <td>{{$banco_alinea->id}}</td>
                                    <td>{{$banco_alinea->vc_descricao_bp}}</td>
                                    <td>{{$banco_alinea->description}}</td>
                                    <td>{{$banco_alinea->chave==1 ? 'Verdadeiro':'Falso'}}</td>
                                    <td>
                                       <a target="_blank" href="{{asset($banco_alinea->vc_imagem_ba)}}">
                                        <img src="{{asset($banco_alinea->vc_imagem_ba)}}" id="myImg" alt="" width="50px" >
                                       </a>
                                    </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="uil uil-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{route('admin.banco_alinea.edit',$banco_alinea->id)}}">Editar</a></li>
                                            <li><a class="dropdown-item" href="{{route('admin.banco_alinea.destroy',$banco_alinea->id)}}">Eliminar</a></li>
                                            <li><a class="dropdown-item" href="{{route('admin.banco_alinea.purge',$banco_alinea->id)}}">Purgar</a></li>
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
                                    <th>Alínea</th>
                                    <th>Chave</th>
                                    <th>Imagem</th>

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

@if (session('banco_alinea.destroy.success'))
    <script>
        Swal.fire(
            'Alínea Eliminada com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('banco_alinea.destroy.error'))
    <script>
        Swal.fire(
            'Erro ao Eliminar Alínea!',
            '',
            'error'
        )
    </script>
@endif
@if (session('banco_alinea.purge.success'))
    <script>
        Swal.fire(
            'Alínea Purgado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('banco_alinea.purge.error'))
    <script>
        Swal.fire(
            'Erro ao Purgar Alínea!',
            '',
            'success'
        )
    </script>
@endif
@endsection
