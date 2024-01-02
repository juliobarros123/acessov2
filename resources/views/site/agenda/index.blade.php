@extends('layouts.site.app')
@section('titulo', ' Minha pauta')
@section('conteudo')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <!--/.modal -->
    <section class="wrapper bg-soft-primary">
        <div class="container pt-10 pb-4 pt-md-14 ">
            <div class="row gx-lg-8 gx-xl-12 gy-10 mb-5 align-items-center">
                <div class="col-md-10 offset-md-1 offset-lg-0 col-lg-5 text-center text-lg-start order-2 order-lg-0"
                    data-cues="slideInDown" data-group="page-title" data-delay="600">
                    <h1 class="display-1 mb-5 mx-md-n5 mx-lg-0 ml-4">Agenda</h1>

                   <!-- Button trigger modal -->

  
  <!-- Modal -->

                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light">
        <div class="container">
            <div class="row gx-md-5 gy-5 ">
                <div class="idance">
                    <div class="schedule content-block">
                        <div class="container">
                            <h2 data-aos="zoom-in-up" class="aos-init aos-animate">Eventos</h2>

                            <div class="timetable">


                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-provas-tab" data-toggle="tab"
                                            data-target="#nav-provas" type="button" role="tab"
                                            aria-controls="nav-provas" aria-selected="true">provas</button>
                                        <button class="nav-link" id="nav-resultados-tab" data-toggle="tab"
                                            data-target="#nav-resultados" type="button" role="tab"
                                            aria-controls="nav-resultados" aria-selected="false">resultados</button>
                                        <button class="nav-link" id="nav-outro-tab" data-toggle="tab"
                                            data-target="#nav-outro" type="button" role="tab" aria-controls="nav-outro"
                                            aria-selected="false">outro</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-provas" role="tabpanel"
                                        aria-labelledby="nav-provas-tab">
                                        <div class="row">

                                            <!-- Schedule Item 1 -->
                                            @foreach (provas()->get() as $item)
                                            {{-- @dump($item) --}}
                                                <div class="col-md-6">
                                                    <div class="timetable-item">
                                                        {{-- <div class="timetable-item-img">
                                                            <img src="https://www.bootdey.com/image/100x80/FFB6C1/000000"
                                                                alt="Contemporary Dance">
                                                        </div> --}}
                                                        {{-- @dump($item->dt_data_prova) --}}
                                                        <div class="timetable-item-main">
                                                            <div class="timetable-item-name">{{$item->vc_nome}}</div>
                                                            <div class="timetable-item-name">Período:{{$item->periodo}}</div>
                                                            <div class="timetable-item-name">Curso:{{$item->curso}}</div>
                                                            <div class="timetable-item-name">Sala:{{$item->sala}}</div>
                                                            <div class="timetable-item-name">Hora:{{$item->inicio_prova}}- {{$item->termino_prova}}</div>

                                                            <a href="#" class="btn btn-primary btn-book" data-toggle="modal" data-target="#exampleModal{{$item->id}}">Tópicos da prova</a>
                                                            <div class="timetable-item-like">
                                                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                                <i class="fa fa-heart" aria-hidden="true"></i>
                                                                <div class="timetable-item-like-count">{{ dt_eua_to_pt($item->dt_data_prova)}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel"> Tópicos</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <?php echo $item->topicos?>
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                       
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                            @endforeach
                                            <!-- Button trigger modal -->

                                            <!-- Schedule Item 2 -->
                                           
                                          
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-resultados" role="tabpanel"
                                        aria-labelledby="nav-resultados-tab">
                                        <div class="row">

                                            {{-- <!-- Schedule Item 1 -->
                                            <div class="col-md-6">
                                                <div class="timetable-item">
                                                    <div class="timetable-item-img">
                                                        <img src="https://www.bootdey.com/image/100x80/FFB6C1/000000"
                                                            alt="Contemporary Dance">
                                                    </div>
                                                    <div class="timetable-item-main">
                                                        <div class="timetable-item-time">4:00pm - 5:00pm</div>
                                                        <div class="timetable-item-name">Contemporary Dance</div>
                                                        <a href="#" class="btn btn-primary btn-book">Book</a>
                                                        <div class="timetable-item-like">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                            <div class="timetable-item-like-count">11</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Schedule Item 2 -->
                                            <div class="col-md-6">
                                                <div class="timetable-item">
                                                    <div class="timetable-item-img">
                                                        <img src="https://www.bootdey.com/image/100x80/00FFFF/000000"
                                                            alt="Break Dance">
                                                    </div>
                                                    <div class="timetable-item-main">
                                                        <div class="timetable-item-time">5:00pm - 6:00pm</div>
                                                        <div class="timetable-item-name">Break Dance</div>
                                                        <a href="#" class="btn btn-primary btn-book">Book</a>
                                                        <div class="timetable-item-like">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                            <div class="timetable-item-like-count">28</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Schedule Item 3 -->
                                            <div class="col-md-6">
                                                <div class="timetable-item">
                                                    <div class="timetable-item-img">
                                                        <img src="https://www.bootdey.com/image/100x80/8A2BE2/000000"
                                                            alt="Street Dance">
                                                    </div>
                                                    <div class="timetable-item-main">
                                                        <div class="timetable-item-time">5:00pm - 6:00pm</div>
                                                        <div class="timetable-item-name">Street Dance</div>
                                                        <a href="#" class="btn btn-primary btn-book">Book</a>
                                                        <div class="timetable-item-like">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                            <div class="timetable-item-like-count">28</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Schedule Item 4 -->
                                            <div class="col-md-6">
                                                <div class="timetable-item">
                                                    <div class="timetable-item-img">
                                                        <img src="https://www.bootdey.com/image/100x80/6495ED/000000"
                                                            alt="Yoga">
                                                    </div>
                                                    <div class="timetable-item-main">
                                                        <div class="timetable-item-time">7:00pm - 8:00pm</div>
                                                        <div class="timetable-item-name">Yoga</div>
                                                        <a href="#" class="btn btn-primary btn-book">Book</a>
                                                        <div class="timetable-item-like">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                            <div class="timetable-item-like-count">23</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Schedule Item 5 -->
                                            <div class="col-md-6">
                                                <div class="timetable-item">
                                                    <div class="timetable-item-img">
                                                        <img src="https://www.bootdey.com/image/100x80/00FFFF/000000"
                                                            alt="Stretching">
                                                    </div>
                                                    <div class="timetable-item-main">
                                                        <div class="timetable-item-time">6:00pm - 7:00pm</div>
                                                        <div class="timetable-item-name">Stretching</div>
                                                        <a href="#" class="btn btn-primary btn-book">Book</a>
                                                        <div class="timetable-item-like">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                            <div class="timetable-item-like-count">14</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Schedule Item 6 -->
                                            <div class="col-md-6">
                                                <div class="timetable-item">
                                                    <div class="timetable-item-img">
                                                        <img src="https://www.bootdey.com/image/100x80/008B8B/000000"
                                                            alt="Street Dance">
                                                    </div>
                                                    <div class="timetable-item-main">
                                                        <div class="timetable-item-time">8:00pm - 9:00pm</div>
                                                        <div class="timetable-item-name">Street Dance</div>
                                                        <a href="#" class="btn btn-primary btn-book">Book</a>
                                                        <div class="timetable-item-like">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                            <div class="timetable-item-like-count">9</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-outro" role="tabpanel"
                                        aria-labelledby="nav-outro-tab">
                                        {{-- <div class="row">

                                            <!-- Schedule Item 1 -->
                                            <div class="col-md-6">
                                                <div class="timetable-item">
                                                    <div class="timetable-item-img">
                                                        <img src="https://www.bootdey.com/image/100x80/FFB6C1/000000"
                                                            alt="Contemporary Dance">
                                                    </div>
                                                    <div class="timetable-item-main">
                                                        <div class="timetable-item-time">4:00pm - 5:00pm</div>
                                                        <div class="timetable-item-name">Contemporary Dance</div>
                                                        <a href="#" class="btn btn-primary btn-book">Book</a>
                                                        <div class="timetable-item-like">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                            <div class="timetable-item-like-count">11</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Schedule Item 2 -->
                                            <div class="col-md-6">
                                                <div class="timetable-item">
                                                    <div class="timetable-item-img">
                                                        <img src="https://www.bootdey.com/image/100x80/00FFFF/000000"
                                                            alt="Break Dance">
                                                    </div>
                                                    <div class="timetable-item-main">
                                                        <div class="timetable-item-time">5:00pm - 6:00pm</div>
                                                        <div class="timetable-item-name">Break Dance</div>
                                                        <a href="#" class="btn btn-primary btn-book">Book</a>
                                                        <div class="timetable-item-like">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                            <div class="timetable-item-like-count">28</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Schedule Item 3 -->
                                            <div class="col-md-6">
                                                <div class="timetable-item">
                                                    <div class="timetable-item-img">
                                                        <img src="https://www.bootdey.com/image/100x80/8A2BE2/000000"
                                                            alt="Street Dance">
                                                    </div>
                                                    <div class="timetable-item-main">
                                                        <div class="timetable-item-time">5:00pm - 6:00pm</div>
                                                        <div class="timetable-item-name">Street Dance</div>
                                                        <a href="#" class="btn btn-primary btn-book">Book</a>
                                                        <div class="timetable-item-like">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                            <div class="timetable-item-like-count">28</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Schedule Item 4 -->
                                            <div class="col-md-6">
                                                <div class="timetable-item">
                                                    <div class="timetable-item-img">
                                                        <img src="https://www.bootdey.com/image/100x80/6495ED/000000"
                                                            alt="Yoga">
                                                    </div>
                                                    <div class="timetable-item-main">
                                                        <div class="timetable-item-time">7:00pm - 8:00pm</div>
                                                        <div class="timetable-item-name">Yoga</div>
                                                        <a href="#" class="btn btn-primary btn-book">Book</a>
                                                        <div class="timetable-item-like">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                            <div class="timetable-item-like-count">23</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Schedule Item 5 -->
                                            <div class="col-md-6">
                                                <div class="timetable-item">
                                                    <div class="timetable-item-img">
                                                        <img src="https://www.bootdey.com/image/100x80/00FFFF/000000"
                                                            alt="Stretching">
                                                    </div>
                                                    <div class="timetable-item-main">
                                                        <div class="timetable-item-time">6:00pm - 7:00pm</div>
                                                        <div class="timetable-item-name">Stretching</div>
                                                        <a href="#" class="btn btn-primary btn-book">Book</a>
                                                        <div class="timetable-item-like">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                            <div class="timetable-item-like-count">14</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Schedule Item 6 -->
                                            <div class="col-md-6">
                                                <div class="timetable-item">
                                                    <div class="timetable-item-img">
                                                        <img src="https://www.bootdey.com/image/100x80/008B8B/000000"
                                                            alt="Street Dance">
                                                    </div>
                                                    <div class="timetable-item-main">
                                                        <div class="timetable-item-time">8:00pm - 9:00pm</div>
                                                        <div class="timetable-item-name">Street Dance</div>
                                                        <a href="#" class="btn btn-primary btn-book">Book</a>
                                                        <div class="timetable-item-like">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                            <div class="timetable-item-like-count">9</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.row -->

        </div>
        <!-- /.container -->
    </section>

    </div>

@endsection
