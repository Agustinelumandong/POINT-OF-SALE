@extends('admin_dashboard')
@section('admin')
    @livewireStyles

    @php
        use Gloudemans\Shoppingcart\Facades\Cart;
    @endphp



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Include Vue.js -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

    <style>
        #product-col {
            height: 100% !important;
        }

        #pos-column {
            height: 100% !important;
        }

        .pos-right-side {
            height: 810px !important;
            margin-bottom: 24px !important;
        }

        .pos-left-side {
            height: 810px !important;
            margin-bottom: 24px !important;
        }

        .pos-detail {
            height: 50% !important;
        }

        .btn-hover-zoom {
            transition: transform .2s;
            cursor: pointer;
        }

        .btn-hover-zoom:hover {
            transform: scale(1.1);
        }
    </style>

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                        </div>
                        <h4 class="page-title">POINT OF SALE</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-5 col-xl-5 " id="pos-column">
                    <div class="card pos-left-side">
                        <div class="card-body">

                            <!-- //Customer View -->
                            <div class="Customer">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group mb-2">
                                        <div role="group" class="input-group">
                                            <select name="customer_id" id="Customer" class="form-select rounded"
                                                style="cursor: pointer;">
                                                <option value="Walk-in-Customer" selected>Walk-In-Customer</option>
                                                @foreach ($customers as $customer)
                                                    @if (strtolower($customer->customerName) !== 'walk-in-customer' &&
                                                            strtolower($customer->customerName) !== 'walk-in customer')
                                                        <option value="{{ $customer->id }}">{{ $customer->customerName }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <a href="{{ route('add.customer') }}"><button type="button"
                                                    class="btn btn-success "><i class="fa-solid fa-plus"></i></button>
                                        </div></a>
                                    </div>
                                </div>
                            </div>

                            <!-- //Product Detail -->
                            <div class="pos-detail">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Product</th>
                                                <th scope="col">Price</th>
                                                <th scope="col" class="text-center">Qty</th>
                                                <th scope="col" class="text-center">Subtotal</th>
                                                <th scope="col" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $cartAll = Cart::content();
                                        @endphp
                                        <tbody>
                                            @foreach ($cartAll as $item)
                                                <tr>
                                                    <td><span>{{ $item->name }}</span> <br> <span
                                                            class="badge bg-success">{{ $item->id }}</span></td>
                                                    <td>₱ {{ $item->price }}</td>
                                                    <td>
                                                        <form method="post"
                                                            action="{{ url('/cart-update/' . $item->rowId) }}">
                                                            @csrf
                                                            <div class="quantity">
                                                                <div role="group" class="input-group">
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-sm btn-decrement">-</button>
                                                                    <input type="number"
                                                                        class="form-control quantity-input"
                                                                        value="{{ $item->qty }}" min="1"
                                                                        style="width:5px ;" name="qty">
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-sm btn-increment">+</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td class="text-center">₱ {{ $item->subtotal }}</td>
                                                    <!-- data-id=" $item->id " -->
                                                    <td>
                                                        <a href="{{ url('/cart-remove/' . $item->rowId) }}" title="Delete"
                                                            class=" cursor-pointer"><i
                                                                class="fas fa-trash-alt fa-2x text-danger cursor-pointer"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <br>
                            <div class="bg-success text-center m-1 container-fluid	">
                                <h3 class="p-1">₱{{ Cart::subtotal() }}</h3>
                            </div>

                            <a href="{{ url('/cart-destroy') }}">
                                <button type="button" class="btn btn-danger">Remove All</button>
                            </a>

                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#signup-modal">Pay Now</button>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col-->

                <div class="col-lg-7 col-xl-7" id="product-col">
                    <div class="card pos-right-side">
                        <div class="card-body">
                            <!-- Search control -->
                            <div class="mb-3">
                                <input type="text" autocomplete="" aria-autocomplete="" id="product-search"
                                    class="form-control" placeholder="Search by name, category, price or product code...">
                            </div>

                            <div class="tab-pane" id="settings">
                                <div id="product-grid" class="row">
                                    @foreach ($product as $key => $item)
                                        <div class="col-md-3 product-item mb-3 btn-hover-zoom"
                                            data-name="{{ strtolower($item->productName) }}"
                                            data-category="{{ strtolower($item['productCategory']['productCategoryName'] ?? '') }}"
                                            data-price="{{ $item->sellingPrice }}"
                                            data-code="{{ strtolower($item->productCode) }}">
                                            <div class="clickable" onclick="submitForm('{{ $item->id }}');">
                                                <form id="form-{{ $item->id }}" method="post"
                                                    action="{{ url('/add-cart') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input type="hidden" name="name" value="{{ $item->productName }}">
                                                    <input type="hidden" name="qty" value="1">
                                                    <input type="hidden" name="price"
                                                        value="{{ $item->sellingPrice }}">

                                                    <div class="card z-depth-0"
                                                        style="width: 100%; height: 100%; padding:10px 0 10px 0;">
                                                        <img class="card-img-top img-fluid"
                                                            src="{{ asset($item->productImage) }}" alt="Card image cap"
                                                            style="height: 150px; object-fit: cover;">
                                                        <div class="card-body mb-0 pb-0">
                                                            <h5 class="card-title m-0">
                                                                {{ htmlspecialchars($item->productName) }}</h5>
                                                            <p class="text-muted">{{ $item->productCode }}</p>
                                                            <p class="card-text badge bg-success p-1">₱
                                                                {{ number_format($item->sellingPrice, 2) }}</p>
                                                            <p class="card-text badge bg-warning ml-2 "
                                                                style="margin-left:70px;">
                                                                {{ $item->productStock }}</p>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Pagination controls -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <nav aria-label="Product navigation">
                                        <ul class="pagination mb-0">
                                            <li class="page-item" id="prev-page">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <li class="page-item page-number active" data-page="1"><a class="page-link"
                                                    href="#">1</a></li>
                                            <li class="page-item" id="next-page">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <!-- Modal content -->
                <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <header class="modal-header">
                                <h5 class="modal-title">Create Payment</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i
                                        class="fas fa-times"></i></button>
                            </header>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 mt-4">
                                        <p><strong>Order Date : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                {{ $todayDate->format('d-F-Y') }}</span></p>
                                        <p><strong>Order Status : </strong> <span class="float-end"><span
                                                    class="badge bg-danger">Unpaid</span></span></p>
                                        @php
                                            $invoice_no = 'EPOS' . mt_rand(100000, 999999);
                                        @endphp
                                        <input type="hidden" value="{{ $invoice_no }}" name="invoice_no">
                                        <p><strong>Invoice No. : </strong> <span class="float-end">{{ $invoice_no }}
                                            </span>
                                        </p>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="list-group">
                                                    <div
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        Total Products
                                                        <span
                                                            class="badge bg-success badge-pill">{{ Cart::count() }}</span>
                                                    </div>
                                                    <div
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        Order Tax
                                                        <span class="font-weight-bold">₱ {{ Cart::tax() }} (21%)</span>
                                                    </div>
                                                    <div
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        Sub-Total
                                                        <span class="font-weight-bold">₱ {{ Cart::subtotal() }}</span>
                                                    </div>

                                                    <div
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        Total Payable
                                                        <span class="font-weight-bold fw-bolder">₱
                                                            {{ Cart::total() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form id="complete-order-form" method="post" action="{{ url('/complete-order') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset class="form-group">
                                                <legend class="col-form-label pt-0">Payment</legend>
                                                <select name="payment_status" class="form-select" id="payment_status"
                                                    name="payment_status">
                                                    <option selected disabled>Select Payment</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Gcash">Gcash</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <legend class="col-form-label pt-0">Received Amount *</legend>
                                                <input type="text" placeholder="Received Amount" class="form-control"
                                                    id="pay" name="pay">
                                                <div class="invalid-feedback"></div>
                                            </fieldset>
                                            <div>
                                                <label>Change Return:</label>
                                                <p class="change_amount">0.00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="customers_id" id="modal_customers_id"
                                        value="Walk-in-Customer"> <!-- Set default value -->
                                    <input type="hidden" name="orderDate" value="{{ date('d-F-Y') }}">
                                    <input type="hidden" name="orderStatus" value="Pending">
                                    <input type="hidden" name="totalProducts" value="{{ Cart::count() }}">
                                    <input type="hidden" name="subTotal" value="{{ Cart::subtotal() }}">
                                    <input type="hidden" name="vat" value="{{ Cart::tax() }}">
                                    <input type="hidden" name="total" value="{{ Cart::total() }}">
                                    <div class="mb-3 text-center">
                                        <button type="submit" class="btn btn-success waves-effect waves-light"><i
                                                class="mdi mdi-printer me-1"></i> Complete Order</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>
            <!-- end row-->
        </div>

        <!-- container-fluid -->
    </div>
    <!-- content -->




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const payInput = document.getElementById('pay');
            const changeAmount = document.querySelector('.change_amount');
            const form = document.getElementById('complete-order-form');
            const totalInput = document.querySelector('input[name="total"]');
            const customerIdInput = document.getElementById('modal_customers_id');

            function calculateAndDisplayChange() {
                const total = parseFloat(totalInput.value) || 0;
                const receivedAmount = parseFloat(payInput.value) || 0;

                // Reset validation state
                payInput.classList.remove('is-invalid');

                // Check if it's a walk-in customer
                if (customerIdInput.value === 'Walk-in-Customer') {
                    if (receivedAmount < total) {
                        // Show error for insufficient payment
                        payInput.classList.add('is-invalid');
                        payInput.nextElementSibling.textContent =
                            'Payment must be equal to or greater than the total for walk-in customers.';
                        changeAmount.textContent = '0.00';
                    } else {
                        // Calculate and show change
                        const change = receivedAmount - total;
                        // changeAmount.textContent = change.toFixed(2);
                        if (change >= 0) {
                            changeAmount.textContent = change.toFixed(2);
                            changeAmount.style.color = 'green';
                        } else {
                            changeAmount.textContent = change.toFixed(2);
                            changeAmount.style.color = 'red';
                        }

                    }
                } else {
                    // For registered customers, just show change if payment is greater than total
                    const change = receivedAmount > total ? receivedAmount - total : 0;
                    if (change >= 0) {
                        changeAmount.textContent = change.toFixed(2);
                        changeAmount.style.color = 'green';
                    } else {
                        changeAmount.textContent = change.toFixed(2);

                        changeAmount.style.color = 'red';
                    }
                }
            }

            // Calculate change whenever payment amount changes
            payInput.addEventListener('input', calculateAndDisplayChange);

            // Validate form before submission
            form.addEventListener('submit', function(e) {
                const total = parseFloat(totalInput.value) || 0;
                const receivedAmount = parseFloat(payInput.value) || 0;

                if (customerIdInput.value === 'Walk-in-Customer' && receivedAmount < total) {
                    e.preventDefault();
                    payInput.classList.add('is-invalid');
                    payInput.nextElementSibling.textContent =
                        'Payment must be equal to or greater than the total for walk-in customers.';
                }
            });
        });
    </script>




    <script>
        document.getElementById('complete-order-form').addEventListener('submit', function(e) {
            // Submit the form using POST
            this.submit();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    customer_id: {
                        required: true,
                    },

                },
                messages: {
                    customer_id: {
                        required: 'Please Select Customer',
                    },


                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>




    <script>
        $(document).ready(function() {
            var currentPage = 1;
            var itemsPerPage = 12;
            var $items = $('.product-item');
            var filteredItems = $items;

            // Add this to verify items are being found
            console.log('Total items found:', $items.length);

            function createPaginationButtons(totalPages) {
                var $pagination = $('.pagination');
                var $pageNumbers = $pagination.find('.page-number');
                $pageNumbers.remove();

                // Always show first page
                var buttonsHTML =
                    '<li class="page-item page-number" data-page="1"><a class="page-link" href="#">1</a></li>';

                if (totalPages <= 7) {
                    // Show all pages if total pages are 7 or less
                    for (var i = 2; i <= totalPages; i++) {
                        buttonsHTML +=
                            `<li class="page-item page-number" data-page="${i}"><a class="page-link" href="#">${i}</a></li>`;
                    }
                } else {
                    // Show ellipsis for many pages
                    if (currentPage <= 4) {
                        for (var i = 2; i <= 5; i++) {
                            buttonsHTML +=
                                `<li class="page-item page-number" data-page="${i}"><a class="page-link" href="#">${i}</a></li>`;
                        }
                        buttonsHTML += '<li class="page-item disabled"><a class="page-link">...</a></li>';
                        buttonsHTML +=
                            `<li class="page-item page-number" data-page="${totalPages}"><a class="page-link" href="#">${totalPages}</a></li>`;
                    } else if (currentPage >= totalPages - 3) {
                        buttonsHTML += '<li class="page-item disabled"><a class="page-link">...</a></li>';
                        for (var i = totalPages - 4; i <= totalPages; i++) {
                            buttonsHTML +=
                                `<li class="page-item page-number" data-page="${i}"><a class="page-link" href="#">${i}</a></li>`;
                        }
                    } else {
                        buttonsHTML += '<li class="page-item disabled"><a class="page-link">...</a></li>';
                        for (var i = currentPage - 1; i <= currentPage + 1; i++) {
                            buttonsHTML +=
                                `<li class="page-item page-number" data-page="${i}"><a class="page-link" href="#">${i}</a></li>`;
                        }
                        buttonsHTML += '<li class="page-item disabled"><a class="page-link">...</a></li>';
                        buttonsHTML +=
                            `<li class="page-item page-number" data-page="${totalPages}"><a class="page-link" href="#">${totalPages}</a></li>`;
                    }
                }

                $pagination.find('#next-page').before(buttonsHTML);
                $pagination.find(`[data-page="${currentPage}"]`).addClass('active');
            }

            function updatePagination() {
                var totalItems = filteredItems.length;
                var totalPages = Math.ceil(totalItems / itemsPerPage);
                var start = (currentPage - 1) * itemsPerPage + 1;
                var end = Math.min(start + itemsPerPage - 1, totalItems);

                // Update showing entries text
                $('#showing-start').text(totalItems === 0 ? 0 : start);
                $('#showing-end').text(end);
                $('#total-entries').text(totalItems);

                // Update pagination buttons
                createPaginationButtons(totalPages);

                // Update prev/next buttons
                $('#prev-page').toggleClass('disabled', currentPage === 1);
                $('#next-page').toggleClass('disabled', currentPage >= totalPages);

                // Show/hide items for current page
                $items.hide();
                filteredItems.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage).show();
            }

            // Handle search functionality
            // Handle search functionality
            $('#product-search').on('keyup', function() {
                var searchText = $(this).val().toLowerCase().trim();
                console.log('Search text:', searchText); // Debug log

                filteredItems = $items.filter(function() {
                    var $item = $(this);

                    // Debug log
                    console.log('Item data:', {
                        name: $item.data('name'),
                        category: $item.data('category'),
                        price: $item.data('price'),
                        code: $item.data('code')
                    });

                    // Get the data attributes with null checks
                    var name = ($item.data('name') || '').toString().toLowerCase();
                    var category = ($item.data('category') || '').toString().toLowerCase();
                    var price = ($item.data('price') || '').toString().toLowerCase();
                    var code = ($item.data('code') || '').toString().toLowerCase();

                    // Check if any field matches the search text
                    var nameMatch = name.includes(searchText);
                    var categoryMatch = category.includes(searchText);
                    var priceMatch = price.includes(searchText);
                    var codeMatch = code.includes(searchText);

                    return nameMatch || categoryMatch || priceMatch || codeMatch;
                });

                currentPage = 1;
                updatePagination();

                // Show/hide no results message
                if (filteredItems.length === 0) {
                    $('#no-results').remove();
                    $('#product-grid').append(
                        '<div id="no-results" class="col-12 text-center mt-4">' +
                        '<p class="text-muted">No products found matching your search.</p></div>'
                    );
                } else {
                    $('#no-results').remove();
                }
            });

            // Handle pagination clicks
            $(document).on('click', '.page-number', function(e) {
                e.preventDefault();
                currentPage = parseInt($(this).data('page'));
                updatePagination();
            });

            $('#prev-page').on('click', function(e) {
                e.preventDefault();
                if (!$(this).hasClass('disabled')) {
                    currentPage--;
                    updatePagination();
                }
            });

            $('#next-page').on('click', function(e) {
                e.preventDefault();
                if (!$(this).hasClass('disabled')) {
                    currentPage++;
                    updatePagination();
                }
            });

            // Initial setup
            updatePagination();
        });
    </script>



    <!--Increment and decrement quantity-->
    <script>
        $(document).on('click', '.btn-increment', function() {
            var $input = $(this).closest('.input-group').find('.quantity-input');
            var value = parseInt($input.val());
            $input.val(value + 1);
            // Update subtotal
            var price = parseFloat($(this).closest('tr').find('td:nth-child(2)').text().replace('₱', ''));
            $(this).closest('tr').find('td:nth-child(4)').text('₱ ' + (price * (value + 1)).toFixed(2));
        });

        $(document).on('click', '.btn-decrement', function() {
            var $input = $(this).closest('.input-group').find('.quantity-input');
            var value = parseInt($input.val());
            if (value > 1) {
                $input.val(value - 1);
                // Update subtotal
                var price = parseFloat($(this).closest('tr').find('td:nth-child(2)').text().replace('₱', ''));
                $(this).closest('tr').find('td:nth-child(4)').text('₱ ' + (price * (value - 1)).toFixed(2));
            }
        });
    </script>

    <!-- Show customer modal when a customer is selected -->
    <script>
        $(document).ready(function() {
            // Set the hidden input to the default value on page load
            $('#modal_customers_id').val($('#Customer').val());

            $('#Customer').change(function() {
                var selectedCustomerId = $(this).val();
                $('#modal_customers_id').val(selectedCustomerId);
            });
        });
    </script>

    <script>
        function submitForm(id) {
            document.getElementById('form-' + id).submit();
        }
    </script>

    @livewireScripts
@endsection
