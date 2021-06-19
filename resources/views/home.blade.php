@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
  @include('includes.message')
    <section id="banner">
        <div class="row justify-content-center">
            <div class=" col-0 col-md-1">
                <br><br>
                <p><i class="fab fa-facebook fa-2x text-light-color"></i></p>
                <br>
                <p><i class="fab fa-instagram fa-2x text-light-color"></i></p>
                <br>
                <p><i class="fab fa-twitter fa-2x text-light-color"></i></p>
            </div>

            <div class="col-md-7 text-center">
                <h1>Barber On </h1>
                <p>Barberias al alcance de tu mano</p>
                <div class="row ">
                    <div class="col-md-4 offset-md-2">
                        <button class=" btn bg-primary-color text-white font-weight-bold btn-block">
                            Android
                            <i class="fab fa-google-play mx-2"></i>
                        </button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn bg-light-color text-primary-color font-weight-bold btn-block">
                            IOS
                            <i class="fab fa-apple mx-2"></i>
                        </button>
                    </div>
                </div>

            </div>

            <div class="col-0 col-md-4 text-center">
                <img src="{{asset('img/phone-hand.png')}}" alt="" width="300" height="600">
            </div>

        </div>
        <div class="col-12 text-center">
                <button class="btn text-light-color font-weight-bold"><i class="fas fa-chevron-down mr-2"></i>Descubrí más!</button>
        </div>
    </section>

    <section class="info float-right">
        <div class="row my-5 pt-3 pb-5">
            <div class="col-md-6">
                <img src="{{asset('img/data4.jpg')}}" alt="" width="350"/>
            </div>
            <div class="col-md-6 p-3 justify-content-center">
                <h1>...Con Barber On podes</h1>
                <p>Encontrá barberias y peluqueros/as independientes en tu zona</p>
                <p>Mira sus trabajos, precios y calificaciones!</p>
                <p>Ya elegiste donde te vas a atender? <span class="text-primary-color font-weight-bold">Obtené tu reserva</span></p>

            </div>
        </div>
    </section>
    <section class="info info-two ">
        <div class="row my-5 pt-3 pb-5">
            <div class="col-md-6 p-3">
                <h1>Potencia tu trabajo...</h1>
                <p>Eres un peluquero/a independiente o tienes una barberia?</p>
                <p>Pues monta tu barbería online para <span class="text-primary-color font-weight-bold">promocionar tu trabajo</span> y contactar con nuevos clientes</p>
            </div>
            <div class="col-md-6">
                <img src="{{asset('img/data3.jpg')}}" alt="" width="250"/>
            </div>
        </div>
    </section>


    <section class="info info-two float-right">

        <div class="row my-5 pt-3 pb-5">
            <div class="col-md-6 p-3">
                <h1>Potencia tu trabajo...</h1>
                <p>Eres un peluquero/a independiente o tienes una barberia?</p>
                <p>Pues monta tu barbería online para <span class="text-primary-color font-weight-bold">promocionar tu trabajo</span> y contactar con nuevos clientes</p>
            </div>
            <div class="col-md-6">
                <img src="{{asset('img/data.jpg')}}" alt="" width="250"/>
            </div>
        </div>
    </section>

    <section class="info ">
        <div class="row my-5 pt-3 pb-5">
            <div class="col-md-6">
                <img src="{{asset('img/data2.jpg')}}" alt="" width="350"/>
            </div>
            <div class="col-md-6 p-3 justify-content-center">
                <h1>Una barberia mejor es una vida mejor</h1>
                <p>Barber On organizará las reservas para que los clientes disfruten de la experiencia <span class="text-primary-color font-weight-bold">sin demoras</span></p>
                <p>Gracias a esta funcionalidad, se evitan aglomeramientos de personas, <span class="text-primary-color font-weight-bold">cuidando así la salud de todos</span></p>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="col">
            <h1>Necesitas contactarnos?</h1>
            <br>
            <p>Visita nuestras redes...</p>
            <div class="col-md-6 offset-md-3">
                <div class="row justify-content-around">
                    <p><i class="fab fa-facebook fa-3x text-primary-color"></i></p>
                    <p><i class="fab fa-instagram fa-3x text-primary-color"></i></p>
                    <p><i class="fab fa-twitter fa-3x text-primary-color"></i></p>
                </div>
            </div>
            <p>...ó simplemente envianos un mail</p>
            <div class="col-md-8 offset-md-2 justify-content-center ">
                <form class="col-md-8 offset-md-2" action="#" method="post">
                    <input class="form-control my-2" type="text" name="name" placeholder="Nombre"/>
                    <input class="form-control my-2" type="email" name="email" placeholder="E-mail"/>
                    <textarea class="form-control my-2" name="message" cols="10" rows="5" placeholder="Envíame un mensaje..."></textarea>
                    <button type="submit" class="my-3 btn bg-primary-color text-light-color">Enviar</button>
                </form>
            </div>
        </div>

    </section>

</div>
@endsection
