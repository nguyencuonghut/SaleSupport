@section('title')
    Đặt hàng
@endsection

<div>
  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createModalLabel">Thêm số bao</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <input type="number" class="form-control" id="qty" name="qty" wire:model="qty">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="button" wire:click.prevent="store()" class="btn btn-primary" data-dismiss="modal">Đặt hàng</button>
        </div>
    </div>
    </div>
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
              <li class="breadcrumb-item"><a href="{{route('user.cart')}}">Giỏ hàng</a></li>
              <li class="breadcrumb-item active">Đặt hàng</li>
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
            @error('qty')
            <span class="text-danger"> {{ $message }}</span>
            @enderror

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Đặt hàng</h3>
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
                        <a wire:click.prevent="sortBy('code')" role="button" href="#" style="color:#212529">Mã SP</a>
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
                      <th>Giá nhà máy</th>
                      <!--
                      <th>Trừ trực tiếp</th>
                      <th>Giá kho</th>
                      <th>Giá kho HT</th>
                      -->
                      <th>Đặt hàng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <td>{{$item->code}}</td>
                            <td>{{$item->weight}}</td>
                            <td>{{number_format($item->last_price->company_price, 0, '.', ',') }}</td>
                            <!--
                            <td>{{number_format($item->last_price->discount, 0, '.', ',') }}</td>
                            <td>{{number_format($item->last_price->warehouse_price, 0, '.', ',') }}</td>
                            <td>{{number_format($item->last_price->ht_warehouse_price, 0, '.', ',') }}</td>
                            -->
                            <td>
                                <button data-toggle="modal" data-target="#createModal" wire:click="create('{{$item->id}}')" class="btn btn-success btn-xs">Đặt ngay</button>
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
