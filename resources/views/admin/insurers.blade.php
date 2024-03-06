
<a href="{{ route('admin.insurerShowAdd') }}"><button>Add</button></a>

@foreach($insurers as $insurer)
    <p>Name: {{ $insurer->name }}<a href="{{ route('admin.insurerShow', $insurer->id) }}"><button>Show details</button></a><a href="{{ route('admin.insurerChange', $insurer->id) }}"><button>Change active</button></a></p>
    <hr>
@endforeach


