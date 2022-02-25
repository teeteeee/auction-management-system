<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= ROOT ?>/dashboard/admin/"> 
        <div class="sidebar-brand-text mx-3"> Admin Dashboard</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="<?= ROOT ?>/dashboard/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
            aria-expanded="true" aria-controls="collapseUsers">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="users"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage User:</h6>
                <a class="collapse-item" href="<?= ROOT ?>/dashboard/admin/users">List</a>
                <a class="collapse-item" href="<?= ROOT ?>/dashboard/admin/users/add.php">Add</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseItems"
            aria-expanded="true" aria-controls="collapseItems">
            <i class="fas fa-fw fa-gifts"></i>
            <span>Items</span>
        </a>
        <div id="collapseItems" class="collapse" aria-labelledby="items"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= ROOT ?>/dashboard/admin/items">List</a>
                <a class="collapse-item" href="<?= ROOT ?>/dashboard/admin/items/add.php">Add</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuctions"
            aria-expanded="true" aria-controls="collapseAuctions">
            <i class="far fa-fw fa-clock"></i>
            <span>Auctions</span>
        </a>
        <div id="collapseAuctions" class="collapse" aria-labelledby="auctions"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= ROOT ?>/dashboard/admin/auctions">List</a>
                <a class="collapse-item" href="<?= ROOT ?>/dashboard/admin/auctions/add.php">Add</a>
                
            </div>
        </div>
    </li>
</ul>