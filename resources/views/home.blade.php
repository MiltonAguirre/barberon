@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
  @include('includes.message')
    <section id="banner">
        <div class="row justify-content-center">

            <div class="col-md-6 text-center">
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


            <div class="col-md-6 text-center">
                <img src="{{asset('img/phone-hand.png')}}" alt="" width="300" height="600">
            </div>

        </div>
    </section>
    <section class="info">
            <div class="row my-5">
                <div class="col-md-5">
                    <img src="{{asset('img/data4.jpg')}}" alt="" width="600"/>

                </div>
                <div class="col-md-5 offset-md-2 p-5 justify-content-center">
                    <h1>...Con Barber On podes</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis doloribus ex temporibus in quam consequuntur perferendis!</p>

                </div>
            </div>
    </section>
    <section class="info info-two">

        <div class="row my-5 ">
            <div class="col-md-7">
            <h1>Rapido, facil, elegante...</h1>

            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos consectetur officiis, nihil dolores laudantium!</p>

            </div>
            <div class="col-md-5">
                <img src="{{asset('img/data3.jpg')}}" alt="" width="400"/>

            </div>
        </div>
    </section>
    <section class="info">
            <div class="row my-5">
                <div class="col-md-5">
                    <img src="{{asset('img/data.jpg')}}" alt="" width="400"/>

                </div>
                <div class="col-md-5 offset-md-2 p-5 justify-content-center">
                    <h1>...Con Barber On podes</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis doloribus ex temporibus in quam consequuntur perferendis!</p>

                </div>
            </div>
    </section>
    <section class="info info-two">

        <div class="row my-5 ">
            <div class="col-md-7">
            <h1>Rapido, facil, elegante...</h1>

            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos consectetur officiis, nihil dolores laudantium!</p>

            </div>
            <div class="col-md-5">
                <img src="{{asset('img/data2.jpg')}}" alt="" width="600"/>

            </div>
        </div>
    </section>

</div>
@endsection
