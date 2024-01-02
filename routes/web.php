<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Milon\Barcode\Reader;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Spatie\PdfToImage\Pdf;
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
// putenv('PATH=' . getenv('PATH') . ':C:\Program Files\Tesseract-OCR');

Route::get('pdf-to-jpg', function () {
   
    // Retorne o caminho da imagem convertida
    // return response()->json(['image_path' => $imagePath]);
    try {
        $pdfPath = "folha-correcao-26.pdf";
        if (!file_exists($pdfPath)) {
            return response()->json(['error' => 'O arquivo PDF não foi encontrado.']);
        }
    
        // Crie um objeto PdfToImage
        $pdfToImage = new Pdf($pdfPath);
    
        // Converta a primeira página do PDF em uma imagem JPG
        $imagePath = $pdfToImage->setPage(1)
            ->saveImage(public_path('converted_images/' . time() . '.jpg'));
    
        // Mais operações com Imagick, se necessário
    } catch (ImagickException $e) {
        // Capturando a exceção e tratando o erro
        echo 'Erro Imagick: ' . $e->getMessage();
        // Pode adicionar aqui mais lógica para lidar com o erro, como log ou exibição de mensagem ao usuário.
    }
});
Route:: /* middleware(['admin'])-> */prefix('')->namespace('Site')->group(
    function () {

        Route::get('', ['as' => 'site.home.index', 'uses' => 'HomeController@index']);
        Route:: /* middleware(['admin'])-> */prefix('provas')->group(
            function () {
                route::get('', ['as' => 'site.provas.index', 'uses' => 'ProvaController@index']);
            }
        );
        Route:: /* middleware(['admin'])-> */prefix('pautas')->group(
            function () {
                route::get('', ['as' => 'site.pautas.index', 'uses' => 'PautaController@index']);
            }
        );
        Route:: /* middleware(['admin'])-> */prefix('agendas')->group(
            function () {
                route::get('', ['as' => 'site.agendas.index', 'uses' => 'AgendaController@index']);
            }
        );
    }
);

Route::get('pedir_rupe', function () {

    $response = Http::withHeaders([
        'Authorization' => 'Basic eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9',
        'Content-Type' => 'application/json'
    ])->get("http://192.168.20.108:8000/api/rupes/pedir");
    return json_decode($response->body(), true);
});

Auth::routes();

Route::get('cod-barra', function () {

    $caminhoCompleto = 'bar-code.png';
    // Verifica se o arquivo existe
    if (!file_exists($caminhoCompleto)) {
        return response()->json(['mensagem' => 'Arquivo não encontrado'], 404);
    }

    // Executa o comando zbarimg para ler o código de barras
    $output = [];
    $returnCode = null;
    $command = "C:\Program Files (x86)\ZBar>zbarimg bar-code.png";
    exec($command, $output, $returnCode);
    //  var_dump($output);
// exit;
    // Verifica se a execução foi bem-sucedida
    if ($returnCode === 0 && !empty($output)) {
        $codigoBarras = trim($output[0]);
        return response()->json(['codigo_barras' => $codigoBarras]);
    } else {
        return response()->json(['mensagem' => 'Erro ao ler o código de barras'], 500);
    }
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/folha_prova', function () {
    return view('folha_prova.index');
});
Route::get('/enunciado', function () {
    return view('enunciado.index');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('ajax/cursos/disciplinas_por_curso/{it_id_curso}', ['as' => 'ajax.cursos.disciplinas_por_curso', 'uses' => 'Ajax\CursoController@index']);

Route::get('/ajax/provas/sala_por_prova/{it_id_prova}', ['as' => 'ajax.provas.sala_por_prova', 'uses' => 'Ajax\ProvaController@sala_por_prova']);

Route::get('/ajax/anos_lectivo/prova_por_ano/{it_id_ano_lectivo}', ['as' => 'ajax.anos_lectivo.prova_por_ano', 'uses' => 'Ajax\ProvaController@prova_por_ano']);