<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>


@if(session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success')}}
</div>
@endif


@if(session('error'))
<div class="alert alert-danger  " role="alert">
    {{ session('error')}}
</div>
@endif

<br>
Hello {{ auth()->check() ? auth()->user()->name : ''}}



<a href='{{ route("product.create")}}'  class="btn btn-secondary">Create</button>
<br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">S.N</th>
      <th scope="col">Name</th>
      <th scope="col">price</th>
      <th scope="col">description</th>
      <th scope="col">Quantity</th>
      <th scope="col">status</th>
      <th scope="col">category</th>
      <th scope="col">image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  @forelse($products as $product)
  <tr>
      <th scope="row">{{ $loop->iteration}}</th>
      <td>{{ $product->name ?? ''}}</td>
      <td>{{ $product->price ?? ''}}</td>
      <td>{{ $product->description ?? ''}}</td>
      <td>{{ $product->quantity ?? ''}}</td>
      <td>{{ $product->status ?? ''}}</td>
      <td>{{ $product->category ?? ''}}</td>
    
      <td> <a href=" {{ asset('uploads').'/'.$product->image }}" target='_blank'> <img src="{{ asset('uploads').'/'.$product->image }}" width='100px'  height='100px'> </a></td>
      <td>

      <a href='{{route("product.edit",$product->id)}}'  class='btn btn-primary'> EDIT </a>
      <a href='{{route("product.delete",$product->id)}}'  class='btn btn-danger'> DELETE </a>
      </td>
    </tr>
 
  @empty
  <td> No Data</td>
  @endforelse
  </tbody>
</table>
    
</body>
</html>