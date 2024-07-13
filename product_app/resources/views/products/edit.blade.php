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
    <form action="{{route('products.update', $product->id)}}" method="post" enctype="multipart/form-data">
        {{-- multipart/form-data => لرفع الصور --}}
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{$product->name}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Details</label>
            <textarea class="form-control" name="details"rows="3">
                {{$product->details}}
            </textarea>
        </div>
        <div class="mb-3">
            <img src="/images/{{$product->image}}" width="300px">
            <label for="" class="form-label"></label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>

    </form> 
</div>




@endsection