@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-6 fle">{{__('Your Registered Trademarks')}}</div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('search-yours') }}" class="m-4">
                        @csrf
                        <input type="text" class="form-control form-input" name="search" placeholder="Search anything...">
                    </form>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <td>Name</td>
                                <td>Registration Date</td>
                                <td>Expiration Date</td>
                            </thead>
                            <tbody>
                            @foreach ($trademarks as $trademark)
                                <tr class="">
                                    <td class="table-text">
                                        <div>{{ $trademark->trademark_name }}</div>
                                    </td>

                                    <td>
                                        <p class="">{{$trademark->registration}}</p>
                                    </td>

                                    <td>
                                        <p class="">{{$trademark->expiration}}</p>
                                    </td>

                                    <!-- Task Delete Button -->
                                    <td>
                                        <form action="{{'/trademarks/' . $trademark->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
