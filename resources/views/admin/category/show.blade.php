@extends('admin.layouts.main')
@section('title')


    دسته ها

@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-list"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> مدیریت دسته </span>
                        <span class="info-box-number"><small>{{$category->name}}</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">تعداد محصولات</span>
                        <span class="info-box-number">760</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-list"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">تعداد دسته ها</span>
                        <span class="info-box-number">{{count(\App\Category::all())}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

        <!-- /.row -->


        <!-- /.row -->

        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">افزودن دسته بندی</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>


                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="box box-primary">
                            <div class="box-header with-border">

                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" enctype="multipart/form-data" method="post" action="{{route('admincategory.store')}}">
                                @csrf
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">نام دسته</label>
                                        <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="نام دسته">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">سر دسته</label>
                                        <select name="parent_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            <option selected="selected" value="0">سر دسته اصلی</option>
                                            @foreach(\App\Category::query()->where('active','=',1)->get() as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">آیکن دسته (اختیاری)</label>
                                        <input name="icon" type="file" id="exampleInputFile">


                                    </div>

                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">افزودن</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


@endsection