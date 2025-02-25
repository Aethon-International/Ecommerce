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
                    <th scope="col">Payment</th>
                    <th scope="col">SubTotal</th>
                    <th scope="col">Delivery Status</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
               
                    
            
                <tbody>
                 
                        
                    @foreach ($order as  $order)
                    <tr>
                      
                            
                       
                      
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                <img src="/product/{{$order->image}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4">{{$order->product_title}}</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">{{$order->price}} $</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">{{$order->quantity}} </p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">{{$order->payment_status}}</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">${{$order->quantity *  $order->price}}</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">{{$order->delivery_status}}</p>
                        </td>
                        <td>
                            <a href="{{url('/remove/orders',$order->id)}}" class="btn btn-md rounded-circle bg-light border mt-4" >
                                <i class="fa fa-times text-danger"></i>
                            </a>
                        </td>
                    
                    </tr>
                  
                    @endforeach
                        </td>
                      
                    </tr>
                </tbody>
            </table>
          
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