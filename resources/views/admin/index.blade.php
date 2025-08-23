@extends('admin.admin_master')
@section('content')

<style>
    .dashboard-card {
        border-radius: 15px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        background: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
    .dashboard-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
    }
    .bg-gradient-blue {
        background: linear-gradient(135deg, #36d1dc, #5b86e5);
    }
    .bg-gradient-orange {
        background: linear-gradient(135deg, #ff7e5f, #feb47b);
    }
    .bg-gradient-green {
        background: linear-gradient(135deg, #56ab2f, #a8e063);
    }
    .bg-gradient-gold {
        background: linear-gradient(135deg, #f7971e, #ffd200);
    }
    .dashboard-title {
        font-size: 16px;
        color: #6c757d;
        margin: 0;
    }
    .dashboard-value {
        font-size: 24px;
        font-weight: bold;
        margin: 0;
        color: #333;
    }
</style>

<div class="container-full">
    <section class="content">
        <div class="row g-4">

            <!-- Jumlah Produk -->
            <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
                <div class="dashboard-card">
                    <div class="dashboard-icon bg-gradient-blue">
                        <i class="mdi mdi-cube-outline"></i>
                    </div>
                    <div>
                        <p class="dashboard-title">Jumlah Produk</p>
                        <p class="dashboard-value">{{ $totalProducts }}</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Pesanan -->
            <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
                <div class="dashboard-card">
                    <div class="dashboard-icon bg-gradient-orange">
                        <i class="mdi mdi-cart-outline"></i>
                    </div>
                    <div>
                        <p class="dashboard-title">Jumlah Pesanan</p>
                        <p class="dashboard-value">{{ $totalOrders }}</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Pelanggan -->
            <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
                <div class="dashboard-card">
                    <div class="dashboard-icon bg-gradient-green">
                        <i class="mdi mdi-account-multiple"></i>
                    </div>
                    <div>
                        <p class="dashboard-title">Jumlah Pelanggan</p>
                        <p class="dashboard-value">{{ $totalCustomers }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Pendapatan -->
            <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
                <div class="dashboard-card">
                    <div class="dashboard-icon bg-gradient-gold">
                        <i class="mdi mdi-cash-multiple"></i>
                    </div>
                    <div>
                        <p class="dashboard-title">Total Pendapatan</p>
                        <p class="dashboard-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

@endsection
