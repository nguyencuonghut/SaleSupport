@section('title')
    Chính sách
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
              <li class="breadcrumb-item active">Chính sách</li>
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
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="btn-group" role="group" aria-label="Basic example" style="text-align:center">
                            <button type="button" class="btn btn-secondary" wire:click="exportExcel('xlsx')" wire:loading.attr="disable">Excel</button>
                            <button type="button" class="btn btn-secondary" wire:click="exportPdf('pdf')" wire:loading.attr="disable">Pdf</button>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="card-tools" style="margin: 5px;">
                            <div class="input-group input-group-sm">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search" wire:model="search">

                                <div class="input-group-append">
                                  <a href="{{route('admin.add.policy')}}" class="btn btn-success"><i class="fas fa-plus"></i></a>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
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
                        <a wire:click.prevent="sortBy('content')" role="button" href="#" style="color:#212529">Nội dung</a>
                        @if($sortField == 'content')
                        <i class="fa {{ $sortAsc == true ? 'fa-sort-up' : 'fa-sort-down' }}" style=" {{ $sortField == 'content' ? '' : 'color:#cccccc'}} "></i>
                        @else
                        <i class="fa fa-sort" style="color:#cccccc"></i>
                        @endif
                      </th>
                      <th>
                        <a wire:click.prevent="sortBy('date_range')" role="button" href="#" style="color:#212529">Thời gian áp dụng</a>
                        @if($sortField == 'date_range')
                        <i class="fa {{ $sortAsc == true ? 'fa-sort-up' : 'fa-sort-down' }}" style=" {{ $sortField == 'date_range' ? '' : 'color:#cccccc'}} "></i>
                        @else
                        <i class="fa fa-sort" style="color:#cccccc"></i>
                        @endif
                      </th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($policies as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{!! $item->content !!}</td>
                            <td>{{$item->date_range}}</td>
                            <td>
                                <a href="#"><i class="fa fa-eye"></i></a>
                                <a href="#"><i class="fa fa-edit"></i></a>
                                <a href="#" wire:click.prevent="deletePolicy({{$item->id}})"><i class="fa fa-trash"></i></a>
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
                        <p>Hiển thị {{$policies->count()}} dòng trong tổng số {{$policies->total()}} dòng</p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        @if ($policies->lastPage() > 1)
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" wire:click="gotoPage(1)">Đầu</a></li>
                  @for ($i = 1; $i <= $policies->lastPage(); $i++)
                    <?php
                    $half_total_links = floor(5 / 2);
                    $from = $policies->currentPage() - $half_total_links;
                    $to = $policies->currentPage() + $half_total_links;
                    if ($policies->currentPage() < $half_total_links) {
                      $to += $half_total_links - $policies->currentPage();
                    }
                    if ($policies->lastPage() - $policies->currentPage() < $half_total_links) {
                      $from -= $half_total_links - ($policies->lastPage() - $policies->currentPage()) - 1;
                    }
                    ?>

                    @if ($from < $i && $i < $to)
                      <li class="page-item"><a class="page-link {{ ($policies->currentPage() == $i) ? "current" : "" }}" wire:click="gotoPage('{{ $i }}')" >{{ $i }}</a></li>
                    @endif
                    @endfor
                  <li class="page-item"><a class="page-link" wire:click="gotoPage('{{ $policies->lastPage() }}')">Cuối</a></li>
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
