@extends('layouts.app')
@section('content')
    <section class="hero">
        <img src="https://www.adobe.com/content/dam/cc/us/en/creative-cloud/photography/discover/landscape-photography/CODERED_B1_landscape_hero-img_900x420.jpg.img.jpg" alt="">
    </section>
    <section class="container">
        <h1 class="fw-bold my-4">Il tuo viaggio a portata di mano</h1>
        <h2 class="fs-4 mb-3">Organizza, pianifica e vivi le tue vacanze con la nostra Travel App!</h2>
        <p>Scopri un modo semplice e divertente per gestire ogni dettaglio del tuo viaggio: dalle tappe da visitare, ai luoghi da esplorare, fino alle piccole curiosità che rendono ogni giornata unica.</p>
        <p>
            <ul>
                <li><strong>Suddividere il tuo viaggio in giornate</strong> e organizzare ogni tappa con facilità.</li>
                <li><strong>Aggiungere dettagli personalizzati</strong> come titolo, descrizione, immagini e note su ogni tappa.</li>
                <li><strong>Visualizzare le tappe su una mappa</strong> per orientarti al meglio.
                </li>
                <li><strong>Tenere traccia del progresso</strong> delle tue avventure e aggiornare le tue esperienze in tempo reale.
                </li>
                <li><strong>Esplorare nuove funzionalità</strong> come valutazioni delle tappe e aggiunta di note durante il viaggio.
                </li>
            </ul>
            Non solo un diario di viaggio, ma un vero compagno di avventure! Rivivi i tuoi ricordi e condividili con chi vuoi, ovunque ti trovi.
        </p>
        <p class="fw-bold">Inizia ora a pianificare il tuo prossimo viaggio e rendilo indimenticabile con la tua Travel App!</p>
    </section>
    <section id="cta">
        <a class="btn-cta" href="{{ route('register') }}">{{ __('Registrati') }}</a>
        <a class="btn-cta" href="{{ route('login') }}">{{ __('Login') }}</a>
    </section>
@endsection

