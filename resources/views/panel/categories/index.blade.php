<x-panel-layout>
    <x-slot name="title">
        - مدریت دسته بندی ها
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('categories.index') }}" class="is-active">دسته بندی ها</a></li>
        </ul>
    </div>
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دسته بندی ها</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام دسته بندی</th>
                            <th>نام انگلیسی دسته بندی</th>
                            <th>دسته پدر</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr role="row" class="">
                            <td><a href="">1</a></td>
                            <td><a href="">برنامه نویسی</a></td>
                            <td>programming</td>
                            <td>ندارد</td>
                            <td>
                                <a href="" class="item-delete mlg-15" title="حذف"></a>
                                <a href="edit-category.html" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4 bg-white">
                  <p class="box__title">ایجاد دسته بندی جدید</p>
                  <form action="" method="post" class="padding-30">
                      <input type="text" placeholder="نام دسته بندی" class="text">
                      <input type="text" placeholder="نام انگلیسی دسته بندی" class="text">
                      <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
                      <select class="select" name="" id="">
                          <option value="0">ندارد</option>
                          <option value="0">برنامه نویسی</option>
                      </select>
                      <button class="btn btn-webamooz_net">اضافه کردن</button>
                  </form>
            </div>
        </div>
    </div>
</x-panel-layout>