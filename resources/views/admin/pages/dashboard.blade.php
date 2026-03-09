@extends('admin.layouts.app')

@section('content')

<style>
.dashboard-page {
    padding: 30px;
    background: #f3f6fb;
    min-height: 100vh;
}

/* Header */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.dashboard-header h3 {
    font-weight: 700;
    color: #111827;
}

.dashboard-header span {
    color: #6b7280;
    font-size: 14px;
}

/* KPI Cards */
.kpi-card {
    background: #fff;
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
}

.kpi-card::after {
    content: '';
    position: absolute;
    right: -20px;
    bottom: -20px;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    opacity: 0.15;
}

.kpi-blue::after { background: #2563eb; }
.kpi-green::after { background: #16a34a; }
.kpi-orange::after { background: #f97316; }

.kpi-title {
    font-size: 13px;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.kpi-value {
    font-size: 36px;
    font-weight: 700;
    color: #111827;
}

.kpi-icon {
    font-size: 30px;
    margin-top: 15px;
}

/* Section Card */
.section-card {
    background: #fff;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

/* Activity */
.activity-item {
    display: flex;
    gap: 12px;
    margin-bottom: 15px;
}

.activity-dot {
    width: 10px;
    height: 10px;
    background: #2563eb;
    border-radius: 50%;
    margin-top: 6px;
}

.activity-text {
    font-size: 14px;
    color: #374151;
}

/* Quick Actions */
.quick-btn {
    width: 100%;
    border-radius: 12px;
    padding: 12px;
    font-weight: 600;
}
</style>

<div class="dashboard-page">

    <!-- Header -->
    <div class="dashboard-header">
        <div>
            <h3>Admin Dashboard</h3>
            <span>Overview of your store</span>
        </div>
        <img src="{{ asset('asset/img/logo.png') }}" height="40">
    </div>

    <!-- KPI -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="kpi-card kpi-blue">
                <div class="kpi-title">Categories</div>
                <div class="kpi-value">{{ $categoryCount }}</div>
                <div class="kpi-icon">📂</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="kpi-card kpi-blue">
                <div class="kpi-title">Sub Categories</div>
                <div class="kpi-value">{{ $subcategoryCount }}</div>
                <div class="kpi-icon">🗂️</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="kpi-card kpi-green">
                <div class="kpi-title">Products</div>
                <div class="kpi-value">{{ $productCount }}</div>
                <div class="kpi-icon">📦</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="kpi-card kpi-orange">
                <div class="kpi-title">Enquirys</div>
                <div class="kpi-value">{{ $enquiryCount }}</div>
                <div class="kpi-icon">🧾</div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="kpi-card kpi-orange">
                <div class="kpi-title">Quick Actions</div>
                <a href="{{ route('productpage') }}" class="btn btn-primary quick-btn mb-2">📦 Add Product</a>
                <a href="{{ route('categorypage') }}" class="btn btn-outline-primary quick-btn mb-2">📂 Add Category</a>
                <!-- <a href="#" class="btn btn-outline-dark quick-btn">📊 View Reports</a> -->
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="row g-4">

        <!-- Recent Activity -->
        <!-- <div class="col-lg-8">
            <div class="section-card">
                <h5 class="mb-3">Recent Activity</h5>

                <div class="activity-item">
                    <div class="activity-dot"></div>
                    <div class="activity-text">New product added to Adhesives category</div>
                </div>

                <div class="activity-item">
                    <div class="activity-dot"></div>
                    <div class="activity-text">Order #1023 marked as shipped</div>
                </div>

                <div class="activity-item">
                    <div class="activity-dot"></div>
                    <div class="activity-text">Category “Industrial Tools” updated</div>
                </div>

            </div>
        </div> -->

        <!-- Quick Actions -->
        

    </div>

</div>

@endsection
