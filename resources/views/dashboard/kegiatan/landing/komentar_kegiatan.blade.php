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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">MITRA</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">MITRA</a></li>
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
                                <h4 class="card-title">MITRA</h4>
                                <div class="div">
                                </div>
                            </div>
                            <div class="card-body pt-0 example1-table">
                                <div class="">
                                    <div class="card overflow-hidden">
                                        <div class="card">
                                            <div class="card-body">

                                                @include('dashboard.kegiatan.komentar_reply', ['id_kegiatan' => $kegiatan->id])

                                                <br />
                                                <!-- <div class="form-group">
                                                    <textarea class="form-control" name="example-textarea-input" rows="3" placeholder="Write Comment"></textarea>
                                                </div>
                                                <a href="javascript:void(0);" class="btn btn-primary">Send Reply</a> -->

                                                <form method="post" action="{{ route('kegiatan.comment.store') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="text" name="komentar" class="form-control" />
                                                        <input type="hidden" name="id_kegiatan" value="{{ $kegiatan->id }}" />
                                                        <input type="hidden" name="id_user" value="{{ Auth()->user()->id }}" />
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Add Comment" />
                                                    </div>
                                                </form>
                                            </div>
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

    {{-- Activation switch button --}}
    <script>
        // isaktif switch button
        function changeBeritaStatus(_this, id) {
            var status = $(_this).prop('checked') == true ? 1 : 0;
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/berita/active',
                data: {
                    'is_aktif': status,
                    'id': id,
                },
                success: function(result) {}
            });
        }
    </script>

</body>

</html>