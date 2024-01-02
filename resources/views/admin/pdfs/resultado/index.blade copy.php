<style>
 table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 4px;
 
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
    font-weight:bold;
    text-transform: uppercase
}
</style>
    @php
        $media = null;
    @endphp

<table id="example">
                <thead>
                    <tr>
                        <th>Nº ORDEM</th>

                        <th>Candidato</th>
                        <th>Idade</th>
                        <th>Gênero</th>
                        @foreach ($disciplinas as $disciplina)
                            <th>{{ abreviarDisciplina($disciplina->vc_nome) }}</th>
                        @endforeach
                        <th>Média</th>
                        <th>Resultado</th>
                       
                    </tr>
                <tbody>
                    @foreach ($candidatos as $candidato)
                        <tr>

                            <td>{{ $candidato->id }}</td>
                            <td>{{ $candidato->vc_primeiro_nome }} {{ $candidato->vc_ultimo_nome }}</td>

                            <td>{{ $candidato->it_idade }}</td>
                            <td>{{ $candidato->vc_genero }}</td>

                            @foreach ($disciplinas as $disciplina)
                                @php
                                // dd($candidato->vc_codigo, $disciplina->id, $candidato->id_correcao);
                                    $nota = notas($candidato->vc_codigo, $disciplina->id, $candidato->id_correcao)->sum('it_cotacao');
                                    $media += $nota;
                                @endphp
                                <td>{{ $nota }}</td>
                            @endforeach
                            @php
                                $media = round($media / $disciplinas->count(), 0, PHP_ROUND_HALF_UP);
                            @endphp
                            <td>{{ $media }}</td>
                            <td>
                                @if ($media >= 10)
                                    Apto
                                @else
                                    Não apto
                                @endif

                               
                            </td>

                        </tr>
                    @endforeach
                </tbody>
              
            </table>
       



