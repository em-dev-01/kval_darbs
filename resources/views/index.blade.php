@extends('layouts.app')
@section('content')
  <!-- Header-->
  <header class="bg-dark py-5">
      <div class="container px-5">
          <div class="row gx-5 align-items-center justify-content-center">
              <div class="col-lg-8 col-xl-7 col-xxl-6">
                  <div class="my-5 text-center text-xl-start">
                      <h1 class="display-5 fw-bolder text-white mb-2">AR Builders</h1>
                      <p class="lead fw-normal text-white-50 mb-4">Būvniecības uzņēmums, specializējas jumtu segumu nomainīšanā</p>
                      <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                        <a class="btn btn-outline-light btn-lg px-4" href="#contacts">Sazinies ar mums!</a>
                      </div>
                  </div>
              </div>
              <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="https://dummyimage.com/600x400/343a40/6c757d" alt="..."></div>
          </div>
      </div>
    </header>
  <!-- Blog preview section-->
  <div class="py-5">
      <div class="container px-5 my-5">
          <div class="row gx-5 justify-content-center">
              <div class="col-lg-8 col-xl-6">
                  <div class="text-center">
                      <h2 class="fw-bolder" id="galerija">Darbu galerija</h2>
                      <p class="lead fw-normal text-muted mb-5">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque fugit ratione dicta mollitia. Officiis ad.</p>
                  </div>
              </div>
          </div>
            <div id="carouselExampleIndicators" class="carousel slide mh-50" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                
                  <div class="carousel-item active">
                    <img class="d-block w-100 h-50" src="https://cdn.pixabay.com/photo/2015/12/01/20/28/road-1072823_1280.jpg" alt="Third slide">
                    <img class="d-block w-100 h-50" src="https://images.pexels.com/photos/18752376/pexels-photo-18752376/free-photo-of-florence.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Fourth slide">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
             
          <!-- Call to action-->
          <aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5 mt-5" id="contacts">
              <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                  <div class="mb-4 mb-xl-0">
                      <div class="fs-3 fw-bold text-white">Sazines ar mums!</div>
                  </div>
                  <div class="ms-xl-4">
                      
                    <form method="POST" action="{{ route('client_requests.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" >
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                       
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" >
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif
                  </div>
              </div>
          </aside>
      </div>
    </div>
    <footer class="bg-dark py-4 mt-auto">
      <div class="container px-5">
          <div class="row align-items-center justify-content-between flex-column flex-sm-row">
              <div class="col-auto"><div class="small m-0 text-white">Copyright © AR Builders 2023</div></div>
              <div class="col-auto">
                  <a class="link-light small" href="#!">Kontakti</a>
              </div>
          </div>
      </div>
  </footer>
@endsection
