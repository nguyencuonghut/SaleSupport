@section('title')
    Sản phẩm
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
              <li class="breadcrumb-item active">Sản phẩm</li>
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
                                  <a href="{{route('admin.add.product')}}" class="btn btn-success"><i class="fas fa-plus"></i></a>
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
                        <a wire:click.prevent="sortBy('code')" role="button" href="#" style="color:#212529">Mã</a>
                        @if($sortField == 'code')
                        <i class="fa {{ $sortAsc == true ? 'fa-sort-up' : 'fa-sort-down' }}" style=" {{ $sortField == 'code' ? '' : 'color:#cccccc'}} "></i>
                        @else
                        <i class="fa fa-sort" style="color:#cccccc"></i>
                        @endif
                      </th>
                      <th>
                        <a wire:click.prevent="sortBy('weight')" role="button" href="#" style="color:#212529">Quy cách</a>
                        @if($sortField == 'weight')
                        <i class="fa {{ $sortAsc == true ? 'fa-sort-up' : 'fa-sort-down' }}" style=" {{ $sortField == 'weight' ? '' : 'color:#cccccc'}} "></i>
                        @else
                        <i class="fa fa-sort" style="color:#cccccc"></i>
                        @endif
                      </th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td><a href="{{route('admin.show.productprice', $item->id)}}">{{$item->code}}</a></td>
                            <td>{{$item->weight}} kg</td>
                            <td>
                                <a href="{{route('admin.edit.product', $item->id)}}"><i class="fa fa-edit"></i></a>
                                <a href="#" wire:click.prevent="deleteProduct({{$item->id}})"><i class="fa fa-trash"></i></a>
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
                        <p>Hiển thị {{$products->count()}} dòng trong tổng số {{$products->total()}} dòng</p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        @if ($products->lastPage() > 1)
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" wire:click="gotoPage(1)">Đầu</a></li>
                  @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <?php
                    $half_total_links = floor(5 / 2);
                    $from = $products->currentPage() - $half_total_links;
                    $to = $products->currentPage() + $half_total_links;
                    if ($products->currentPage() < $half_total_links) {
                      $to += $half_total_links - $products->currentPage();
                    }
                    if ($products->lastPage() - $products->currentPage() < $half_total_links) {
                      $from -= $half_total_links - ($products->lastPage() - $products->currentPage()) - 1;
                    }
                    ?>

                    @if ($from < $i && $i < $to)
                      <li class="page-item"><a class="page-link {{ ($products->currentPage() == $i) ? "current" : "" }}" wire:click="gotoPage('{{ $i }}')" >{{ $i }}</a></li>
                    @endif
                    @endfor
                  <li class="page-item"><a class="page-link" wire:click="gotoPage('{{ $products->lastPage() }}')">Cuối</a></li>
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
