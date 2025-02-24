<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, admin, dashboard, template">

	<title>NobleUI - Admin Dashboard</title>

  @include('admin.css')
</head>
<body>
   
	<div class="main-wrapper">

	@include('admin.sidebar')
	
		<div class="page-wrapper">
			@include('admin.navbar')

			<div class="page-content">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif




                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">All Products</h6>
                                <div class="table-responsive">
                                    <table id="dataTableExample" class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Original Price</th>
                                                <th>Quantity</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($product as $products)
                                            <tr>
                                                <td>{{ $products->id }}</td>
                                                <td>{{ $products->name }}</td>
                                                <td>{{ $products->description }}</td>
                                                <td>{{ $products->category_id }}</td> <!-- Make sure category_name is stored in DB -->
                                                <td>{{ $products->price }}</td>
                                                <td>{{ $products->original_price }}</td>
                                                <td>{{ $products->quantity }}</td>
                                                <td>
                                                  
                                                  <!-- Assuming you have a product object passed to the view -->
                                                  <img class="image_size" src="/product/{{$products->image}}" >
                                                  
                                                </td>
                                                <td>{{ $products->status }}</td>
                                                <td>
                                                    <a href="{{ url('/edit/product/' . $products->id) }}" class="btn btn-primary btn-sm">Update</a>
                                                </td>
                                                <td>
                                                    <form action="{{ url('/delete/product/'.$products->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

              

            @include('admin.footer')
        </div>
    </div>

    @include('admin.js')
 
	
</body>
</html>
