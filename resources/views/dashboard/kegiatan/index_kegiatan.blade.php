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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">
                            KEGIATAN
                            <a href="{{ url('/activities') }}">
                                <span class="badge bg-info me-1 my-2" title="Show All Activities Page"><i class="fe fe-navigation"></i></span>
                            </a>
                        </span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Kegiatan</li>
                        </ol>
                    </div>
                </div>
                <!-- /breadcrumb -->

                <!-- row  -->
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between d-flex justify-content-between">
                                <h4 class="card-title">Kegiatan</h4>
                                @can('kegiatan_create')
                                <a href="{{ url('/kegiatan/addNew') }}">
                                    <button href="{{ url('/kegiatan/addNew') }}" type="button" class="btn btn-primary me-1"><i class="fe fe-plus"></i>
                                        Tambah Baru
                                    </button>
                                </a>
                                @endcan
                            </div>
                            <div class="card-body pt-0 example1-table">

                                <!-- Add alert -->
                                @if (session('success'))
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: "{{ session('success') }}",
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                </script>
                                @endif
                                <!-- /Alert -->

                                <div class="table-responsive">
                                    <table class="table  table-bordered text-nowrap mb-0" id="example1">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Judul</th>
                                                <th>Kategori Kegiatan</th>
                                                <th>PIC</th>
                                                <th>Tanggal Pelaksanaan</th>
                                                @can('kegiatan_isaktif')
                                                <th width="5%">is_active</th>
                                                @endcan
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            if (!empty($kegiatan) || $kegiatan != '') {
                                                foreach ($kegiatan as $activity) {
                                            ?>
                                                    <tr>
                                                        <td class="text-center">{{ $no }}</td>
                                                        <td>{{ $activity->judul }}</td>
                                                        <td class="text-center">
                                                            @if (!empty($activity->id_kategori))
                                                            {{ $activity->nama_kategori }}
                                                            @elseif (empty($activity->id_kategori))
                                                            {{ '-' }}
                                                            @endif
                                                        </td>


                                                        {{-- Get name user who created the data from users table --}}
                                                        @for ($u = 0; $u < count($users); $u++) @if ($users[$u]->id == $activity->created_by)
                                                            <td>{{ $users[$u]->name }}</td>
                                                            @endif
                                                            @endfor

                                                            <td class="text-center">
                                                                {{ date('d/m/Y', strtotime($activity->created_at)) }}
                                                            </td>
                                                            @can('kegiatan_isaktif')
                                                            <td class="text-center">
                                                                <!-- isaktif / is aktif -->
                                                                <div class="form-group">
                                                                    <label class="custom-switch ps-0" for="customSwitch-22{{ $activity->id }}">
                                                                        <input data-id="{{ $activity->id }}" type="checkbox" name="custom-switch-checkbox1" class="x custom-switch-input" id="customSwitch-22{{ $activity->id }}" onclick="changeKegiatanStatus(event.target, <?= $activity->id ?>);" {{ $activity->is_aktif == 1 ? 'checked' : '' }}>
                                                                        <span class="custom-switch-indicator"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            @endcan
                                                            <td class="text-center">
                                                                <div class="flex align-items-center list-user-action">
                                                                    @can('kegiatan_detail')
                                                                    <a href="{{ url('/kegiatan/detail/' . base64_encode($activity->id)) }}" class="btn btn-sm btn-primary" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Detail">
                                                                        <i class="fe fe-file-text"></i>
                                                                    </a>
                                                                    @endcan
                                                                    @can('kegiatan_update')
                                                                    <a href="{{ url('/kegiatan/komentar/' . base64_encode($activity->id)) }}" class="btn btn-sm btn-primary" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Komentar">
                                                                        <i class="fe fe-message-circle"></i>
                                                                    </a>
                                                                    <a href="{{ url('/kegiatan/thumbnail/' . base64_encode($activity->id)) }}" class="btn btn-sm btn-warning" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Change Thumbnail">
                                                                        <i class="fe fe-image"></i>
                                                                    </a>
                                                                    <a href="{{ url('/kegiatan/edit/' . base64_encode($activity->id)) }}" class="btn btn-sm btn-info" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Edit">
                                                                        <i class="fe fe-edit"></i>
                                                                    </a>
                                                                    @endcan
                                                                    @can('kegiatan_delete')
                                                                    <a href="{{ url('/kegiatan/delete/' . base64_encode($activity->id)) }}" class="btn btn-sm btn-danger" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Delete" onclick="return confirm('Apakah anda yakin ingin hapus ?')">
                                                                        <i class="fe fe-trash-2"></i>
                                                                    </a>
                                                                    @endcan
                                                                </div>
                                                            </td>
                                                    </tr>
                                            <?php $no += 1;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                scrollX: true,
                retrieve: true,
            });
        });
        // isaktif switch button
        function changeKegiatanStatus(_this, id) {
            var status = $(_this).prop('checked') == true ? 1 : 0;
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/kegiatan/active',
                data: {
                    'is_aktif': status,
                    'id': id,
                },
                success: function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: result.success,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        }
    </script>

    <!-- Add alert -->
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        })
    </script>
    @endif
    <!-- /Alert -->
</body>

</html>