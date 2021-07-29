@section('title')
    Chi tiết phòng/ban
@endsection

@section('brand')
    Chi tiết phòng ban
@endsection
<div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">{{$department->name}}</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    Id
                  </th>
                  <th>
                    Tên
                  </th>
                  <th>
                    Email
                  </th>
                  <th>
                    Quyền
                  </th>
                  <th>
                    Ngày tạo
                  </th>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- Pagination -->
              <div class="wrap-pagination-info">
                @if ($users->lastPage() > 1)
                    <ul class="page-numbers">
                        <li><a class="page-number-item" wire:click="gotoPage(1)">Đầu</a></li>

                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                            <?php
                            $half_total_links = floor(5 / 2);
                            $from = $users->currentPage() - $half_total_links;
                            $to = $users->currentPage() + $half_total_links;
                            if ($users->currentPage() < $half_total_links) {
                                $to += $half_total_links - $users->currentPage();
                            }
                            if ($users->lastPage() - $users->currentPage() < $half_total_links) {
                                $from -= $half_total_links - ($users->lastPage() - $users->currentPage()) - 1;
                            }
                            ?>

                            @if ($from < $i && $i < $to)
                                <li><a class="page-number-item {{ ($users->currentPage() == $i) ? "current" : "" }}" wire:click="gotoPage('{{ $i }}')" >{{ $i }}</a></li>
                            @endif
                        @endfor
                        <li><a class="page-number-item" wire:click="gotoPage('{{ $users->lastPage() }}')">Cuối</a></li>
                    </ul>
                @endif
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
