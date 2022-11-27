@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

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

                <div class="m-auto">
                    <a href="{{route('register-trade')}}"><button type="button" class="btn btn-success btn-lg">Register New Trademarks</button></a>
                    <a href="{{route('view-trademark')}}"><button type="button" class="btn btn-primary btn-lg">View Your Trademark</button></a>
                    <a href="{{route('view-fav-trademark')}}"><button type="button" class="btn btn-secondary btn-lg">View Favorite Trademarks</button></a>
                </div>

                <form method="POST" action="{{ route('search-all') }}" class="m-lg-4">
                    @csrf
                    <input type="text" class="form-control form-input" name="search" placeholder="Search anything...">
                </form>


                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                        <td>Name</td>
                        <td>Owner</td>
                        <td>Category</td>
                        <td>Registration Date</td>
                        <td>Expiration Date</td>
                        </thead>
                        <tbody>
                        @foreach ($trademarks as $trademark)
                            <tr class="">
                                <td class="table-text">
                                    <div><a href="{{'/view-trademark/'.$trademark->id}}">{{ $trademark->trademark_name }}</a></div>
                                </td>

                                <td>
                                    <div>{{$trademark->user->name}}</div>
                                </td>
                                <td>
                                    <div>{{$trademark->category->name}}</div>
                                </td>

                                <td>
                                    <p class="">{{$trademark->registration}}</p>
                                </td>

                                <td>
                                    <p class="">{{$trademark->expiration}}</p>
                                </td>

                                <td>

                                    @if(in_array($trademark->id, $favTrades))
                                        <form action="{{'/delete-favorite/' . $trademark->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-outline-secondary" >
                                                <i class="fa fa-btn fa-trash"></i>Remove Favorite
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{'/add-favorite/' . $trademark->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}

                                            <button type="submit" class="btn btn-secondary">
                                                <i class="fa fa-btn fa-trash"></i>Favorite
                                            </button>
                                        </form>
                                    @endif


                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if(count($trademarks) < 1)
                        <div class="h4 text-lg-center">There are no trademarks to show</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
