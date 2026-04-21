@extends('layouts.app')

@section('styles')
    <style>
        .order-infographic {
            margin-top: 4rem;
            text-align: center;
            background: white;
            padding: 2rem;
            border-radius: 20px;
        }

        .order-infographic img {
            max-width: 50%;
            height: auto;
            border-radius: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="order-infographic">
        <h1 style="margin-bottom: 2rem; color: #c09924;">Cara Pemesanan</h1>
        <img src="{{ asset('img/pemesanan.png') }}" alt="Infografis Tata Cara Pemesanan">
    </div>
@endsection