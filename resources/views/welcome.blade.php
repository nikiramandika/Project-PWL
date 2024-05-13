@if(auth()->check())
    <h1>Hi {{ auth()->user()->name }}</h1>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
@else
    <h1>Hi Guest</h1>
    <a href="{{ route('login') }}">Login</a>
@endif
