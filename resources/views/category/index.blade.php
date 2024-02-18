@extends('adminlte::page')

@section('title', 'Category List')

@section('content_header')
    <h3>Category Page</h3>
@stop

@section('content')
<div class="container">
    <div class="card">
        @if (isset($category))
            <form action="{{route('category.update','')}}/{{$category->id}}" method="post">
                @method('PUT')
        @else
            <form action="{{route('category.store')}}" method="post">
        @endif
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-8 offset-md-2 col-sm-12 form-group">
                    <label for="category" class="form-data">Category:</label>
                    <input type="text" class="form-control" name="category" id="category" value="{{ old('category', $category->name ?? '') }}" required/>
                </div>

                <div class="col-md-8 offset-md-2 col-sm-12 form-group text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
                    <a href="{{ route('category.index') }}" class="btn btn-default"><i class="fa fa-close"></i>&nbsp;Cancel</a>
                </div>              
            </div>       
        </form>
    </div>
    <h3></h3>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
    
                <!-- we will also add show, edit, and delete buttons -->
                <td>
    
                    {{-- <a class="btn btn-small btn-success" href="{{ URL::to('category/' . $value->id) }}">Show</a> --}}
                    <a class="" href="{{ URL::to('category/' . $value->id . '/edit') }}"><i class="fa fa-edit"></i></a>
                    <a href="#" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this category?')) { document.getElementById('deleteForm{{$value->id}}').submit(); }">
                        <i class="fa fa-trash"></i>
                    </a>
                    
                    <form id="deleteForm{{$value->id}}" action="{{ route('category.destroy', $value->id) }}" method="post" style="display: none;">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-small btn-warning">Delete this Category</button>
                    </form>                    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop