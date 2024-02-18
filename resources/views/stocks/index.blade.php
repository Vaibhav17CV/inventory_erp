@extends('adminlte::page')

@section('title', 'Stocks List')

@section('content_header')
    <h3>Stocks Page</h3>
@stop

@section('content')
<div class="container">

    @if (isset($stock))
    <form action="{{route('stocks.update','')}}/{{$stocks->id}}" method="post">
        @method('PUT')
    @else
        <form action="{{route('stocks.store')}}" method="post">
    @endif
        {{ csrf_field() }}
        <div class="card">
            <div class="row">
                <div class="col-md-8 offset-md-2 col-sm-12 form-group">
                    <label for="category" class="form-data">Category:</label>
                    <select class="form-control" name="category" id="category">
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8 offset-md-2 col-sm-12 form-group">
                    <label for="name" class="form-data">Material: </label>
                    <select class="form-control" name="material" id="material" required>
                    </select>
                </div>
                <div class="col-md-8 offset-md-2 col-sm-12 form-group">
                    <label for="material" class="form-data">Date:</label>
                    <input type="date" class="form-control" name="stock_date" id="stock_date" value="" required/>
                </div>
                <div class="col-md-8 offset-md-2 col-sm-12 form-group">
                    <label for="qty" class="form-data">Qty:</label>
                    <input type="text" class="form-control" name="qty" id="qty" value="" required/>
                </div>
                <div class="col-md-8 offset-md-2 col-sm-12 form-group text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
                    <a href="{{ route('stocks.index') }}" class="btn btn-default"><i class="fa fa-close"></i>&nbsp;Cancel</a>
                </div>
            </div>
        </div>      
    </form>
    
    <h1></h1>
    
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>ID</td>
                <td>category Name</td>
                <td>Material Name</td>
                <td>Date</td>
                <td>Opening Balance</td>
                <td>in\out</td>
                <td>Closed Balance</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
        @foreach($stocks as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->category->name }}</td>
                <td>{{ $value->material->name }}</td>
                <td>{{ $value->stock_date }}</td>
                <td>{{ $value->opening_balance }}</td>
                <td>{{ $value->stock_qty }}</td>
                <td>{{ $value->closing_balance }}</td>
    
                <!-- we will also add show, edit, and delete buttons -->
                <td>
    
                    <a class="" href="{{ URL::to('material/' . $value->material->id . '/edit') }}"><i class="fa fa-edit"></i></a>
                    {{-- <a href="#" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this material?')) { document.getElementById('deleteForm{{$value->material->id}}').submit(); }">
                        <i class="fa fa-trash"></i>
                    </a> --}}
                    
                    <form id="deleteForm{{$value->material->id}}" action="{{ route('material.destroy', $value->material->id) }}" method="post" style="display: none;">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-small btn-warning">Delete this material</button>
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
<script>
    $(document).ready(function() {
        $('#category').change(function() {
            var categoryId = $(this).val();
            var materialsSelect = $('#material');
            materialsSelect.empty(); // Clear previous materials
            materialsSelect.append('<option value="">Select a Material</option>'); // Add default option
            
            if (categoryId) {
                @foreach ($materials as $material)
                    if ({{ $material->category_id }} == categoryId) {
                        var materialOption = $('<option>').text("{{ $material->name }}").val("{{ $material->id }}");
                        materialsSelect.append(materialOption);
                    }
                @endforeach
            }
        });

        document.getElementById('qty').addEventListener('input', function() {
            const regex = /^\d{0,4}(?:\.\d{0,2})?$/;
            const inputValue = this.value;
            
            if (!regex.test(inputValue)) {
                this.value = inputValue.slice(0, -1);
                alert('Please enter a valid two-digit decimal number.');
            }
        });
    });
</script>
@stop