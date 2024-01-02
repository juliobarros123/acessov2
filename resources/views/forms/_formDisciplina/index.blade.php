<div class="form-group col-sm-6">
    <label for="">Nome da disciplina</label>
    <input type="text" placeholder="Digite o nome da disciplina" class="form-control" name="vc_nome" value="{{isset($disciplina->vc_nome) ? $disciplina->vc_nome : ''}}" pattern="^[^0-9][\w\sÀ-ÿ]*$"
    title="O nome da disciplina deve começar com uma letra, não com um número" required>
</div>






