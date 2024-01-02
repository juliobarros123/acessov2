@extends('layouts.admin.body')
@section('titulo', 'Banco Alinea')
@section('conteudo')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-h-100">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Cadastrar Alínea</h4>
                                <button type="button" class="btn btn-primary w-md" onclick="addNovaAlinea()"><i
                                        class="fa fa-plus"></i> Nova alínea</button>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('admin.banco_alinea.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @include('forms._formBancoAlinea.index')

                                        <div class="" id="dd" style=""></div>
                                        <br>
                                        <button type="submit" class="btn btn-primary w-md">Cadastrar</button>
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

    @if (session('banco_alinea.create.success'))
        <script>
            Swal.fire(
                'Alínea Cadastrado com sucesso!',
                '',
                'success'
            )
        </script>
    @endif

    @if (session('banco_alinea.create.error'))
        <script>
            Swal.fire(
                'Erro ao Cadastrar Alínea!',
                '',
                'error'
            )
        </script>
    @endif
    @if (session('chave.error'))
        <script>
            Swal.fire(
                'Essa pergunta já possui uma alinea verdadeira!',
                '',
                'error'
            )
        </script>
    @endif

    <script>
        const alineas = [];

        function addNovaAlinea() {

            event.preventDefault();
            let numero = Math.floor(Math.random() * 100);
            let componente = document.getElementById("dd");
            let elemento = document.createElement("div");
            elemento.classList.add("row");
            elemento.id = `div${numero}`;
            elemento.innerHTML = `@include('forms._formBancoAlinea.index', ['numero' => rand(1, 100)])`;


            /*  elemento.style = ""; */
            elemento.innerHTML = `
            <br><br>
            

<div class="col-md-4">
    <label for="it_id_banco_pergunta">Perguntas</label>
    <select name="it_id_banco_pergunta" class="form-control" id="it_id_banco_pergunta" required>
        @if (isset($banco_alinea->it_id_banco_pergunta))
            <option value="{{ $banco_alinea->it_id_banco_pergunta }}" class="form-control" selected>
                {{ $banco_alinea->vc_descricao_bp }}</option>
        @else
            {{-- <option selected disabled>Selecciona a pergunta</option> --}}
        @endif
        @foreach ($banco_perguntas as $bpergunta)
            <option value="{{ $bpergunta->id }}" class="form-control">{{ $bpergunta->vc_descricao_bp }}</option>
        @endforeach
    </select>

</div>
<div class="form-group col-md-4">
    <label for="">Chave</label>
    <select type="int" name="alinea[${numero}][chave]" class="form-control key" required onchange="updateSelects(this)">
        @if (isset($banco_alinea->chave))
            <option value="{{ $banco_alinea->chave }}" selected>
                {{ $banco_alinea->chave == 1 ? 'Verdadeiro' : 'Falso' }}
            </option>
        @endif
        <option class="form-control" value="0">Falso</option>
        @if ($v)
            <option class="form-control" value="1">
                Verdadeiro</option>
        @else
            <option disabled class="form-control" value="1">
                Verdadeiro</option>
        @endif
    </select>

</div>
<div class="col-md-4" >
    <label for="">Imagem</label>
    <div style='display:flex; flex-direction:row;'>
        <input type="file" class="form-control" name="vc_imagem_ba${numero}">
   
    </div>
</div>
<div class="col-md-4" >
    <label for="">Alinea</label>
    <div style='display:flex; flex-direction:row;'>
    <textarea type="textarea" class="form-control" placeholder="Digite a descrição da alínea" name="alinea[${numero}][description]" required>{{ isset($banco_alinea->description) ? $banco_alinea->description : '' }}</textarea> 
    <button class="btn btn-dismiss" id="remover${numero} " onclick="remover(div${numero})"><i style="color:#003B76" class="fas fa-times fa-lg"></i></button>
    </div>
</div>

            `;

            componente.appendChild(elemento);
        }




        function remover(id) {
            event.preventDefault();
            let componente = document.getElementById("dd");
            id.remove();

            quantidade(1, 1, 000);
        }

        function updateSelects(select) {
        var selects = document.getElementsByClassName('key');

        for (var i = 0; i < selects.length; i++) {
            if (selects[i] !== select) {
                selects[i].value = '0';
                selects[i].getElementsByTagName('option')[0].textContent = 'Falso';
            } else {
                select.value = '1';
                select.getElementsByTagName('option')[0].textContent = 'Verdadeiro';
            }
        }
    }
    function updateSelects(select) {
        var selects = document.getElementsByClassName('key');

        for (var i = 0; i < selects.length; i++) {
            if (selects[i] !== select) {
                selects[i].value = '0';
                selects[i].getElementsByTagName('option')[0].textContent = 'Falso';
            } else {
                select.value = '1';
                select.getElementsByTagName('option')[0].textContent = 'Verdadeiro';
            }
        }
    }

    </script>
@endsection

{{-- <form action="{{route('admin.banco_alinea.store')}}" method="post">
    @csrf
    @include('forms._formABancoAlinea.index')
    <input type="submit" value="Cadastrar">
</form> --}}
