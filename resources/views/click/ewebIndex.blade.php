{{-- resources/views/gioco/index.blade.php --}}
@extends('click.layoutClick') {{-- o il layout che stai usando --}}

@section('title', 'Espresso Web Configuratore')

@section('content')
    <div class="container">
                            <livewire:eweb.eweb-config />
    </div>

@endsection
