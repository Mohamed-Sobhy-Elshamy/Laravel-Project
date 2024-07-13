@extends('products.layout')

@section('content')

<div class="row mt-3">
    <div class="col align-self-start">
      <a class="btn btn-primary" href="{{route('products.index')}}">All Product</a>
    </div>
</div>
<br />

<div class="container p-3">
        {{-- multipart/form-data => لرفع الصور --}}
        @csrf
        @method('PUT')
        

        <div style="text-align: center; font-family: Arial, sans-serif; margin: 20px;">
            <h3 style="color: #333; margin-bottom: 10px;">Name: {{$product->name}}</h3>
            <hr style="border: 1px solid #ddd; width: 50%; margin: 10px auto;">
        
            <div style="margin: 20px 0;">
                <h3 style="color: #333; margin-bottom: 10px;">Details: {{$product->details}}</h3>
                <hr style="border: 1px solid #ddd; width: 50%; margin: 10px auto;">
            </div>
        
            <div>
                <h3 style="color: #333; margin-bottom: 10px;">Image:</h3>
                <img src="/images/{{$product->image}}" style="width: 300px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            </div>
        </div>
        

        

</div>




@endsection