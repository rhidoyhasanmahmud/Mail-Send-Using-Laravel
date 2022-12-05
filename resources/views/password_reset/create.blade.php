@extends('layouts.backend')

@section('title', 'Mail Send')

@section('content_header', 'Mail Send')

@section('content')

<div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header"></div>
                <div class="widget-body">
                    <div class="widget-main">
                        <form action="{{url('/forget-password')}}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="email">Email Address <sup class="text-danger">*</sup></label>
                                        <input type="text" name="email" value="{{ old('email') }}"
                                               placeholder="Enter Email Address" class="form-control" id="email"
                                               required>
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-sm btn-success"> Send
                                        <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
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
