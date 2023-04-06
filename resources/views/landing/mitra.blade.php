@include('landing.layouts.header')

<section class="page">
    <!-- ***** Page Top Start ***** -->
    <div class="cover" data-image="assets/images/photos/parallax.jpg">
        <div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Daftar Mitra</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="active">Daftar Mitra</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Page Top End ***** -->

    <!-- ***** Page Content Start ***** -->
    <div class="page-bottom pbottom-70">
        <div class="container">
            <!-- ***** Aside Start ***** -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <aside class="default-aside">
                    <div class="sidebar">
                        <div class="search-widget">
                            <div class="search">
                                <form method="GET" action="{{url('list-mitra/search')}}">
                                    <input type="text" id="search" name="search" value="{{ !empty($search) ? $search:'' }}" placeholder="Cari Mitra">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <!-- ***** Aside End ***** -->
            <div class="row">

                @foreach ($mitra as $data)
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="{{ url('/list-mitra/' . base64_encode($data->id)) . '/' . $data->slug }}">
                        <div class="team-item">
                            <div class="header">
                                <div class="img">
                                    @if(!empty($data->logo))
                                    <img src="{{ asset('logomitra/'.$data->logo) }}" width="76" height="85" alt="">
                                    @else
                                    <img src="{{ asset('logomitra/company.jpeg') }}" width="76" height="85" alt="">
                                    @endif
                                </div>
                                <div class="info">
                                    <strong>{{ $data->nama_mitra }}</strong>
                                    <span>{{ 'Jenis Mitra : ' . $data->get_jenisMitra->jenis }}</span>
                                </div>
                            </div>
                            <div class="body">
                                {{ ucwords(strtolower($data->get_dis->nama) . ', ' . $data->get_dis->get_kota->nama . ', ' . $data->get_dis->get_kota->get_prov->nama) }}
                            </div>
                            <ul class="social">
                                <li><a href="https://wa.me/{{$data->whatsapp}}"><i class="fa fa-whatsapp"></i></a></li>
                                <li><a href="https://{{$data->email}}"><i class="fa fa-envelope"></i></a></li>
                                <li><a href="https://{{$data->facebook}}"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://{{$data->instagram}}"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </a>
                </div>
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="{{ url('/list-mitra/' . base64_encode($data->id)) . '/' . $data->nama_mitra }}" class="home-services-item">
                        <i class="fa fa-clone"></i>
                        <h5 class="services-title">{{ $data->nama_mitra }}</h5>
                        <p>{{ 'Jenis Mitra : ' . $data->get_jenisMitra->jenis }}</p>
                        <p>{{ ucwords(strtolower($data->get_dis->nama) . ', ' . $data->get_dis->get_kota->nama . ', ' . $data->get_dis->get_kota->get_prov->nama) }}
                        </p>
                    </a>
                </div> -->
                @endforeach
            </div>
        </div>
    </div>
    <!-- ***** Page Content End ***** -->

    <!-- ***** Pagination Start ***** -->
    <nav>
        <ul class="pagination justify-content-center">
            {!! $mitra->onEachSide(1)->links() !!}
        </ul>
    </nav>
</section>


@include('landing.layouts.footer')