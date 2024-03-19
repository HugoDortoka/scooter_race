@foreach($courses as $course)
    <div>
        <h1>{{ $course->name }}</h1>
        <div>
            <img src="{{ asset($course->map_image) }}" alt="{{ $course->name }}">
        </div>
    </div>
@endforeach