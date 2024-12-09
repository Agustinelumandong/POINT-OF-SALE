<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>
    Invoice POS
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0 !important;
      padding: 0 !important;
      font-family: Arial, sans-serif;
      background-color: white !important;
    }

    .invoice-container {
      max-width: 100% !important;
      padding: 10px !important;
      background-color: #fff !important;
      border-radius: 5px !important;
    }

    .invoice-header {
      text-align: center !important;
      margin-bottom: 5px !important;
    }

    .invoice-details {
      font-size: 14px !important;
    }

    .invoice-details p {
      margin: 0 !important;
    }


    .invoice-footer {
      text-align: center !important;
      font-size: 14px !important;
    }

    .invoice-footer p {
      margin: 0 !important;
    }

    .line {
      border-top: 1px dashed #ddd !important;
      margin: 10px 0 !important;
    }

    .mgaTH,
    .mgaTH tr {
      background-color: #f8f9fa !important;
      font-size: 14px !important;
    }
  </style>
</head>

<body>

  <div class="invoice-container">
    <div class="invoice-header">
      <h5>Invoice POS</h5>
      <!-- <img alt="Company Logo" height="50" src="{{ asset('backend/assets/images/pos-logo.svg') }}" width="50" /> -->
    </div>
    <div class="invoice-details">
      <p><strong>Date :</strong> {{ $order->orderDate }}</p>
      <p><strong>Address :</strong> {{ $order->customer->customerAddress }}</p>
      <p><strong>Email :</strong> {{ $order->customer->customerEmail }}</p>
      <p><strong>Phone :</strong> {{ $order->customer->customerPhone }}</p>
      <p><strong>Customer :</strong> {{ $order->customer->customerName }}</p>
    </div>
    <div class="line">
    </div>

    <table class="table mt-3" style="width: 100%;">
      <thead>
        <tr class="mgaTH">
          <th>Item</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody style="text-align: center;">
        @foreach($orderItem as $item)
        <tr>
          <td>{{ $item->product->productName }}</td>
          <td>{{ $item->quantity }}</td>
          <td>{{ $item->unitCost }}</td>
          <td>{{ $item->totalCost }}</td>
        </tr>
        @endforeach
        <div class="line"></div>

      </tbody>
      <br />
      <tr>
        <td colspan="3" class="text-end" style="font-size: 14px;"><strong>Subtotal</strong></td>
        <td style="font-size: 14px;">${{$order->subTotal}}</td>
      </tr>
      <tr>
        <td colspan="3" class="text-end" style="font-size: 14px;"><strong>Tax (12%)</strong></td>
        <td style="font-size: 14px;">${{ $order->vat }}</td>
      </tr>
      <tr>
        <td colspan="3" class="text-end" style="font-size: 14px;"><strong>Total</strong></td>
        <td style="font-size: 14px;">${{ $order->total }}</td>
      </tr>
      <tr>
        <td colspan="3" class="text-end" style="font-size: 14px;"><strong>Pay</strong></td>
        <td style="font-size: 14px;">${{ $order->pay }}</td>
      </tr>
      <tr>
        <td colspan="3" class="text-end" style="font-size: 14px;"><strong>Change</strong></td>
        <td style="font-size: 14px;">${{ $order->pay - $order->total }}</td>
      </tr>
    </table>


    <div class="line">
    </div>
    <div class="invoice-footer">
      <p>
        <strong>Thank You For Shopping With Us .</strong>
      </p>
      <p>
        <strong>Please Come Again</strong>
      </p>
      </br>
      <p class="text-muted">{{$order->invoice_no}}</p>
    </div>
  </div>

</body>

</html>