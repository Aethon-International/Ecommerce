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
                    <h6 class="card-title">All Categoriese</h6>
                   
                    <div class="table-responsive">
                      <table id="dataTableExample" class="table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Messages</th>
        
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($contact as $contact)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->messages }}</td>
                                    
                                </tr>
                            @endforeach
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
