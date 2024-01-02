<div class="row">
    <div class="form-group col col-sm-4">
        <input type="text" maxlength="3" class="form-control" placeholder="Digite a sala" name="vc_name" value="{{isset($sala->vc_nome) ? $sala->vc_nome : ''}}">
    </div>
    <div class="form-group col col-sm-4">
        <input type="number" maxlength="3" class="form-control" placeholder="Digite a capacidade da  sala" name="capacidade_total" value="{{isset($sala->capacidade_total) ? $sala->capacidade_total : ''}}">
    </div>
</div>


