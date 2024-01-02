<div class="row">
    <div class="form-group col-sm-4">
        <label for="" class="form-label">Curso:</label>
        <select required name="it_id_curso" class="form-control">
            @if (isset($curso_disciplina))
                <option value="{{ $curso_disciplina->it_id_curso }}" >{{ $curso_disciplina->curso }}
                </option>
            @else
                <option value="{{ $curso->id }}" selected>{{ $curso->vc_nome }}
                </option>
            @endif
        </select>
        @if ($errors->has('it_id_curso'))
            <small id="emailHelp" class="form-text text-danger"> {{ $errors->first('it_id_curso') }}.</small>
        @endif
    </div>

    <div class="form-group col-sm-4">
        <label for="" class="form-label">Disciplina:</label>
        <select required name="it_id_disciplina" class="form-control">

            @if (isset($curso_disciplina))
                <option value="{{ $curso_disciplina->it_id_disciplina }}" >{{ $curso_disciplina->disciplina }}
                </option>
            @else
                <option selected disabled>Selecciona a disciplina:</option>
            @endif
            @foreach ($disciplinas as $disciplina)
                <option value="{{ $disciplina->id }}" >{{ $disciplina->vc_nome }}
                </option>
            @endforeach

        </select>
        @if ($errors->has('it_id_disciplina'))
            <small id="emailHelp" class="form-text text-danger"> {{ $errors->first('it_id_disciplina') }}.</small>
        @endif
    </div>
    {{-- @dump($curso); --}}
</div>
