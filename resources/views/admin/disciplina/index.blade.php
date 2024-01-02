@extends('layouts.admin.body')
@section('titulo','Disciplina')
@section('conteudo')
<div class="main-content">
   
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <!-- Button trigger modal -->

  
  <!-- Modal -->
 
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Disciplinas</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <table id="example" class="table
                                " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($disciplinas as $disciplina)
                                                    <tr>
                                                        <td>{{ $disciplina->id }}</td>
                                                        <td>{{ $disciplina->vc_nome }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="uil uil-ellipsis-h"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    
                                                                    <li><a class="dropdown-item"
                                                                        
                                                                        href="javascript:void(0);" data-toggle="modal"
                                                        data-target="#Aprovar{{ $disciplina->id }}Modal"
                                                                        >Gerar enunciados</a></li>

                                                                    <li><a class="dropdown-item" href="{{route('admin.banco_pergunta.add_pergunta',$disciplina->id)}}">Adicionar pergunta</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.disciplina.edit',$disciplina->id)}}">Editar</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.disciplina.destroy',$disciplina->id)}}">Eliminar</a></li>
                                                                    <li><a class="dropdown-item" href="{{route('admin.disciplina.purge',$disciplina->id)}}">Purgar</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>                       
                                                    </tr>
                                                    <div class="modal fade" id="Aprovar{{ $disciplina->id }}Modal" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabelAprovar{{ $disciplina->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabelAprovar{{ $disciplina->id }}">Gerar enunciado
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                               <div class="modal-body">
                                                                    <form
                                                                        action=""
                                                                        method="post" enctype="multipart/form-data">
                                                                        @csrf
        
                                                                        <div class="col-12">
        
                                                                            <div class="row">
                                                                                <div class="form-group col-md-12  ">
                                                                                    <label  for="imagem">{{ __('Imagem') }}</label>
                                                                                    <input value="{{ isset($disciplina->imagem) ? $disciplina->vc_logo : '' }}" id="imagem" type="file"
                                                                                        class="form-control @error('imagem') is-invalid @enderror" name="imagem" value="{{ old('imagem') }}"
                                                                                       autocomplete="imagem" autofocus>
                                                                            
                                                                                    @error('imagem')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group col-md-12">
                                                                                    <label
                                                                                        for="username">{{ __('ID-disciplina*') }}</label>
                                                                                    <input type="text"
                                                                                        class="form-control border-primary  "
                                                                                        id="id_disciplina"
                                                                                        value="{{ isset($disciplina->id_disciplina) ? $disciplina->id_disciplina : '' }}"
                                                                                        id="id_disciplina" name="id_disciplina"
                                                                                        placeholder="ID do disciplina">
        
                                                                                </div>
        
                                                                                <div class="form-group col-md-12">
                                                                                    <label
                                                                                        for="username">{{ __('Passe*') }}</label>
                                                                                    <input type="text"
                                                                                        class="form-control border-primary  "
                                                                                        id="passe"
                                                                                        value="{{ isset($disciplina->passe) ? $disciplina->passe : '' }}"
                                                                                        id="passe" name="passe"
                                                                                        placeholder="Palavra passe do disciplina">
        
                                                                                </div>
                                                                            </div>
                                                                        </div>
        
                                                                        <div
                                                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Adicionar</button>
                                                                        </div>
        
                                                                    </form>
                                                                </div> 
                                                              
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Ações</th>
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
    
    </div>
    <!-- End Page-content -->
</div>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
@if (session('disciplina.destroy.success'))
    <script>
        Swal.fire(
            'Disciplina Eliminado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('disciplina.destroy.error'))
    <script>
        Swal.fire(
            'Erro ao Eliminar Disciplina!',
            '',
            'error'
        )
    </script>
@endif
@if (session('disciplina.purge.success'))
    <script>
        Swal.fire(
            'Disciplina Purgado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('disciplina.purge.error'))
    <script>
        Swal.fire(
            'Erro ao Purgar Disciplina!',
            '',
            'success'
        )
    </script>
@endif
@endsection