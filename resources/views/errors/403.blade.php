@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column;">
    <h1 style="font-size: 24px; color: #3490dc; font-weight: bold;">You do not have access to this page.</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" style="margin-top: 20px; padding: 10px 20px; background-color: #3490dc; color: white; border: none; border-radius: 5px; font-size: 16px;">
            Logout
        </button>
    </form>
</div>
@endsection