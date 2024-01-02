<div class="form-group col-sm-4">
    <label for="">Periodo</label>
    <select class="form-control" name="vc_nome">
        <option value="Manhã" @if(isset($periodo)){ @if($periodo->vc_nome=="Manhã") selected @endif} @endif>Manhã</option>
        <option value="Tarde" @if(isset($periodo)){ @if($periodo->vc_nome=="Tarde") selected @endif} @endif>Tarde</option>
        <option value="Noite" @if(isset($periodo)){ @if($periodo->vc_nome=="Noite") selected @endif} @endif>Noite</option>
    </select>
    
</div>
