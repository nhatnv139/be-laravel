@section('title')
{{ $title }}
@endsection

{{-- <h1>List users</h1> --}}
<h1>{{ $title }}</h1>
<a href="{{ route('users.add') }}" class="btn btn-primary">Add User</a>
<hr>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Email</th>
            <th width="15%">Time</th>
            <th width="5%">Edit</th>
            <th width="5%">Delete</th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($usersList))
        @foreach ($usersList as $key => $item)
        <tr>
            <th>{{ $key+1 }}</th>
            <th>{{ $item->fullname }}</th>
            <th>{{ $item->email }}</th>
            <th>{{ $item->create_at }}</th>
            <th><a href="{{ route('users.edit', ['id'=>$item->id]) }}"> Edit</a></th>
            <th><a href="{{ route('users.post-edit', ['id'=>$item->id]) }}"> Delete</a></th>
        </tr>
        @endforeach
        @else 
        <tr>
            <td colspan="4">No Data</td>
        </tr>
        @endif
    </tbody>
</table>