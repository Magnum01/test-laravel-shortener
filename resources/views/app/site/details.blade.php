@extends('layouts.app')

@php
    /** @var \App\Entity\Link\ShortenLink $link */
    /** @var \App\Entity\Link\View[] $views */
@endphp

@section('content')
    <section class="jumbotron bg-light">
        <div class="container">
            <h1 class="text-center">Link details</h1>

            <div class="cart">
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <th>Code</th>
                            <td>
                                @php $linkUrl = route('link.open', $link->getShortCode()); @endphp

                                <a href="{{ $linkUrl }}" target="_blank">{{ $link->getShortCode() }}</a>

                                <a id="copy_button" class="btn btn-sm btn-primary float-right" data-clipboard-text="{{ $linkUrl }}">Copy to clipboard</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Original Link</th>
                            <td>
                                <a href="{{ $link->getOriginalUrl() }}" target="_blank">{{ $link->getOriginalUrl() }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Total views</th><td>{{ $views->count() }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($link->isExpired())
                                    <span class="badge badge-secondary">Expired</span>
                                @endif
                                @if ($link->isActive())
                                    <span class="badge badge-primary">Active</span>
                                @endif
                            </td>
                        </tr>

                        @if($link->hasExpirationDate())
                            <tr>
                                <th>Expired At</th>
                                <td>{{ $link->expired_at->format('d.m.Y G:i') }}</td>
                            </tr>
                        @endif

                        <tbody>
                        </tbody>
                    </table>

                    @if($views->count() > 0)
                        <h4 class="pt-3">Clicks:</h4>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="55%">User Agent</th>
                                <th scope="col" width="30%">Referrer</th>
                                <th scope="col" width="15%">Date</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($views as $view)
                                    <tr>
                                        <td>{{ $view->user_agent }}</td>
                                        <td>{{ $view->referrer }}</td>
                                        <td>{{ $view->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @else

                        <p class="font-weight-bold mt-5 text-center">Has not clicked the link yet.</p>

                    @endif

                </div>
            </div>

        </div>
    </section>
@endsection
