@extends('layouts.app')

@section('styles')
    <style>
        .contact-section {
            max-width: 1000px;
            margin: 4rem auto;
            padding: 0 2rem;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .contact-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .contact-header h1 {
            font-size: 3rem;
            color: #c09924;
            margin-bottom: 1rem;
        }

        .contact-header .underline {
            width: 100px;
            height: 5px;
            margin: 0 auto;
            border-radius: 5px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .contact-card {
            background: white;
            padding: 3rem 2rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }

        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 45px rgba(102, 126, 234, 0.15);
        }

        .contact-card i {
            font-size: 3.5rem;
        }

        .contact-card h3 {
            font-size: 1.5rem;
            color: #333;
        }

        .contact-card p {
            color: #666;
            line-height: 1.6;
        }

        .btn-contact {
            margin-top: auto;
            padding: 0.8rem 1.5rem;
            background: #f8f9fa;
            border-radius: 25px;
            font-weight: 600;
            transition: background 0.3s;
        }

        .contact-card:hover .btn-contact {
            background: #c09924;
            color: white;
        }

        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="contact-section">
        <div class="contact-header">
            <h1>Hubungi Kami</h1>
            <p>Kami siap membantu Anda mewujudkan souvenir impian</p>

        </div>

        <div class="contact-grid">
            <a href="mailto:nurarif1000@Gmail.com" target="_blank" class="contact-card email-card">
                <i data-lucide="mail"></i>
                <h3>Email</h3>
                <p>Punya pertanyaan atau ingin pesan khusus? Tim kami siap membantu Anda setiap saa</p>
                <div class="btn-contact">Email</div>
            </a>

            <a href="https://wa.me/6282258406966" target="_blank" class="contact-card whatsapp-card">
                <i data-lucide="message-circle"></i>
                <h3>WhatsApp</h3>
                <p>Konsultasi gratis dan pemesanan custom langsung melalui Customer Service kami.</p>
                <div class="btn-contact">Chat Sekarang</div>
            </a>

            <div class="contact-card address-card">
                <i data-lucide="map-pin"></i>
                <h3>Toko Kami</h3>
                <p>Jl. Pisangan No.52, RT.11/RW.3, Penggilingan, Kec. Cakung, Kota Jakarta Timur, Daerah Khusus Ibukota
                    Jakarta 13940<br>(Buka: Senin - Sabtu, 08:00 - 21:00)</p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        lucide.createIcons();
    </script>
@endsection