@section('title')
    Cập nhật người dùng
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
              <li class="breadcrumb-item active">Cập nhật</li>
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
                  <h3 class="card-title">Cập nhật người dùng</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form wire:submit.prevent="editUser">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label class="col-form-label" for="name">Tên<span> *</span></label>
                            <input type="text" class="form-control" id="name" name="name" wire:model="name">
                            @error('name')
                              <span class="text-danger"> {{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label class="col-form-label" for="email">Email<span> *</span></label>
                             <input type="text" class="form-control" id="email" name="email" wire:model="email">
                            @error('email')
                              <span class="text-danger"> {{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div wire:key="UNIQUE_KEY">
                                  <div wire:ignore>
                                    <label class="col-form-label" for="department_id">Phòng ban<span> *</span></label>
                                    <select class="form-control select2" style="width: 100%;" name="department_id" id="department_id" wire:model="department_id">
                                      @foreach ($departments as $department)
                                      <option value={{$department->id}}>{{$department->name}}</option>
                                      @endforeach
                                    </select>
                                    @error('department_id')
                                      <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <div wire:key="UNIQUE_KEY">
                                  <div wire:ignore>
                                    <label class="col-form-label" for="type">Quyền<span> *</span></label>
                                    <select class="form-control select2" style="width: 100%;" name="type" id="type" wire:model="type">
                                      <option value='USER'>USER</option>
                                      <option value='ADMIN'>ADMIN</option>
                                    </select>
                                    @error('department_id')
                                      <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                  </div>
                                </div>
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
