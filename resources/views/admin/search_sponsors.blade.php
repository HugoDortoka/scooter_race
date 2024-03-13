@if($sponsors->isEmpty())
    <p>No results have been found related to your search</p>
@else
    @foreach($sponsors as $sponsor)
        <div class="row justify-content-center">
            <div>
                <div class="insurer">
                    <h5>Name: {{ $sponsor->name }}</h5>
                    <a href="{{ route('admin.sponsorShow', $sponsor->id) }}" class="btn btn-pink mr-2">Show details</a>
                    <a href="{{ route('admin.sponsorChange', $sponsor->id) }}" class="btn btn-pink">Change active</a>
                </div>
            </div>
        </div>
    @endforeach
@endif