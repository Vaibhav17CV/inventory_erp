@extends('adminlte::page')

@section('title', 'Materials List')

@section('content_header')
<li><a href="{{ URL::to('material') }}">List of Materials</a>
    <h1>Create material</h1>
@stop

@section('content')
    <form action="{{route('material.store')}}" method="post">
        {{ csrf_field() }}
        <div class="card">
            <div class="col-md-8 col-sm-6 form-group">
                <label for="name" class="form-data">Category: </label>
                <select class="form-data" name="category" id="category">
                    <option value="">Select</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    
                </select>
            </div>
            <div class="col-md-8 col-sm-6 form-group">
                <label for="name" class="form-data">Materials: </label>
                <input type="text" class="form-data" name="material" id="material" value="{{ old('material') }}" required/>
            </div>
            <div class="col-md-8 col-sm-6 form-group">
                <label for="name" class="form-data">Qty: </label>
                <input type="text" class="form-data" name="qty" id="qty" value="{{ old('qty') }}" required/>
            </div>
            <div class="col-xs-4 pull-right text-center">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
                &nbsp;&nbsp;
                <a href="{{ route('material.index') }}" class="btn btn-default"><i class="fa fa-close"></i>&nbsp;Cancel</a>
            </div>
        </div>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop