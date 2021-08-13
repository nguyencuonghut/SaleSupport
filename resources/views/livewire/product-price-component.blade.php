@section('title')
    Giá theo sản phẩm
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
              <li class="breadcrumb-item"><a href="{{route('admin.products')}}">Sản phẩm </a></li>
              <li class="breadcrumb-item active">{{$product->code}}</li>
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
                <h3 class="card-title">Bảng giá {{$product->code}}</h3>
                <div class="card-tools" style="margin: 5px;">
                    <div class="input-group input-group-sm">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search" wire:model="search">
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
                        <a wire:click.prevent="sortBy('discount')" role="button" href="#" style="color:#212529">Trừ trực tiếp</a>
                        @if($sortField == 'discount')
                        <i class="fa {{ $sortAsc == true ? 'fa-sort-up' : 'fa-sort-down' }}" style=" {{ $sortField == 'discount' ? '' : 'color:#cccccc'}} "></i>
                        @else
                        <i class="fa fa-sort" style="color:#cccccc"></i>
                        @endif
                      </th>
                      <th>
                        <a wire:click.prevent="sortBy('company_price')" role="button" href="#" style="color:#212529">Giá nhà máy</a>
                        @if($sortField == 'company_price')
                        <i class="fa {{ $sortAsc == true ? 'fa-sort-up' : 'fa-sort-down' }}" style=" {{ $sortField == 'company_price' ? '' : 'color:#cccccc'}} "></i>
                        @else
                        <i class="fa fa-sort" style="color:#cccccc"></i>
                        @endif
                      </th>
                      <th>
                        <a wire:click.prevent="sortBy('warehouse_price')" role="button" href="#" style="color:#212529">Giá kho</a>
                        @if($sortField == 'warehouse_price')
                        <i class="fa {{ $sortAsc == true ? 'fa-sort-up' : 'fa-sort-down' }}" style=" {{ $sortField == 'warehouse_price' ? '' : 'color:#cccccc'}} "></i>
                        @else
                        <i class="fa fa-sort" style="color:#cccccc"></i>
                        @endif
                      </th>
                      <th>
                        <a wire:click.prevent="sortBy('ht_warehouse_price')" role="button" href="#" style="color:#212529">Giá kho Hà Tĩnh</a>
                        @if($sortField == 'ht_warehouse_price')
                        <i class="fa {{ $sortAsc == true ? 'fa-sort-up' : 'fa-sort-down' }}" style=" {{ $sortField == 'ht_warehouse_price' ? '' : 'color:#cccccc'}} "></i>
                        @else
                        <i class="fa fa-sort" style="color:#cccccc"></i>
                        @endif
                      </th>
                      <th>Thời gian tạo</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($prices as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{number_format($item->discount, 0, '.', ',') }}</td>
                            <td>{{number_format($item->company_price, 0, '.', ',') }}</td>
                            <td>{{number_format($item->warehouse_price, 0, '.', ',') }}</td>
                            <td>{{number_format($item->ht_warehouse_price, 0, '.', ',') }}</td>
                            <td>{{$item->created_at}}</td>
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
                        <p>Hiển thị {{$prices->count()}} dòng trong tổng số {{$prices->total()}} dòng</p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        @if ($prices->lastPage() > 1)
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" wire:click="gotoPage(1)">Đầu</a></li>
                  @for ($i = 1; $i <= $prices->lastPage(); $i++)
                    <?php
                    $half_total_links = floor(5 / 2);
                    $from = $prices->currentPage() - $half_total_links;
                    $to = $prices->currentPage() + $half_total_links;
                    if ($prices->currentPage() < $half_total_links) {
                      $to += $half_total_links - $prices->currentPage();
                    }
                    if ($prices->lastPage() - $prices->currentPage() < $half_total_links) {
                      $from -= $half_total_links - ($prices->lastPage() - $prices->currentPage()) - 1;
                    }
                    ?>

                    @if ($from < $i && $i < $to)
                      <li class="page-item"><a class="page-link {{ ($prices->currentPage() == $i) ? "current" : "" }}" wire:click="gotoPage('{{ $i }}')" >{{ $i }}</a></li>
                    @endif
                    @endfor
                  <li class="page-item"><a class="page-link" wire:click="gotoPage('{{ $prices->lastPage() }}')">Cuối</a></li>
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
