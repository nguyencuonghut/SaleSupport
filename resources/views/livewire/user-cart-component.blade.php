@section('title')
    Giỏ hàng
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
              <li class="breadcrumb-item active">Giỏ hàng</li>
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

            @if(Cart::count() > 0)
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Giỏ hàng</h3>
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
                      <th>STT</th>
                      <th>Mã SP</th>
                      <th>Quy cách</th>
                      <th>Trừ trực tiếp</th>
                      <th>Giá nhà máy</th>
                      <th>Giá kho</th>
                      <th>Giá kho HT</th>
                      <th>Số bao</th>
                      <th>Trọng lượng</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                      @php
                          $i = 0;
                      @endphp
                    @foreach (Cart::content() as $item)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->options->weight}}</td>
                            <td>{{$item->options->discount}}</td>
                            <td>{{number_format($item->price, 0, '.', ',')}}</td>
                            <td>{{number_format($item->options->warehouse_price, 0, '.', ',')}}</td>
                            <td>{{number_format($item->options->ht_warehouse_price, 0, '.', ',')}}</td>
                            <td>{{$item->qty}}</td>
                            <td>{{number_format($item->qty * $item->options->weight, 0, '.', ',')}} kg</td>
                            <td>
                                <a href="#"><i class="fa fa-edit"></i></a>
                                <a href="#" wire:click.prevent="destroy('{{ $item->rowId }}')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                      <td colspan="4"><b>Cộng tiền hàng<b></td>
                      <td>{{number_format($subtotal_company, 0, '.', ',')}}</td>
                      <td>{{number_format($subtotal_warehouse, 0, '.', ',')}}</td>
                      <td>{{number_format($subtotal_ht_warehouse, 0, '.', ',')}}</td>
                      <td>{{number_format($total_qty, 0, '.', ',')}}</td>
                      <td>{{number_format($total_weight, 0, '.', ',')}} kg</td>
                    </tr>
                    <tr>
                      <td colspan="4"><b>Các khoản giảm trừ<b></td>
                      <td>{{number_format($subtotal_discount, 0, '.', ',')}}</td>
                      <td>{{number_format($subtotal_discount, 0, '.', ',')}}</td>
                      <td>{{number_format($subtotal_discount, 0, '.', ',')}}</td>
                    </tr>
                    <tr>
                      <td colspan="4"><b>Tiền phải nộp</b></td>
                      <td>{{number_format($subtotal_company - $subtotal_discount, 0, '.', ',')}}</td>
                      <td>{{number_format($subtotal_warehouse - $subtotal_discount, 0, '.', ',')}}</td>
                      <td>{{number_format($subtotal_ht_warehouse - $subtotal_discount, 0, '.', ',')}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" wire:click.prevent="destroyAll()">Xóa tất cả</button>
            </div>
            </div>
            <!-- /.card -->
            @else
            <h3>Giỏ hàng trống!</h3>
            <a href="{{route('user.add.order')}}" class="btn btn-success">Tạo đơn hàng</a>

            @endif
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
