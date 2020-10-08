<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total user</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">13302</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah outlet</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">4</div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- Content Row -->

  <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex align-items-center bd-highlight mb-3">
        <h6 class="mr-auto font-weight-bold text-primary">Menu Terbeli</h6>
        <!-- <div class="d-flex flex-row-reverse bd-highlight"> -->
        <!-- Bulan -->
        <div class="dropdown px-2 bd-highlight">
          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Select month
          </button>
          <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">January</a>
            <a class="dropdown-item" href="#">February</a>
            <a class="dropdown-item" href="#">March</a>
            <a class="dropdown-item" href="#">April</a>
            <a class="dropdown-item" href="#">May</a>
            <a class="dropdown-item" href="#">June</a>
            <a class="dropdown-item" href="#">July</a>
            <a class="dropdown-item" href="#">August</a>
            <a class="dropdown-item" href="#">September</a>
            <a class="dropdown-item" href="#">October</a>
            <a class="dropdown-item" href="#">November</a>
            <a class="dropdown-item" href="#">December</a>
          </div>
        </div>
        <!-- Tahun -->
        <div class="dropdown px-2 bd-highlight">
          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Select year
          </button>
          <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </div>
      </div>
      <!-- </div> -->

      <!-- Card Body -->
      <div class="card-body">
        <div class="chart-area">
          <canvas id="myAreaChart"></canvas>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->