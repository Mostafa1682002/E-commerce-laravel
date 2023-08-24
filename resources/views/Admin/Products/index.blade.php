@extends('Admin.layouts.master')
@section('title')
    قائمة المنتجات
@stop
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">قائمة المنتجات</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}" class="default-color">الرئيسيه</a></li>
                    <li class="breadcrumb-item active">قائمة المنتجات</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @if (session('succes'))
                        <div class="alert  alert-success" role="alert">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('succes') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert  alert-danger" role="alert">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            لم يتم حفظ البيانات
                        </div>
                        @foreach ($errors->all() as $error)
                            <div class="alert  alert-danger" role="alert">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        اضافة منتج جديد
                    </button>
                    <br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المنتج</th>
                                    <th>القسم</th>
                                    <th>السعر</th>
                                    <th>نسبة التخفيض</th>
                                    <th>السعر الكلي</th>
                                    <th>الصوره</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->category->category_name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->discount }}</td>
                                        <td>{{ $product->total_price }}</td>
                                        <td>
                                            <img style="width: 50px;height: 50px;border-radius: 50%"
                                                src="{{ asset('assets/uploades/Images') . "/$product->id/$product->image" }}"
                                                alt="">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $product->id }}" title="تعديل"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $product->id }}" title="حذف"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    <!-- edit_modal_Grade -->
                                    <div class="modal fade" id="edit{{ $product->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        تعديل المنتج
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('products.update', $product->id) }}"
                                                        enctype="multipart/form-data" method="post">
                                                        @method('patch')
                                                        @csrf
                                                        <div class="col">
                                                            <label for="product_name" class="mr-sm-2">اسم المنتج
                                                                :</label>
                                                            <input id="product_name" type="text" name="product_name"
                                                                class="form-control" value="{{ $product->product_name }}"
                                                                required>
                                                            <input id="id" type="hidden" name="id"
                                                                class="form-control" value="{{ $product->id }}">
                                                        </div>
                                                        <br>
                                                        <div class="col">
                                                            <label for="categorie_id" class="mr-sm-2">القسم
                                                                :</label>
                                                            <div class="box">
                                                                <select class="custom-select mr-sm-2" name="categorie_id">
                                                                    <option value="{{ $product->categorie_id }}">
                                                                        {{ $product->category->category_name }}</option>
                                                                    @foreach ($categores as $categore)
                                                                        <option value="{{ $categore->id }}">
                                                                            {{ $categore->category_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="col">
                                                            <label for="price" class="mr-sm-2">السعر
                                                                :</label>
                                                            <input id="price" type="number" name="price"
                                                                class="form-control" value="{{ $product->price }}"
                                                                required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="discount" class="mr-sm-2">نسبة التخفيض
                                                                :</label>
                                                            <input id="discount" type="number" name="discount"
                                                                class="form-control" value="{{ $product->discount }}"
                                                                required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="image" class="mr-sm-2">الصوره
                                                                :</label>
                                                            <input id="image" type="file" name="image"
                                                                accept="image/*" class="form-control" value="">
                                                        </div>
                                                        <br><br>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">الغاء</button>
                                                            <button type="submit" class="btn btn-success">تعديل</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- delete_modal_Grade -->
                                    <div class="modal fade" id="delete{{ $product->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        حذف مننج
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                        method="post">
                                                        @method('Delete')
                                                        @csrf
                                                        هل انت متاكد من عملية حذف المنتج؟
                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control" value="{{ $product->id }}">
                                                        <input id="id" type="text" name="name" readonly
                                                            class="form-control" value="{{ $product->product_name }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">الغاء</button>
                                                            <button type="submit" class="btn btn-danger">حذف</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- add_modal_Grade -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            اضافة منتجات
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class=" row mb-30" action="{{ route('products.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="List_products">
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="product_name" class="mr-sm-2">اسم المنتج
                                                        :</label>
                                                    <input class="form-control" type="text" name="product_name" />
                                                </div>
                                                <div class="col">
                                                    <label for="categorie_id" class="mr-sm-2">القسم
                                                        :</label>
                                                    <div class="box">
                                                        <select class="fancyselect" name="categorie_id">
                                                            @foreach ($categores as $categore)
                                                                <option value="{{ $categore->id }}">
                                                                    {{ $categore->category_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label for="price" class="mr-sm-2">السعر
                                                        :</label>
                                                    <input class="form-control" type="number" name="price"
                                                        value="" />
                                                </div>
                                                <div class="col">
                                                    <label for="discount" class="mr-sm-2">نسبة التخفيض
                                                        :</label>
                                                    <input class="form-control" type="number" name="discount"
                                                        value="" />
                                                </div>
                                                <div class="col">
                                                    <label for="image" class="mr-sm-2">الصوره
                                                        :</label>
                                                    <input class="form-control" type="file" accept="image/*"
                                                        name="image" value="" />
                                                </div>
                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">العمليات
                                                        :</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete
                                                        type="button" value="حذف" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button" value="ادراج صف" />
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">الغاء</button>
                                        <button type="submit" class="btn btn-success">حفظ</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection
