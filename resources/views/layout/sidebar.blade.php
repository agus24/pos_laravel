<?php 
    $menu = new App\MenuList;
?>

<li class="nav-item start">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-key"></i>
        <span class="title">Master</span>
        <span class="selected"></span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        @foreach($menu->show('Master',Auth::user()->id) as $value)
        <li class="nav-item start">
            <a href="{{ url($value->link) }}" class="nav-link ">
                <i class="{{ $value->icon }}"></i>
                <span class="title">{{ $value->name }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</li>
<li class="nav-item start">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-home"></i>
        <span class="title">Inventory</span>
        <span class="selected"></span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        @foreach($menu->show('Inventory',Auth::user()->id) as $value)
        <li class="nav-item start">
            <a href="{{ url($value->link) }}" class="nav-link ">
                <i class="{{ $value->icon }}"></i>
                <span class="title">{{ $value->name }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</li>