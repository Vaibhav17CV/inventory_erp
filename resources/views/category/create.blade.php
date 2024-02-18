@extends('adminlte::page')

@section('title', 'Category List')

@section('content_header')
<li><a href="{{ URL::to('category') }}">List of Category</a>
    <h1>Create category</h1>
@stop

@section('content')
    <form action="{{route('category.store')}}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8 col-sm-6 form-group">
                <label for="name" class="form-data">Category: </label>
                <input type="text" class="form-data" name="category" id="category" value="{{ old('category') }}" required/>
            </div>
            
            <div class="col-xs-4 pull-right text-center">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
                &nbsp;&nbsp;
                <a href="{{ route('category.index') }}" class="btn btn-default"><i class="fa fa-close"></i>&nbsp;Cancel</a>
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