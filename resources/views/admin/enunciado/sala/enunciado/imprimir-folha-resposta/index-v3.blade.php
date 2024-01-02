<style>
    .element-center {
        text-align: center;
        vertical-align: middle;
    }

    .box-logo {
        background-color: blue;
    }

    td {
        /* background-color: red; */
    }

    .centered {
        display: inline-block;
        vertical-align: middle;
    }

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
        border: 1px solid black;
    }

    .pergunta {
        text-align: justify;
        /* color: blue; */
        margin-bottom: 0px !important;
        margin-top: 0px !important;
        font-size: 12px !important;
    }

    .alinea {
        text-align: justify;
        font-size: 15px;
    }

    .text-center {
        text-align: center;
    }

    .check-alinea {
        font-size: 16px;
        background-color: black !important;
    }

    .alinea {
        margin-top: 0px !important;
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

    .box-logo {
        background-color: blue;
    }

    td {
        /* background-color: red; */
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
        border: 1px solid black;
    }

    .pergunta {
        text-align: justify;
        /* color: blue; */
    }

    .alinea {
        text-align: justify;
        font-size: 11px;
    }

    .text-center {
        text-align: center;
    }

    .check-alinea {
        font-size: 16px;
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
        padding: 5px;



    }

    .pergunta {
        margin-bottom: 10px;
    }

    .perguntapadding {
        padding-left: 50px| !important;
    }

    .ul {
        margin-bottom: 5px;
    }

    .ali {}

    .image_bp {
        height: 180px;
        width: 210px;
    }

   
    .alinea-letra{
        /* position: relative;
        bottom:  500px; */
        /* background-color: red; */
        width: 1000px;

    }

    .circulo{
        /* float: left; */

        /* position: fixed;
       top: 1000px;
    */
    height: 20px; 
       
    }
</style>

@foreach ($enunciados as $enunciado)
    {{-- <p class="mt">vvv</p> --}}
    <header class="mt">
        <table class="w-100 bordaer-table ">
            <tr>
                <td width="25%" class="">
                    <img src="assets/images/logo.png" class="logo_itel" height="10px">
                </td>
                <td class="element-center " width="50%" colspan="2">

                    <img src="assets/images/insignia.png" alt="" width="100px" height="100px">

                    <p class="font-cab">
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


                    <p class="font-cab">
                        Duração: 90 Min
                    </p>
                    <br>
                    <p class="font-cab">
                        Cotação total: 20V
                    </p>
                    <br>
                    <p class="font-cab">
                        Disciplina: <strong>{{ disciplina_por_enunciado($enunciado->id)->vc_nome }}</strong>

                    </p>

                </td>
            </tr>
            <tr>
                <td width="25%" class=" element-center ">
                    <p class="font-cab">
                        Sala: {{ $enunciado->sala }}
                    </p>
                </td>
                <td width="25%" class=" element-center ">
                    <p class="font-cab">
                        Periodo:{{ $enunciado->periodo }}
                    </p>
                </td>
                {{-- @dump($enunciado) --}}
                <td width="25%" class=" element-center ">
                    <p class="font-cab">
                        Cód. Enunciado:{{ $enunciado->codigo }}
                    </p>
                </td>
                <td width="25%" class=" element-center ">
                    <p class="font-cab">
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
            <p class="quest">

                Nome:<small> <strong> {{ $enunciado->vc_primeiro_nome }}
                        {{ $enunciado->vc_ultimo_nome }}</strong></small>
                <br>
                Cód. Candidato: <small> <strong>{{ $enunciado->vc_codigo }}</strong></small>
            </p>
            <p class="quest">
                Leia a prova com atenção, e responda as questões de uma forma clara
            </p>



            <table class="quest">
                @php $count = 0; @endphp
                <tr> <!-- Inicia a primeira linha -->
                    @foreach (perguntas()->where('perguntas.it_id_enunciado', $enunciado->id)->get() as $pergunta)
                        <td>
                            <p class="pergunta perguntapadding">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $pergunta->it_numero }}.
                            </p>

                            <p class="ul">
                                @foreach (alineas_geradas()->where('alinea_geradas.it_id_pergunta', $pergunta->id)->get() as $alinea)
                                    <p >
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="alinea-letra">
                                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                         {{ $alinea->alinea }})</div>    
                                        
                                     
                                            <img class="circulo" src="images/cb.jpg">
                                        

                                    </p>


                                    <br>
                                @endforeach
                            </p>
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
        <hr class="text-center " style="margin: 0 auto;width:300px;color: black">
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
