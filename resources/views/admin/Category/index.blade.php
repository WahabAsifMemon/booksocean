@extends('admin/layout/master')
@section('page-title')
  Manage Category
@endsection
@section('main-content')
 <section class="content">
      
      <!-- /.row -->
     <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"> 
                    <a class="btn btn-danger btn-xm"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-danger btn-xm"><i class="fa fa-eye-slash"></i></a>
                    <a class="btn btn-danger btn-xm"><i class="fa fa-trash"></i></a>
                    <a href="/admin/category/create" class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
              </h3>
              <div class="box-tools">
                <form method="GET" action="/admin/category">
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="s" class="form-control pull-right" placeholder="Search" value="{{ (request()->get('s')) ? request()->get('s') : null }}">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </form>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if($categorys)
              <table class="table table-bordered">
                <thead style="background-color: #F8F8F8;">
                  <tr>
                    <th width="4%"><input type="checkbox" name="" id="checkAll"></th>
                    <th width="70%">Title</th>
                    <th width="10%">Status</th>
                    <th width="10%">Manage</th>
                  </tr>
                </thead>
                @foreach($categorys as $category)
                <tr>
                  <td><input type="checkbox" name="" id="" class="checkSingle"></td>
                  <td>{{ $category->title }}</td>
                  <td>
                   @if($category->status == 'DEACTIVE')
                      <button class="btn btn-danger btn-sm updatingStatus" status="DEACTIVE" id="{{ $category->id }}" table="category"><i id="icon_{{ $category->id }}" class="fa fa-thumbs-down"></i></button>
                    @else
                      <button class="btn btn-info btn-sm updatingStatus" status="ACTIVE" id="{{ $category->id }}" table="category"><i id="icon_{{ $category->id }}" class="fa fa-thumbs-up"></i></button>
                    @endif
                  </td>
                  <td>
                    <form method="POST" action="/admin/category/{{ $category->id }}">
                      @csrf
                      @method('delete')
                      <a href="/admin/category/{{ $category->id }}/edit" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
                      <button class="btn btn-danger btn-flat btn-sm" onclick="return confirm('Are you sure to delete this?')"> <i class="fa fa-trash-o"></i></button>
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
                              Showing {{($categorys->currentpage()-1)*$categorys->perpage()+1}} to  {{ $categorys->currentpage()*(($categorys->perpage() < $categorys->total()) ? $categorys->perpage(): $categorys->total())}} of {{ $categorys->total()}} entries</span>
                      </div>
                    <div class="col-sm-6 text-right">
              {{ $categorys->links() }}
                        
                    </div>
                  </div>
              </div>
          </div>
          @else
              <div class="alert alert-danger">No record found!</div>
          @endif
            <!-- /.box-body -->
          </div>

    </section>
    @endsection
