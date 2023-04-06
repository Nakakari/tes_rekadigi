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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Change Thumbnail</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">MITRA</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Berita</li>
                            <li class="breadcrumb-item active" aria-current="page">Change Thumbnail</li>
                        </ol>
                    </div>
                </div>
                <!-- /breadcrumb -->

                <!-- row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">
                                    <h5 class="card-title mg-b-20">Choose Picture for Thumbnail</h5>
                                </div>
                                <form action="{{ url('/berita/addThumbnail/' . base64_encode($id)) }}" id="formData" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-600">News's
                                            Name</label>
                                        <input class="form-control" type="text" name="judul" id="judul" value="{{ $berita->judul }}" disabled>
                                    </div>
                                    <label class="main-content-label tx-11 tx-medium tx-gray-600">Image List</label>
                                    @foreach ($berita->get_dokumen as $news)
                                    <div class="row row-sm">
                                        <div class="col-lg-1">
                                            <label class="rdiobox">
                                                <input name="thumbnail" type="radio" value="{{ $news->id }}">
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-11">
                                            <embed alt="{{ $news->nama}}" src="{{ asset('/dokumen/berita/' . $news->nama) }}" type="application/pdf" width="100%" height="150px"></embed>
                                        </div>
                                    </div>
                                    @endforeach

                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" type="submit">Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /row -->

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
    <script>
        $(document).ready(function() {
            $('#deskripsi').summernote();
        });
    </script>
</body>

</html>