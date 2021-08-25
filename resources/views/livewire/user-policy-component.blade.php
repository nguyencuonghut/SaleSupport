@section('title')
    Chính sách
@endsection

@push('styles')
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{asset('plugins/fullcalendar/main.css')}}">
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
              <li class="breadcrumb-item active">Chính sách</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                  <div class="card card-primary">
                    <div class="card-body p-0">
                      <!-- THE CALENDAR -->
                      <div id="calendar"></div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>

@push('scripts')
  <!-- fullCalendar 2.2.5 -->
  <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('plugins/fullcalendar/main.js')}}"></script>
  <script src="{{asset('plugins/fullcalendar/locales-all.js')}}"></script>

  <script>
    document.addEventListener('livewire:load', function() {
        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar');
        var data =   @this.events;
        var calendar = new Calendar(calendarEl, {
        locale: 'vi',
        headerToolbar: {
            left  : 'prev,next today',
            center: 'title',
            right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        eventTextColor: 'black',
        editable: true,
        events: JSON.parse(data),
        loading: function(isLoading) {
                if (!isLoading) {
                    // Reset custom events
                    this.getEvents().forEach(function(e){
                        if (e.source === null) {
                            e.remove();
                        }
                    });
                }
            }
        });
        calendar.render();
        //console.log(@this.events);
    });
  </script>
@endpush
