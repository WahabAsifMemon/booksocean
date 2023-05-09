@extends('admin/layout/master')
@section('page-title')
  Manage Team
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
                            <a href="/admin/team/create" class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
                        </h3>
                        <div class="box-tools">
                            <form method="GET" action="/admin/team">
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
                        @if($teams)
                        <table class="table table-bordered">
                            <thead style="background-color: #F8F8F8;">
                                <tr>
                                    <th width="4%"><input type="checkbox" name="" id="checkAll"></th>
                                    <th width="20%">Fullname</th>
                                    <th width="20%">Designation</th>
                                    <th width="20%">Team Image</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Manage</th>
                                </tr>
                            </thead>
                            @foreach($teams as $team)
                            <tr>
                                <td><input type="checkbox" name="" id="" class="checkSingle"></td>
                                <td>{{$team->fullname}}</td>
                                <td>{{$team->designation}}</td>
                                <td>
                                    @if($team->team_img == 'No image found')
                                    <img src="/assets/admin/dist/img/no-img.png" width="100" height="100" class="img-thumbnail" alt="No image found">
                                    @else
                                    <img src="/uploads/{{$team->team_img}}" width="100" height="100"  alt="{{$team->title}}">
                                    @endif
                                </td>
                                <td>
                                    @if($team->status == 'DEACTIVE')
                      <button class="btn btn-danger btn-sm updatingStatus" status="DEACTIVE" id="{{ $team->id }}" table="team"><i id="icon_{{ $team->id }}" class="fa fa-thumbs-down"></i></button>
                    @else
                      <button class="btn btn-info btn-sm updatingStatus" status="ACTIVE" id="{{ $team->id }}" table="team"><i id="icon_{{ $team->id }}" class="fa fa-thumbs-up"></i></button>
                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="/admin/team/{{  $team->id}}">
                                        @csrf
                                        @method('delete')
                                    <a href="/admin/team/{{ $team->id }}/edit" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
                                    <button class="btn btn-danger btn-flat btn-sm" onclick="confirm('Are you sure to delete this?')"> <i class="fa fa-trash-o"></i></button>
                                </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    @else
                        <div class="alert alert-danger">No record found!</div>
                    @endif
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="row">
                            <div class="col-sm-6">
                                <span style="display:block;font-size:15px;line-height:34px;margin:20px 0;">
                                    Showing {{($teams->currentpage()-1)*$teams->perpage()+1}} to  {{ $teams->currentpage()*(($teams->perpage() < $teams->total()) ? $teams->perpage(): $teams->total())}} of {{ $teams->total()}} entries</span>
                            </div>
                            <div class="col-sm-6 text-right">
                    {{ $teams->links() }}
                               
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
        </div>
        </section>
        @endsection