<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <title>پنل وبلاگ {{ $title ?? '' }}</title>
    <link rel="stylesheet" href="{{ asset('blog/panel/css/style.css') }}">
    {{ $styles ?? '' }}
    <link rel="stylesheet" href="{{ asset('blog/panel/css/responsive_991.css') }}" media="(max-width:991px)">
    <link rel="stylesheet" href="{{ asset('blog/panel/css/responsive_768.css') }}" media="(max-width:768px)">
    <link rel="stylesheet" href="{{ asset('blog/css/style.css') }}" media="(max-width:768px)">
    <link rel="stylesheet" href="{{ asset('blog/panel/css/font.css') }}">
</head>
<body>
<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href="https://webamooz.net"></a>
    <div class="profile__info border cursor-pointer text-center">
        <div class="avatar__img"><img src="{{ auth()->user()->getProfileUrl() }}" class="avatar___img">
            <input type="file" accept="image/*" class="hidden avatar-img__input">
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>            
        <span class="profile__name">کاربر : {{ auth()->user()->name}}</span>
        <span class="profile__name">نقش  : {{ auth()->user()->getRoleIn()  }}</span>
    </div>

    {{-- دسته بندی --}}

    <ul>
        <li class="item-li i-dashboard @if(request()->is('dashboard')) is-active  @endif "><a href="{{ route('dashboard') }}">پیشخوان</a></li>
                {{-- کابران && دسته بندی --}}
            @if (auth()->user()->role === 'admin')
        <li class="item-li i-users @if(request()->is('panel.users') || request()->is('panel.users.*'))  is-active  @endif "><a href="{{ route('users.index') }}"> کاربران</a></li>
        <li class="item-li i-categories @if(request()->is('panel.categories') || request()->is('panel.categories.*'))  is-active  @endif "><a href="{{ route('categories.index') }}">دسته بندی ها</a></li>
            @endif
                {{-- مقالات --}}
            @if (auth()->user()->role === 'admin' OR auth()->user()->role === 'author')
        <li class="item-li i-articles @if(request()->is('panel.posts') || request()->is('panel.posts.*'))  is-active  @endif"><a href="{{ route('posts.index') }}">مقالات</a></li>
            @endif
                {{-- کامنت --}}
            @if (auth()->user()->role === 'admin')
        <li class="item-li i-comments @if(request()->is('panel.comments') || request()->is('panel.comments.*'))  is-active  @endif"><a href="{{ route('comments.index') }}"> نظرات</a></li>
            @endif
        <li class="item-li i-user__inforamtion @if(request()->is('profile') || request()->is('profile*'))  is-active  @endif"><a href="{{ route('profile') }}">اطلاعات کاربری</a></li>
    </ul>



</div>
<div class="content">
    <div class="header d-flex item-center bg-white width-100 border-bottom padding-12-30">
        <div class="header__right d-flex flex-grow-1 item-center">
            <span class="bars"></span>
            <a class="header__logo" href="https://webamooz.net"></a>
        </div>
        <div class="header__left d-flex flex-end item-center margin-top-2">
            <a href="{{ route('logout') }}" class="logout" title="خروج" onclick="event.preventDefault(); document.getElementById('logoute-form').submit();"></a>
            <form action="{{ route('logout') }}" method="POST" id="logoute-form" >@csrf</form>
        </div>
    </div>
    {{ $slot }}
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(Session::has('status'))
<script>
    Swal.fire({ title: "{{ session('status') }}", confirmButtonText: 'تایید', icon: 'success' })
</script>
@endif

<script src="{{ asset('blog/panel/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('blog/panel/js/js.js') }}"></script>
{{ $scripts ?? '' }}
</body>
</html>