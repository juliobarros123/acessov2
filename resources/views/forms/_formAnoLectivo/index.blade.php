<div class="row">
<div class="form-group col-sm-6">
    <label for=""  class="form-label">Ano Inicio</label>
    <input type="number" class="form-control"  placeholder="Digite o Inicio do Ano Lectivo" name="ya_inicio" value="{{isset($ano_lectivo->ya_inicio) ? $ano_lectivo->ya_inicio : ''}}">
</div>

<div class="form-group col-sm-6">
    <label for="" class="form-label">Fim</label>
    <input type="number" class="form-control" placeholder="Digite o Fim do Ano Lectivo" name="ya_fim" value="{{isset($ano_lectivo->ya_fim) ? $ano_lectivo->ya_fim : ''}}">
</div>
</div>