<x-panel-layout>
    <x-slot name="title">
        - مدریت کاربران
    </x-slot>
    <p>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ route('dashboard') }}" >پیشخوان</a></li>
                <li><a href="{{ route('users.index') }}" class="is-active">کاربران</a></li>
            </ul>
        </div>
        <div class="main-content font-size-13">
            <div class="tab__box">
                <div class="tab__items">
                    <a class="tab__item is-active" href="{{ route('users.index') }}">همه کاربران</a>
                    <a class="tab__item" href="{{ route('users.create') }}">ایجاد کاربر جدید</a>
                </div>
            </div>
            <div class="d-flex flex-space-between item-center flex-wrap padding-30 border-radius-3 bg-white">
            </div>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام و نام خانوادگی</th>
                        <th>ایمیل</th>
                        <th>موبایل</th>
                        <th>سطح کاربری</th>
                        <th>تاریخ عضویت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            
                        
                    <tr role="row" class="">
                        <td>{{ $user->id }}</a></td>
                        <td>{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td>{{ $user->getRoleIn() }}</td>
                        <td>{{ $user->getCreatedAtInJalali() }}</td>
                        <td>
                            <a href="" class="item-delete mlg-15" title="حذف"></a>
                            <a href="{{ route('users.edit', $user->id) }}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </p>
</x-panel-layout>