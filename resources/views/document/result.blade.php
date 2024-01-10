@if(count($results) > 0)
@foreach($results as $res)
@foreach($res as $r)
<div class="col m2 s6">
    <a href="documents/{{ $r->id }}">
        <div class="card hoverable indigo lighten-5
		 task" data-id="{{ $r->id }}">
            <input type="checkbox" class="filled-in" id="chk{{$r->id}}"><label for="chk{{$r->id}}"></label>
            <div class="card-content2 center">
                @if($r->mimetype == "image/jpeg")
                <i class="material-icons">image</i>
                @elseif($r->mimetype == "video/mp4")
                <i class="material-icons">movie</i>
                @elseif($r->mimetype == "audio/mpeg")
                <i class="material-icons">music_video</i>
                @else
                <i class="material-icons">folder</i>
                @endif
                <h6>{{ $r->name }}</h6>
                <p>{{ $r->filesize }}</p>
            </div>
        </div>
    </a>
</div>
@endforeach
@endforeach
@else
<h5 class="teal-text">No Matches Found :(</h5>
@endif