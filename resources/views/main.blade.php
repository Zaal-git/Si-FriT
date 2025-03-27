@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-3 p-3 text-white bg-secondary">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">0</h4>
                            <p class="mb-0">Total Server Terdaftar</p>
                        </div>
                        <i class="ti ti-box fs-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-3 p-3 text-white bg-success">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">3</h4>
                            <p class="mb-0">Total Jaringan Terdaftar</p>
                        </div>
                        <i class="ti ti-tags fs-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-3 p-3 text-white bg-warning">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">0</h4>
                            <p class="mb-0">Total Pengajuan Masuk</p>
                        </div>
                        <i class="ti ti-refresh fs-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-3 p-3 text-white bg-primary">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">0</h4>
                            <p class="mb-0">Pengajuan Yang Sedang Di Proses</p>
                        </div>
                        <i class="ti ti-box fs-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-3 p-3 text-white bg-info">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">0</h4>
                            <p class="mb-0">Pengajuan Disetujui</p>
                        </div>
                        <i class="ti ti-box fs-1"></i>
                    </div>
                </div>
            </div>

          <div class="col-lg-12">
            <div class="card shadow-sm p-4 rounded-3">
              <div class="card-body">
                <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                  Traffic Overview
                  <span>
                    <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success" data-bs-title="Traffic Overview"></iconify-icon>
                  </span>
                </h5>
                <div id="traffic-overview"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by Distributed by UPA TIK TEAM</p>
        </div>
</div>
@include('layouts.footer')
    
