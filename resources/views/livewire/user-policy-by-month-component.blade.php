@section('title')
    Chính sách tháng {{Carbon\Carbon::now()->format('m-Y')}}
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
              <li class="breadcrumb-item active">Chính sách tháng {{Carbon\Carbon::now()->format('m-Y')}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-md-3">
                @foreach ($policies as $policy)
                <div class="col mb-4">
                    <div class="card h-100">
                      <div class="card-body">
                        <h5 class="card-title"><b>{{$policy->title}}</b></h5>
                        <br>
                        <h5 class="card-title"><i>{{Carbon\Carbon::parse($policy->start)->format('m/d/Y')}} - {{Carbon\Carbon::parse($policy->end)->format('m/d/Y')}}</i></h5>
                        <p class="card-text">{!!$policy->content!!}</p>
                      </div>
                    </div>
                  </div>
                @endforeach
            </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>

@push('scripts')
    <script>
        function get_random_color() {
            var letters = '3456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++ ) {
                color += letters[Math.round(Math.random() * 12)];
            }
            return color;
        }

        $(".card").each(function() {
            $(this).css("background-color", get_random_color());
        });
    </script>
@endpush
