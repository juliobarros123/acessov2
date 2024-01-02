<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth'])->group(function () {

    /* START CORREÇÃO*/
    Route:: /* middleware(['admin'])-> */prefix('resultados')->namespace('Admin')->group(
        function () {

            route::get('', ['as' => 'admin.resultados', 'uses' => 'ResultadoController@index']);
            route::get('individual', ['as' => 'admin.resultados.individual', 'uses' => 'ResultadoController@individual']);
            route::post('apresentar', ['as' => 'admin.resultados.apresentar', 'uses' => 'ResultadoController@apresentar']);
            route::get('', ['as' => 'admin.resultados', 'uses' => 'ResultadoController@index']);

            route::post('folha-resposta', ['as' => 'admin.resultados.folha-resposta', 'uses' => 'ResultadoController@folha_esposta']);
            route::post('proximo', ['as' => 'admin.resultados.proximo', 'uses' => 'ResultadoController@proximo']);
            route::post('finalizar', ['as' => 'admin.resultados.finalizar', 'uses' => 'ResultadoController@finalizar']);
            route::post('store', ['as' => 'admin.resultados.store', 'uses' => 'ResultadoController@store']);
            route::get('show/{id}', ['as' => 'admin.resultados.show', 'uses' => 'ResultadoController@show']);
            route::get('edit/{id}', ['as' => 'admin.resultados.edit', 'uses' => 'ResultadoController@edit']);
            route::post('update/{id}', ['as' => 'admin.resultados.update', 'uses' => 'ResultadoController@update']);
            route::get('destroy/{id}', ['as' => 'admin.resultados.destroy', 'uses' => 'ResultadoController@destroy']);

            route::get('imprimir', ['as' => 'admin.resultados.imprimir', 'uses' => 'ResultadoController@imprimir']);
            route::post('post_imprimir', ['as' => 'admin.resultados.post_imprimir', 'uses' => 'ResultadoController@post_imprimir']);

            route::post('filtrar', ['as' => 'admin.resultados.filtrar', 'uses' => 'ResultadoController@filtrar']);
            route::get('por_prova', ['as' => 'admin.resultados.por_prova', 'uses' => 'ResultadoController@por_prova']);
            route::post('por_prova_imprimir', ['as' => 'admin.resultados.por_prova_imprimir', 'uses' => 'ResultadoController@por_prova_imprimir']);

        }
    );
    /* END CORREÇÃO */

    /* START CORREÇÃO*/
    Route:: /* middleware(['admin'])-> */prefix('correcoes')->namespace('Admin')->group(
        function () {

            route::get('corregir', ['as' => 'admin.correcoes.corregir', 'uses' => 'CorrecaoController@corregir']);
            route::post('folha-resposta', ['as' => 'admin.correcoes.folha-resposta', 'uses' => 'CorrecaoController@folha_esposta']);
            route::post('proximo', ['as' => 'admin.correcoes.proximo', 'uses' => 'CorrecaoController@proximo']);
            route::post('finalizar', ['as' => 'admin.correcoes.finalizar', 'uses' => 'CorrecaoController@finalizar']);
            route::post('store', ['as' => 'admin.correcoes.store', 'uses' => 'CorrecaoController@store']);
            route::get('show/{id}', ['as' => 'admin.correcoes.show', 'uses' => 'CorrecaoController@show']);
            route::get('edit/{id}', ['as' => 'admin.correcoes.edit', 'uses' => 'CorrecaoController@edit']);
            route::post('update/{id}', ['as' => 'admin.correcoes.update', 'uses' => 'CorrecaoController@update']);
            route::get('destroy/{id}', ['as' => 'admin.correcoes.destroy', 'uses' => 'CorrecaoController@destroy']);
        }
    );
    /* END CORREÇÃO */

    /* START Pergunta */
    Route:: /* middleware(['admin'])-> */prefix('pergunta')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.pergunta.index', 'uses' => 'PerguntaController@index']);
            route::get('create', ['as' => 'admin.pergunta.create', 'uses' => 'PerguntaController@create']);
            route::post('store', ['as' => 'admin.pergunta.store', 'uses' => 'PerguntaController@store']);
            route::get('show/{id}', ['as' => 'admin.pergunta.show', 'uses' => 'PerguntaController@show']);
            route::get('edit/{id}', ['as' => 'admin.pergunta.edit', 'uses' => 'PerguntaController@edit']);
            route::post('update/{id}', ['as' => 'admin.pergunta.update', 'uses' => 'PerguntaController@update']);
            route::get('destroy/{id}', ['as' => 'admin.pergunta.destroy', 'uses' => 'PerguntaController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.pergunta.purge', 'uses' => 'PerguntaController@purge']);
        }
    );
    /* END Pergunta */
    /* START periodo */
    Route:: /* middleware(['admin'])-> */prefix('periodo')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.periodo.index', 'uses' => 'PeriodoController@index']);
            route::get('create', ['as' => 'admin.periodo.create', 'uses' => 'PeriodoController@create']);
            route::post('store', ['as' => 'admin.periodo.store', 'uses' => 'PeriodoController@store']);
            route::get('show/{id}', ['as' => 'admin.periodo.show', 'uses' => 'PeriodoController@show']);
            route::get('edit/{id}', ['as' => 'admin.periodo.edit', 'uses' => 'PeriodoController@edit']);
            route::post('update/{id}', ['as' => 'admin.periodo.update', 'uses' => 'PeriodoController@update']);
            route::get('destroy/{id}', ['as' => 'admin.periodo.destroy', 'uses' => 'PeriodoController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.periodo.purge', 'uses' => 'PeriodoController@purge']);
        }
    );
    /* END PERIODO */

    /* START ANO_LECTIVO */
    Route:: /*middleware(['admin'])-> */prefix('ano_lectivo')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.ano_lectivo.index', 'uses' => 'AnoLectivoController@index']);
            route::get('create', ['as' => 'admin.ano_lectivo.create', 'uses' => 'AnoLectivoController@create']);
            route::post('store', ['as' => 'admin.ano_lectivo.store', 'uses' => 'AnoLectivoController@store']);
            route::get('show/{id}', ['as' => 'admin.ano_lectivo.show', 'uses' => 'AnoLectivoController@show']);
            route::get('edit/{id}', ['as' => 'admin.ano_lectivo.edit', 'uses' => 'AnoLectivoController@edit']);
            route::post('update/{id}', ['as' => 'admin.ano_lectivo.update', 'uses' => 'AnoLectivoController@update']);
            route::get('destroy/{id}', ['as' => 'admin.ano_lectivo.destroy', 'uses' => 'AnoLectivoController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.ano_lectivo.purge', 'uses' => 'AnoLectivoController@purge']);
        }
    );
    /* END ANO LECTIVO */
    /* START DISCIPLINA */
    /* START CLASSE */
    Route:: /* middleware(['admin'])-> */prefix('classe')->namespace('Admin')->group(
        function () {

            route::get('index', ['as' => 'admin.classe.index', 'uses' => 'ClasseController@index']);
            route::get('create', ['as' => 'admin.classe.create', 'uses' => 'ClasseController@create']);
            route::post('store', ['as' => 'admin.classe.store', 'uses' => 'ClasseController@store']);
            route::get('show/{id}', ['as' => 'admin.classe.show', 'uses' => 'ClasseController@show']);
            route::get('edit/{id}', ['as' => 'admin.classe.edit', 'uses' => 'ClasseController@edit']);
            route::post('update/{id}', ['as' => 'admin.classe.update', 'uses' => 'ClasseController@update']);
            route::get('destroy/{id}', ['as' => 'admin.classe.destroy', 'uses' => 'ClasseController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.classe.purge', 'uses' => 'ClasseController@purge']);
        }
    );
    /* END disciplina */
    /* START ENUNCIADO */
    Route:: /* middleware(['admin'])-> */prefix('enunciado')->namespace('Admin')->group(
        function () {

            route::get('index', ['as' => 'admin.enunciado.index', 'uses' => 'EnunciadoController@index']);
            route::get('create', ['as' => 'admin.enunciado.create', 'uses' => 'EnunciadoController@create']);
            route::post('store', ['as' => 'admin.enunciado.store', 'uses' => 'EnunciadoController@store']);
            route::get('show/{id}', ['as' => 'admin.enunciado.show', 'uses' => 'EnunciadoController@show']);
            route::get('edit/{id}', ['as' => 'admin.enunciado.edit', 'uses' => 'EnunciadoController@edit']);
            route::post('update/{id}', ['as' => 'admin.enunciado.update', 'uses' => 'EnunciadoController@update']);
            route::get('destroy/{id}', ['as' => 'admin.enunciado.destroy', 'uses' => 'EnunciadoController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.enunciado.purge', 'uses' => 'EnunciadoController@purge']);
            route::post('gerar', ['as' => 'admin.enunciado.gerar', 'uses' => 'EnunciadoController@gerar']);
            route::get('gerar_por_disciplina/{id_disciplina}', ['as' => 'admin.enunciado.gerar_por_disciplina', 'uses' => 'EnunciadoController@gerar_por_disciplina']);
            route::get('imprimir/{id_enunciado}', ['as' => 'admin.enunciado.imprimir', 'uses' => 'EnunciadoController@imprimir']);
            route::get('gabarito/{id_enunciado}', ['as' => 'admin.enunciado.gabarito', 'uses' => 'EnunciadoController@imprimir_folha_resposta']);
        }
    );

    //Fim Enunciado

    /* START ENUNCIADO Sala */
    Route:: /* middleware(['admin'])-> */prefix('gerar-por-sala')->namespace('Admin')->group(
        function () {

            route::get('rooms', ['as' => 'admin.enunciado.sala.room', 'uses' => 'EnunciadoSalaController@room']);
            route::get('index/{id}/{it_id_sala}', ['as' => 'admin.enunciado.sala.enunciado.index', 'uses' => 'EnunciadoSalaController@index']);
            // route::get('room', ['as' => 'admin.enunciado.sala.room', 'uses' => 'EnunciadoSalaController@room']);
            route::get('create', ['as' => 'admin.enunciado.sala.enunciado.create', 'uses' => 'EnunciadoSalaController@create']);
            route::post('store', ['as' => 'admin.enunciado.sala.enunciado.store', 'uses' => 'EnunciadoSalaController@store']);
            route::get('show/{id}', ['as' => 'admin.enunciado.sala.enunciado.show', 'uses' => 'EnunciadoSalaController@show']);
            route::get('edit/{id}', ['as' => 'admin.enunciado.sala.enunciado.edit', 'uses' => 'EnunciadoSalaController@edit']);
            route::post('update/{id}', ['as' => 'admin.enunciado.sala.enunciado.update', 'uses' => 'EnunciadoSalaController@update']);
            route::get('destroy/{id}', ['as' => 'admin.enunciado.sala.enunciado.destroy', 'uses' => 'EnunciadoSalaController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.enunciado.sala.enunciado.purge', 'uses' => 'EnunciadoSalaController@purge']);
            route::post('gerar', ['as' => 'admin.enunciado.sala.enunciado.gerar', 'uses' => 'EnunciadoSalaController@gerar']);
            route::get('gerar_por_disciplina/{id_disciplina}', ['as' => 'admin.enunciado.sala.enunciado.gerar_por_disciplina', 'uses' => 'EnunciadoSalaController@gerar_por_disciplina']);
            route::get('imprimir/{id_enunciado}', ['as' => 'admin.enunciado.sala.enunciado.imprimir', 'uses' => 'EnunciadoSalaController@imprimir']);
            route::post('gabarito', ['as' => 'admin.enunciado.sala.enunciado.gabarito_post', 'uses' => 'EnunciadoSalaController@imprimir_folha_resposta_post']);

            route::get('imprimir_fr_massa/{id_prova}', ['as' => 'admin.enunciado.sala.enunciado.imprimir_fr_massa', 'uses' => 'EnunciadoSalaController@imprimir_fr_massa']);
            route::get('imprimir_enunciados_massa/{id_prova}', ['as' => 'admin.enunciado.sala.enunciado.imprimir_enunciados_massa', 'uses' => 'EnunciadoSalaController@imprimir_enunciados_massa']);
            route::get('gabarito/{id_enunciado}', ['as' => 'admin.enunciado.sala.enunciado.gabarito', 'uses' => 'EnunciadoSalaController@imprimir_folha_resposta']);
          
            route::get('folha_correcao/{id_prova}', ['as' => 'admin.enunciado.sala.enunciado.folha_correcao', 'uses' => 'EnunciadoSalaController@folha_correcao']);
            route::get('imprimir_enunciado/{id_enunciado}', ['as' => 'admin.enunciado.sala.imprimir_enunciado', 'uses' => 'EnunciadoSalaController@imprimir_enunciado']);
            route::get('folha_resposta/{id_enunciado}', ['as' => 'admin.enunciado.sala.folha-resposta', 'uses' => 'EnunciadoSalaController@folha_resposta']);
            route::post('carregar_chave/', ['as' => 'admin.enunciado.sala.enunciado.carregar_chave', 'uses' => 'EnunciadoSalaController@carregar_chave']);
            route::post('carregar_chave_geral/', ['as' => 'admin.enunciado.sala.enunciado.carregar_chave_geral', 'uses' => 'EnunciadoSalaController@carregar_chave_geral']);
            route::post('corrigir_prova/', ['as' => 'admin.enunciado.sala.enunciado.corrigir_prova', 'uses' => 'EnunciadoSalaController@corrigir_prova']);
         
            route::get('corregir_massa/{id_enunciado}', ['as' => 'admin.enunciado.sala.enunciado.corregir_massa', 'uses' => 'EnunciadoSalaController@corregir_massa']);
            route::get('corregir_massa_geral/{id_prova}', ['as' => 'admin.enunciado.sala.enunciado.corregir_massa_geral', 'uses' => 'EnunciadoSalaController@corregir_massa_geral']);
          
                
            
        }
    );

    /* END ENUNCIADO Sala */
    /* START BANCO PERGUNTA*/
    Route:: /* middleware(['admin'])-> */prefix('folha_resposta')->namespace('Admin')->group(
        function () {

            route::get('index', ['as' => 'admin.folhaResposta.index', 'uses' => 'FolhaRespostaController@index']);
            route::get('create', ['as' => 'admin.folhaResposta.create', 'uses' => 'FolhaRespostaController@create']);
            route::post('store', ['as' => 'admin.folhaResposta.store', 'uses' => 'FolhaRespostaController@store']);
            route::get('show/{id}', ['as' => 'admin.folhaResposta.show', 'uses' => 'FolhaRespostaController@show']);
            route::get('edit/{id}', ['as' => 'admin.folhaResposta.edit', 'uses' => 'FolhaRespostaController@edit']);
            route::post('update/{id}', ['as' => 'admin.folhaResposta.update', 'uses' => 'FolhaRespostaController@update']);
            route::get('destroy/{id}', ['as' => 'admin.folhaResposta.destroy', 'uses' => 'FolhaRespostaController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.folhaResposta.purge', 'uses' => 'FolhaRespostaController@purge']);
        }
    );
    /* END Folha Resposta */
    Route:: /* middleware(['admin'])-> */prefix('disciplina')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.disciplina.index', 'uses' => 'DisciplinaController@index']);
            route::get('create', ['as' => 'admin.disciplina.create', 'uses' => 'DisciplinaController@create']);
            route::post('store', ['as' => 'admin.disciplina.store', 'uses' => 'DisciplinaController@store']);
            route::get('show/{id}', ['as' => 'admin.disciplina.show', 'uses' => 'DisciplinaController@show']);
            route::get('edit/{id}', ['as' => 'admin.disciplina.edit', 'uses' => 'DisciplinaController@edit']);
            route::post('update/{id}', ['as' => 'admin.disciplina.update', 'uses' => 'DisciplinaController@update']);
            route::get('destroy/{id}', ['as' => 'admin.disciplina.destroy', 'uses' => 'DisciplinaController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.disciplina.purge', 'uses' => 'DisciplinaController@purge']);
        }
    );
    /* EANO BANCO PERGUNTA*/

    /* START BANCO candidato*/
    Route:: /* middleware(['admin'])-> */prefix('candidato')->namespace('Admin')->group(
        function () {

            route::get('index', ['as' => 'admin.candidato.index', 'uses' => 'CandidatoController@index']);
            route::get('create', ['as' => 'admin.candidato.create', 'uses' => 'CandidatoController@create']);
            route::post('store', ['as' => 'admin.candidato.store', 'uses' => 'CandidatoController@store']);
            route::get('show/{id}', ['as' => 'admin.candidato.show', 'uses' => 'CandidatoController@show']);
            route::get('edit/{id}', ['as' => 'admin.candidato.edit', 'uses' => 'CandidatoController@edit']);
            route::post('update/{id}', ['as' => 'admin.candidato.update', 'uses' => 'CandidatoController@update']);
            route::get('destroy/{id}', ['as' => 'admin.candidato.destroy', 'uses' => 'CandidatoController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.candidato.purge', 'uses' => 'CandidatoController@purge']);
        }
    );
    /* EANO BANCO candidato*/

    /* START ANO LECTIVO */

    Route:: /*middleware(['admin'])->*/prefix('sala')->namespace('Admin')->group(
        function () {

            route::get('index', ['as' => 'admin.sala.index', 'uses' => 'SalaController@index']);
            route::get('create', ['as' => 'admin.sala.create', 'uses' => 'SalaController@create']);
            route::post('store', ['as' => 'admin.sala.store', 'uses' => 'SalaController@store']);
            route::get('show/{id}', ['as' => 'admin.sala.show', 'uses' => 'SalaController@show']);
            route::get('edit/{id}', ['as' => 'admin.sala.edit', 'uses' => 'SalaController@edit']);
            route::post('update/{id}', ['as' => 'admin.sala.update', 'uses' => 'SalaController@update']);
            route::get('destroy/{id}', ['as' => 'admin.sala.destroy', 'uses' => 'SalaController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.sala.purge', 'uses' => 'SalaController@purge']);
        }
    );
    /* END SALA */

    /* START CURSO */

    Route:: /*middleware(['admin'])->*/prefix('cursos')->namespace('Admin')->group(
        function () {

            route::get('', ['as' => 'admin.cursos.index', 'uses' => 'CursoController@index']);
            route::get('create', ['as' => 'admin.cursos.create', 'uses' => 'CursoController@create']);
            route::post('store', ['as' => 'admin.cursos.store', 'uses' => 'CursoController@store']);
            route::get('show/{id}', ['as' => 'admin.cursos.show', 'uses' => 'CursoController@show']);
            route::get('edit/{id}', ['as' => 'admin.cursos.edit', 'uses' => 'CursoController@edit']);
            route::post('update/{id}', ['as' => 'admin.cursos.update', 'uses' => 'CursoController@update']);
            route::get('destroy/{id}', ['as' => 'admin.cursos.destroy', 'uses' => 'CursoController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.cursos.purge', 'uses' => 'CursoController@purge']);
        }
    );
    /* END CURSO */

    /* START CURSO-DISCIPLINA */

    Route:: /*middleware(['admin'])->*/prefix('cursos-disciplinas')->namespace('Admin')->group(
        function () {
            route::get('', ['as' => 'admin.cursos_disciplinas', 'uses' => 'CursoDisciplinaController@index']);
            route::get('create', ['as' => 'admin.cursos_disciplinas.create', 'uses' => 'CursoDisciplinaController@create']);
            route::post('store', ['as' => 'admin.cursos_disciplinas.store', 'uses' => 'CursoDisciplinaController@store']);
            route::get('show/{id}', ['as' => 'admin.cursos_disciplinas.show', 'uses' => 'CursoDisciplinaController@show']);
            route::get('edit/{id}', ['as' => 'admin.cursos_disciplinas.edit', 'uses' => 'CursoDisciplinaController@edit']);
            route::post('update/{id}', ['as' => 'admin.cursos_disciplinas.update', 'uses' => 'CursoDisciplinaController@update']);
            route::get('destroy/{id}', ['as' => 'admin.cursos_disciplinas.destroy', 'uses' => 'CursoDisciplinaController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.cursos_disciplinas.purge', 'uses' => 'CursoDisciplinaController@purge']);
            route::get('vincular/{id_curso}', ['as' => 'admin.cursos_disciplinas.vincular', 'uses' => 'CursoDisciplinaController@vincular']);
        }
    );
    /* END CURSO-DISCIPLINA */

    /* START DISCIPLINA */
    //  Route::/* middleware(['admin'])-> */prefix('disciplina')->namespace('Admin')->group(
    //     function () {


    /* END disciplina */
    /* START ENUNCIADO */
    Route:: /* middleware(['admin'])-> */prefix('enunciado')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.enunciado.index', 'uses' => 'EnunciadoController@index']);
            route::get('create', ['as' => 'admin.enunciado.create', 'uses' => 'EnunciadoController@create']);
            route::post('store', ['as' => 'admin.enunciado.store', 'uses' => 'EnunciadoController@store']);
            route::get('show/{id}', ['as' => 'admin.enunciado.show', 'uses' => 'EnunciadoController@show']);
            route::get('edit/{id}', ['as' => 'admin.enunciado.edit', 'uses' => 'EnunciadoController@edit']);
            route::post('update/{id}', ['as' => 'admin.enunciado.update', 'uses' => 'EnunciadoController@update']);
            route::get('destroy/{id}', ['as' => 'admin.enunciado.destroy', 'uses' => 'EnunciadoController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.enunciado.purge', 'uses' => 'EnunciadoController@purge']);
        }
    );
    /* END ENUNCIADO */

    /* START BANCO PERGUNTA*/
    Route:: /* middleware(['admin'])-> */prefix('banco_pergunta')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.banco_pergunta.index', 'uses' => 'BancoPerguntaController@index']);
            route::get('create', ['as' => 'admin.banco_pergunta.create', 'uses' => 'BancoPerguntaController@create']);
            route::post('store', ['as' => 'admin.banco_pergunta.store', 'uses' => 'BancoPerguntaController@store']);
            route::get('show/{id}', ['as' => 'admin.banco_pergunta.show', 'uses' => 'BancoPerguntaController@show']);
            route::get('edit/{id}', ['as' => 'admin.banco_pergunta.edit', 'uses' => 'BancoPerguntaController@edit']);
            route::post('update/{id}', ['as' => 'admin.banco_pergunta.update', 'uses' => 'BancoPerguntaController@update']);
            route::get('destroy/{id}', ['as' => 'admin.banco_pergunta.destroy', 'uses' => 'BancoPerguntaController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.banco_pergunta.purge', 'uses' => 'BancoPerguntaController@purge']);
            route::get('add_pergunta/{id}', ['as' => 'admin.banco_pergunta.add_pergunta', 'uses' => 'BancoPerguntaController@add_pergunta']);

        }
    );
    /* END BANCO PERGUNTA*/

    /* START BANCO_ALINEA */

    Route:: /*middleware(['admin'])->*/prefix('banco_alinea')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.banco_alinea.index', 'uses' => 'BancoAlineaController@index']);
            route::get('create', ['as' => 'admin.banco_alinea.create', 'uses' => 'BancoAlineaController@create']);
            route::post('store', ['as' => 'admin.banco_alinea.store', 'uses' => 'BancoAlineaController@store']);
            route::get('show/{id}', ['as' => 'admin.banco_alinea.show', 'uses' => 'BancoAlineaController@show']);
            route::get('edit/{id}', ['as' => 'admin.banco_alinea.edit', 'uses' => 'BancoAlineaController@edit']);
            route::post('update/{id}', ['as' => 'admin.banco_alinea.update', 'uses' => 'BancoAlineaController@update']);
            route::get('destroy/{id}', ['as' => 'admin.banco_alinea.destroy', 'uses' => 'BancoAlineaController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.banco_alinea.purge', 'uses' => 'BancoAlineaController@purge']);
            route::get('add_alinea/{id}', ['as' => 'admin.banco_alinea.add_alinea', 'uses' => 'BancoAlineaController@add_alinea']);


        }
    );
    /* END BANCO_ALINEA */


    /* START Prova */

    Route:: /*middleware(['admin'])->*/prefix('prova')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.prova.index', 'uses' => 'ProvaController@index']);
            route::get('see/{id}', ['as' => 'admin.prova.see', 'uses' => 'ProvaController@see']);
            route::get('create', ['as' => 'admin.prova.create', 'uses' => 'ProvaController@create']);
            route::post('store', ['as' => 'admin.prova.store', 'uses' => 'ProvaController@store']);
            route::get('show/{id}', ['as' => 'admin.prova.show', 'uses' => 'ProvaController@show']);
            route::get('edit/{id}', ['as' => 'admin.prova.edit', 'uses' => 'ProvaController@edit']);
            route::post('update/{id}', ['as' => 'admin.prova.update', 'uses' => 'ProvaController@update']);
            route::get('destroy/{id}', ['as' => 'admin.prova.destroy', 'uses' => 'ProvaController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.prova.purge', 'uses' => 'ProvaController@purge']);
            route::get('resultados/{id}', ['as' => 'admin.prova.resultados', 'uses' => 'ProvaController@resultados']);


        }
    );
    /* END Prova */
    /*Horário*/

    Route:: /*middleware(['admin'])->*/prefix('horario')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.horario.index', 'uses' => 'HorarioController@index']);
            route::get('create', ['as' => 'admin.horario.create', 'uses' => 'HorarioController@create']);
            route::post('store', ['as' => 'admin.horario.store', 'uses' => 'HorarioController@store']);
            route::get('show/{id}', ['as' => 'admin.horario.show', 'uses' => 'HorarioController@show']);
            route::get('edit/{id}', ['as' => 'admin.horario.edit', 'uses' => 'HorarioController@edit']);
            route::post('update/{id}', ['as' => 'admin.horario.update', 'uses' => 'HorarioController@update']);
            route::get('destroy/{id}', ['as' => 'admin.horario.destroy', 'uses' => 'HorarioController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.horario.purge', 'uses' => 'HorarioController@purge']);
        }
    );
    /*fim horário*/
    /*START USER*/
    Route:: /* middleware(['admin'])-> */prefix('user')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);
            route::get('create', ['as' => 'admin.user.create', 'uses' => 'UserController@create']);
            route::post('store', ['as' => 'admin.user.store', 'uses' => 'UserController@store']);
            route::get('show/{id}', ['as' => 'admin.user.show', 'uses' => 'UserController@show']);
            route::get('edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'UserController@edit']);
            route::post('update/{id}', ['as' => 'admin.user.update', 'uses' => 'UserController@update']);
            route::get('destroy/{id}', ['as' => 'admin.user.destroy', 'uses' => 'UserController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.user.purge', 'uses' => 'UserController@purge']);
        }
    );
    /*END USER*/
    /*START TIPO_USER*/
    Route:: /* middleware(['admin'])-> */prefix('tipo_user')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.tipo_user.index', 'uses' => 'TipoUserController@index']);
            route::get('create', ['as' => 'admin.tipo_user.create', 'uses' => 'TipoUserController@create']);
            route::post('store', ['as' => 'admin.tipo_user.store', 'uses' => 'TipoUserController@store']);
            route::get('edit/{id}', ['as' => 'admin.tipo_user.edit', 'uses' => 'TipoUserController@edit']);
            route::post('update/{id}', ['as' => 'admin.tipo_user.update', 'uses' => 'TipoUserController@update']);
            route::get('destroy/{id}', ['as' => 'admin.tipo_user.destroy', 'uses' => 'TipoUserController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.tipo_user.purge', 'uses' => 'TipoUserController@purge']);
        }
    );

    Route:: /* middleware(['admin'])-> */prefix('turmas')->namespace('Admin')->group(
        function () {
            route::get('sge', ['as' => 'admin.turmas.sge', 'uses' => 'TurmaController@sge']);
            route::get('alunos_sge_download/{id_turma}', ['as' => 'admin.turmas.alunos_sge_download', 'uses' => 'TurmaController@alunos_sge_download']);

            
        }
    );
    Route:: /* middleware(['admin'])-> */prefix('notas')->namespace('Admin')->group(
        function () {
            route::get('{id_prova}/imprimir', ['as' => 'admin.notas.imprimir', 'uses' => 'NotaController@imprimir']);
            // route::get('alunos_sge_download/{id_turma}', ['as' => 'admin.turmas.alunos_sge_download', 'uses' => 'TurmaController@alunos_sge_download']);

            
        }
    );
});




// /ajax/curso_por_disciplina/