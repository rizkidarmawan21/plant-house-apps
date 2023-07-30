<!-- Sidebar -->
<div class="border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
        <img src="/images/dashboard-store-logo.svg" alt="" class="my-4" />
    </div>
    <div class="list-group list-group-flush">
        <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action ">Dashboard</a>
        <a href="{{ route('admin.category.index') }}" class="list-group-item list-group-item-action">Category Product</a>
        <a href="{{ route('admin.product.index') }}" class="list-group-item list-group-item-action">My
            Products</a>
        <a href="{{ route('admin.transaction.index') }}" class="list-group-item list-group-item-action">Transactions</a>
        <a href="{{ route('admin.article.index') }}" class="list-group-item list-group-item-action">Article</a>
    </div>
</div>
<!-- /#sidebar-wrapper -->
