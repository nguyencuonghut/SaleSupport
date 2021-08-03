@section('title')
    Cấp lại mật khẩu
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
              <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Người dùng</a></li>
              <li class="breadcrumb-item active">Cấp lại mật khẩu</li>
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
                  <h3 class="card-title">Cấp lại mật khẩu</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form wire:submit.prevent="resetPassword">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label class="col-form-label" for="password">Mật khẩu<span> *</span></label>
                            <input type="password" class="form-control" id="password" name="password" wire:model="password">
                            @error('password')
                              <span class="text-danger"> {{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label class="col-form-label" for="password_confirmation">Mật khẩu<span> *</span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" wire:model="password_confirmation">
                            @error('password_confirmation')
                              <span class="text-danger"> {{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Cập nhật</button>
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
    $('#department_id').select2();
  });
  $('#department_id').change(function (e) {
    let elementName = $(this).attr('id');
    @this.set(elementName, e.target.value);
  });

</script>
@endpush
