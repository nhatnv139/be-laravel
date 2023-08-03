@section('title')
{{ $title }}
@endsection

{{-- <h1>List users</h1> --}}
<h1>{{ $title }}</h1>
{{-- <a href="#" class="btn btn-primary">Add User</a> --}}
<hr>

<form action="" method="POST">
    <div class="mb-3">
        <label for="FullName"></label>
        <input type="text" class="form-control" name="fullname" placeholder="name" value="{{ old('fullname') ?? $userDetail->fullname }}">
        @error('fullname')
        <span style="color: red">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="Email"></label>
        <input type="text" class="form-control" name="email" placeholder="email" value="{{ old('email') ?? $userDetail->email }}">
        @error('email')
        <span style="color: red">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('users.index') }}" class="btn btn-warning">Back</a>
    @csrf
</form>
