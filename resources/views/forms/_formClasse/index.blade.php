<div class="row">
    <div class="form-group col col-sm-4">
        <select class="form-control" name="vc_nome">
            @if (isset($classe))
                <option value="{{$classe->vc_nome}}">{{$classe->vc_nome}}</option>
                  <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
            
                @else
                    <option>Selecione uma classe</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
            
            @endif
        </select>
    </div>
</div>








{{-- <label for="vc_nome">Classe:</label>
        <input classe="form-control" type="number" maxlength="1" placeholder="Digite a classe" id="vc_nome" name="vc_nome"  value="{{isset($classe->vc_nome) ? $classe->vc_nome : ''}}" >--}}