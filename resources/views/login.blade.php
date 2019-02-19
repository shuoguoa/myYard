@extends('app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8  col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        @if(count($errors) > 0)
                            < class="alert alert-danger">
                                <strong >Whoops! </strong>
                            There were some problems with your input.<br><br>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>ß
                                @endforeach
                            </ul>
                        @endif
                        <form class="form-horizontal" role="form" method="post" action="{{url('/Auth/WebAuth/login')}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Account</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="account" value="{{old('emaiil')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="passwprd">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remeber">Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                    <a class="btn btn-link" href="{{url('/password/email'))}">
                                    Forgot your password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
