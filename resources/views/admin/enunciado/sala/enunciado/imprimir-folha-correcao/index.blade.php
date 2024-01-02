


<style>
    .w-100 {
        width: 100%;
    }

    .font-cab {
        font-size: 11px;
    }

    .logo_itel {
        height: 70px;
    }

    .bordaer-table {
        border-collapse: collapse;
        /* border: 1px solid #dee2e6 !important; */
    }

    table,
    th,
    td {
        border: 1px solid white;
    }

    .pergunta {
        /* text-align: justify; */
        /* color: blue; */
        /* margin-bottom: 0px !important;
        margin-top: 0px !important;
        font-size: 12px !important; */
    }


    .text-center {
        text-align: center;
    }

    .check-alinea {
        font-size: 16px;
        background-color: black !important;
    }



    .cotacao {
        /* background-color: red; */
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }

    .mt-mb-0 {
        margin-top: 3px !important;
        margin-bottom: 3px !important;
    }

    hr {
        margin-top: 0px !important;
        margin-bottom: 0px !important;

    }
</style>
<style>
    .element-center {
        text-align: center;
        vertical-align: middle;
    }



    .centered {
        display: inline-block;
        vertical-align: middle;
    }

    .w-100 {
        width: 100%;
    }



    .logo_itel {
        height: 100px;
    }

    .bordaer-table {
        border-collapse: collapse;
        /* border: 1px solid #dee2e6 !important; */
    }

    table,
    th,
    td {
        /* border: 1px solid black; */
    }



    .alinea {
        text-align: justify;
        font-size: 11px;
        /* background: yellow; */
        padding: 30px;
        margin-top: 100px;
        /* padding-left: 100px */
        margin-left: 20px;
    }

    .text-center {
        text-align: center;
    }


.color-white{
    color: white !important;
}
    /* .header{
        margin-top: 80&;
    } */
    .mt {
        /* background-color: red; */
        margin-top: 1000px;
    }

    .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        /* background-color: #ccc; */
        padding: 10px;
        color: white!important;
    }
    hr{
        color: white;
    }
    header{
        color: white!important;
    }
</style>

<style>
    .quest {
        width: 100%;
        border: none;
        font-size: 12px;
    }

    .quest td {
        width: 33%;
        border: none;




    }



    .perguntapadding {
        /* padding-left: 50px !important; */
        background: green
    }



    .circulo {
        /* float: left; */

        /* position: fixed;
       top: 1000px;
    */
        height: 20px;

    }
    .td-pergunta{
        /* background-color: aqua; */
        vertical-align: top;
    }
  
</style>

