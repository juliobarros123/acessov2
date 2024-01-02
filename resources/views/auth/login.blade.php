
@extends('layouts.site.app')
@section('titulo',' INICIAR SESSÃO')
@section('conteudo')
 <!--/.modal -->
    <section class="wrapper bg-soft-primary">
        <section class="wrapper">
            <div class="container pb-14 pb-md-16">
              <div class="row">
                <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto" style="margin-bottom: 320px; padding-top:80px;">
                  <div class="card">
                    <div class="card-body p-11 text-center">
                        <h2 class="mb-3 text-start">Iniciar Sessão</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                        
                        <div class="form-floating mb-4">
                          <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                          <label for="email">Email</label>
                        </div>
                        <div class="form-floating password-field mb-4">
                          <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                          <span class="password-toggle"><i class="uil uil-eye"></i></span>
                          <label for="password" name="password">Palavra-Passe</label>
                        </div>
                        <button class="btn btn-primary rounded-pill btn-login w-100 mb-2" type="submit">Enviar</button>
                      </form>
                      <!-- /form -->
                  
                      </nav>
                      <!--/.social -->
                    </div>
                    <!--/.card-body -->
                  </div>
                  <!--/.card -->
                </div>
                <!-- /column -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.container -->
          </section>
          <!-- /section -->
        </div>
    </section>

@endsection