<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">

    <title>lista de resultados</title>
    <style>
        .logotipo {
            position: absolute;
            margin-top: -100px;
            margin-right: -110px;
            float: left;
            z-index: 1;
        }

        /* .tb{
                position: absolute;
                margin-top: 10px;
                margin-right: -110px;
                float: left;
                z-index: 1;
            } */


        .logo {
            width: 500px;
            height: 100px;
            /* background-color: red; */
            /* position: absolute;
            left: 50px;
            margin-left: 300px; */
            left: 50px;
            margin-left: 30px;
            margin-top: -170px;
            font-size: 100px;
        }

        .director {
            font-style: italic;
            font-family: 'Times New Roman', Times, serif;
            text-transform: uppercase;
            font-size: 13px;
            /* color: red */

        }

        .narracao {
            margin-left: 30px;

            font-family: 'Times New Roman', Times, serif;
            font-size: 12.8px;
            text-align: justify;
            width: 92%;
            line-height: 19px;
            /* background-color: red; */
        }









        .desciplina {

            /* width: 380px; */
            padding-bottom: 0px;
            padding-bottom: 0px;
            padding-top: 1.7px;
            /* text-align: center; */
            font-size: 11px;
            padding-left: 6px;
        }




        .cab-table {
            font-size: 10px;
            /* text-align: center; */
            padding-bottom: 3px;
            padding-top: 3px;
            padding-left: 5px;
            padding-right: 5px;

            font-weight: bold;
            text-transform: uppercase
        }

        td {
            font-size: 10px;
            text-align: center;
            padding-bottom: 3px;
            padding-top: 3px;
            padding-left: 5px;
            padding-right: 5px;

            font-weight: bold;
            text-transform: uppercase
        }



        .cab-cert {
            /* background-color: red; */
            /* padding-left: 20px; */
            text-transform: uppercase;
            font-size: 11.5px;
            font-weight: bold;

            text-align: center;
            /* padding-top: 1600px; */
            /* height: 100px; */
        }

        table,
        td,
        th {
            border: 1px solid black;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .text-center {
            text-align: center;
        }

        h3 {
            font-weight: 500;
        }
        .text-upper-case{
            text-transform:uppercase;
        }
    </style>
</head>

<body
    style="background-image: url('images/fundo.png');background-position: top left;
    background-repeat: no-repeat;
    background-image-resize: 2;
    background-image-resolution: from-image;">

    @php
        $media = null;
    @endphp
    <p class="cab-cert">

        <br>
        <br>
        <br>
        <br>

        <br>
        REPÚBLICA DE ANGOLA
        <br>
        MINISTÉRIO DA EDUCAÇÃO
        <br>



    </p>
    <br>

    <h3 class="text-center text-upper-case">LISTA DE DIVULGAÇÃO DOS RESULTADOS NO ANO LECTIVO {{ $ano_lectivo }}
    <br>
        
    </h3>
   <p class="text-center"><strong>{{ $prova->vc_nome }}/
    {{ $prova->curso }}/(
    {{ $prova->inicio_prova }}-
    {{ $prova->termino_prova }})/
    {{ $prova->periodo }}
 

</strong></p>

    



    <table class="table">

        <tr>
            <th class=" td cab-table ">Nº ordem</th>
            <th class=" td cab-table ">Candidato</th>
            <th class=" td cab-table ">Idade</th>
            <th class=" td cab-table ">Gênero</th>

            @foreach ($disciplinas as $disciplina)
                <th class=" td cab-table "><strong> {{ abreviarDisciplina($disciplina->vc_nome) }}</strong></th>
            @endforeach
            <td class=" td cab-table " style="">MÉDIA</td>
            <td class=" td cab-table " style="">Resultado</td>
        </tr>


        @foreach ($candidatos as $candidato)
            <tr>

                <td>{{ $loop->index+1 }}</td>
                <td>{{ $candidato->vc_primeiro_nome }} {{ $candidato->vc_ultimo_nome }}</td>

                <td>{{ $candidato->it_idade }}</td>
                <td>{{ $candidato->vc_genero }}</td>

                @foreach ($disciplinas as $disciplina)
                    @php
                        // dd($candidato->vc_codigo, $disciplina->id, $candidato->id_correcao);
                        $nota = notas($candidato->vc_codigo, $disciplina->id)->sum('it_cotacao');
                        $media += $nota;
                    @endphp
                    <td style="{{ $nota >= 10 ? 'color:green' : 'color:red' }}">{{ $nota }}</td>
                @endforeach
                @php
                    $media = round($media / $disciplinas->count(), 0, PHP_ROUND_HALF_UP);
                @endphp
                <td style="{{ $media >= 10 ? 'color:green' : 'color:red' }}">{{ $media }}</td>
                <td style="{{ $media >= 10 ? 'color:green' : 'color:red' }}">
                    @if ($media >= 10)
                        Apto
                    @else
                        Não apto
                    @endif

                    @php
                    $media=0;
                @endphp
                </td>

            </tr>
        @endforeach


    </table>




</body>

</html>
