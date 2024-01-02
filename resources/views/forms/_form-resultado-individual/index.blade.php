<div class="row">
    <div class="form-group col-sm-4">
        <label for="" class="form-label">Candidato</label>
        <select required name="id_candidato" class="form-control">
        <option value="" selected disabled> Selecciona o candidato</option>
            @foreach ($candidatos as $candidato)
                <option value="{{ isset($candidato->id) ? $candidato->id : '' }}">{{ $candidato->vc_primeiro_nome }}
                    {{ $candidato->vc_ultimo_nome }}
                    
                </option>
            @endforeach
        </select>
      
    </div>

    <div class="form-group col-sm-4">
        <label for="" class="form-label">Disciplina</label>
        <select required name="id_disciplina" class="form-control">
            <option value="" selected disabled> Selecciona a disciplina</option>
            @foreach ($disciplinas as $disciplina)
                <option value="{{ isset($disciplina->id) ? $disciplina->id : '' }}">{{ $disciplina->vc_nome }}
                </option>
            @endforeach
        </select>
       
    </div>
</div>
