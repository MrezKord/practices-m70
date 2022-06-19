<nav
    class="
relative
w-full
flex flex-wrap
items-center
justify-between
py-4
text-white
navbar navbar-expand-lg navbar-light
">
    <div class="container-fluid w-full flex flex-wrap items-center justify-between px-6">
        <div class="collapse navbar-collapse flex-grow items-center" id="navbarSupportedContent">
            <!-- Left links -->
            <ul class="navbar-nav flex gap-5 pl-0 list-style-none mr-auto">
                @foreach ($items as $key => $item)
                    <li class="nav-item pr-2">
                        <a class="nav-link text-white p-0"
                            href="{{ $key }}">{{ $item }}</a>
                    </li>
                @endforeach
                <li class="nav-item pr-2">
                    <form method="POST" action="{{ route('logout') }}" class="w-fit">
                    @csrf
                        <button type="submit" class="nav-link text-white p-0">
                            Log out
                        </button>
                    </form>
                </li>
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->
    </div>
</nav>
