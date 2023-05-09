@extends('admin/layout/master')
@section('page-title')
Manage Brand
@endsection
@section('main-content')
<!-- Main content -->
<section class="content">

<!-- /.row -->
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"> 
          <a class="btn btn-danger btn-xm"><i class="fa fa-eye"></i></a>
          <a class="btn btn-danger btn-xm"><i class="fa fa-eye-slash"></i></a>
          <a class="btn btn-danger btn-xm"><i class="fa fa-trash"></i></a>
          <a href="/admin/brand/create" class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
    </h3>
    <div class="box-tools">
     <form method="GET" action="\admin\brand">
      <div class="input-group input-group-sm" style="width: 250px;">
        <input type="text" name="s" class="form-control pull-right" placeholder="Search" value="{{(request()->get('s'))?request()->get('s') : null}}">

        <div class="input-group-btn">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
     </form>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    @if($brand)
    <table class="table table-bordered">
      <thead style="background-color: #F8F8F8;">
        <tr>
          <th width="4%"><input type="checkbox" name="" id="checkAll"></th>
          <th widoth="20%">Title</th>
          <th width="20%">Meida Image</th>
          <th width="10%">Status</th>
          <th width="10%">Manage</th>
        </tr>
      </thead>
      @foreach($brand as $brand)
      <tr>
        <td><input type="checkbox" name="" id="" class="checkSingle"></td>
        <td>{{$brand->title}}</td>
        <td>{{$brand->brand_type}}</td>
        <td>
        @if($brand->brand_img == 'No image found')
                  <img src="\assets\admin\dist\img\no-img.png" width="100" height="80" class="img-thumbnail" alt="No image found">
        @endif
        </td>
        <td>
          <form method="POST" action="/admin/brand/{{ $brand->id }}/status">
           @csrf
           @method('put')
        @if($brand-> status=="DEACTIVE")
          <button class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></button>
        @else
          <button class="btn btn-info btn-sm"><i class="fa fa-thumbs-up"></i></button>
        @endif
        </td>
      </form>
        <td>
          <form method="POST" action="/admin/brand/{{ $brand->id }}">
          @csrf
          @method('delete')    
          <a href="/admin/brand/{{ $brand->id }}/edit" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
          <button class="btn btn-danger btn-flat btn-sm" onclick="return confirm('Are you sure you want to delete this?')"> <i class="fa fa-trash-o"></i></button>
          </form>
          </td>
      </tr>
    @endforeach
  </table>
  </div>
  <!-- /.box-body -->
    <div class="box-footer clearfix">
              <div class="row">
                  <div class="col-sm-6">
                      <span style="display:block;font-size:15px;line-height:34px;margin:20px 0;">
                          Showing {{($brand->currentpage()-1)*$brand->perpage()+1}} to  {{ $brand->currentpage()*(($brand->perpage() < $brand->total()) ? $brand->perpage(): $brand->total())}} of {{ $brand->total()}} entries</span>
                  </div>
      <div class="col-sm-6 text-right">
       {{ $brand->links() }}
      </div>
    </div>
  @else
      <div class="alert alert-danger">No record found!</div>
  @endif
   </div>
</div>
  <!-- /.box-body -->
</div>


</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection