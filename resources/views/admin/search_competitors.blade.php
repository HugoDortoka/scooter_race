@if($competitors->isEmpty())
    <p>No results have been found related to your search</p>
@else
    @foreach($competitors as $competitor)
        <div class="row justify-content-center">
            <div>
                <div class="insurer">
                    <h5>Name: {{ $competitor->name }} {{ $competitor->surname }}</h5>
                </div>
            </div>
        </div>
    @endforeach
@endif