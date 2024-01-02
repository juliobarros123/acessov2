<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Vertical | Vuesy - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/prova.css') }}">
    <!-- plugin css -->
    <link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- swiper css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" id="app-style" rel="stylesheet"
        type="text/css" />
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" id="app-style" rel="stylesheet" type="text/css"  /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"
        integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
</head>

<body data-topbar="dark">
    @include('layouts.admin.header')
    @yield('conteudo')
    @include('layouts.admin.footer')

    <!-- JAVASCRIPT -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenujs/metismenujs.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!-- swiper js -->
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.5.1.slim.min') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    @if (session('feedback'))
        {{-- @dump(session('feedback')); --}}

        @if (isset(session('feedback')['type']))
            <script>
                Swal.fire(
                    '{{ session('feedback')['sms'] }}',
                    '',
                    '{{ session('feedback')['type'] }}'
                )
            </script>
        @endif

        @if (isset(session('feedback')['error']))
            <script>
                Swal.fire(
                    '{{ session('feedback')['sms'] }}',
                    '',
                    'error'
                )
            </script>
        @endif
    @endif
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

    <script>
        $("#it_id_curso").change(function() {
            var id = $(this).val();

            var url = window.location.origin + '/ajax/cursos/disciplinas_por_curso/' + id;
            //   alert(url);
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                async: true,
                data: '',
                success: function(response) {

                    $("#it_id_disciplina").empty();
                    $("#it_id_disciplina").append(
                        `<option selected disabled  ">Selecciona a disciplina</option>`)
                    $.each(response, function(index, data) {
                        $("#it_id_disciplina").append(
                            `<option  value="${data.it_id_disciplina}">${data.disciplina} </option>`
                        );
                    });



                }
            });
        });
    </script>
    <script>
        $("#it_id_ano_lectivo").change(function() {
            var it_id_ano_lectivo = $(this).val();

            var url = window.location.origin + '/ajax/anos_lectivo/prova_por_ano/' + it_id_ano_lectivo;
            //   alert(url);
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                async: true,
                data: '',
                success: function(response) {
                    //   alert("ola");
                    console.log(response);
                    $("#it_id_prova").empty();

                    $("#it_id_prova").append(
                        `<option value="" selected disabled> Selecciona a prova
                                                    </option>`);
                    $.each(response, function(index, data) {
                        $("#it_id_prova").append(
                            `<option  value="${data.id}">${data.vc_nome}/${data.curso}/${data.inicio_prova
}/${data.termino_prova
}/${data.periodo
}  </option>`
                        );

                    });



                }
            });
        });
    </script>
    <script>
        $("#it_id_prova").change(function() {
            var it_id_prova = $(this).val();

            var url = window.location.origin + '/ajax/provas/sala_por_prova/' + it_id_prova;
            //   alert(url);
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                async: true,
                data: '',
                success: function(response) {
                    //   alert("ola");
                    console.log(response);
                    $("#it_id_sala").empty();

                    $.each(response, function(index, data) {
                        $("#it_id_sala").append(
                            `<option  value="${data.id}">${data.it_id_sala} </option>`
                        );
                        $("#n_enunciados").val(`${data.vc_n_candidatos} `)
                    });



                }
            });
        });
    </script>
    <script>
        $("#it_n_pergunta").keyup(function() {

            let valor = $(this).val();
            let cotacao = 20 / valor;
            // alert(valor_pergunta);
            let cotacao_formatada = cotacao.toFixed(2);
            $("#it_cotacao").val(cotacao_formatada);


        });
    </script>
    <script src="{{ asset('vendor/js/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>
