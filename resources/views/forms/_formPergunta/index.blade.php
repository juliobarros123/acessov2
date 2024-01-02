<div class="row">
<div class="form-group col-sm-6">
    <label class="form-label" for="">Pergunta</label>
    <input class="form-control" type="text" placeholder="Digite a Pergunta" name="descricao" value="{{isset($pergunta->descricao) ? $pergunta->descricao : ''}}" required minlength="5" maxlength="100">
</div>
<div class="form-group col-sm-6">
    <label class="form-label" for="">Alinea</label>
    <input class="form-control" type="text" pattern="([aA-zZ]+)" placeholder="Digite a Alinea" name="ch_alinea" value="{{isset($pergunta->ch_alinea) ? $pergunta->ch_alinea : ''}}" required maxlength="1">
</div>
<div class="form-group col-sm-6">
    <label class="form-label" for="">Número</label>
    <input class="form-control" type="number" placeholder="Digite o número" name="it_numero" value="{{isset($pergunta->it_numero) ? $pergunta->it_numero : ''}}" required>
</div>
<div class="form-group col-sm-6">
    <label class="form-label" for="it_id_banco_pergunta">Cotacão</label>
    <select class="form-control" name="it_id_banco_pergunta" id="it_id_banco_pergunta" required>
        @if(isset($pergunta->it_cotacao))
        <option value="{{$pergunta->it_id_banco_pergunta}}" selected>{{$pergunta->it_cotacao}}</option>
    @endif
        @foreach ($bperguntas as $bpergunta)
            <option value="{{$bpergunta->id}}">{{$bpergunta->it_cotacao}}</option>
        @endforeach
        
    </select>
</div>
<div class="form-group col-sm-6">
    <label class="form-label" for="it_id_enunciado">Código</label>
    <select class="form-control" name="it_id_enunciado" id="it_id_enunciado" required>
        @if(isset($pergunta->codigo))
            <option value="{{$pergunta->it_id_enunciado}}" selected>{{$pergunta->codigo}}</option>
        @endif
        @foreach ($enunciados as $enunciado)
            <option value="{{$enunciado->id}}">{{$enunciado->codigo}}</option >
        @endforeach      
    </select>
    
</div>
</div>