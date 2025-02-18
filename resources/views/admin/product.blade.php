<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_admin
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">

<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>NobleUI - HTML Bootstrap 5 Admin Dashboard Template</title>

    <!-- Fonts -->
    @include('admin.css')
</head>

<body>
   
    <div class="main-wrapper">

        @include('admin.sidebar')

        <div class="page-wrapper">

            @include('admin.navbar')

            <div class="page-content">

                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">ADD PRODUCT FORM</h6>
                
                                <form class="forms-sample" action="{{ url('/add/product') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <!-- Left Column -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="exampleInputUsername1" class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control" id="exampleInputUsername1" required autocomplete="off" placeholder="Add Product Name Here">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputUsername1" class="form-label">Price</label>
                                                <input type="text" name="price" class="form-control" id="exampleInputUsername1" required autocomplete="off" placeholder="Add Price Here">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputUsername1" class="form-label">Original Price</label>
                                                <input type="text" name="original_price" class="form-control" id="exampleInputUsername1" required autocomplete="off" placeholder="Add Original Price Here">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputUsername1" class="form-label">Quantity</label>
                                                <input type="text" name="quantity" class="form-control" id="exampleInputUsername1" required autocomplete="off" placeholder="Add Quantity Here">
                                            </div>
                                        </div>
                
                                        <!-- Right Column -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">Category</label>
                                                <select name="category_id" class="form-control" id="category_id" required>
                                                    <option value="" disabled selected>Select Category</option>
                                                    @foreach($category as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputUsername1" class="form-label">Description</label>
                                                <input type="text" name="description" class="form-control" id="exampleInputUsername1" required autocomplete="off" placeholder="Add Description Here">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputUsername1" class="form-label">Image</label>
                                                <input type="file" name="image" class="form-control" id="exampleInputUsername1" required autocomplete="off">
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" class="form-control" id="status">
                                                    <option value="active" selected>Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

       
                	<div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">All Categoriese</h6>
                   
                    <div class="table-responsive">
                      <table id="dataTableExample" class="table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Delete</th>
        
                          </tr>
                        </thead>
                        <tbody>
                         
                                <tr>
                                    <td>l</td>
                                    <td>cxvcx</td>
                                    <td>dss</td>
                                    <td>
                                        <a href="" 
                                           onclick="return confirm('Are you sure you want to delete this category?')"
                                           class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                           
                        </tbody>
                        
                      </table>
                    </div>
                  </div>
                </div>
                        </div>
                    </div>
    
                  </div>
                </div>
                        </div>

                </div>

                @include('admin.footer')

            </div>
        </div>

        <!-- core:js -->
        @include('admin.js')

</body>

</html>
