<x-panel-layout>

    <x-slot name='title'>
        - مدیریت نظرات
    </x-slot>
        {{-- paginations --}}
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('blog/css/style.css') }}">
    </x-slot>

    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('comments.index') }}" class="is-active"> نظرات</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('comments.index') }}"> همه نظرات</a>
                <a class="tab__item " href="{{ route('comments.index', ['approved' => 0]) }}">نظرات تاییده نشده</a>
                <a class="tab__item " href="{{ route('comments.index', ['approved' => 1]) }}">نظرات تاییده شده</a>
            </div>
        </div>


        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>ارسال کننده</th>
                    <th>برای</th>
                    <th>دیدگاه</th>
                    <th>تاریخ</th>
                    <th>تعداد پاسخ ها </th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>

                    @foreach ($comments as $comment)    
                        <tr role="row" >
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->post->title }}</td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ $comment->getCreatedAtInJalali() }}</td>
                            <td>{{ $comment->replies_count }}</td>
                            <td class="{{ $comment->is_approved ? 'text-success' : 'text-error' }}">{{ $comment->getStatusInFarsy() }}</td>
                        <td>
                            <a href="{{ route('comments.destroy', $comment->id) }}" onclick="destroycomment(event, {{ $comment->id }})" class="item-delete mlg-15" title="حذف"></a>
                                @if ($comment->is_approved)
                            <a href="{{ route('comments.update', $comment->id) }}" onclick="updatecomment(event, {{ $comment->id }})" class="item-reject mlg-15" title="رد"></a>
                                @else
                            <a href="{{ route('comments.update', $comment->id) }}" onclick="updatecomment(event, {{ $comment->id }})" class="item-confirm mlg-15" title="تایید"></a>
                                @endif
                            <form action="{{ route('comments.update', $comment->id) }}" method="post" id="update-comment-{{ $comment->id }}">@csrf @method('put')</form>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="post" id="destroy-comment-{{ $comment->id }}">@csrf @method('delete')</form>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>

    <x-slot name='scripts'>
        <script>
                    // delete comment
            function destroycomment(event, id)
            {
                event.preventDefault();
                document.getElementById('destroy-comment-' + id).submit();
            }
                    // status comment
            function updatecomment(event, id)
            {
                event.preventDefault();
                document.getElementById('update-comment-' + id).submit();
            }
        </script>
    </x-slot>

    {{ $commentsappends(request()->query())->links() }}

</x-panel-layout>