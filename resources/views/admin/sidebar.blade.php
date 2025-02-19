	<!-- partial:partials/_sidebar.html -->
    <nav class="sidebar">
        <div class="sidebar-header">
          <a href="#" class="sidebar-brand">
            Noble<span>UI</span>
          </a>
          <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
        <div class="sidebar-body">
          <ul class="nav">
           
                <span class="link-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item nav-category">categories</li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                <i class="link-icon" data-feather="mail"></i>
                <span class="link-title">categoriese</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="emails">
                <ul class="nav sub-menu">
                  <li class="nav-item">
                    <a href="{{ url('/category') }}" class="nav-link">Add Categoriese</a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/products') }}" class="nav-link">Add Products</a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/all/products') }}" class="nav-link">All Products</a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item nav-category">producs</li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                <i class="link-icon" data-feather="mail"></i>
                <span class="link-title">Email</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="emails">
                <ul class="nav sub-menu">
                  <li class="nav-item">
                    <a href="pages/email/inbox.html" class="nav-link">Inbox</a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/email/read.html" class="nav-link">Read</a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/email/compose.html" class="nav-link">Compose</a>
                  </li>
                </ul>
              </div>
            </li>
           
            
             
          
          </ul>
        </div>
      </nav>
      <nav class="settings-sidebar">
        <div class="sidebar-body">
          <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
          </a>
          <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Theme:</h6>
            <a class="theme-item" href="../demo1/dashboard.html">
              <img src="../assets/images/screenshots/light.jpg" alt="light theme">
            </a>
            <h6 class="text-muted mb-2">Dark Theme:</h6>
            <a class="theme-item active" href="../demo2/dashboard.html">
              <img src="../assets/images/screenshots/dark.jpg" alt="light theme">
            </a>
          </div>
        </div>
      </nav>
          <!-- partial -->