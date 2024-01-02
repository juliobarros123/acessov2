<style>
    .element-center {
        text-align: center;
        vertical-align: middle
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
        font-size: small;
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
        font-size: 15px
    }
    .text-center {
        text-align: center;
    }
    .check-alinea{
        font-size: 16px
    }
</style>


<header>
    <table class="w-100 bordaer-table ">
        <tr>
            <td width="25%" class="">
                <img src="assets/images/logo.png" class="logo_itel" height="10px">
            </td>
            <td class="element-center " width="50%" colspan="2">

                <img src="assets/images/insignia.png" alt="" width="100px" height="100px">

                <p class="font-cab">
                    REPÚBLICA DE ANGOLA <br>
                    MINISTÉRIO DAS TELECOMUNICAÇÕES DE INFORMAÇÃO E COMUNICAÇÃO SOCIAL <br>
                    MINISTÉRIO DA EDUCAÇÃO <br>
                    INSTITUTO DE TELECOMUNICAÇÕES - ITEL <br>
                    DEPARTAMENTO PEDAGÓGICO <br>
                </p>
            </td>
            <td width="25%" class=" element-center">
                <br><br>
                <br><br>
                <br><br>

                <p class="font-cab">09/05/2022</p>
                <br>
                <p class="font-cab">
                    Duração:90 Min
                </p>
                <br>
                <p class="font-cab">
                    Cotação total:20V
                </p>

            </td>
        </tr>
        <tr>
            <td width="25%" class=" element-center ">
                <p class="font-cab">
                    Sala: {{$enunciado->sala}}
                </p>
            </td>
            <td width="25%" class=" element-center ">
                <p class="font-cab">
                    Periodo:{{$enunciado->periodo}}
                </p>
            </td>
            {{-- @dump($enunciado) --}}
            <td width="25%" class=" element-center ">
                <p class="font-cab">
                    Cód. Enunciado:{{$enunciado->codigo}}
                </p>
            </td>
            <td width="25%" class=" element-center ">
                <p class="font-cab">
                    Ano Lectivo:{{$enunciado->ya_inicio}}/{{$enunciado->ya_fim}}
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
            Nome:

        </p>
        <p class="quest">
            Leia a prova com atenção, e responda as questões de uma forma clara
        </p>


        <div class=" quest">
            @foreach (perguntas()->where('perguntas.it_id_enunciado', $enunciado->id)->get() as $pergunta)
                {{-- @dump(perguntas()->where('perguntas.it_id_enunciado',$enunciado->id)->get()) --}}
                <p class="pergunta">
                    {{ $pergunta->it_numero }}. {{ $pergunta->vc_descricao_bp }}
                </p>
                {{-- @dump(alineas_geradas()) --}}
                {{-- @dump(alineas_geradas()->where('alinea_geradas.it_id_pergunta',9)->get(),"ol") --}}
                {{-- @dump(alineas_geradas()->where('perguntas.id',$pergunta->id)->where('perguntas.it_id_enunciado',$enunciado->id)->get()) --}}
                <ol type="a">
                    @foreach (alineas_geradas()->where('alinea_geradas.it_id_pergunta', $pergunta->id)->get() as $alinea)
                        <li style="list-style: none" class="alinea"> {{ $alinea->alinea }})
                            {{ banco_alinea($alinea->it_id_banco_alinea)->description }}
                        </li>
                    @endforeach
                </ol>
            @endforeach

        </div>
    </div>
    <div>
        <hr class="text-center">
        <p class="text-center">Cotação:
            @foreach (perguntas()->where('perguntas.it_id_enunciado', $enunciado->id)->get() as $pergunta)
                {{ $pergunta->it_numero }}) {{ $pergunta->it_cotacao }}v;
            @endforeach
        </p>
        <hr class="text-center">
    </div>
    </div>
</section>
<footer class="">
    <p class="text-center font-cab" >
        INSTITUTO DE TELECOMUNICAÇÕES, EM LUANDA, AOS {{ hoje_extenso() }}
    </p>
    <p class="text-center font-cab" >
        O(A) COORDENADOR(A)
    </p>
    <div class="col-12 p-2">
        <hr class="text-center " style="margin: 0 auto;width:300px;color: black">
    </div>
    <p class="text-center" id="fim">
        {{ $enunciado->vc_coordenador }}
    </p>
    <div class="row">
        <div class="col-3">
            <div class="img ">
                <img src="assets/images/qrcode.jfif" alt="" style="margin:0 auto" width="150px" height="150px">
            </div>
        </div>
    </div>
</footer>
