@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Your Saved Favorite Trademarks') }}</div>

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

                    <form method="POST" action="{{ route('search-all') }}" class="m-lg-4">
                        @csrf
                        <input type="text" class="form-control form-input" name="search"
                               placeholder="Search anything...">
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
                            @foreach ($favTrademarks as $favTrademark)
                                <tr class="">
                                    <td class="table-text">
                                        <div>{{ $favTrademark->trademark->trademark_name }}</div>
                                    </td>

                                    <td>
                                        <div>{{$favTrademark->user->name}}</div>
                                    </td>

                                    <td>
                                        <div>{{$favTrademark->trademark->category->name}}</div>
                                    </td>

                                    <td>
                                        <p class="">{{$favTrademark->trademark->registration}}</p>
                                    </td>

                                    <td>
                                        <p class="">{{$favTrademark->trademark->expiration}}</p>
                                    </td>

                                    <td>

                                        <form action="{{'/delete-favorite/' . $favTrademark->trademark->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Remove Favorite
                                            </button>

                                            <input type="hidden" name="type" value="fav">
                                        </form>

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(count($favTrademarks) < 1)
                            <div class="h4 text-lg-center">There are no trademarks to show</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