@foreach ($enunciados as $enunciado)
    {{-- <p class="mt">vvv</p> --}}
    <header class="mt">
        <table class="w-100 bordaer-table ">
            <tr>
                <td width="25%" class="">
                    <img src="assets/images/logo-folha-correcao.png" class="logo_itel" height="10px">
                </td>
                <td class="element-center " width="50%" colspan="2">

                    <img src="assets/images/logo-folha-correcao.png" alt="" width="100px" height="100px">

                    <p class="font-cab color-white">
                        REPÚBLICA DE ANGOLA <br>
                        MINISTÉRIO DAS TELECOMUNICAÇÕES, TECNOLOGIAS DE INFORMAÇÃO E COMUNICAÇÃO SOCIAL <br>
                        MINISTÉRIO DA EDUCAÇÃO <br>
                        INSTITUTO DE TELECOMUNICAÇÕES - ITEL <br>
                        DEPARTAMENTO PEDAGÓGICO <br>
                    </p>
                </td>
                <td width="25%" class=" element-center">
                    <br><br>
                    <br><br>
                    <br><br>


                    <p class="font-cab color-white">
                        Duração: 90 Min
                    </p>
                    <br>
                    <p class="font-cab color-white">
                        Cotação total: 20V
                    </p>
                    <br>
                    <p class="font-cab color-white">
                        Disciplina: <strong>{{ disciplina_por_enunciado($enunciado->id)->vc_nome }}</strong>

                    </p>

                </td>
            </tr>
            <tr>
                <td width="25%" class=" element-center ">
                    <p class="font-cab color-white">
                     <strong>Gabarito a carregar</strong>  
                    </p>
                </td>
                <td width="25%" class=" element-center ">
                    <p class="font-cab color-white">
                        Sala: {{ $enunciado->sala }}/
                        Periodo:{{ $enunciado->periodo }}
                    </p>
                </td>
                {{-- @dump($enunciado) --}}
                <td width="25%" class=" element-center ">
                    <p class="font-cab color-white">
                        Cód. Enunciado:{{ $enunciado->codigo }}
                    </p>
                </td>
                <td width="25%" class=" element-center ">
                    <p class="font-cab color-white">
                        Ano Lectivo:{{ $enunciado->ya_inicio }}/{{ $enunciado->ya_fim }}
                    </p>

                </td>
            </tr>
        </table>
        {{-- <table class="w-100 ">

                            </table>
                            --}}
    </header>
    <section>
        <div class="container">
            <p class="quest color-white">

                Nome:<small> <strong> {{ $enunciado->vc_primeiro_nome }}
                        {{ $enunciado->vc_ultimo_nome }}</strong></small>
                <br>
                Cód. Candidato: <small> <strong>{{ $enunciado->vc_codigo }}</strong></small>
            </p>
            <p class="quest color-white">
                Leia a prova com atenção, e responda as questões de uma forma clara
            </p>



            <table class="quest">
                @php $count = 0; @endphp
                <tr> <!-- Inicia a primeira linha -->
                    @foreach (perguntas()->where('perguntas.it_id_enunciado', $enunciado->id)->get() as $pergunta)
                        <td style="text-align: center" class="td-pergunta"   >

                            <div> {{ $pergunta->it_numero }}.
                                @foreach (alineas_geradas()->where('alinea_geradas.it_id_pergunta', $pergunta->id)->get() as $alinea)
                                    {{-- <div class="alinea"> <span> {{ $alinea->alinea }}</span>)<img class="circulo" src="images/cb.jpg"> </div>  --}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       <div class="alinea" style="height: 200px; display: table; padding:10px">
                                        <span style="vertical-align: middle; display: table-cell;">
                                            <span> {{ $alinea->alinea }}</span>)
                                        </span>
                                        {{-- <img class="circulo"  src="images/cb.jpg"> --}}
                                        @if (alinea_certa($pergunta->it_id_banco_pergunta,$alinea->it_id_banco_alinea))
                                        <img class="circulo" src="images/cp.jpg" style="vertical-align: middle;">
                                    @else
                                        <img class="circulo" src="images/cb.jpg" style="vertical-align: middle;">
                                    @endif
                                    </div>
                                  
                                @endforeach

                            </div>
                        </td>

                        @php $count++; @endphp

                        @if ($count % 3 === 0)
                </tr>
                <tr> <!-- Fecha a linha atual após três colunas e inicia uma nova linha -->
@endif
@endforeach

@if ($count % 3 !== 0)
    @for ($i = 0; $i < 3 - ($count % 3); $i++)
        <td></td> <!-- Preenche colunas vazias se não houver três colunas na última linha -->
    @endfor
    </tr> <!-- Fecha a linha final -->
@endif
</table>








</div>

</div>
</section>
<footer class="footer">
    <div>
        <hr class="text-center">
        <p class="text-center cotacao">Cotação:
            @foreach (perguntas()->where('perguntas.it_id_enunciado', $enunciado->id)->get() as $pergunta)
                {{ $pergunta->it_numero }}) {{ $pergunta->it_cotacao }}v;
            @endforeach
        </p>
        <hr class="text-center">
    </div>
    <p class="text-center font-cab mt-mb-0">
        INSTITUTO DE TELECOMUNICAÇÕES, EM LUANDA, AOS {{ hoje_extenso() }}
    </p>
    <p class="text-center font-cab">
        O(A) COORDENADOR(A)
    </p>
    <div class="">
        <hr class="text-center " style="margin: 0 auto;width:300px;color: white">
    </div>
    <p class="text-center" id="fim">
        {{ $enunciado->vc_coordenador }}
    </p>
    {{-- <div class="row">
        <div class="col-3">
            <div class="img ">
                <img src="assets/images/qrcode.jfif" alt="" style="margin:0 auto" width="150px" height="150px">
            </div>
        </div>
    </div> --}}
</footer>
@endforeach

