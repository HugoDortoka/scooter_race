<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
{{ $course->name }}
<form action="{{ route('admin.courseSaveUploadPhotos', $course->id) }}" method="post" enctype="multipart/form-data">
    @csrf    
    <input type="submit" value="Save" class="btn btn-pink">
    <input type="button" value="Cancel" onclick="window.location.href = '{{ route('admin.home') }}';" class="btn btn-pink"/>
    <input type="hidden" name="photo_urls" id="photo_urls">
    <div id="drop-area" class="drop-area" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)">
        Drag and drop here
    </div>
</form>
<div id="imagenes"></div>
<script>
    const uploadImageUrl = '{{ route('admin.courseSaveUploadPhotosTemporarily', $course->id) }}';
    const baseImageUrl = "{{ asset('') }}";
</script>
<script src="{{ asset('assets/js/drag_and_drop.js') }}"></script>