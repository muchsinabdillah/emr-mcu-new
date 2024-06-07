@extends('layouts.mainlogin')
@section('container') 
<div class="main-wrapper">

    <div class="login-bg-color bg-black-300">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel login-box">
                    <div class="panel-heading">
                        <div class="panel-title text-center">
                            <h4>MCU System RS YARSI</h4>
                        </div>
                    </div>
                    <div class="panel-body p-20">

                        <div class="section-title">
                            <div class="row">
                                <div class="col justify-content-center text-center">
                                    <img width="120px" height="120px" src="{{ URL::asset('logo.jpg') }}" />
                                </div>
                            </div>
                            <p class="sub-title text-muted">Selamat datang di Rumah Sakit Yarsi...</p>
                        </div>
                            @if(session('error'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>Informasi !</strong>  {{session('error')}}.
                                </div>
                            @endif
                            @error('login_gagal')
                            {{-- <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span> --}}
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{-- <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span> --}}
                                <span class="alert-inner--text"><strong>Warning!</strong> {{ $message }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror
                        <form action="{{url('proses_login')}}"  method="POST" id="logForm" autocomplete="off">
                            {{ csrf_field() }}
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="acl">Jenis</label>
                                <select class="form-select" id="acl" name="acl">
                                    @foreach($acl as $role)
                                        <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" required name="username" placeholder="Enter Username" autocomplete="off" >
                                <div class="form-control-wrap">
                                    @if($errors->has('username'))
                                            <span class="error">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" required id="password" Name="password" placeholder="Password">
                                <div class="form-control-wrap"> 
                                     @if($errors->has('password'))
                                            <span class="error">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="checkbox op-check">
                                <label>
                                    <input type="checkbox" name="remember" class="flat-blue-style"> <span class="ml-10">Remember me</span>
                                </label>
                            </div>
                            <div class="form-group mt-20">
                                <div>
                                    <button type="submit" class="btn btn-success btn-labeled pull-center">Sign in<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>

                        <hr>
 

                    </div>
                </div>
                <!-- /.panel -->
                <p class="text-muted text-center"><small>Copyright © RS YARSI 2023</small></p>
            </div>
            <!-- /.col-md-6 col-md-offset-3 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /. -->

</div>
<!-- /.main-wrapper -->