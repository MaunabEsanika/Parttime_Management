@extends('layouts.guest')


@section('content')
    <style>
        body{
            background-color: #f8f8f8;
        }
        .text {
            display: block;/* or inline-block */
            text-overflow: ellipsis;
            word-wrap: break-word;
            overflow: hidden;
            max-height: 3.6em;
            line-height: 1.8em;
        }
        .md-pills .nav-link.active {
            color: #fff;
            background-color: #616161;
        }
        button.close {
            position: absolute;
            right: 0;
            z-index: 2;
            padding-right: 1rem;
            padding-top: .6rem;
        }

        .parent {
            position: relative;
        }
        .child {
            position: absolute;
            font-family: Arial;
            display:flex;
            justify-content:center;
            align-items:center;
            position: absolute;
            right: 10px;
            top:10px;
            color: white;
        }
    </style>
    <div class="container py-5">
        <div class="row my-5">
{{--            <div class="col-md-3">--}}
{{--                @auth('hotel')--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-4 mb-2 align-items-center">--}}
{{--                                    <div class="avatar w-100 white d-flex justify-content-center align-items-center">--}}
{{--                                        <img src="{{asset($hotel->profile->hotelPhoto())}}"  class="img-fluid z-depth-1">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-8 text-muted d-flex flex-column justify-content-start pt-1">--}}
{{--                                    <p class="mb-2"><strong>{{$hotel->profile->nama}}</strong></p>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                            <hr/>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endauth--}}
{{--            </div>--}}
            <div class="col-md-8">

                @foreach($pekerjaan as $pkerja)
                    <a  class="card hoverable mb-1" href="{{url("/job/$pkerja->url_slug")}}">
                        <div  class="card-body wow fadeIn">
                            {{--                    <div class="avatar w-100 white d-flex justify-content-center align-items-center">--}}
                            {{--                        <img src="{{asset($pkerja->hotel->profile->hotelPhoto())}}"  class="img-fluid z-depth-1">--}}
                            {{--                    </div>--}}
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title">{{$pkerja->getPosisi()}}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{$pkerja->hotel->profile->nama}}</h6>
                                    <div class="card-text text">{!!html_entity_decode($pkerja->deskripsi)!!}</div>
{{--                                    <a href="{{url("/job/$pkerja->url_slug")}}" class="btn btn-md blue-gradient">Selengkapnya</a>--}}
                                    <table class="table">
                                        <thead class="black white-text">
                                        <tr>
                                            <th scope="col">Applyer</th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <table class="table">
                                        <thead class="grey lighten-2">
                                        <tr>
                                            <th scope="col">Lolos</th>
                                            <th scope="col">Terdaftar</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">0</th>
                                            <td>0</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-4 align-items-center">
                                    <div class="avatar w-100 white d-flex justify-content-center align-items-center">
                                        <img src="{{asset(!empty($pkerja->foto) ? $pkerja->foto : $hotel->profile->hotelPhoto())}}"  class="img-fluid z-depth-1">
                                    </div>
                                </div>

                            </div>


                        </div>

                    </a>
                    <br/>
                @endforeach
                    {!! $pekerjaan->render() !!}
            </div>
            <div class="col-md-4">
                <div class="card">

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col"><i class="fas fa-user mr-2 blue-text" aria-hidden="true"></i>Total Applyer</th>
                                <th scope="col"><i class="fas fa-briefcase mr-2 blue-text" aria-hidden="true"></i>Pekerjaan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">0</th>
                                <td>{{\App\Pekerjaan::where('hotel_id', $hotel->id)->count()}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="card-text">
{{--                            <a href="#!" class="card-title">Pekerjaan {{\App\Pekerjaan::where('hotel_id', $hotel->id)->count()}}</a>--}}
{{--                            <a href="#!" class="card-title">Contact Us</a>--}}
                            <a href="#!" class="card-title">© 2020 Kolega Hotel, Inc.</a>
                        </div>

                        {{--<h6 class="card-subtitle mb-2 text-muted">Contact User</h6>--}}

                        {{-- <p class="card-text">Some quick example text to build on the panel title and make up the bulk of the panel's content.</p>
                         <a href="#!" class="card-link mr-3">Card link</a>
                         <a href="#!" class="card-link ml-0">Another link</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="page-footer font-small indigo darken-4 py-4">

        <!-- Footer Elements -->
        <div class="container">

            <div class="row">
                <div class="col-md-6 d-flex justify-content-start">
                    <!-- Copyright -->
                    <div class="footer-copyright text-center bg-transparent">© 2020 Copyright:
                        <a href="#"> kolegahotel.com</a>
                    </div>
                    <!-- Copyright -->
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <ul class="list-unstyled d-flex mb-0">
                        <li>
                            <a class="mr-3" role="button"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a class="mr-3" role="button"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a class="mr-3" role="button"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a class="" role="button"><i class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- Footer Elements -->

    </footer>
@endsection