@foreach($comments as $comment)
<div style="margin-left: 2cm;">

    <li>
        <div class="avatar">
            <img src="{{ asset('/imageprofil/' . $comment->iduser->image) }}" alt="{{$comment->iduser->image}}">
        </div>
        <div class="comment-content">
            <div class="comment-by">
                <strong>{{ $comment->iduser->name }}</strong>
                <span>{{$comment->created_at}}</span>
                <a aria-controls="collapseExample" aria-expanded="false" class="btn-reply" data-bs-toggle="collapse" href="#collapseExample{{ $comment->id }}" role="button"><i class="fa fa-reply"></i>
                    Reply</a>
            </div>
            <p>{{ $comment->komentar }}</p>
        </div>
    </li>

    <a href="" id="reply"></a>
    <br />
    @if(!empty(Auth()->user()->id))
    <form method="post" class="collapse ml-5" id="collapseExample{{ $comment->id }}" action="{{ route('reply.store') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="komentar" class="form-control" />
            <input type="hidden" name="id_berita" value="{{ $comment->id_berita }}" />
            <input type="hidden" name="id_komen" value="{{ $comment->id }}" />
            <input type="hidden" name="id_user" value="{{ Auth()->user()->id }}" />
            <input type="hidden" name="id_parent" value="{{ $comment->id }}" />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Reply" />
        </div>
    </form>
    @endif
    @include('dashboard.berita.landing.komentar_reply', ['comments' => $comment->replies])
</div>
@endforeach