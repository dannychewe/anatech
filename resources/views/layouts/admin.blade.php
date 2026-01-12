<!DOCTYPE html>
<html>
<head>
    <title>Admin - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tiny.cloud/1/vpxsz259t116jjroj9oad3attspm8p16452cnnhpvehznqoj/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
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
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="admin-sidebar__brand">
                <a href="{{ route('admin.dashboard') }}" class="admin-brand">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Anatech Systems" style="height: 36px;">
                </a>
                <button class="btn admin-sidebar__toggle d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminSidebarNav" aria-expanded="false" aria-controls="adminSidebarNav">
                    Menu
                </button>
            </div>

            <div class="collapse d-lg-block" id="adminSidebarNav">
                <div class="admin-sidebar__section">
                    <div class="admin-sidebar__label">Overview</div>
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>

                <div class="admin-sidebar__section">
                    <div class="admin-sidebar__label">Catalog</div>
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                       href="{{ route('admin.products.index') }}">Products</a>
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.product-categories.*') ? 'active' : '' }}"
                       href="{{ route('admin.product-categories.index') }}">Product Categories</a>
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
                       href="{{ route('admin.services.index') }}">Services</a>
                </div>

                <div class="admin-sidebar__section">
                    <div class="admin-sidebar__label">Content</div>
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}"
                       href="{{ route('admin.blogs.index') }}">Blogs</a>
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                       href="{{ route('admin.categories.index') }}">Categories</a>
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}"
                       href="{{ route('admin.tags.index') }}">Tags</a>
                  
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}"
                       href="{{ route('admin.testimonials.index') }}">Testimonials</a>
                </div>

                <div class="admin-sidebar__section">
                    <div class="admin-sidebar__label">Bookings</div>
                    
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}"
                       href="{{ route('admin.bookings.index') }}">Bookings</a>
                </div>

                <div class="admin-sidebar__section">
                    <div class="admin-sidebar__label">Communications</div>
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}"
                       href="{{ route('admin.contacts.index') }}">Contact Messages</a>
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.newsletter.*') ? 'active' : '' }}"
                       href="{{ route('admin.newsletter.index') }}">Newsletter Subscribers</a>
                    <a class="admin-sidebar__link" href="{{ route('admin.newsletter.campaigns.create') }}">New Campaign</a>
                </div>

                <div class="admin-sidebar__section">
                    <div class="admin-sidebar__label">Site Setup</div>
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.hero.index') ? 'active' : '' }}"
                       href="{{ route('admin.hero.index') }}">Homepage Hero</a>
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}"
                       href="{{ route('admin.brands.index') }}">Brands</a>
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.about.index') ? 'active' : '' }}"
                       href="{{ route('admin.about.index') }}">About Us</a>
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.footer.index') ? 'active' : '' }}"
                       href="{{ route('admin.footer.index') }}">Footer</a>
                </div>

                <div class="admin-sidebar__section">
                    <div class="admin-sidebar__label">People</div>
                    <a class="admin-sidebar__link {{ request()->routeIs('admin.team-members.*') ? 'active' : '' }}"
                       href="{{ route('admin.team-members.index') }}">Team</a>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="admin-sidebar__logout">
                    @csrf
                    <button type="submit" class="btn btn-sm admin-logout w-100">Logout</button>
                </form>
            </div>
        </aside>

        <div class="admin-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var fileInputs = document.querySelectorAll('.admin-content input[type="file"].form-control');

            fileInputs.forEach(function (input) {
                if (input.closest('.admin-dropzone')) {
                    return;
                }

                var wrapper = document.createElement('div');
                wrapper.className = 'admin-dropzone';

                var prompt = document.createElement('div');
                prompt.className = 'admin-dropzone__prompt';
                prompt.textContent = 'Drag and drop files here or click to upload';

                var hint = document.createElement('div');
                hint.className = 'admin-dropzone__hint';
                hint.textContent = 'Supported: JPG, PNG, GIF, WEBP';

                var clearButton = document.createElement('button');
                clearButton.type = 'button';
                clearButton.className = 'btn btn-sm btn-outline-secondary admin-dropzone__clear';
                clearButton.textContent = 'Clear selection';

                var preview = document.createElement('div');
                preview.className = 'admin-dropzone__preview';

                input.parentNode.insertBefore(wrapper, input);
                wrapper.appendChild(prompt);
                wrapper.appendChild(hint);
                wrapper.appendChild(clearButton);
                wrapper.appendChild(input);
                wrapper.appendChild(preview);

                var existingImages = (input.dataset.existingImages || '')
                    .split(',')
                    .map(function (item) { return item.trim(); })
                    .filter(Boolean);

                var addPreviewItem = function (options) {
                    var item = document.createElement('div');
                    item.className = 'admin-dropzone__item';
                    if (options.type === 'existing') {
                        item.classList.add('admin-dropzone__item--existing');
                    } else {
                        item.classList.add('admin-dropzone__item--selected');
                    }

                    if (options.kind === 'image') {
                        var img = document.createElement('img');
                        img.src = options.src;
                        item.appendChild(img);
                    } else {
                        var fileBox = document.createElement('div');
                        fileBox.className = 'admin-dropzone__file';
                        fileBox.textContent = options.name;
                        item.appendChild(fileBox);
                    }

                    preview.appendChild(item);
                };

                if (existingImages.length) {
                    existingImages.forEach(function (url) {
                        addPreviewItem({ type: 'existing', kind: 'image', src: url });
                    });
                }

                var stopDefaults = function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                };

                ['dragenter', 'dragover'].forEach(function (evt) {
                    wrapper.addEventListener(evt, function (event) {
                        stopDefaults(event);
                        wrapper.classList.add('is-dragover');
                    });
                });

                ['dragleave', 'drop'].forEach(function (evt) {
                    wrapper.addEventListener(evt, function (event) {
                        stopDefaults(event);
                        wrapper.classList.remove('is-dragover');
                    });
                });

                wrapper.addEventListener('drop', function (event) {
                    if (event.dataTransfer && event.dataTransfer.files) {
                        input.files = event.dataTransfer.files;
                        input.dispatchEvent(new Event('change'));
                    }
                });

                clearButton.addEventListener('click', function () {
                    input.value = '';
                    preview.querySelectorAll('.admin-dropzone__item--selected').forEach(function (item) {
                        item.remove();
                    });
                });

                input.addEventListener('change', function () {
                    preview.querySelectorAll('.admin-dropzone__item--selected').forEach(function (item) {
                        item.remove();
                    });
                    var files = Array.prototype.slice.call(input.files || []);
                    if (!files.length) {
                        return;
                    }

                    files.slice(0, 8).forEach(function (file) {
                        if (file.type && file.type.indexOf('image/') === 0) {
                            var url = URL.createObjectURL(file);
                            addPreviewItem({ type: 'selected', kind: 'image', src: url });
                            var lastImg = preview.lastElementChild ? preview.lastElementChild.querySelector('img') : null;
                            if (lastImg) {
                                lastImg.onload = function () { URL.revokeObjectURL(url); };
                            }
                        } else {
                            addPreviewItem({ type: 'selected', kind: 'file', name: file.name });
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
