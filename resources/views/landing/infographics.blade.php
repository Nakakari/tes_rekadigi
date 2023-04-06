@include('landing.layouts.header')
{{-- header --}}
@include('layouts.header')
{{-- /header --}}

<section class="page">
    <!-- ***** Page Top Start ***** -->
    <div class="cover" data-image="assets/images/photos/parallax.jpg">
        <div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Infografis Persebaran Mitra</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="active">Infografis Persebaran Mitra</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Page Top End ***** -->

    <!-- container -->
    <div class="main-container container-fluid">

        <!-- row  -->
        <div class="row" style="margin-left: 2px;margin-right:2px">
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="div">
                        </div>
                    </div>
                    <div class="card-body pt-0 example1-table">
                        <form method="GET" action="{{ route('infographics_search') }}">
                            @csrf
                            <div class="row row-sm">
                                <div class="col-lg-1">
                                    <select class="js-example-basic-multiple-prov" id="tahun" name="tahun" style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1">
                                        <option value="0" <?= $data['tahun'] == 0 ? 'selected' : '' ?>>Pilih Tahun</option>
                                        @for($i=0;$i<=7;$i++) <option value="{{date('Y')-$i}}" <?= date('Y') - $i == $data['tahun'] ? 'selected' : '' ?>>{{date('Y')-$i}}</option>
                                            @endfor
                                            <option value="-">Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" name="judul" id="judul" value="{{$data['judul']}}" placeholder="judul pendampingan">
                                </div>
                                <div class="col-lg-2 mg-t-20 mg-lg-t-0">
                                    <select class="js-example-basic-multiple-prov" id="select_prov" name="select_prov" style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1">
                                        <option value="0" <?= $data['select_prov'] == 0 ? 'selected' : '' ?>>Pilih Provinsi</option>
                                        @foreach ($provinsi as $prov)
                                        <option value="{{ $prov->nama }}" <?= $prov->nama == $data['select_prov'] ? 'selected' : '' ?>>{{ $prov->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2 mg-t-20 mg-lg-t-0">
                                    <select class="js-example-basic-multiple-kab" name="select_kab" id="select_kab" style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1">
                                        <option value="0" <?= $data['select_kab'] == 0 ? 'selected' : '' ?>>Pilih Kota</option>
                                        @foreach ($kabupaten as $kab)
                                        <option value="{{ $kab->nama }}" <?= $kab->nama == $data['select_kab'] ? 'selected' : '' ?>>{{ $kab->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2 mg-t-20 mg-lg-t-0">
                                    <select class="js-example-basic-multiple-dis" name="select_dis" id="select_dis" style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1">
                                        <option value="0" <?= $data['select_dis'] == 0 ? 'selected' : '' ?>>Pilih Distrik</option>
                                        @foreach ($distrik as $dis)
                                        <option value="{{ $dis->nama }}" <?= $dis->nama == $data['select_dis'] ? 'selected' : '' ?>>{{ $dis->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-1">
                                    <button class="btn ripple btn-primary" type="submit">Cari</button>
                                </div>
                                <!-- <div class="col-lg-1">
                                    <button class="btn ripple btn-primary">Reset</button>
                                </div> -->
                            </div>
                            <br />
                        </form>
                        <table>
                            <tr>
                                <td><b>Pencarian</b></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tahun </td>
                                <td>:</td>
                                <td>{{$data['tahun']}}</td>
                            </tr>
                            <tr>
                                <td>Judul Pendampingan </td>
                                <td>:</td>
                                <td>{{$data['judul']}}</td>
                            </tr>
                            <!-- <tr>
                                <td>Provinsi </td>
                                <td>:</td>
                                <td>{{$data['select_prov']}}</td>
                            </tr>
                            <tr>
                                <td>Kota </td>
                                <td>:</td>
                                <td><?php
                                    if ($data['select_kab'] != "Pilih Kota" || empty($data['select_kab'])) {
                                        echo $data['select_kab'];
                                    }
                                    if ($data['select_kab'] == "Pilih Kota") {
                                        echo "";
                                    }
                                    ?></td>
                            </tr> -->
                            <tr>
                                <td>Distrik </td>
                                <td>:</td>
                                <td><?php
                                    if ($data['select_dis'] != "Pilih Distrik" || empty($data['select_dis']) || $data['select_dis'] != 0) {
                                        echo $data['select_dis'] . " , " . $data['select_kab'] . " , " . $data['select_prov'];
                                    }
                                    if ($data['select_dis'] == "Pilih Distrik" || $data['select_dis'] == 0) {
                                        echo "";
                                    }
                                    ?></td>
                            </tr>
                        </table>
                        <br />
                        <div class="row row-sm">
                            @foreach ($jenismitra as $jt)
                            <?php
                            $warna = 'primary';
                            if ($jt->id % 2 == 0) {
                                $warna = 'primary';
                            } elseif ($jt->id % 2 != 0 && $jt->id % 3 != 0 && $jt->id % 5 != 0) {
                                $warna = 'purple';
                            } elseif ($jt->id % 3 == 0 && $jt->id % 2 != 0) {
                                $warna = 'warning';
                            } elseif ($jt->id % 3 != 0 && $jt->id % 5 != 0) {
                                $warna = 'purple';
                            } elseif ($jt->id % 5 == 0) {
                                $warna = 'success';
                            } else {
                                $warna = 'success';
                            }
                            ?>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                                <div class="card sales-card circle-image1 card bg-{{$warna}}-gradient text-white ">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="ps-4 pt-4 pe-3 pb-4 pt-0">
                                                <div class="">
                                                    <h6 class="mb-2 tx-16 ">{{$jt->jenis}}</h6>
                                                </div>
                                                <div class="pb-0 mt-0">
                                                    <div class="d-flex">
                                                        <h4 class="tx-30 font-weight-semibold mb-2">
                                                            {{$count[$jt->id]}}
                                                        </h4>
                                                    </div>
                                                    <p class="mb-0 tx-14">Mitra
                                                        <span class=" text-primary"> </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="circle-icon widget bg-primary-gradient text-center align-self-center shadow-primary overflow-hidden box-shadow-primary">
                                                <i class="fe fe-shopping-bag tx-20 lh-lg text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                                <div class="card sales-card circle-image4 card bg-secondary-gradient text-white">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="ps-4 pt-4 pe-3 pb-4 pt-0">
                                                <div class="">
                                                    <h6 class="mb-2 tx-16">Total Mitra</h6>
                                                </div>
                                                <div class="pb-0 mt-0">
                                                    <div class="d-flex">
                                                        <h4 class="tx-30 font-weight-semibold mb-2">
                                                            {{$countmitra}}
                                                        </h4>
                                                    </div>
                                                    <p class="mb-0 tx-14">Mitra
                                                        <span class=" text-success"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="circle-icon widget bg-secondary-gradient text-center align-self-center warning-success overflow-hidden box-shadow-warning">
                                                <i class="fe fe-credit-card tx-20 lh-lg text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="mapid" style="height:100;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row closed -->

        <!-- include('landing/infographics/chart') -->
        <div class="row" style="margin-left: 2cm;margin-right:2cm;margin-bottom: 2cm;margin-top: 2cm;">
            <h4 class="section-title" style="text-align: center;">Data Pendampingan Mitra</h4>
            @include('landing/infographics/tabelpendampingan')
        </div>
    </div>
    <!-- /Container -->
</section>

@include('landing.layouts.footer')
{{-- script --}}
@include('layouts.script')
{{-- /script --}}

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple-prov').select2();
    });
    $(document).ready(function() {
        $('.js-example-basic-multiple-kab').select2();
    });
    $(document).ready(function() {
        $('.js-example-basic-multiple-dis').select2();
    });
    $(document).ready(function() {
        $('.js-example-basic-multiple-prov').select2().on('change', function() {
            var nama_prov = $(this).val();
            // window.alert(nama_prov);
            if (nama_prov) {
                $.ajax({
                    url: '/getKabupatenDiMap/' + nama_prov,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success: function(data) {
                        $('select[name="select_kab"]').empty();
                        $('select[name="select_kab"]').append(
                            '<option hidden>Pilih Kota</option>');
                        $('select[name="select_kab"]').append(
                            '<option value=0>Semua</option>');
                        $.each(data, function(key, datakabupaten) {
                            $('select[name="select_kab"]').append(
                                '<option value="' + datakabupaten.nama + '">' +
                                datakabupaten.nama + '</option>');
                        });

                    }
                });
            } else {
                $('select[name="select_kab"]').empty();
            }
        });
    });

    $(document).ready(function() {
        $('.js-example-basic-multiple-kab').select2().on('change', function() {
            var nama_kota = $(this).val();
            // window.alert(nama_kota);
            if (nama_kota) {
                $.ajax({
                    url: '/getDistrikDiMap/' + nama_kota,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success: function(data) {
                        $('select[name="select_dis"]').empty();
                        $('select[name="select_dis"]').append(
                            '<option hidden>Pilih Distrik</option>');
                        $('select[name="select_dis"]').append(
                            '<option value=0>Semua</option>');
                        $.each(data, function(key, datadistrik) {
                            $('select[name="select_dis"]').append(
                                '<option value="' + datadistrik.nama + '">' +
                                datadistrik.nama + '</option>');
                        });

                    }
                });
            } else {
                $('select[name="select_dis"]').empty();
            }
        });
    });
</script>

<!-- fullscreen -->
<link rel="stylesheet" href="https://cdn.statically.io/gh/brunob/leaflet.fullscreen/b920f36f/Control.FullScreen.css">
<script src="https://cdn.statically.io/gh/brunob/leaflet.fullscreen/b920f36f/Control.FullScreen.js"></script>
<!-- export -->
<link rel="stylesheet" href="https://cdn.statically.io/gh/pasichnykvasyl/Leaflet.BigImage/b9223853/dist/Leaflet.BigImage.min.css">
<script src="https://cdn.statically.io/gh/pasichnykvasyl/Leaflet.BigImage/b9223853/dist/Leaflet.BigImage.min.js">
</script>
<!-- layer -->

<script>
    //sample data values for populate map
    var data = [{}, ];

    var map = L.map('mapid', {
        fullscreenControl: true,
        fullscreenControlOptions: {
            position: 'topleft'
        }
    }).setView([-2.9547949, 104.6929233], 5);
    L.control.bigImage({
        position: 'topright'
    }).addTo(map);


    // layer
    // end layer

    map.addLayer(new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')); //base layer

    var markersLayer = new L.LayerGroup(); //layer contain searched elements

    map.addLayer(markersLayer);


    var controlSearch = new L.Control.Search({
        position: 'topright',
        layer: markersLayer,
        initial: false,
        zoom: 12,
        marker: false
    });

    map.addControl(controlSearch);

    L.Control.geocoder({
        position: 'topleft'
    }).addTo(map);

    var koordinate = <?= json_encode($mitra2->toArray()) ?>;
    var data_dis = <?= json_encode($distrik->toArray()) ?>;
    var data_kab = <?= json_encode($kabupaten->toArray()) ?>;
    var data_prov = <?= json_encode($provinsi->toArray()) ?>;
    var join = <?= json_encode($pendampingan->toArray()) ?>;
    console.log(koordinate);

    // https://img.icons8.com/ios-filled/50/000000/company.png

    var myIcon = L.icon({
        iconUrl: 'https://img.icons8.com/stickers/100/000000/shop-location.png',
        iconSize: [40, 45], // size of the icon
    });

    var judulpendampingan = [];
    for (var i = 0; i < koordinate.length; i++) {
        var title = koordinate[i].nama_mitra, //value searched
            loc = [koordinate[i].latitude, koordinate[i].longitude], //position found
            marker = new L.Marker(new L.latLng(loc), {
                title: koordinate[i].nama_mitra,
                icon: myIcon
            }); //se property searched
        var id = koordinate[i].id
        var alamat = koordinate[i].alamat
        var logo = koordinate[i].logo
        if (koordinate[i].logo == null || koordinate[i].logo == '') {
            var logo = "company.jpeg";
        }

        for (var l = 0; l < data_dis.length; l++) {
            if (koordinate[i].id_distrik == data_dis[l].id) {
                var iddistrik = data_dis[l].id_kota
                var distrik = data_dis[l].nama
            }
        }

        for (var j = 0; j < data_kab.length; j++) {
            if (iddistrik == data_kab[j].id) {
                var idkabupaten = data_kab[j].id_provinsi
                var kabupaten = data_kab[j].nama
            }
        }

        for (var k = 0; k < data_prov.length; k++) {
            if (idkabupaten == data_prov[k].id) {
                var provinsi = data_prov[k].nama
            }
        }
        for (var m = 0; m < join.length; m++) {
            if (join[m].mitra == koordinate[i].nama_mitra) {
                var judulpendampingan = join[m].judul;
            }
        }
        var id2 = btoa(id);
        var url = "/list-mitra/" + id2 + "/" + title;
        var gambar_mitra = "https://i.ytimg.com/vi/7QJAbKUeCsI/maxresdefault.jpg";
        var url_mitra = "/logomitra/" + logo;

        marker.bindPopup(
            '<img  src=<?= url('/') ?>' + url_mitra + '>' + '<br />' +
            'Nama Mitra : ' + title +
            '<br />' + 'Alamat : ' + alamat +
            '<br />' + 'Distrik : ' + distrik +
            '<br />' + 'Kota : ' + kabupaten +
            '<br />' + 'Provinsi : ' + provinsi +
            '<br /><a href="' + url +
            '"><button type="button" class ="btn btn-pill bg-primary-gradient me-1 my-2">More</a >');
        markersLayer.addLayer(marker);


    }
</script>