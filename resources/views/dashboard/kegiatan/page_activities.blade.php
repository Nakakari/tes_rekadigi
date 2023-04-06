@include('landing.layouts.header')

<section class="page">
    <!-- ***** Page Top Start ***** -->
    <div class="cover" data-image="assets/images/photos/parallax.jpg">
        <div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>{{ $kegiatan->judul }}</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="home.html">Home</a></li>
                            <li><a href="services.html">Activities</a></li>
                            <li class="active">{{ $kegiatan->judul }}</li>
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
            <div class="row">
                <div class="col-lg-1 col-md-12 col-sm-12">
                </div>
                <div class="col-lg-10 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="blog-post-thumb big mbottom-60">
                                <!-- ***** Post Top Start ***** -->
                                <div class="img">
                                    @foreach ($kegiatan->get_dokumen as $news)
                                    <img src="{{ asset('/dokumen/kegiatan/' . $news->nama) }}" viewbox="auto" width="auto" height="auto">
                                    @endforeach
                                    <div class="date">
                                        <strong>{{ date('M', strtotime($kegiatan->created_at)) }}</strong>
                                        <span>{{ date('d', strtotime($kegiatan->created_at)) }}</span>
                                    </div>
                                </div>
                                <ul class="post-meta mbottom-20">
                                    <li><a href="#"><span class="icon fa fa-user"></span>by
                                            {{ $kegiatan->get_user->name }}</a></li>
                                </ul>
                                <!-- ***** Post Top End ***** -->

                                <!-- ***** Post Content Start ***** -->
                                <div class="text post-detail">
                                    <style>
                                        p {
                                            text-align: justify;
                                            text-justify: inter-word;
                                            /* font-family: 'Poppins' !important; */
                                        }
                                    </style>
                                    <p>{{ strip_tags($kegiatan->deskripsi) }}</p>
                                </div>
                                <!-- ***** Post Content End ***** -->

                                <!-- ***** Post Share Start ***** -->
                                <div class="post-footer">
                                    <span class="float-start">

                                    </span>
                                    <ul class="share">
                                        <span class="">Share - </span>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    </ul>
                                </div>
                                <!-- ***** Post Share End ***** -->
                            </div>
                        </div>

                        <!-- ***** Comment List Start ***** -->
                        <div class="col-lg-12">
                            <div class="section-comments">
                                <h5 class="mbottom-60">Comments</h5>
                                <ul>
                                    @include('dashboard.kegiatan.landing.komentar_reply', ['comments'=>$kegiatan->comments,'id_kegiatan' => $kegiatan->id])

                                    <!-- <li>
                                        <div class="avatar">
                                            <img src="assets/images/comment-avatar.png" alt="">
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-by">
                                                <strong>Hans Down</strong>
                                                <span>09 APR 2018</span>
                                                <a href="#" class="btn-reply"><i class="fa fa-reply"></i>
                                                    Reply</a>
                                            </div>
                                            <p>Praesent ut fringilla ligula. Vivamus et lacus nec risus malesuada
                                                vestibulum. Phasellus lobortis viverra lobortis. Donec iaculis, erat
                                                eu
                                                bibendum faucibus.</p>
                                        </div>
                                    </li> -->
                                    <!-- <li>
                                        <div class="avatar">
                                            <img src="assets/images/comment-avatar.png" alt="">
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-by">
                                                <strong>Penny Tool</strong>
                                                <span>09 APR 2018</span>
                                                <a href="#" class="btn-reply"><i class="fa fa-reply"></i>
                                                    Reply</a>
                                            </div>
                                            <p>Praesent ut fringilla ligula. Vivamus et lacus nec risus malesuada
                                                vestibulum. Phasellus lobortis viverra lobortis. Donec iaculis, erat
                                                eu
                                                bibendum faucibus.</p>
                                        </div>
                                        <ul>
                                            <li>
                                                <div class="avatar">
                                                    <img src="assets/images/comment-avatar.png" alt="">
                                                </div>
                                                <div class="comment-content">
                                                    <div class="comment-by">
                                                        <strong>Eric Widget</strong>
                                                        <span>09 APR 2018</span>
                                                        <a href="#" class="btn-reply"><i class="fa fa-reply"></i>
                                                            Reply</a>
                                                    </div>
                                                    <p>Praesent ut fringilla ligula. Vivamus et lacus nec risus
                                                        malesuada vestibulum. Phasellus lobortis viverra lobortis.
                                                        Donec
                                                        iaculis, erat eu bibendum faucibus.</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                        <!-- ***** Comment List End ***** -->

                        <!-- ***** Comment Form Start ***** -->
                        @if(!empty(Auth()->user()->id))
                        <div class="col-lg-12">
                            <div class="post-comment">
                                <h5 class="mbottom-30">Post a Comment</h5>
                                <div class="comment-form">
                                    <form method="post" action="{{ route('kegiatan.comment.store') }}">
                                        @csrf
                                        <!-- <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-item">
                                                    <label for="f1">Name:</label>
                                                    <input type="text" id="f1">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-item">
                                                    <label for="f2">Email:</label>
                                                    <input type="text" id="f2">
                                                </div>
                                            </div> -->
                                        <div class="col-lg-12">
                                            <div class="form-item">
                                                <div class="form-group">
                                                    <label for="f3">Comment:</label>
                                                    <textarea name="komentar"></textarea>
                                                    <input type="hidden" name="id_kegiatan" value="{{ $kegiatan->id }}" />
                                                    <input type="hidden" name="id_user" value="{{ Auth()->user()->id }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn-primary-line">Submit
                                                Comment</button>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        @endif
                        <!-- ***** Comment Form End ***** -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- ***** Page Content End ***** -->
</section>

@include('landing.layouts.footer')