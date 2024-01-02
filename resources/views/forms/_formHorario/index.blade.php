<div class="row">
<div class="form-group col-sm-4">
    <label for=""  class="form-label">Hora de Inicio</label>
    <input type="time" class="form-control"  placeholder="Digite a Hora de Inicio" name="inicio_prova" value="{{isset($horario->inicio_prova) ? $horario->inicio_prova : ''}}">
</div>

<div class="form-group col-sm-4">
    <label for="" class="form-label">Fim</label>
    <input type="time" class="form-control" placeholder="Digite a Hora de termino " name="termino_prova" value="{{isset($horario->termino_prova) ? $horario->termino_prova : ''}}">
</div>

</div>