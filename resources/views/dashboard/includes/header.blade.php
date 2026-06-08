<div class="sticky-top">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="{{ asset('faculty_pictures/nfc.png') }}" alt="logo" class="logo h-100 d-inline-block align-text-top">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                 <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('inquires') }}">Inquires</a>
              </li>

            </ul>
          </div>
          <div class="d-flex" >
            <div class="btn-group mx-2" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-warning"><i class="fa-solid fa-user"></i></button>
              <button type="button" class="btn btn-outline-warning">Admin</button>
            </div>
            <a class="btn btn-light border border-1" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </a>
        </div>
        </div>
    </nav>
  </div>

      <div class="container-fluid pt-1 bg-dark"></div>
     <!--========================================== Off Canvas================================================== -->
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasExampleLabel">Dashboard Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div class="list-group list-group-flush">
            <button type="button" class="list-group-item list-group-item-action"><i class="fa-solid fa-house"></i> Dashboard</button>
          </div>
          <!-- accordian single -->
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fa-solid fa-user-group"></i>&nbsp; Inquires
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <div class="list-group list-group-flush">

                        <!-- Add Inquiry -->
                        <a href="{{ route('inquiryform') }}" class="list-group-item list-group-item-action">
                            <i class="fa-solid fa-user-plus me-2"></i> Add Inquiry
                        </a>

                        <!-- All Inquiries -->
                        <a href="{{ route('inquires') }}" class="list-group-item list-group-item-action">
                            <i class="fa-solid fa-list me-2"></i> All Inquiries
                        </a>

                    </div>

                </div>
            </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <i class="fa-solid fa-gear"></i> &nbsp; Departments
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="list-group list-group-flush">
                    <div class="dropdown">
                        <button class="list-group-item list-group-item-action dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                            <i class="fa-solid fa-list me-2"></i> Sub Department
                        </button>

                        <ul class="dropdown-menu w-100">
                            <li>
                            <a class="dropdown-item" href="{{ route('faculty') }}">
                                <i class="fa-solid fa-chalkboard-user me-2"></i> Faculty
                            </a>
                            </li>
                            <li>
                            <a class="dropdown-item" href="{{ route('student') }}">
                                <i class="fa-solid fa-user-graduate me-2"></i> Students
                            </a>
                            </li>
                        </ul>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
            <!-- accordian single -->
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf

                <button type="submit" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
      </div>
