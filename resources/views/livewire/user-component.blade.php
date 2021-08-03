@section('title')
    Người dùng
@endsection

<div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
              <li class="breadcrumb-item active">Người dùng</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Display session message -->
            @if(Session::has('success_message'))
            <div class="alert alert-success">
              {{ Session::get('success_message') }}
            </div>
          @endif
          @if(Session::has('error_message'))
            <div class="alert alert-danger">
              {{ Session::get('error_message') }}
            </div>
          @endif

            <div class="card">
              <div class="card-header">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="btn-group" role="group" aria-label="Basic example" style="text-align:center">
                            <button type="button" class="btn btn-secondary">Excel</button>
                            <button type="button" class="btn btn-secondary">Pdf</button>
                            <button type="button" class="btn btn-secondary">Print</button>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card-tools" style="margin: 5px;">
                            <div class="input-group input-group-sm">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search" wire:model="search">

                                <div class="input-group-append">
                                  <a href="{{ route('admin.add.user') }}" class="btn btn-success"><i class="fas fa-plus"></i></a>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>
                        <a wire:click.prevent="sortBy('id')" role="button" href="#" style="color:#212529">ID</a>
                        @if($sortField == 'id')
                        <i class="fa {{ $sortAsc == true ? 'fa-sort-up' : 'fa-sort-down' }}" style=" {{ $sortField == 'id' ? '' : 'color:#cccccc'}} "></i>
                        @else
                        <i class="fa fa-sort" style="color:#cccccc"></i>
                        @endif
                      </th>
                      <th>
                        <a wire:click.prevent="sortBy('name')" role="button" href="#" style="color:#212529">Tên</a>
                        @if($sortField == 'name')
                        <i class="fa {{ $sortAsc == true ? 'fa-sort-up' : 'fa-sort-down' }}" style=" {{ $sortField == 'name' ? '' : 'color:#cccccc'}} "></i>
                        @else
                        <i class="fa fa-sort" style="color:#cccccc"></i>
                        @endif
                      </th>
                      <th>
                        <a wire:click.prevent="sortBy('email')" role="button" href="#" style="color:#212529">Email</a>
                        @if($sortField == 'email')
                        <i class="fa {{ $sortAsc == true ? 'fa-sort-up' : 'fa-sort-down' }}" style=" {{ $sortField == 'email' ? '' : 'color:#cccccc'}} "></i>
                        @else
                        <i class="fa fa-sort" style="color:#cccccc"></i>
                        @endif
                      </th>
                      <th>
                        <a wire:click.prevent="sortBy('type')" role="button" href="#" style="color:#212529">Quyền</a>
                        @if($sortField == 'type')
                        <i class="fa {{ $sortAsc == true ? 'fa-sort-up' : 'fa-sort-down' }}" style=" {{ $sortField == 'type' ? '' : 'color:#cccccc'}} "></i>
                        @else
                        <i class="fa fa-sort" style="color:#cccccc"></i>
                        @endif
                      </th>
                      <th>
                        <a wire:click.prevent="sortBy('department_id')" role="button" href="#" style="color:#212529">Phòng ban</a>
                        @if($sortField == 'department_id')
                        <i class="fa {{ $sortAsc == true ? 'fa-sort-up' : 'fa-sort-down' }}" style=" {{ $sortField == 'department_id' ? '' : 'color:#cccccc'}} "></i>
                        @else
                        <i class="fa fa-sort" style="color:#cccccc"></i>
                        @endif
                      </th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->type}}</td>
                            <td><a href="{{route('admin.show.department', $item->department->id)}}">{{$item->department->name}}</a></td>
                            <td>
                                <a href="#"><i class="fa fa-eye"></i></a>
                                <a href="{{route('admin.edit.user', $item->id)}}"><i class="fa fa-edit"></i></a>
                                <a href="{{route('admin.resetpassword', $item->id)}}"><i class="fa fa-key"></i></a>
                                <a href="#" wire:click.prevent="deleteUser({{$item->id}})"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->

              <!-- Paginate -->
              <div class="card-footer clearfix">
                  <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <p>Hiển thị {{$users->count()}} dòng trong tổng số {{$users->total()}} dòng</p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        @if ($users->lastPage() > 1)
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" wire:click="gotoPage(1)">Đầu</a></li>
                  @for ($i = 1; $i <= $users->lastPage(); $i++)
                    <?php
                    $half_total_links = floor(5 / 2);
                    $from = $users->currentPage() - $half_total_links;
                    $to = $users->currentPage() + $half_total_links;
                    if ($users->currentPage() < $half_total_links) {
                      $to += $half_total_links - $users->currentPage();
                    }
                    if ($users->lastPage() - $users->currentPage() < $half_total_links) {
                      $from -= $half_total_links - ($users->lastPage() - $users->currentPage()) - 1;
                    }
                    ?>

                    @if ($from < $i && $i < $to)
                      <li class="page-item"><a class="page-link {{ ($users->currentPage() == $i) ? "current" : "" }}" wire:click="gotoPage('{{ $i }}')" >{{ $i }}</a></li>
                    @endif
                    @endfor
                  <li class="page-item"><a class="page-link" wire:click="gotoPage('{{ $users->lastPage() }}')">Cuối</a></li>
                </ul>
                @endif
                    </div>
                  </div>
              </div>
              <!-- /.Paginate -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
