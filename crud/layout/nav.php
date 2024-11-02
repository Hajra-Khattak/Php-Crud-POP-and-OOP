<nav
    class="nav justify-content-start bg-dark text-light mb-3 py-2 ">

<!-- Nav tabs -->
<ul
    class="nav  "
    id="navId"
    role="tablist">
    <li class="nav-item">
        <a
            href="#tab1Id"
            class="nav-link active "
            data-bs-toggle="tab"
            aria-current="page">Active</a>
    </li>
    <li class="nav-item dropdown">
        <a
            class="nav-link  text-light"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="true"
            aria-expanded="false">Dropdown</a>
        
    </li>
    <li class="nav-item" role="presentation">
        <a href="#tab5Id" class="nav-link text-light" data-bs-toggle="tab">Another link</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="#" class="nav-link text-light" data-bs-toggle="tab">Disabled</a>
    </li>
</ul>
</nav>

<!-- Tab panes -->
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="tab1Id" role="tabpanel">

    </div>
    <div class="tab-pane fade" id="tab2Id" role="tabpanel"></div>
    <div class="tab-pane fade" id="tab3Id" role="tabpanel"></div>
    <div class="tab-pane fade" id="tab4Id" role="tabpanel"></div>
    <div class="tab-pane fade" id="tab5Id" role="tabpanel"></div>
</div>

<!-- (Optional) - Place this js code after initializing bootstrap.min.js or bootstrap.bundle.min.js -->
<script>
    var triggerEl = document.querySelector("#navId a");
    bootstrap.Tab.getInstance(triggerEl).show(); // Select tab by name
</script>