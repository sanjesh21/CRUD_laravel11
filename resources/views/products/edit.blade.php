<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="main">
        <div class="bg-dark py-3">
            <h2 class="text-white text-center">Laravel CRUD task</h1>
        </div>
       <form enctype="multipart/form-data" action="{{route('products.update',$product->id)}}" method="POST">
        @method('put')
        @csrf
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-md-10 d-flex justify-content-end">
                  <a href="{{route('products.index')}}" class="btn btn-dark">Products</a>
                </div>
              </div>
            <div class="row d-fex justify-content-center">
                <div class="col-md-10">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header">
                            <h3>Edit Product</h2>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="">Name</label>
                                <input value="{{old('name',$product->name)}}" type="text" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="Name" name="name">
                                @error('name')
                                <p class="invalid-feedback">{{$message}}</p>                                    
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">SKU</label>
                                <input value="{{old('sku',$product->sku)}}"type="text" class="@error('sku') is-invalid @enderror form-control form-control-lg" placeholder="SKU" name="sku">
                                @error('sku')
                                <p class="invalid-feedback">{{$message}}</p>                                    
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">price</label>
                                <input value="{{old('price',$product->price)}}"type="number" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="Price" name="price">
                                @error('price')
                                <p class="invalid-feedback">{{$message}}</p>                                    
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Description</label>
                                <textarea placeholder="Description" cols="30" rows="5" class="form-control form-control-lg" name="description">{{ old('description', $product->description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Image</label>
                                <input type="file" class="form-control form-control-lg" name="image" placeholder="Choose image file..">
                                @if ($product->image != "")
                                    <img src="{{ asset('uploads/products/'.$product->image) }}" width="100" height="100" alt="{{ $product->image }}">
                                @endif
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-dark">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </form>
    </div>
  </body>
</html>