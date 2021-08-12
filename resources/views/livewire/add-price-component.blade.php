@section('title')
    Thêm giá mới
@endsection
@push('styles')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
@endpush

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
              <li class="breadcrumb-item"><a href="{{route('admin.prices')}}">Bảng giá</a></li>
              <li class="breadcrumb-item active">Thêm mới</li>
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


            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Thêm giá mới</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form wire:submit.prevent="addPrice">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div wire:key="UNIQUE_KEY">
                                  <div wire:ignore>
                                    <label class="col-form-label" for="product_id">Sản phẩm<span> *</span></label>
                                    <select class="form-control select2" style="width: 100%;" name="product_id" id="product_id" wire:model="product_id">
                                      @foreach ($products as $product)
                                      <option value={{$product->id}}>{{$product->code}}</option>
                                      @endforeach
                                    </select>
                                    @error('product_id')
                                      <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label class="col-form-label" for="discount">Trừ trực tiếp<span> *</span></label>
                             <input type="text" class="form-control" id="discount" name="discount" wire:model="discount">
                             @error('discount')
                              <span class="text-danger"> {{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                              <label class="col-form-label" for="company_price">Giá nhà máy<span> *</span></label>
                              <input type="text" class="form-control" id="company_price" name="company_price" wire:model="company_price">
                              @error('company_price')
                              <span class="text-danger"> {{ $message }}</span>
                              @enderror
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                              <label class="col-form-label" for="warehouse_price">Giá kho<span> *</span></label>
                              <input type="text" class="form-control" id="warehouse_price" name="warehouse_price" wire:model="warehouse_price">
                              @error('warehouse_price')
                              <span class="text-danger"> {{ $message }}</span>
                              @enderror
                          </div>
                        </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                              <div class="form-group">
                                  <label class="col-form-label" for="ht_warehouse_price">Giá kho Hà Tĩnh<span> *</span></label>
                                  <input type="text" class="form-control" id="ht_warehouse_price" name="ht_warehouse_price" wire:model="ht_warehouse_price">
                                  @error('ht_warehouse_price')
                                  <span class="text-danger"> {{ $message }}</span>
                                  @enderror
                              </div>
                            </div>
                      </div>
                    </div>

                  <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Thêm</button>
                  </div>
                </form>
            </div>


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

@push('scripts')
<!-- Select2 -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
  $(document).ready(function () {
    $('#product_id').select2();
  });
  $('#product_id').change(function (e) {
    let elementName = $(this).attr('id');
    @this.set(elementName, e.target.value);
  });

</script>
@endpush
