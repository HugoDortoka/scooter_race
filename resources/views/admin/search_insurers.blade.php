@if($insurers->isEmpty())
    <p>No results have been found related to your search</p>
@else
    @foreach($insurers as $insurer)
        <div class="row justify-content-center">
            <div>
                <div class="insurer">
                    <h5>Name: {{ $insurer->name }}</h5>
                    <a href="{{ route('admin.insurerShow', $insurer->id) }}" class="btn btn-pink mr-2">Show details</a>
                    <a href="{{ route('admin.insurerChange', $insurer->id) }}" class="btn btn-pink">Change active</a>
                </div>
            </div>
        </div>
    @endforeach
@endif