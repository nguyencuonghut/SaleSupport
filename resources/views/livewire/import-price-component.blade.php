@section('title')
    Import bảng giá
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
              <li class="breadcrumb-item"><a href="{{route('admin.prices')}}">Bảng giá</a></li>
              <li class="breadcrumb-item active">Import bảng giá</li>
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
              <div class="card-header bg-primary">
                <h3 class="card-title">Import bảng giá</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form enctype="multipart/form-data" wire:submit.prevent="import">
                    @csrf
                    <input type="file" name="file" id="file" class="form-control" wire:model="file">
                    @error('file')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror
                    <br>
                    <button type="submit" class="btn btn-success">Import</button>
                </form>
              </div>
              <!-- /.card-body -->
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
