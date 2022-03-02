<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= URL_ADMIN ?>index.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-baby-carriage"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Boo Admin</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?= URL_ADMIN ?>index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Côté Livres
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-book"></i>
        <span>Livres</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion livres</h6>
            <a class="collapse-item" href="<?= URL_ADMIN ?>livres/index.php">Liste des livres</a>
            <a class="collapse-item" href="<?= URL_ADMIN ?>livres/add.php">Ajouter un livre</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?= URL_ADMIN ?>#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-male"></i>
        <span>Auteurs</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion auteurs</h6>
            <a class="collapse-item" href="<?= URL_ADMIN ?>auteur/index.php">Liste des auteurs</a>
            <a class="collapse-item" href="<?= URL_ADMIN ?>auteur/add.php">Ajouter un auteur</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="<?= URL_ADMIN ?>#" data-toggle="collapse" data-target="#categories"
        aria-expanded="true" aria-controls="categories">
        <i class="fas fa-male"></i>
        <span>Catégories</span>
    </a>
    <div id="categories" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion catégories</h6>
            <a class="collapse-item" href="<?= URL_ADMIN ?>categorie/index.php">Liste des catégories</a>
            <a class="collapse-item" href="<?= URL_ADMIN ?>categorie/add.php">Ajouter une catégorie</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="<?= URL_ADMIN ?>#" data-toggle="collapse" data-target="#editeurs"
        aria-expanded="true" aria-controls="editeurs">
        <i class="fas fa-male"></i>
        <span>Editeurs</span>
    </a>
    <div id="editeurs" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion éditeurs</h6>
            <a class="collapse-item" href="<?= URL_ADMIN ?>editeur/index.php">Liste des éditeurs</a>
            <a class="collapse-item" href="<?= URL_ADMIN ?>editeur/add.php">Ajouter un éditeur</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Côté Client
</div>

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="<?= URL_ADMIN ?>utilisateur/index.php">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Utilisateurs</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?= URL_ADMIN ?>#" data-toggle="collapse" data-target="#client"
        aria-expanded="true" aria-controls="client">
        <i class="fas fa-male"></i>
        <span>Usagers</span>
    </a>
    <div id="client" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion catégories</h6>
            <a class="collapse-item" href="<?= URL_ADMIN ?>client/index.php">Liste des usagers</a>
            <a class="collapse-item" href="<?= URL_ADMIN ?>client/add.php">Ajouter un usager</a>
        </div>
    </div>
</li>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?= URL_ADMIN ?>#" data-toggle="collapse" data-target="#location"
        aria-expanded="true" aria-controls="location">
        <i class="fas fa-male"></i>
        <span>Locations</span>
    </a>
    <div id="location" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion locations</h6>
            <a class="collapse-item" href="<?= URL_ADMIN ?>location/index.php">Liste des locations</a>
            <a class="collapse-item" href="<?= URL_ADMIN ?>location/add.php">Ajouter une location</a>
        </div>
    </div>
</li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>



</ul>
<!-- End of Sidebar -->
