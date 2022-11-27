@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="card-body">
            @if (session('failed'))
                <div class="alert alert-danger" role="alert">
                    {{ session('failed') }}
                </div>
            @endif
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register New Trademark') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register-trade') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="trademark_name" class="col-md-4 col-form-label text-md-end">{{ __('Trademark Name') }}</label>

                                <div class="col-md-6">
                                    <input id="trademark_name" type="text" class="form-control @error('name') is-invalid @enderror" name="trademark_name" value="{{ old('trademark_name') }}" required autocomplete="trademark_name" autofocus>

                                    @error('trademark_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category_id" class="col-md-4 col-form-label text-md-end">{{ __('Category')}}</label>

                                <span class="">
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category['id'] }}" >{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </div>

                            <div class="row mb-3">
                                <label for="registration" class="col-md-4 col-form-label text-md-end">{{ __('Registration Date') }}</label>

                                <div class="col-md-6">
                                    <input id="registration" type="date" class="form-control @error('registration') is-invalid @enderror" name="registration" value="{{ old('registration') }}" required>

                                    @error('registration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="expiration" class="col-md-4 col-form-label text-md-end">{{ __('Expiration Date') }}</label>

                                <div class="col-md-6">
                                    <input id="expiration" type="date" class="form-control @error('expiration') is-invalid @enderror" name="expiration" required>

                                    @error('expiration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <input name="owner_id" id="owner_id" type="hidden" value="{{auth()->id()}}"/>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
