    <div class="row">
        @if (isset($candidatoImage))
            <div class="form-group col-sm-3">
                <img src="{{ asset($candidato->vc_foto) }}" alt="{{ $candidato->vc_primeiro_nome }}" width="100%"
                    height="250px">
            </div>
        @endif
    </div>
    <div class="row">
        <div class="form-group col-sm-4">
            <label for="">Primeiro Nome</label>
            <input required class="form-control" type="text" placeholder="Digite o Primerio Nome"
                name="vc_primeiro_nome"
                value="{{ isset($candidato->vc_primeiro_nome) ? $candidato->vc_primeiro_nome : '' }}">
        </div>
        <div class="form-group col-sm-4">
            <label for="">Nomes do Meio</label>
            <input required class="form-control" type="text" placeholder="Digite os Nome(s) do Meio"
                name="vc_nome_meio" value="{{ isset($candidato->vc_nome_meio) ? $candidato->vc_nome_meio : '' }}">
        </div>
        <div class="form-group col-sm-4">
            <label for="">Ultimo Nome </label>
            <input required class="form-control" type="text" placeholder="Digite o Seu Ultimo Nome "
                name="vc_ultimo_nome" value="{{ isset($candidato->vc_ultimo_nome) ? $candidato->vc_ultimo_nome : '' }}">
        </div>
    </div>
    <br>
    <div class="row">

        <div class="form-group col-sm-4">
            <label for="">Classe</label>
            <select required class="form-control" name="it_id_classe" id="">
                @if (isset($candidato))
                    <option value="{{ $candidato->idClasse }}">
                        {{ $candidato->nome_classe }}
                    </option>
                @else
                    <option selected disabled>Selecciona a classe</option>
                @endif
                @foreach ($classes as $classe)
                    <option value="{{ $classe->id }}">{{ $classe->vc_nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-sm-4">
            <label for="">Data de Nascimento</label>
            <input required class="form-control" type="date" name="dt_data_nascimento"
                value="{{ isset($candidato->dt_data_nascimento) ? $candidato->dt_data_nascimento : '' }}">
            @if ($errors->has('dt_data_nascimento'))
                <small id="emailHelp" class="form-text text-danger">
                    {{ $errors->first('dt_data_nascimento') }}.</small>
            @endif
        </div>
        <div class="form-group col-sm-4">
            <label for="">Naturalidade </label>
            <input required class="form-control" type="text" placeholder=" Naturalidade " name="vc_naturalidade"
                value="{{ isset($candidato->vc_naturalidade) ? $candidato->vc_naturalidade : '' }}">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="form-group col-sm-4">
            <label for="">Província</label>
            <input required class="form-control" type="text" placeholder="Província" name="vc_provincia"
                value="{{ isset($candidato->vc_provincia) ? $candidato->vc_provincia : '' }}">
                <select required class="form-control" name="it_id_ano_lectivo" id="">
                    @if (isset($candidato->vc_provincia))
                        <option value="{{ $candidato->vc_provincia }}">{{ $candidato->vc_provincia }}
                        </option>
                    @else
                    <option selected disabled>Selecciona a provincia</option>
                    @endif
                    <option value="Bengo">Bengo</option>
                    <option value="Benguela">Benguela</option>
                    <option value="Bié">Bié</option>
                    <option value="Cabinda">Cabinda</option>
                    <option value="Cuando-Cubango">Cuando-Cubango</option>
                    <option value="Cuanza Norte">Cuanza Norte</option>
                    <option value="Cuanza Sul">Cuanza Sul</option>
                    <option value="Cunene">Cunene</option>
                    <option value="Huambo">Huambo</option>
                    <option value="Huíla">Huíla</option>
                    <option value="Lunda Norte">Lunda Norte</option>
                    <option value="Lunda Sul">Lunda Sul</option>
                    <option value="Luanda">Luanda</option>
                    <option value="Malanje">Malanje</option>
                    <option value="Moxico">Moxico</option>
                    <option value="Namibe">Namibe</option>
                    <option value="Uíge">Uíge</option>
                    <option value="Zaire">Zaire</option>                     
                </select>
        </div>
        <div class="form-group col-sm-4">
            <label for="">Nome do Pai</label>
            <input required class="form-control" type="text" name="vc_nome_pai" placeholder=" Nome da Pai"
                value="{{ isset($candidato->vc_nome_pai) ? $candidato->vc_nome_pai : '' }}">
        </div>
        <div class="form-group col-sm-4">
            <label for="">Nome da Mãe<em></em> </label>
            <input required class="form-control" type="text" placeholder=" Nome da Mãe " name="vc_nome_mae"
                value="{{ isset($candidato->vc_nome_mae) ? $candidato->vc_nome_mae : '' }}">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="form-group col-sm-4">
            <label for="">Deficiência</label>
            <select required class="form-control" name="vc_deficiencia" id="">
                
                <option selected disabled>Selecciona</option>
                <option value="sim">Sim</option>
                <option value="nao">Nao</option>
            </select>
        </div>
        <div class="form-group col-sm-4">
            <label for="">Estado Cívil</label>
            <select required class="form-control" name="vc_estado_civil" id="">
               
                <option selected disabled>Selecciona o seu estado cívil</option>
                <option value="Solteiro">Solteiro</option>
                <option value="Casado">Casado</option>
            </select>
        </div>
        <div class="form-group col-sm-4">
            <label for="">Genero</label>
            <select required class="form-control" name="vc_genero" id="">
                
                <option selected disabled>Selecciona o seu genero</option>
                <option value="f">Masculino</option>
                <option value="m">Femenino</option>
            </select>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="form-group col-sm-4">
            <label for="">Telefone</label>
            <input required class="form-control" type="number" placeholder="Telefone" name="it_telefone"
                value="{{ isset($candidato->it_telefone) ? $candidato->it_telefone : '' }}">
        </div>
        <div class="form-group col-sm-4">
            <label for="">Email</label>
            <input required class="form-control" type="email" placeholder="exemplo@gmail.com" name="vc_email"
                value="{{ isset($candidato->vc_email) ? $candidato->vc_email : '' }}">
        </div>
        <div class="form-group col-sm-4">
            <label for="">Residência</label>
            <input required class="form-control" type="text" placeholder="Residência" name="vc_residencia"
                value="{{ isset($candidato->vc_residencia) ? $candidato->vc_residencia : '' }}">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="form-group col-sm-4">
            <label for="">Nº do BI</label>
            <input required class="form-control" type="text" placeholder="" name="vc_bi"
                value="{{ isset($candidato->vc_bi) ? $candidato->vc_bi : '' }}">
        </div>
        <div class="form-group col-sm-4">
            <label for="">Data de Emissão</label>
            <input required class="form-control" type="date" placeholder="Data de Emissão" name="dt_data_emissao"
                value="{{ isset($candidato->dt_data_emissao) ? $candidato->dt_data_emissao : '' }}">
        </div>
        <div class="form-group col-sm-4">
            <label for="">LocaL de Emissão</label>
            <input required class="form-control" type="text" placeholder="Local Emissao" name="vc_local_emissao"
                value="{{ isset($candidato->vc_local_emissao) ? $candidato->vc_local_emissao : '' }}">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="form-group col-sm-4">
            <label for="">Escola Anterior</label>
            <input required class="form-control" type="text" placeholder="Escola Anterior"
                name="vc_escola_anterior"
                value="{{ isset($candidato->vc_escola_anterior) ? $candidato->vc_escola_anterior : '' }}">
        </div>
        <div class="form-group col-sm-4">
            <label for="">Ano de Conclusão</label>
            <select required class="form-control" name="ya_ano_conclusao" id="">
                @if (isset($candidato))
                    <option value="{{ $candidato->ya_ano_conclusao }}">{{ $candidato->ya_ano_conclusao }}</option>
                @else
                    <option selected disabled>Selecciona o ano de conclusão</option>
                @endif
                <option value="{{ 2020 }}">2020</option>
                <option value="{{ 2022 }}">2022</option>
                <option value="{{ 2023 }}">2023</option>
            </select>
        </div>

        <div class="form-group col-sm-4">
            <label for="">Media</label>
            <input required class="form-control" type="number" placeholder="Media" name="it_media"
                value="{{ isset($candidato->it_media) ? $candidato->it_media : '' }}">
        </div>
    </div>
    <br>

    <div class="row">

   


        <div class="form-group col-sm-4">
            <label for="">Ano Lectivo</label>
            <select required class="form-control" name="it_id_ano_lectivo" id="">
                @if (isset($candidato->idAno))
                    <option value="{{ $candidato->idAno }}">{{ $candidato->ya_inicio }}-{{ $candidato->ya_fim }}
                    </option>
                @else
                    <option selected disabled>Selecciona o ano lectivo</option>
                @endif
                @foreach ($anos as $ano)
                    <option value="{{ $ano->id }}">{{ $ano->ya_inicio }}-{{ $ano->ya_fim }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-sm-4">
            <label for="">Cursos:</label>
            <select required class="form-control" name="it_id_curso" id="">
                @if (isset($candidato->id))
                    <option value="{{ $candidato->it_id_curso }}">{{ $candidato->curso }}</option>
                @else
                    <option disabled selected>Selecciona o curso</option>
                @endif
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->vc_nome }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group col-sm-4">
            <label for="">Data de candidatura</label>
            <input required class="form-control" type="date" placeholder="Data de candidatura"
                name="dt_data_candidatura"
                value="{{ isset($candidato->dt_ano_candidatura) ? $candidato->dt_ano_candidatura : '' }}">

        </div>
        <div class="form-group col-sm-4">
            <label for="">foto</label>
            <input class="form-control" type="file" name="vc_foto" id="">
        </div>
    </div>
    <br>

    <div class="row">
        {{-- <div class="form-group col-sm-4">
            <label for="">Sala</label>
                <select required class="form-control" name="it_id_sala" id="">
                @if (isset($candidato->nome_sala))
                    <option value="{{ $candidato->idSala }}">{{ $candidato->nome_sala}}</option>
                @endif
                @foreach ($salas as $sala)
                    <option value="{{ $sala->id }}">{{ $sala->vc_nome }}</option>
                @endforeach
            </select>

        </div> --}}
        {{-- <div class="form-group col-sm-4">
                <label for="">Periodo</label>
                <select required class="form-control" name="it_id_periodo" id="">
                @if (isset($candidato->nome_periodo))
                    <option value="{{ $candidato->idPeriodo}}">{{ $candidato->nome_periodo}}</option>
                @endif
                @foreach ($periodos as $periodo)
                    <option value="{{ $periodo->id }}">{{ $periodo->vc_nome }}</option>
                @endforeach
                </select>
        </div> --}}

    </div>
