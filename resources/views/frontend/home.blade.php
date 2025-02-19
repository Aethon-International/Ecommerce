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

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


       @include('frontend.navbar')


       @include('frontend.modal')


       @include('frontend.hero')



       @include('frontend.feature')


      
       @include('frontend.shop')

       
       @include('frontend.items')

       
       @include('frontend.freshorganic')

      

       @include('frontend.bestseller')


       @include('frontend.fact')

       
       @include('frontend.testimonial')


       @include('frontend.footer')

      

       @include('frontend.copywrite')

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
   @include('frontend.js')
    </body>

</html>