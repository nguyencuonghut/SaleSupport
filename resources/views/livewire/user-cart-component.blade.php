@section('title')
    Giỏ hàng
@endsection

<div>

  <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa số bao</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label" for="qty">Số bao<span> *</span></label>
                        <input type="number" class="form-control" id="qty" name="qty" wire:model="qty">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Cập nhật</button>
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
              <li class="breadcrumb-item"><a href="{{route('user.add.order')}}">Đặt hàng</a></li>
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
            @error('qty')
            <span class="text-danger"> {{ $message }}</span>
            @enderror

            @if(Cart::count() > 0)
            <!-- Order table -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Giỏ hàng</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Mã SP</th>
                      <!--
                      <th>Quy cách</th>
                      <th>Trừ trực tiếp</th>
                      <th>Giá nhà máy</th>
                      <th>Giá kho</th>
                      <th>Giá kho HT</th>
                      -->
                      <th>Số bao</th>
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
                            <!--
                            <td>{{$item->options->weight}}</td>
                            <td>{{$item->options->discount}}</td>
                            <td>{{number_format($item->price, 0, '.', ',')}}</td>
                            <td>{{number_format($item->options->warehouse_price, 0, '.', ',')}}</td>
                            <td>{{number_format($item->options->ht_warehouse_price, 0, '.', ',')}}</td>
                            <td>{{number_format($item->qty * $item->options->weight, 0, '.', ',')}} kg</td>
                            -->
                            <td>{{$item->qty}}</td>
                            <td>
                                <button data-toggle="modal" data-target="#updateModal" wire:click="edit('{{$item->rowId}}')" class="btn btn-warning btn-xs">Sửa</button>
                                <button class="btn btn-danger btn-xs" wire:click.prevent="destroy('{{ $item->rowId }}')">Xóa</button>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" wire:click.prevent="destroyAll()">Xóa tất cả</button>
              </div>
            </div>
            <!-- /.card -->

            <!-- Invoice table -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tiền hàng</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <tr>
                    <td>Tổng trọng lượng</td>
                    <td>{{number_format($total_weight , 0, '.', ',')}} kg</td>
                  </tr>
                  <tr>
                    <td>Tiền hàng</td>
                    <td>{{number_format($subtotal_company , 0, '.', ',')}} đ</td>
                  </tr>
                  <tr>
                    <td>Giảm trừ</td>
                    <td>{{number_format($subtotal_discount , 0, '.', ',')}} đ</td>
                  </tr>
                  <tr>
                    <td style="color: blue;">Tiền nộp</td>
                    <td style="color: blue;">{{number_format($subtotal_company - $subtotal_discount, 0, '.', ',')}} đ</td>
                  </tr>
                </table>
              </div>
              <!-- /.card-body -->
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
