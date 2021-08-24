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
  <script>
    document.addEventListener('livewire:load', function() {
        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;
        var calendarEl = document.getElementById('calendar');
        var checkbox = document.getElementById('drop-remove');
        var data =   @this.events;
        var calendar = new Calendar(calendarEl, {
        events: JSON.parse(data),
        dateClick(info)  {
           var title = prompt('Enter Event Title');
           var date = new Date(info.dateStr + 'T00:00:00');
           if(title != null && title != ''){
             calendar.addEvent({
                title: title,
                start: date,
                allDay: true
              });
             var eventAdd = {title: title,start: date};
             @this.addevent(eventAdd);
             alert('Great. Now, update your database...');
           }else{
            alert('Event Title Is Required');
           }
        },
        editable: true,
        selectable: true,
        displayEventTime: false,
        droppable: true, // this allows things to be dropped onto the calendar
        drop: function(info) {
            // is the "remove after drop" checkbox checked?
            if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        },
        eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
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
        @this.on(`refreshCalendar`, () => {
            calendar.refetchEvents()
        });
    });
  </script>
@endpush
