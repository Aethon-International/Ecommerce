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
                                                <th> customer Name</th>
                                                <th> customer phone</th>
                                                <th> customer address</th>
                                                
                                                <th>Product title</th>
                                                <th>quantity</th>
                                                <th>Price</th>
                                                <th>User id</th>
                                                
                                                <th>Image</th>
                                                <th>payment Status</th>
                                                <th>delivery  Status</th>
                                                <th>Update</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->name }}</td>
                                                <td>{{ $order->phone }}</td>
                                                <td>{{ $order->address }}</td>
                                                <td>{{ $order->product_title }}</td>
                                                <td>{{ $order->quantity }}</td> <!-- Make sure category_name is stored in DB -->
                                                <td>{{ $order->price }}</td>
                                                <td>{{ $order->user_id }}</td>
                                                <td>
                                                    @if($order->image)
                                                        <img src="/product/{{$order->image}}" width="100">
                                                    @else
                                                        <p>No Image</p>
                                                    @endif
                                                </td>
                                                <td>{{ $order->payment_status }}</td>
                                                <td>{{ $order->delivery_status }}</td>
                                             
                                                
                                               
                                                <td>
                                                    <form action="{{ url('update/order/status', $order->id) }}" method="POST">
                                                        @csrf
                                                        <select name="delivery_status" onclick="confirm" class="form-select" onchange="this.form.submit()">
                                                            <option value="pending" {{ $order->delivery_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="shipped" {{ $order->delivery_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                            <option value="delivered" {{ $order->delivery_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                            <option value="cancelled" {{ $order->delivery_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                        </select>
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
