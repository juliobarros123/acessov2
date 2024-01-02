@extends('layouts.site.app')
@section('titulo',' Folha Prova')
@section('conteudo')
 <!--/.modal -->
 <section class="wrapper bg-soft-primary">
  <div class="container pt-10 pb-15 pt-md-14 pb-md-20">
    <div class="row gx-lg-8 gx-xl-12 gy-10 mb-5 align-items-center">
      <div class="col-md-10 offset-md-1 offset-lg-0 col-lg-5 text-center text-lg-start order-2 order-lg-0" data-cues="slideInDown" data-group="page-title" data-delay="600">
        <h1 class="display-1 mb-5 mx-md-n5 mx-lg-0 ml-4">Provas de admissão</h1>
        <h3>Para ser admitido precisa fazer provas das disciplinas seguntes: </h3>
        
      </div>
    
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>
    <!-- /section -->
    <section class="wrapper bg-light">
      <div class="container py-14 py-md-16 pb-md-17">
        <div class="row gx-md-5 gy-5 mt-n18 mt-md-n21 mb-14 mb-md-17">
          <div class="col-md-6 col-xl-3">
            <div class="card shadow-lg card-border-bottom border-soft-yellow">
              <div class="card-body">
                <img src="{{asset('site/assets/img/icons/lineal/browser.svg')}}" class="svg-inject icon-svg icon-svg-md text-yellow mb-3" alt="" />
                <h4>Língua Portuguesa</h4>
                <p class="mb-2">A Língua Portuguesa é o objeto de estudo que se dedica à compreensão e produção de textos escritos e orais, bem como às regras gramaticais que norteiam a sua estruturação e uso.</p>
                {{-- <a href="demo12.html#" class="more hover link-green">Tópicso</a> --}}
                 <a href="{{url('enunciado')}}" class="more hover link-yellow">Ver</a>
                <a href="{{url('folha_prova')}}" class="more hover link-green">Minha resolução</a>
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
                <p class="mb-2">A Matemática é uma ciência que estuda quantidades, estruturas, espaço e mudanças, utilizando a lógica e o raciocínio dedutivo para formular e resolver problemas.</p>
                 <a href="{{url('enunciado')}}" class="more hover link-yellow">Ver</a>
                <a href="{{url('folha_prova')}}" class="more hover link-green">Minha resolução</a>
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
                <p class="mb-2">A Física estuda as leis fundamentais da natureza e seus fenômenos naturais, do nível subatômico ao cósmico, utilizando métodos matemáticos para formular e testar teorias</p>
                <a href="{{url('enunciado')}}" class="more hover link-yellow">Ver</a>
                <a href="{{url('folha_prova')}}" class="more hover link-green">Minha resolução</a>
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
                <p class="mb-2">A Química  estuda a matéria e suas transformações, desde a composição e estrutura das substâncias até as suas propriedades e reações, além de suas interações com a energia e o ambiente.</p>
                 <a href="{{url('enunciado')}}" class="more hover link-yellow">Ver</a>
                <a href="{{url('folha_prova')}}" class="more hover link-green">Minha resolução</a>
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
  
  </div>

@endsection