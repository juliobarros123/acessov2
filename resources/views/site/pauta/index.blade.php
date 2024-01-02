@extends('layouts.site.app')
@section('titulo',' Minha pauta')
@section('conteudo')
 <!--/.modal -->
 <section class="wrapper bg-soft-primary">
  <div class="container pt-10 pb-15 pt-md-14 pb-md-20">
    <div class="row gx-lg-8 gx-xl-12 gy-10 mb-5 align-items-center">
      <div class="col-md-10 offset-md-1 offset-lg-0 col-lg-5 text-center text-lg-start order-2 order-lg-0" data-cues="slideInDown" data-group="page-title" data-delay="600">
        <h1 class="display-1 mb-5 mx-md-n5 mx-lg-0 ml-4">Minha pauta</h1>
        <h3>Confira os resultados individuais dos seus testes e o resultado final</h3>
        
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
          <div class="col-md-6 col-xl-3">
            <div class="card shadow-lg card-border-bottom border-soft-yellow">
              <div class="card-body">
                <img src="{{asset('site/assets/img/icons/lineal/browser.svg')}}" class="svg-inject icon-svg icon-svg-md text-yellow mb-3" alt="" />
                <h4>Língua Portuguesa</h4>
              
                {{-- <a href="demo12.html#" class="more hover link-green">Tópicso</a> --}}
                 <span class=" hover link-yellow">Nota:</span>
                 <span class=" hover  link-green">13</span>
                 <br>
                 <span class=" hover  link-red">N/APTO</span>
                 <span class=" hover  link-green">APTO</span>
              </div>
              <!--/.card-body -->
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-6 col-xl-3">
            <div class="card shadow-lg card-border-bottom border-soft-green">
              <div class="card-body">
                <img src="{{asset('site/assets/img/icons/lineal/chat-2.svg')}}" class="svg-inject icon-svg icon-svg-md text-green mb-3" alt="" />
                <h4>Matemática</h4>
              
               <span class=" hover link-yellow">Nota:</span>
                 <span class=" hover  link-green">13</span>
                 <br>
                 <span class=" hover  link-red">N/APTO</span>
                 <span class=" hover  link-green">APTO</span>
              </div>
              <!--/.card-body -->
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-6 col-xl-3">
            <div class="card shadow-lg card-border-bottom border-soft-orange">
              <div class="card-body">
                <img src="{{asset('site/assets/img/icons/lineal/id-card.svg')}}" class="svg-inject icon-svg icon-svg-md text-orange mb-3" alt="" />
                <h4>Física</h4>
              
              <span class=" hover link-yellow">Nota:</span>
                 <span class=" hover  link-green">13</span>
                 <br>
                 <span class=" hover  link-red">N/APTO</span>
                 <span class=" hover  link-green">APTO</span>
              </div>
              <!--/.card-body -->
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-6 col-xl-3">
            <div class="card shadow-lg card-border-bottom border-soft-blue">
              <div class="card-body">
                <img src="{{asset('site/assets/img/icons/lineal/gift.svg')}}" class="svg-inject icon-svg icon-svg-md text-blue mb-3" alt="" />
                <h4>Química</h4>
              
               <span class=" hover link-yellow">Nota:</span>
                 <span class=" hover  link-green">13</span>
                 <br>
                 <span class=" hover  link-red">N/APTO</span>
                 <span class=" hover  link-green">APTO</span>
              </div>
              <!--/.card-body -->
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
     
      </div>
      <!-- /.container -->
    </section>
    <section class="wrapper bg-light">
      <div class="container  d-flex justify-content-center">
          <div class="col-md-6 col-xl-3">
            <div class="card shadow-lg card-border-bottom border-soft-red">
              <div class="card-body">
                <h4 class="text-center">APTO/NÃO APTO</h4>
              </div>
              <!--/.card-body -->
            </div>
            <!--/.card -->
     
          <!--/column -->
        </div>
        <!--/.row -->
     
      </div>
      <!-- /.container -->
    </section>
  </div>

@endsection