@extends ('admin_dashboard')
@section('admin')

<div class="content">
  <!-- Start Content-->
  <div class="container-fluid">
    <!-- start page title -->
    <div class="row">
      <div class="col-12">
        <div class="page-title-box">
          <div class="page-title-right">

          </div>
          <h4 class="page-title">Pending Orders</h4>
        </div>
      </div>
    </div>
    <!-- end page title -->

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">

            <table
              id="basic-datatable"
              class="table dt-responsive nowrap w-100">
              <thead>
                <tr>
                  <th>Orders ID</th>
                  <th>Customer Name</th>
                  <th>Order Date</th>
                  <th>Payment Method</th>
                  <th>Invoice No.</th>
                  <th>Pay</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($orders as $key=>$item)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{$item['customer']['customerName']}}</td>
                  <td>{{$item->orderDate}}</td>
                  <td>{{$item->payment_status}}</td>
                  <td>{{$item->invoice_no}}</td>
                  <td>{{$item->pay}}</td>
                  <td> <span class="badge bg-danger">{{ $item->orderStatus }}</span> </td>
                  <td>
                    <a href="{{ route('order.details', $item->id)}}"><i class="fa-regular fa-pen-to-square fa-2xl"></i></a>&nbsp;&nbsp;&nbsp;
                  </td>
                  @endforeach
              </tbody>
            </table>
          </div>
          <!-- end card body-->
        </div>
        <!-- end card -->
      </div>
      <!-- end col-->
    </div>
    <!-- end row-->
  </div>
  <!-- container -->
</div>
<!-- content -->
@endsection