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
                        <div class="card-tools">
                            <input type="text" name="table_search" class="form-control" placeholder="Search">
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Tên</th>
                      <th>Email</th>
                      <th>Quyền</th>
                      <th>Phòng ban</th>
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
                                <a href="#"><i class="fa fa-edit"></i></a>
                                <a href="#"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->

              <!-- Paginate -->
              <div class="card-footer clearfix">
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
