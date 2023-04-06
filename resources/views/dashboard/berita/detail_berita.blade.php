{{-- header --}}
@include('layouts.header')
{{-- /header --}}

<body class="ltr main-body app sidebar-mini">

    <!-- Loader -->
    {{-- <div id="global-loader">
        <img src="{{ asset('nowa/assets/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div> --}}
    <!-- /Loader -->

    <!-- Page -->
    <div class="page">

        <div>
            <!-- main-header -->
            @include('layouts.main-header')
            <!-- /main-header -->

            <!-- main-sidebar -->
            @include('layouts.main-sidebar')
            <!-- main-sidebar -->
        </div>

        <!-- main-content -->
        <div class="main-content app-content">

            <!-- container -->
            <div class="main-container container-fluid">

                <!-- breadcrumb -->
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">DETAIL BERITA</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">DETAIL BERITA</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Berita</li>
                        </ol>
                    </div>
                </div>
                <!-- /breadcrumb -->

                <!-- row  -->
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <!-- <h4 class="card-title">DETAIL BERITA</h4> -->
                            </div>
                            <div class="card overflow-hidden">
                                <div class="card-body" style="text-align: center;">
                                    <a href="javascript:void(0);">
                                        <h5 class="font-weight-semibold">{{ $berita->judul }}</h5>
                                    </a>
                                </div>
                                <div class="item7-card-img px-4 pt-4">
                                    <a href="javascript:void(0);"></a>
                                    @foreach ($berita->get_dokumen as $news)
                                        <img src="{{ asset('/dokumen/berita/' . $news->nama) }}" alt="img"
                                            class="cover-image br-7 w-100">
                                    @endforeach
                                </div>
                                <div class="card-body">
                                    <style>
                                        p {
                                            text-align: justify;
                                            text-justify: inter-word;
                                            /* font-family: 'Poppins' !important; */
                                        }
                                    </style>
                                    <p class="">{{ $berita->deskripsi }}</p>
                                </div>
                                <div class="card-footer pb-2 pt-2">
                                    <div class="item7-card-desc d-md-flex">
                                        <div class="d-flex align-items-center mt-0">
                                            <img alt="{{ $berita->get_user->image }}"
                                                src="{{ asset('/imageprofil/' . $berita->get_user->image) }}"
                                                class="avatar brround avatar-md me-3" alt="avatar-img">
                                            <div>
                                                <a href="profile.html"
                                                    class="text-default font-weight-bold">{{ $berita->get_user->name }}</a>
                                                <small class="d-block text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="ms-auto mb-2 d-flex mt-3">
                                            <a href="javascript:void(0);" class="me-3 mb-2 me-2 d-flex"><span
                                                    class="fe fe-calendar text-muted tx-17"></span>
                                                <div class="mt-0 mt-0 text-dark"> {{ $berita->created_at }}</div>
                                            </a>
                                            <a class="me-0 d-flex"
                                                href="{{ url('berita/komentar/' . base64_encode($id)) }}"><span
                                                    class="fe fe-message-square text-muted me-2 tx-17"></span>
                                                <div class="mt-0 mt-0 text-dark">{{ $total_komentar }}</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /row closed -->
            </div>
            <!-- /Container -->
        </div>
        <!-- /main-content -->

        <!-- Footer opened -->
        @include('layouts.footer')
        <!-- Footer closed -->
    </div>
    <!-- End Page -->

    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="las la-arrow-up"></i></a>

    {{-- script --}}
    @include('layouts.script')
    {{-- /script --}}

</body>

</html>
