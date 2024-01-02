<div class="row">
    <div class="form-group col-sm-4">
        <label for="it_id_sala">Sala</label>
        <select name="it_id_sala" class="form-control" id="it_id_sala" required>
            @if (isset($prova->it_id_sala))
                <option value="{{ $prova->it_id_sala }}" class="form-control" selected>{{ $prova->sala }}</option>
            @else
                <option selected disabled>Selecciona a sala</option>
            @endif
            @foreach ($salas as $sala)
                <option value="{{ $sala->id }}" class="form-control">{{ $sala->vc_nome }}</option>
            @endforeach
        </select>
        <br>

    </div>
    
    <div class="form-group col-sm-4">

        <label for="">Prova</label>
        <input type="text" class="form-control" placeholder="Nome" name="vc_nome" required
            value={{ isset($prova->vc_nome) ? $prova->vc_nome : '' }}>
    </div>
    <div class="form-group col-sm-4">

        <label for="">Nº candidatos</label>
        <input class="form-control" placeholder="Nº candidatos" name="vc_n_candidatos" required readonly
       value="{{ isset($prova->vc_n_candidatos) ? $prova->vc_n_candidatos : '' }}">

    </div>

</div>
<div class="row">
    <div class="form-group col-sm-4">
        <label for="it_id_curso">Curso</label>
        <select name="it_id_curso" class="form-control" id="it_id_curso" required>
            @if (isset($prova->it_id_curso))
                <option value="{{ $prova->it_id_curso }}" class="form-control" selected>{{ $prova->curso }}</option>
            @else
                <option selected disabled>Selecciona o curso</option>
            @endif
            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}" class="form-control">{{ $curso->vc_nome }}</option>
            @endforeach
        </select>
        <br>

    </div>
    <div class="form-group col-sm-4">
        <label for="it_id_horario">horario</label>
        <select name="it_id_horario" class="form-control" id="it_id_horario" required>
            @if (isset($prova->it_id_horario))
                <option value="{{ $prova->it_id_horario }}" class="form-control" selected>{{ $prova->horario }}</option>
            @else
                <option selected disabled>Selecciona o horario</option>
            @endif
            @foreach ($horarios as $horario)
            <option value="{{ $horario->id }}" class="form-control">
                {{ $horario->inicio_prova }} -- {{ $horario->termino_prova }}
            </option>

            @endforeach
        </select>
    </div>
    <div class="form-group col-sm-4">
        <label for="it_id_ano_lectivo">Ano lectivo</label>
        <select name="it_id_ano_lectivo" class="form-control" id="it_id_ano_lectivo" required>
            @if (isset($prova->it_id_ano_lectivo))
                <option value="{{ $prova->it_id_ano_lectivo }}" class="form-control" selected>{{ $prova->ano_lectivo }}</option>
            @else
                <option selected disabled>Selecciona a Ano lectivo</option>
            @endif
            @foreach ($ano_lectivos as $ano_lectivo)
                <option value="{{ $ano_lectivo->id }}" class="form-control">{{ $ano_lectivo->ya_inicio }}--{{ $ano_lectivo->ya_fim }}</option>
            @endforeach
        </select>
        <br>

    </div>
    <div class="form-group col-sm-4">

        <label for="">Periodo</label>
        <input class="form-control" placeholder="Periodo" name="periodo" required readonly
       value="{{ isset($prova->vc_n_candidatos) ? $prova->vc_n_candidatos : '' }}">

    </div>
    <div class="form-group col-sm-4">

        <label for="">Data da prova</label>
        <input type="date" class="form-control" placeholder="Periodo" name="dt_data_prova" required 
       value="{{ isset($prova->dt_data_prova) ? $prova->dt_data_prova : '' }}">

    </div>

  
        <div class="form-group col-md-12">
            <label for="topicos">{{ __('Topícos') }}</label>
            <textarea class ="form-control" name="topicos"   id="editor"  placeholder="Descreva o tópico da prova"  cols="10" rows="5" >{{ isset($prova->topicos) ? $prova->topicos : '' }}</textarea>
            @error('{{ $prova->topicos }}')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    
</div>
<!--<div class="row">
    <div class="col-sm-4 form-group">        
        <label for="">Capacidade Usada</label>
        <input type="number" class="form-control" placeholder="Capacidade Usada" name="capacidade_usada" required
            value={{ isset($prova->capacidade_usada) ? $prova->capacidade_usada : '' }}>
    </div>
</div>-->
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var salasJson = {!! $salasJson !!};

        document.getElementById('it_id_sala').addEventListener('change', function() {
            var salaSelecionada = parseInt(this.value);
            var capacidadeSala = 0;

            for (var i = 0; i < salasJson.length; i++) {
                if (salasJson[i].id === salaSelecionada) {
                    capacidadeSala = salasJson[i].capacidade_total;
                    break;
                }
            }

            document.getElementsByName('vc_n_candidatos')[0].value = capacidadeSala;
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var periodosJson = {!! $periodosJson !!};

        document.getElementById('it_id_horario').addEventListener('change', function() {
          
            var horaSelecionada = parseInt(this.value);
            var vc_nome = "";

            for (var i = 0; i < periodosJson.length; i++) {
                if (periodosJson[i].id === horaSelecionada) {                   
                    vc_nome = periodosJson[i].vc_nome;
                    break;
                }
            }

            document.getElementsByName('periodo')[0].value = vc_nome;
        });
    });
</script>



