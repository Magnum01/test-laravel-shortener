@extends('layouts.app')

@section('content')
    <section class="jumbotron text-center bg-light">
        <div class="container">
            <h1>URL shortener</h1>

            <form action="{{ route('link.process') }}" method="POST">
                @csrf

                <div class="input-group col-md-12">
                    <input required name="link" type="search" class="form-control rounded @error('link') is-invalid @enderror" placeholder="URL" aria-label="Search" aria-describedby="search-addon" value="{{ old('link') }}" />
                    <button type="submit" class="btn btn-outline-primary">Shorten URL</button>

                    @error('link')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group mt-2 ml-0 col-md-3">
                    <label for="expired_at">Expired at</label>
                    <input id="expired_at" name="expired_at" class="form-control @error('expired_at') is-invalid @enderror" placeholder="Expired at" />

                    @error('expired_at')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

            </form>

        </div>
    </section>
@endsection

@section('js')
    <script>
        var isoDate = new Date().toISOString();

        $('#expired_at').attr('min', isoDate.substring(0, isoDate.length - 1))

        console.log(isoDate)
    </script>
@endsection
