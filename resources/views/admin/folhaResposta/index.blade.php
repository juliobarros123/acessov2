@extends('layouts.admin.body')
@section('titulo','FolhasRespostas')
@section('conteudo')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Folhas de respostas</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                           <table id="example" class="table
                           " style="width:100%">
        <thead>
          <th>ID</th>
            <th>Código</th>
            <th>Primeiro nome do candidato</th>
            <th>Último nome do candidato</th>
            <th>BILHETE DE IDENTIDADE</th>
            <th>Ano Letivo</th>
            <th>Acções</th>
        </thead>
         <tbody>
       @foreach ($folhaResposta as $folhaRespostas)
            <tr>
                <td>{{$folhaRespostas->id}}</td>
                <td>{{$folhaRespostas->codigo}}</td>
                <td>{{$folhaRespostas->vc_primeiro_nome}}</td>
                <td>{{$folhaRespostas->vc_ultimo_nome}}</td>
                <td>{{$folhaRespostas->vc_bi}}</td>
                <td>{{$folhaRespostas->ya_inicio}} - {{$folhaRespostas->ya_fim}}</td>
                
                
                 <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="uil uil-ellipsis-h"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="{{route('admin.folhaResposta.edit',$folhaRespostas->id)}}">Editar</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.folhaResposta.destroy',$folhaRespostas->id)}}">Eliminar</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.folhaResposta.purge',$folhaRespostas->id)}}">Purgar</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
               
        
            </tr>
       @endforeach
    </tbody>
        <tfoot>
            <tr>
           <th>ID</th>
            <th>Código</th>
            <th>Primeiro nome do candidato</th>
            <th>Último nome do candidato</th>
            <th>BILHETE DE IDENTIDADE</th>
            <th>Ano Letivo</th>
            <th>Acções</th>  </tr>
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

@if (session('ano_lectivo.destroy.success'))
    <script>
        Swal.fire(
            'Ano Lectivo Eliminado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('ano_lectivo.destroy.error'))
    <script>
        Swal.fire(
            'Erro ao Eliminar Ano Lectivo!',
            '',
            'error'
        )
    </script>
@endif
@if (session('ano_lectivo.purge.success'))
    <script>
        Swal.fire(
            'Ano Lectivo Purgado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('ano_lectivo.purge.error'))
    <script>
        Swal.fire(
            'Erro ao Purgar Ano Lectivo!',
            '',
            'success'
        )
    </script>
@endif
@endsection

