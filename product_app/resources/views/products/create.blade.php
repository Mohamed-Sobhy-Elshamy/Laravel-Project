@extends('products.layout')

@section('content')

<div class="row mt-3">
    <div class="col align-self-start">
      <a class="btn btn-primary" href="{{route('products.index')}}">All Product</a>
    </div>
</div>
<br />

{{-- handle ERROR --}}
@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach ($errors->all() as $item)
            <li>{{$item}}</li>
        @endforeach
    </ul>
</div>    
@endif

<div class="container p-3">
    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        {{-- multipart/form-data => لرفع الصور --}}
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Details</label>
            <textarea class="form-control" name="details"rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form> 
</div>




@endsection