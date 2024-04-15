@if($competitors->isEmpty())
    <p>No results have been found related to your search</p>
@else
    @foreach($competitors as $competitor)
        <div class="row justify-content-center">
            <div>
                <div class="registrations">
                    <h5>Name: {{ $competitor->name }}</h5>
                    <h5>Surname: {{ $competitor->surname }}</h5>
                </div>
            </div>
        </div>
    @endforeach
@endif