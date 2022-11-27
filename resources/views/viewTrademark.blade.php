@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-6 fle">{{__('Registered Trademark Profile')}}</div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('removed'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('removed') }}
                            </div>
                        @endif
                    </div>

                    @if(isset($trademark))
                        <div class="card-body">
                            <h1 class="card-title fw-bold">{{$trademark->trademark_name}}</h1>
                            <h6 class="card-subtitle text-muted"> by {{$trademark->user->name}}</h6>
                        </div>

                        <div class="card-body">
                            <h3 class="card-text">Category: <span class="fw-bold text-decoration-underline">{{$trademark->category->name}}</span></h3>
                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Registration start from: {{$trademark->registration}}</li>
                            <li class="list-group-item">Registration end at: {{$trademark->expiration}}</li>
                        </ul>

                        @if($trademark->user->id == auth()->id())
                            <div class="card-body text-center">
                                <form action="{{'/trademarks/1' }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Delete
                                    </button>
                                </form>
                            </div>
                        @elseif(in_array($trademark->id, $favTrades))
                            <div class="card-body text-center">
                                <form action="{{'/delete-favorite/' . $trademark->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-outline-secondary">
                                        <i class="fa fa-btn fa-trash"></i>Remove Favorite
                                    </button>

                                    <input type="hidden" name="type" value="view">
                                </form>
                            </div>
                        @else
                            <div class="card-body text-center">
                                <form action="{{'/add-favorite/' . $trademark->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fa fa-btn fa-trash"></i>Favorite
                                    </button>

                                    <input type="hidden" name="type" value="view">
                                </form>
                            </div>
                        @endif

                        <div class="card-footer text-muted">
                            {{$trademark->created_at->diffForHumans()}}
                        </div>
                    @else
                        <div class="card-body">
                                <div class="alert alert-danger" role="alert">
                                    You don't have any registered trademark yet. <span><a href="{{route('register-trade')}}">Register now</a></span>
                                </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
