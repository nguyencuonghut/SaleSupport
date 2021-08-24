@section('title')
    Cập nhật chính sách
@endsection

@push('styles')
<!-- summernote -->
<link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
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
              <li class="breadcrumb-item"><a href="{{route('admin.policies')}}">Chính sách</a></li>
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
                  <h3 class="card-title">Cập nhật chính sách</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form wire:submit.prevent="editPolicy">
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
                            <div wire:key="UNIQUE_KEY">
                              <div wire:ignore>
                                <label class="col-form-label" for="date_range">Thời gian áp dụng<span> *</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="date_range" name="date_range" wire:model="date_range">
                                </div>
                              </div>
                            </div>
                            @error('date_range')
                              <span class="text-danger"> {{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div wire:key="UNIQUE_KEY">
                          <div wire:ignore>
                            <label class="col-form-label" for="content">Nội dung<span> *</span></label>
                            <textarea id="content" name="content" wire:model="content">
                            </textarea>
                          </div>
                        </div>
                        @error('content')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
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
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
    // Summernote
    $('#content').summernote({
        height: 100,
        callbacks: {
            onChange: function(contents, $editable) {
                @this.set('content', contents);
            },
        }
    });
    $("#content").on("summernote.enter", function(we, e) {
        $(this).summernote("pasteHTML", "<br><br>");
        e.preventDefault();
    });

    //Date range picker
    $('#date_range').daterangepicker();
    $('#date_range').change(function (e) {
        let elementName = $(this).attr('id');
        @this.set(elementName, e.target.value);
    });
</script>
@endpush
