<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="images/image-Picsart-BackgroundRemover.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/datatable.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="sticky-top">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="images/image-Picsart-BackgroundRemover.png" alt="logo" class="logo h-100 d-inline-block align-text-top">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                 <a class="nav-link active" aria-current="page" href="./index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="inquires.html">Inquires</a>
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
             <a href="inquiryform.html" class="list-group-item list-group-item-action">
                  <i class="fa-solid fa-users"></i> Add Inquiry
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
      <a class="dropdown-item" href="faculty.html">
        <i class="fa-solid fa-chalkboard-user me-2"></i> Faculty
      </a>
    </li>
    <li>
      <a class="dropdown-item" href="./student.html">
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
          <div class="list-group list-group-flush">
            <button type="button" class="list-group-item list-group-item-action"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
          </div>

        </div>
      </div>
      @extends('dashboard.layouts.app')

@section('content')
      <!--======================================= Content Area Start =================================================-->
      <div class="container-fluid">
        <div class="row py-4">
    <div class="col-12 col-md-12 col-lg-3 d-flex">
        <div class="card mb-3 border-primary-subtle flex-fill">
            <div class="row g-0 d-flex align-items-center h-100">
              <div class="col-md-4 d-flex justify-content-center">
                <i class="fa-solid fa-users fa-5x m-2 text-primary"></i>
              </div>
              <div class="col-md-8 d-flex flex-column">
                <div class="card-body flex-grow-1 d-flex flex-column">
                  <h5 class="card-title text-primary">Inquires</h5>
                  <p class="card-text flex-grow-1">This is a wider card with supporting text.</p>
                  <p class="card-text mt-auto"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-3 d-flex">
        <div class="card mb-3 border-success-subtle flex-fill">
            <div class="row g-0 d-flex align-items-center h-100">
              <div class="col-md-4 d-flex justify-content-center">
                <i class="fa-solid fa-building-columns fa-5x m-3 text-success"></i>
              </div>
              <div class="col-md-8 d-flex flex-column">
                <div class="card-body flex-grow-1 d-flex flex-column">
                  <h5 class="card-title text-success">Departments</h5>
                  <p class="card-text flex-grow-1">Explore all university departments and faculties.</p>
                  <p class="card-text mt-auto"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-3 d-flex">
        <div class="card mb-3 border-danger-subtle flex-fill">
            <div class="row g-0 d-flex align-items-center h-100">
              <div class="col-md-4 d-flex justify-content-center">
                <i class="fa-solid fa-user-graduate fa-5x m-2 text-danger"></i>
              </div>
              <div class="col-md-8 d-flex flex-column">
                <div class="card-body flex-grow-1 d-flex flex-column">
                  <h5 class="card-title text-danger">Admissions</h5>
                  <p class="card-text flex-grow-1">Check admission criteria,<br>apply online.</p>
                  <p class="card-text mt-auto"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-3 d-flex">
        <div class="card mb-3 border-warning-subtle flex-fill">
            <div class="row g-0 d-flex align-items-center h-100">
              <div class="col-md-4 d-flex justify-content-center">
                <i class="fa-solid fa-book-reader fa-5x m-3 text-warning"></i>
              </div>
              <div class="col-md-8 d-flex flex-column">
                <div class="card-body flex-grow-1 d-flex flex-column">
                  <h5 class="card-title text-warning">Library</h5>
                  <p class="card-text flex-grow-1">Access books, e-resources, and research materials.</p>
                  <p class="card-text mt-auto"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

      </div>
      <div class="container-fluid">
        <div class="row mb-5">
          <div class="col-lg-12">
            <div class="card">
              <h5 class="card-header">Last List</h5>
              <div class="card-body">

                <table id="example" class="table table-striped" style="width:100%">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Department</th>
                          <th>Age</th>
                          <th>Phone no</th>
                          <th>ID Card</th>
                          <th>Matric Marks</th>
                          <th>Part 1 marks</th>
                          <th>Part 2 marks</th>
                          <th>Entry test marks</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                         <td>Ali Khan</td>
                         <td>Computer Science</td>
                         <td>15</td>
                         <td>0301-1234567</td>
                         <td>35202-1234567-1</td>
                         <td>895</td>
                         <td>450</td>
                         <td>445</td>
                         <td>78</td>
                       </tr>

                     <tr>
                       <td>Ahmed Raza</td>
                       <td>Pre-Engineering</td>
                       <td>15</td>
                       <td>0312-7654321</td>
                       <td>35201-9876543-2</td>
                       <td>870</td>
                       <td>435</td>
                       <td>435</td>
                       <td>72</td>
                    </tr>

                    <tr>
                       <td>Sara Malik</td>
                       <td>Pre-Medical</td>
                       <td>15</td>
                       <td>0333-1122334</td>
                       <td>35203-2233445-3</td>
                       <td>910</td>
                       <td>460</td>
                       <td>450</td>
                       <td>85</td>
                    </tr>

                    <tr>
                      <td>Ayesha Noor</td>
                      <td>Arts</td>
                      <td>15</td>
                      <td>0345-5566778</td>
                      <td>35204-5566778-4</td>
                      <td>840</td>
                      <td>420</td>
                      <td>420</td>
                      <td>68</td>
                     </tr>

                     <tr>
                       <td>Hassan Ali</td>
                       <td>Computer Science</td>
                       <td>15</td>
                       <td>0321-9988776</td>
                       <td>35205-9988776-5</td>
                       <td>880</td>
                       <td>440</td>
                       <td>440</td>
                       <td>75</td>
                     </tr>

                     <tr>
                       <td>Fatima Zahra</td>
                       <td>Pre-Medical</td>
                       <td>15</td>
                       <td>0309-3344556</td>
                       <td>35206-3344556-6</td>
                       <td>925</td>
                       <td>470</td>
                       <td>455</td>
                       <td>90</td>
                     </tr>

                     <tr>
                       <td>Usman Tariq</td>
                       <td>Pre-Engineering</td>
                       <td>15</td>
                       <td>0342-7788990</td>
                       <td>35207-7788990-7</td>
                       <td>860</td>
                       <td>430</td>
                       <td>430</td>
                       <td>70</td>
                     </tr>

                     <tr>
                       <td>Maryam Iqbal</td>
                       <td>Arts</td>
                       <td>15</td>
                       <td>0315-6677889</td>
                       <td>35208-6677889-8</td>
                       <td>845</td>
                       <td>425</td>
                       <td>420</td>
                       <td>69</td>
                     </tr>

                     <tr>
                       <td>Bilal Ahmed</td>
                       <td>Computer Science</td>
                       <td>15</td>
                       <td>0336-2211334</td>
                       <td>35209-2211334-9</td>
                       <td>890</td>
                       <td>445</td>
                       <td>445</td>
                       <td>77</td>
                     </tr>

                     <tr>
                       <td>Zain Abbas</td>
                       <td>Pre-Engineering</td>
                       <td>15</td>
                       <td>0307-8899001</td>
                       <td>35210-8899001-0</td>
                       <td>865</td>
                       <td>430</td>
                       <td>435</td>
                       <td>71</td>
                     </tr>

                     <tr>
                       <td>Noor Fatima</td>
                       <td>Pre-Medical</td>
                       <td>15</td>
                       <td>0324-5566001</td>
                       <td>35211-5566001-1</td>
                       <td>905</td>
                       <td>455</td>
                       <td>450</td>
                       <td>84</td>
                     </tr>

                     <tr>
                       <td>Hamza Shah</td>
                       <td>Computer Science</td>
                       <td>15</td>
                       <td>0319-3344778</td>
                       <td>35212-3344778-2</td>
                       <td>875</td>
                       <td>438</td>
                       <td>437</td>
                       <td>73</td>
                     </tr>

                     <tr>
                       <td>Iqra Nadeem</td>
                       <td>Arts</td>
                       <td>15</td>
                       <td>0348-1122998</td>
                       <td>35213-1122998-3</td>
                       <td>830</td>
                       <td>415</td>
                       <td>415</td>
                       <td>65</td>
                     </tr>

                     <tr>
                       <td>Saad Ullah</td>
                       <td>Pre-Engineering</td>
                       <td>15</td>
                       <td>0305-7788112</td>
                       <td>35214-7788112-4</td>
                       <td>855</td>
                       <td>425</td>
                       <td>430</td>
                       <td>69</td>
                     </tr>

                     <tr>
                       <td>Hira Salman</td>
                       <td>Pre-Medical</td>
                       <td>15</td>
                       <td>0331-4455667</td>
                       <td>35215-4455667-5</td>
                       <td>920</td>
                       <td>465</td>
                       <td>455</td>
                       <td>88</td>
                     </tr>

                     <tr>
                       <td>Abdullah Noor</td>
                       <td>Computer Science</td>
                       <td>15</td>
                       <td>0320-6677009</td>
                       <td>35216-6677009-6</td>
                       <td>885</td>
                       <td>440</td>
                       <td>445</td>
                       <td>76</td>
                     </tr>

                     <tr>
                       <td>Laiba Ahmed</td>
                       <td>Arts</td>
                       <td>15</td>
                       <td>0341-9988775</td>
                       <td>35217-9988775-7</td>
                       <td>835</td>
                       <td>418</td>
                       <td>417</td>
                       <td>66</td>
                     </tr>

                     <tr>
                       <td>Shayan Malik</td>
                       <td>Pre-Engineering</td>
                       <td>15</td>
                       <td>0308-2233449</td>
                       <td>35218-2233449-8</td>
                       <td>868</td>
                       <td>434</td>
                       <td>434</td>
                       <td>72</td>
                     </tr>

                     <tr>
                       <td>Anaya Rizvi</td>
                       <td>Pre-Medical</td>
                       <td>15</td>
                       <td>0339-5566889</td>
                       <td>35219-5566889-9</td>
                       <td>915</td>
                       <td>460</td>
                       <td>455</td>
                       <td>86</td>
                     </tr>

                     <tr>
                       <td>Rehan Siddiq</td>
                       <td>Computer Science</td>
                       <td>15</td>
                       <td>0316-8899443</td>
                       <td>35220-8899443-0</td>
                       <td>878</td>
                       <td>439</td>
                       <td>439</td>
                       <td>74</td>
                     </tr>

                  </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection


    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="js/datatable.js"></script>
    <script src="js/datatable.bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Buttons JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.9/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.9/js/buttons.colVis.min.js"></script>

    <script src="js/custom.js"></script>
</body>
</html>
