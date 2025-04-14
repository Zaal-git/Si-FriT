@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Pengajuan - Jaringan</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServerModal">Tambah Server</button>
                    </div>
                    <div class="card-body">
                        <table id="dataTables" class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    
@include('layouts.footer')
    
