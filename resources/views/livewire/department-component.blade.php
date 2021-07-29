@section('title')
    Phòng Ban
@endsection

@section('brand')
    Phòng Ban
@endsection
<div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Tất cả phòng/ban</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    #
                  </th>
                  <th>
                    Mã
                  </th>
                  <th>
                    Tên
                  </th>
                  <th>
                    Số nhân viên
                  </th>
                  <th>
                    Ngày tạo
                  </th>
                </thead>
                <tbody>
                    @foreach ($departments as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a style="color: #212529 !important" href={{route('admin.show.department', $item->id)}}>{{ $item->code }}</a></td>
                        <td><a style="color: #212529 !important" href={{route('admin.show.department', $item->id)}}>{{ $item->name }}</a></td>
                        <td>{{$item->users->count()}}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
