@extends('layouts.admin.body')
@section('titulo','Painel Administrativo')
@section('conteudo')

<div id="layout-wrapper">
<div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body pb-2">
                                <div class="d-flex align-items-start mb-4 mb-xl-0">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title">Estatística de resultados </h5>
                                    </div>
                                 
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-xl-4">
                                        <div class="card bg-light mb-0">
                                            <div class="card-body">
                                                <div class="py-2">
                                                    <h5>Total de Aptos:</h5>
                                                    <h2 class="mt-4 pt-1 mb-1 text-success">500</h2>
                                                    {{-- <p class="text-muted font-size-15 text-truncate">From Jan 20,2022 to July,2022</p> --}}
                                                    <h5>Total de N/Aptos:</h5>
                                                    <h2 class="mt-4 pt-1 mb-1 text-danger">400</h2>
                                                    {{-- <p class="text-muted font-size-15 text-truncate">From Jan 20,2022 to July,2022</p> --}}

                                                    <div class="d-flex mt-4 align-items-center">
                                                        <div id="mini-1" data-colors='["--bs-success"]' class="apex-charts"></div>
                                                        <div class="ms-3">
                                                            <span class="badge bg-danger"><i class="mdi mdi-arrow-down me-1"></i>16.3%</span>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="row mt-4">
                                                        <div class="col">
                                                            <div class="d-flex mt-2">
                                                                <i class="mdi mdi-square-rounded font-size-10 text-success mt-1"></i>
                                                                <div class="flex-grow-1 ms-2 ps-1">
                                                                    <h5 class="mb-1">3,526,56</h5>
                                                                    <p class="text-muted text-truncate mb-0">Net Profit</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="d-flex mt-2">
                                                                <i class="mdi mdi-square-rounded font-size-10 text-primary mt-1"></i>
                                                                <div class="flex-grow-1 ms-2 ps-1">
                                                                    <h5 class="mb-1">5,324,85</h5>
                                                                    <p class="text-muted text-truncate mb-0">Net Revenue</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xl-8">
                                        <div>
                                            <div id="column_chart" data-colors='["--bs-primary", "--bs-primary-rgb, 0.2"]' class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-2">Estatística de notas por disciplinas</h5>
                                    </div>
                                    {{-- <div class="flex-shrink-0">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Monthly<i class="mdi mdi-chevron-down ms-1"></i>
                                                </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Yearly</a>
                                                <a class="dropdown-item" href="#">Monthly</a>
                                                <a class="dropdown-item" href="#">Weekly</a>
                                                <a class="dropdown-item" href="#">Today</a>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>

                                <div id="chart-donut" data-colors='["--bs-primary", "--bs-success","--bs-danger"]' class="apex-charts" dir="ltr"></div>

                                <div class="mt-1 px-2">
                                    <div class="order-wid-list d-flex justify-content-between border-bottom">
                                        <p class="mb-0"><i class="mdi mdi-square-rounded font-size-10 text-primary me-2"></i>Matemática</p>
                                        <div>
                                            <span class="pe-5">56</span>
                                            <span class="badge bg-primary"> + 0.2% </span>
                                        </div>
                                    </div>
                                    <div class="order-wid-list d-flex justify-content-between border-bottom">
                                        <p class="mb-0"><i class="mdi mdi-square-rounded font-size-10 text-success me-2"></i>Física</p>
                                        <div>
                                            <span class="pe-5">12</span>
                                            <span class="badge bg-success"> - 0.7% </span>
                                        </div>
                                    </div>
                                    <div class="order-wid-list d-flex justify-content-between">
                                        <p class="mb-0"><i class="mdi mdi-square-rounded font-size-10 text-danger me-2"></i>Lìngua portuguesa</p>
                                        <div>
                                            <span class="pe-5">15</span>
                                            <span class="badge bg-danger"> + 0.4% </span>
                                        </div>
                                    </div>
                                    <div class="order-wid-list d-flex justify-content-between">
                                        <p class="mb-0"><i class="mdi mdi-square-rounded font-size-10 text-danger me-2"></i>Química</p>
                                        <div>
                                            <span class="pe-5">14</span>
                                            <span class="badge bg-warning"> + 0.4% </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row-->

              

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> &copy; 
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://1.envato.market/themesdesign" target="_blank">Themesdesign</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

</div>
@endsection

