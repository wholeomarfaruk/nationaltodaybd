@extends('layouts.website')
@section('content')
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#main-canvas"
        aria-controls="main-canvas">
        Open Mobile Menu
    </button>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="main-canvas" aria-labelledby="main-canvas-label"
        data-bs-scroll="true" data-bs-backdrop="true" style="z-index: 1055;">

        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="main-canvas-label">Main Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <nav id="sidebar-menu">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>

                    <li class="nav-item border-bottom w-100 mt-2">
                        <button
                            class="btn btn-outline-primary w-100 text-start d-flex justify-content-between align-items-center"
                            type="button" data-bs-toggle="offcanvas" data-bs-target="#sub-canvas-1"
                            aria-controls="sub-canvas-1">
                            <span>Category with Sub-Menu (Level 1)</span>
                            <i class="fas fa-caret-right"></i>
                        </button>
                    </li>

                    <li class="nav-item border-bottom w-100">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item border-bottom w-100">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item border-bottom w-100 mt-2">
                        <button
                            class="btn btn-outline-primary w-100 text-start d-flex justify-content-between align-items-center"
                            type="button" data-bs-toggle="offcanvas" data-bs-target="#sub-canvas-3"
                            aria-controls="sub-canvas-3">
                            <span>Category with Sub-Menu (Level 1)</span>
                            <i class="fas fa-caret-right"></i>
                        </button>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="sub-canvas-1" aria-labelledby="sub-canvas-1-label"
        data-bs-scroll="true" data-bs-backdrop="false" style="z-index: 1060;">

        <div class="offcanvas-header">
            <button type="button" class="btn btn-sm btn-outline-secondary me-2 back-button" data-bs-target="#main-canvas"
                aria-label="Back">
                <i class="fas fa-arrow-left"></i> Back
            </button>
            <h5 class="offcanvas-title" id="sub-canvas-1-label">Sub-Menu: News</h5>
            <button type="button" class="btn-close ms-auto close-all-button" aria-label="Close All"></button>
        </div>

        <div class="offcanvas-body">
            <nav id="submenu-1">
                <ul class="navbar-nav">
                    <li class="nav-item border-bottom w-100">
                        <a class="nav-link" href="#">Local News</a>
                    </li>
                    <li class="nav-item border-bottom w-100">
                        <button
                            class="btn btn-outline-primary w-100 text-start d-flex justify-content-between align-items-center"
                            type="button" data-bs-toggle="offcanvas" data-bs-target="#sub-canvas-2"
                            aria-controls="sub-canvas-2">
                            <span>Sports (Level 2)</span>
                            <i class="fas fa-caret-right"></i>
                        </button>
                    </li>
                    <li class="nav-item border-bottom w-100">
                        <a class="nav-link" href="#">Technology</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="sub-canvas-2" aria-labelledby="sub-canvas-2-label"
        data-bs-scroll="true" data-bs-backdrop="false" style="z-index: 1065;">

        <div class="offcanvas-header">
            <button type="button" class="btn btn-sm btn-outline-secondary me-2 back-button" data-bs-target="#sub-canvas-1"
                aria-label="Back">
                <i class="fas fa-arrow-left"></i> Back
            </button>
            <h5 class="offcanvas-title" id="sub-canvas-2-label">Sub-Menu: Sports</h5>
            <button type="button" class="btn-close ms-auto close-all-button" aria-label="Close All"></button>
        </div>

        <div class="offcanvas-body">
            <nav id="submenu-2">
                <ul class="navbar-nav">
                    <li class="nav-item border-bottom w-100"><a class="nav-link" href="#">Cricket</a></li>
                    <li class="nav-item border-bottom w-100"><a class="nav-link" href="#">Football</a></li>
                    <li class="nav-item border-bottom w-100"><a class="nav-link" href="#">Athletics</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="sub-canvas-3" aria-labelledby="sub-canvas-3-label"
        data-bs-scroll="true" data-bs-backdrop="false" style="z-index: 1060;">

        <div class="offcanvas-header">
            <button type="button" class="btn btn-sm btn-outline-secondary me-2 back-button"
                data-bs-target="#main-canvas" aria-label="Back">
                <i class="fas fa-arrow-left"></i> Back
            </button>
            <h5 class="offcanvas-title" id="sub-canvas-1-label">Sub-Menu: 3</h5>
            <button type="button" class="btn-close ms-auto close-all-button" aria-label="Close All"></button>
        </div>

        <div class="offcanvas-body">
            <nav id="submenu-1">
                <ul class="navbar-nav">
                    <li class="nav-item border-bottom w-100">
                        <a class="nav-link" href="#">Local News</a>
                    </li>
                    <li class="nav-item border-bottom w-100">
                        <div class="btn-group dropend w-100">
                            <a type="button" class="nav-link w-100" href="#">
                                Split dropend
                            </a>

                            <button type="button"
                                class="btn flex-grow-0"
                                data-bs-toggle="offcanvas" data-bs-target="#sub-canvas-4"
                            aria-controls="sub-canvas-4">
                               <i class="fas fa-caret-right"></i>
                            </button>
                        </div>

                    </li>
                    <li class="nav-item border-bottom w-100">
                        <a class="nav-link" href="#">Technology</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="sub-canvas-4" aria-labelledby="sub-canvas-4-label"
        data-bs-scroll="true" data-bs-backdrop="false" style="z-index: 1065;">

        <div class="offcanvas-header">
            <button type="button" class="btn btn-sm btn-outline-secondary me-2 back-button"
                data-bs-target="#sub-canvas-3" aria-label="Back">
                <i class="fas fa-arrow-left"></i> Back
            </button>
            <h5 class="offcanvas-title" id="sub-canvas-4-label">Sub-Menu: 4</h5>
            <button type="button" class="btn-close ms-auto close-all-button" aria-label="Close All"></button>
        </div>

        <div class="offcanvas-body">
            <nav id="submenu-2">
                <ul class="navbar-nav">
                    <li class="nav-item border-bottom w-100"><a class="nav-link" href="#">Cricket</a></li>
                    <li class="nav-item border-bottom w-100"><a class="nav-link" href="#">Football</a></li>
                    <li class="nav-item border-bottom w-100"><a class="nav-link" href="#">Athletics</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        /**
         * Custom JavaScript for Nested Offcanvas Back/Close Logic
         */
        document.addEventListener('DOMContentLoaded', () => {

            // --- LOGIC FOR THE "CLOSE ALL" BUTTON ---
            document.querySelectorAll('.close-all-button').forEach(button => {
                button.addEventListener('click', function() {
                    // Get ALL offcanvas elements and hide their instances
                    document.querySelectorAll('.offcanvas').forEach(el => {
                        const instance = bootstrap.Offcanvas.getInstance(el);
                        if (instance) {
                            instance.hide();
                        }
                    });
                });
            });


            // --- LOGIC FOR THE "BACK" BUTTON ---
            document.querySelectorAll('.back-button').forEach(button => {
                button.addEventListener('click', function() {
                    // 1. Get the current (open) offcanvas instance
                    const currentOffcanvasElement = this.closest('.offcanvas');
                    const currentOffcanvasInstance = bootstrap.Offcanvas.getInstance(
                        currentOffcanvasElement);

                    // 2. Get the target element ID from the data-bs-target attribute (e.g., #main-canvas)
                    const targetSelector = this.getAttribute('data-bs-target');
                    const targetOffcanvasElement = document.querySelector(targetSelector);

                    if (currentOffcanvasInstance) {
                        // 3. Hide the CURRENT offcanvas
                        currentOffcanvasInstance.hide();
                    }

                    if (targetOffcanvasElement) {
                        // 4. Show the TARGET (parent) offcanvas
                        const targetOffcanvasInstance = bootstrap.Offcanvas.getInstance(
                            targetOffcanvasElement) || new bootstrap.Offcanvas(
                            targetOffcanvasElement);
                        targetOffcanvasInstance.show();
                    }
                });
            });

        });
    </script>
@endpush
