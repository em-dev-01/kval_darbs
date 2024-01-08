<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AR Builders') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    @include('layouts.navigation')
    @include('components.success-alert')
    <header class="bg-dark py-5">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-white mb-2">AR Builders</h1>
                        <p class="lead fw-normal text-white-50 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Quod earum, corporis tempore veniam alias, minima eaque consequuntur error officia
                            totam sunt placeat vel perferendis quibusdam delectus facere reiciendis! Omnis, hic.
                            nomainīšanā</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            <a class="btn btn-outline-light btn-lg px-4" href="#contacts">Sazinies ar mums!</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"></div>
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
                        <p class="lead fw-normal text-muted">Lorem ipsum, dolor sit amet consectetur adipisicing
                            elit. Eaque fugit ratione dicta mollitia. Officiis ad.</p>
                    </div>
                </div>
            </div>

            <div class=" w-75 mx-auto h-75">
                <div class="container px-5 my-5">
                    <div id="carouselExampleIndicators" class="carousel slide mh-50" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100 h-50"
                                    src="https://penntoday.upenn.edu/sites/default/files/2019-07/construction-pavilioncleancore.jpg">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 h-50"
                                    src="https://img.freepik.com/premium-photo/interior-renovation-residential-apartment-using-drywall-without-painting-construction-work-indoors-renovation-process-inside-house_493343-29445.jpg?w=1060"
                                    alt="Fourth slide">
                            </div>

                            <div class="carousel-item">
                                <img class="d-block w-100 h-50"
                                    src="https://images.pexels.com/photos/3990359/pexels-photo-3990359.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                    alt="Third slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 h-50"
                                src="https://images.pexels.com/photos/1388944/floor-flooring-hand-man-1388944.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                alt="Fourth slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 h-50"
                                    src="https://penntoday.upenn.edu/sites/default/files/2019-07/construction-pavilioncleancore.jpg"
                                    alt="Third slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 h-50"
                                    src="https://img.freepik.com/premium-photo/interior-renovation-residential-apartment-using-drywall-without-painting-construction-work-indoors-renovation-process-inside-house_493343-29445.jpg?w=1060"
                                    alt="Fourth slide">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    @guest
        
    
    <aside class="bg-gradient rounded-0 p-4 p-sm-5 mt-5" id="contacts">
        <div class="flex align-items-center flex-column flex-xl-row text-center text-xl-start">
            <div class="mb-4 mb-xl-0">
                <div class="fs-3 fw-bold text-white">Piesaki savu projektu šeit</div>
            </div>
            <div class="ms-xl-4">

                <form method="POST" action="{{ route('client_requests.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Vārds</label>
                                <input type="text" class="form-control" id="name" name="name">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="email">E-pasts</label>
                            <input type="email" class="form-control" id="email" name="email">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="description">Apraksts</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                </div>
                <button type="submit" class="btn btn-primary">Sūtīt pieteikumu</button>
                </form>
            </div>
        </div>
        </div>
    </aside>
    @endguest
    </div>
    </div>
</body>

</html>
