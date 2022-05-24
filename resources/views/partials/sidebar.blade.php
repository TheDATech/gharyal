<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">

            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

        </div><a class="navbar-brand" href="#">
            <div class="d-flex align-items-center py-3">
                <img class="me-2" src="{{ asset('backend/assets/img/icons/spot-illustrations/falcon.png') }}" alt="" width="150" />
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">

                    <!-- parent pages--><a class="nav-link" href="{{ route('home') }}" role="button" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-tachometer-alt"></span></span><span class="nav-link-text ps-1">Dashboard</span>
                        </div>
                    </a>
                    <!-- parent pages--><a class="nav-link" href="{{ route('chat.index') }}" role="button" aria-expanded="false">
                                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-headset"></span></span><span class="nav-link-text ps-1">Chat</span>
                        </div>
                    </a>
                    <!-- parent pages--><a class="nav-link" href="{{ route('groups.index') }}" role="button" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users"></span></span><span class="nav-link-text ps-1">Groups</span>
                        </div>
                    </a>
                    <!-- parent pages--><a class="nav-link dropdown-indicator" href="#roles" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="user">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-user-tag"></span></span><span class="nav-link-text ps-1">Roles</span>
                        </div>
                    </a>
                    <ul class="nav collapse false" id="roles">
                        <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}" aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Role List</span>
                                </div>
                            </a>
                            <!-- more inner pages-->
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('roles.create') }}" aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Add New Role</span>
                                </div>
                            </a>
                            <!-- more inner pages-->
                        </li>
                    </ul>
                    <!-- parent pages--><a class="nav-link dropdown-indicator" href="#user" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="user">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-user"></span></span><span class="nav-link-text ps-1">Representatives</span>
                        </div>
                    </a>
                    <ul class="nav collapse false" id="user">
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}" aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Representative List</span>
                                </div>
                            </a>
                            <!-- more inner pages-->
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.create') }}" aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Add New Representative</span>
                                </div>
                            </a>
                            <!-- more inner pages-->
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>