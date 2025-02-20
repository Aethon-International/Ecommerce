<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Fruitables - Vegetable Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

       @include('frontend.css')
    </head>

    <body>
        @include('sweetalert::alert')

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


       @include('frontend.navbar')


<!-- Cart Page Start -->
<div class="container-fluid py-5"  style="margin-top: 100px">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Products</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
               
                    
            
                <tbody>
                 
                        
                   
                    <tr>
                        @foreach ($cart as $cart )
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                <img src="/storage/{{$cart->image}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4">{{ $cart->product_title }}</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">{{ $cart->price }} $</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">{{ $cart->quantity }} </p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">{{ $cart->quantity *  $cart->price }} $</p>
                        </td>
                        <td>
                            <a href="{{ url('/remove/cart',$cart->id) }}" class="btn btn-md rounded-circle bg-light border mt-4" >
                                <i class="fa fa-times text-danger"></i>
                            </a>
                        </td>
                    
                    </tr>
                  
                            
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
          
        </div>
        <div class="mt-5">
            <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
        </div>
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0">${{ $subtotal }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <div class="">
                                <p class="mb-0">Flat rate: $0.00</p>
                            </div>
                        </div>
                        <p class="mb-0 text-end">{{ $user->address }}.</p>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4">${{ $subtotal }}</p>
                    </div>
                    <a href="{{ url('/cash/order') }}" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->


     
       @include('frontend.footer')

      

       @include('frontend.copywrite')

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
   @include('frontend.js')
    </body>

</html>