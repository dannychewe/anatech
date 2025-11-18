<!DOCTYPE html>
<html>
<head>
    <title>Admin - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tiny.cloud/1/vpxsz259t116jjroj9oad3attspm8p16452cnnhpvehznqoj/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            tinymce.init({
                selector: '.rich-text',
                height: 300,
                plugins: 'lists link image table code',
                toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table | code',
                menubar: false,
                branding: false
            });
        });
    </script>

</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
         href="{{ route('admin.dashboard') }}">
        Dashboard
      </a>
    </li>

    <!-- Catalog -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle 
            {{ request()->routeIs('admin.products.*') 
            || request()->routeIs('admin.product_categories.*') 
            || request()->routeIs('admin.services.*') 
            ? 'active' : '' }}"
          href="#" id="catalogDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Catalog
        </a>

        <ul class="dropdown-menu" aria-labelledby="catalogDropdown">

            {{-- Products --}}
            <li>
                <a class="dropdown-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                  href="{{ route('admin.products.index') }}">
                    Products
                </a>
            </li>

            {{-- Product Categories --}}
            <li>
                <a class="dropdown-item {{ request()->routeIs('admin.product_categories.*') ? 'active' : '' }}"
                  href="{{ route('admin.product_categories.index') }}">
                    Product Categories
                </a>
            </li>

            {{-- Services --}}
            <li>
                <a class="dropdown-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
                  href="{{ route('admin.services.index') }}">
                    Services
                </a>
            </li>

        </ul>
    </li>


    <!-- Content -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.blogs.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.tags.*') || request()->routeIs('admin.podcasts.*') || request()->routeIs('admin.testimonials.*') ? 'active' : '' }}"
         href="#" id="contentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Content
      </a>
      <ul class="dropdown-menu" aria-labelledby="contentDropdown">
        <li><a class="dropdown-item {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}"
               href="{{ route('admin.blogs.index') }}">Blogs</a></li>
        <li><a class="dropdown-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
               href="{{ route('admin.categories.index') }}">Categories</a></li>
        <li><a class="dropdown-item {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}"
               href="{{ route('admin.tags.index') }}">Tags</a></li>
        <li><hr class="dropdown-divider"></li>
        <!-- <li><a class="dropdown-item {{ request()->routeIs('admin.podcasts.*') ? 'active' : '' }}"
               href="{{ route('admin.podcasts.index') }}">Podcasts / Videos</a></li> -->
        <li><a class="dropdown-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}"
               href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
      </ul>
    </li>

    <!-- Events & Bookings -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.events.*') || request()->routeIs('admin.bookings.*') ? 'active' : '' }}"
         href="#" id="eventsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Bookings
      </a>
      <ul class="dropdown-menu" aria-labelledby="eventsDropdown">
        <!-- <li><a class="dropdown-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}"
               href="{{ route('admin.events.index') }}">Events</a></li> -->
        <li><a class="dropdown-item {{ request()->routeIs('admin.bookings.index') ? 'active' : '' }}"
               href="{{ route('admin.bookings.index') }}">Bookings</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{ route('admin.bookings.export.csv') }}">Export Bookings (CSV)</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.bookings.export.pdf') }}">Export Bookings (PDF)</a></li>
      </ul>
    </li>

    <!-- Communications -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.contacts.*') || request()->routeIs('admin.newsletter.*') ? 'active' : '' }}"
         href="#" id="commsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Communications
      </a>
      <ul class="dropdown-menu" aria-labelledby="commsDropdown">
        <li><a class="dropdown-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}"
               href="{{ route('admin.contacts.index') }}">Contact Messages</a></li>
        <li><a class="dropdown-item {{ request()->routeIs('admin.newsletter.index') ? 'active' : '' }}"
               href="{{ route('admin.newsletter.index') }}">Newsletter Subscribers</a></li>
        <!-- <li><a class="dropdown-item" href="{{ route('admin.newsletter.campaigns.create') }}">New Campaign</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{ route('admin.newsletter.export.csv') }}">Export Subscribers (CSV)</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.newsletter.export.pdf') }}">Export Subscribers (PDF)</a></li> -->
      </ul>
    </li>

    <!-- Site Setup -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.hero.index') || request()->routeIs('admin.about.index') || request()->routeIs('admin.footer.index') ? 'active' : '' }}"
         href="#" id="siteDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Site Setup
      </a>
      <ul class="dropdown-menu" aria-labelledby="siteDropdown">
        <li><a class="dropdown-item {{ request()->routeIs('admin.hero.index') ? 'active' : '' }}"
               href="{{ route('admin.hero.index') }}">Homepage Hero</a></li>
        <li><a class="dropdown-item {{ request()->routeIs('admin.about.index') ? 'active' : '' }}"
               href="{{ route('admin.about.index') }}">About Us</a></li>
        <li><a class="dropdown-item {{ request()->routeIs('admin.footer.index') ? 'active' : '' }}"
               href="{{ route('admin.footer.index') }}">Footer</a></li>
      </ul>
    </li>

    <!-- People -->
    <!-- <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.team-members.*') ? 'active' : '' }}"
         href="#" id="peopleDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        People
      </a>
      <ul class="dropdown-menu" aria-labelledby="peopleDropdown">
        <li><a class="dropdown-item {{ request()->routeIs('admin.team-members.*') ? 'active' : '' }}"
               href="{{ route('admin.team-members.index') }}">Team</a></li>
      </ul>
    </li> -->

  </ul>

  <form action="{{ route('logout') }}" method="POST" class="d-flex">
    @csrf
    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
  </form>
</div>

        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
