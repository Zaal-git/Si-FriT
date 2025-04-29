<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SI-FrIT</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/Si-FRiT-logo.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="  https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css  ">
  <link rel="stylesheet" href="  https://cdn.datatables.net/2.2.2/css/dataTables.uikit.css  ">
  <style>
    .stat-card {
        transition: all 0.3s ease;
        border-radius: 10px;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    .symbol {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        border-radius: 8px;
    }
    .badge {
        display: inline-flex;
        align-items: center;
    }
</style>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">