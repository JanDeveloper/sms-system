@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="panel-heading">
            @if(session('response'))
                <div class="alert alert-success">
                    {{ session('response') }}
                </div>
            @endif
            </div>
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ url('/message') }}">
                       {{ @csrf_field() }} 
                       <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Enter Message') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="message" value="" required autofocus></textarea>
                            </div>
                        </div>
                        <table class="table table-striped table hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Mobile</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($users) > 0)
                                @foreach($users->all() as $user)
                                <tr>
                                    <td><input type="checkbox" name="phone_number[]" class="checkbox" value="{{ $user->phone_number }}" /></td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                </tr>
                                @endforeach
                            @endif
                            
                        </tbody>
                    </table>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                            Send Message
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
