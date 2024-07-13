@extends('products.layout')

@section('content')

<div class="row mt-3">
    <div class="col align-self-start">
      <a class="btn btn-primary" href="{{route('products.create')}}">Create Product</a>
    </div>
</div>
<br />

{{-- عرض الرسالة اللي ف controller -> Store --}}
@if ($message = Session::get('success'))
<div class="alert alert-success" role="alert">
    {{$message}}
</div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-hover table-borderless table-primary align-middle">
        <thead class="table-light">
            
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($products as $item)
                <tr class="table-primary">
                    <td>{{$item->id}}</td>
                    <td> <img src="/images/{{$item->image}}" alt="Image Product" width="300px"></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->details}}</td>
                    <td>

                        @auth
                            <form action="{{ route('products.destroy', $item->id) }}" method="post" style="margin-bottom: 5px;">
                                {{-- للحماية من ال hack --}}
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="display: block; width: 100%;">Delete</button>
                                <a href="{{ route('products.edit', $item->id) }}" class="btn btn-primary" style="display: block; width: 100%; margin-bottom: 5px;">Edit</a>
                            </form>
                        @endauth
                            <a href="{{ route('products.show', $item->id) }}" class="btn btn-info" style="display: block; width: 100%;">Show</a>
                    </td>
                </tr>
            @endforeach
           
            
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>

    {{-- pagination --}}

</div>








    
@endsection

