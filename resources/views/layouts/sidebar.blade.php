<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                @if ($user && $user->avatar)
                    <img src="{{ asset('uploads/users/' . $user->avatar) }}" alt=""
                        class="avatar-md rounded-circle">
                @endif
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ Auth::user()->name }}</h4>
                <span class="text-muted text-capitalize"><i
                        class="ri-record-circle-line align-middle font-size-14 text-success"></i>
                    {{ Auth::user()->role->name }}</span>
            </div>
        </div>


        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                @foreach (getAccessibleMenus() as $menu)
                    @php
                        $isActive = request()->is(ltrim($menu->url, '/')) ? 'active' : '';
                        $hasChildren = $menu->children->count() > 0;
                    @endphp

                    <li class="{{ $hasChildren ? 'has-submenu' : '' }}">
                        <a href="{{ $hasChildren ? '#menu-' . $menu->id : url($menu->url) }}"
                            class="waves-effect {{ $isActive }} {{ $hasChildren ? 'has-arrow' : '' }}"
                            @if ($hasChildren) data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="menu-{{ $menu->id }}" @endif>
                            <i class="ri-{{ $menu->icon }}"></i>
                            <span>{{ $menu->name }}</span>
                        </a>

                        @if ($hasChildren)
                            <ul class="sub-menu collapse" id="menu-{{ $menu->id }}">
                                @foreach ($menu->children as $child)
                                    <li>
                                        <a href="{{ url($child->url) }}"
                                            class="{{ request()->is(ltrim($child->url, '/')) ? 'active' : '' }}"
                                            target="{{ $child->target }}">
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
