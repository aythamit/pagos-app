<div class="col-12">
    <label for="video_input_{{$vid->id}}" class="btn btn-primary"><span class="pr-1"><i class="fas fa-plus"></i></span>Upload video</label>
    <input type="file" id="video_input_{{$vid->id}}" name="video_input_{{$vid->id}}" class="d-none" accept="video/mp4,video/x-m4v,video/*" max-size="6154427" >
</div>
<div class="col-lg-12 col-md-6 col-12">
    <div class="form-group">
        <label for="video">Actual video</label>
        <video controls id="video_video_{{$vid->id}}" class="w-100" playsinline>
            <source id="video_source_{{$vid->id}}" src="{{$vid->video !== '' && $vid->video !== null ? asset('../storage/videos/'.$vid->video) : ''}}" @if($vid->mime !== '')type="video/{{@$vid->mime}}"@endif />
            Your browser does not support the video tag.
        </video>
    </div>
</div>