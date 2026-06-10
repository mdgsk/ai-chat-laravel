@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<!-- <form action="/submit" method="POST"> -->
<form action="{{ route('form.submit') }}" method="POST">
    @csrf

    <input type="text" name="name" value="{{ old('name') }}">

    <button type="submit">
        Submit
    </button>
</form>