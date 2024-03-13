@if($courses->isEmpty())
    <p>No results have been found related to your search</p>
@else
    @foreach($courses as $course)
        <div class="row justify-content-center">
            <div>
                <div class="insurer">
                    <h5>Name: {{ $course->name }}</h5>
                    <a href="{{ route('admin.courseShow', $course->id) }}" class="btn btn-pink mr-2">Show details</a>
                    <a href="{{ route('admin.courseChange', $course->id) }}" class="btn btn-pink">Change active</a>
                </div>
            </div>
        </div>
    @endforeach
@endif