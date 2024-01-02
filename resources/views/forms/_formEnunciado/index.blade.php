
<div class="row">
    <div class="form-group col-sm-6">
        <label for="id_ano_lectivo" class="form-label">Enunciado</label>
        <select name="id_ano" id="id_ano_lectivo" class="form-control">
            @if(isset($enunciado->ya_inicio) && isset($enunciado->ya_fim))
                <option value="{{$enunciado->id_ano_lectivo}}" selected>{{$enunciado->ya_inicio}}-{{$enunciado->ya_fim}}</option>
            @endif
            @foreach ($anos as $ano)
                <option value="{{isset($ano->id) ? $ano->id : ''}}">{{$ano->ya_inicio}}-{{$ano->ya_fim}}</option>
            @endforeach      
        </select>
    </div>
    <br>
    <div class="form-group col-sm-6">
        <label for="id_periodo" class="form-label">Periodo</label>
        <select name="id_periodo" id="id_periodo" class="form-control">
            
            @if(isset($enunciado->periodo))
                <option value="{{$enunciado->id_periodo}}" selected>{{$enunciado->periodo}}</option>
            @endif
            @foreach ($periodos as $periodo)
                <option value="{{isset($periodo->id) ? $periodo->id : ''}}">{{$periodo->vc_nome}}</option>
            @endforeach      
        </select> 
    </div>           
</div>



