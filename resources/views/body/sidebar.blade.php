<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">

            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown" <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>



                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ url('/dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboards </span>
                    </a>
                </li>


                <li class="menu-title mt-2">Apps</li>

                <li>
                    <a href="#sidebarEmployee" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Employee Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmployee">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.employee') }}">All Employee</a>
                            </li>
                            <li>
                                <a href="{{ route('add.employee') }}">Add Employee</a>
                            </li>
                            <li>
                                <a href="{{ route('show.deleted.employee') }}">Deleted Employee</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarEmployeeS" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Employee Salary </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmployeeS">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('pay.salary') }}">Pay Salary</a>
                            </li>
                            <li>
                                <a href="{{ route('add.advance.salary') }}">Add Advance Salary</a>
                            </li>
                            <li>
                                <a href="{{ route('month.salary') }}">Last Month Salary</a>
                            </li>
                            <li>
                                <a href="{{ route('all.advance.salary') }}">All Advance Salary</a>
                            </li>
                            <li>
                                <a href="{{ route('show.deleted.advance.salary') }}">Deleted Advance Salary</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#attendance" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Employee Attendance </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="attendance">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('employee.attend.list') }}">Employee Attendance List </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarCustomer" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Customer Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCustomer">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.customer') }}">All Customer</a>
                            </li>
                            <li>
                                <a href="{{ route('add.customer') }}">Add Customer</a>
                            </li>
                            <li>
                                <a href="{{ route('show.deleted.customer') }}">Deleted Customer</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarSupplier" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Supplier Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSupplier">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.supplier') }}">All Supplier</a>
                            </li>
                            <li>
                                <a href="{{ route('add.supplier') }}">Add Supplier</a>
                            </li>
                            <li>
                                <a href="{{ route('show.deleted.supplier') }}">Deleted Supplier</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarProduct" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span>Products Management</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarProduct">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.product') }}">All Products</a>
                            </li>
                            <li>
                                <a href="{{ route('add.product') }}">Add Products</a>
                            </li>
                            <li>
                                <a href="{{ route('show.deleted.product') }}">Deleted Products</a>
                            </li>
                            <li>
                                <a href="{{ route('import.product.page') }}">Import Products</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarProductCategory" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Product Category </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarProductCategory">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.productCategory') }}">All Product Category</a>
                            </li>
                            <li>
                                <a href="{{ route('add.productCategory') }}">Add Product Category</a>
                            </li>
                            <li>
                                <a href="{{ route('show.deleted.productCategory') }}">Deleted Product Category</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarOrders" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Orders </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarOrders">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('unpaid.order') }}">Pending Orders</a>
                            </li>
                            <li>
                                <a href="{{ route('paid.order') }}">Complete</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#stock" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-multiple-outline"></i>
                        <span> Stock Manage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="stock">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('stock.manage') }}">Stock </a>
                            </li>
                        </ul>
                    </div>
                </li>






                <li class="menu-title mt-2">Others</li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span> Expense</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('add.expense') }}">Add Expense</a>
                            </li>
                            <li>
                                <a href="{{ route('today.expense') }}">Today Expense</a>
                            </li>
                            <li>
                                <a href="{{ route('month.expense') }}">Month Expense</a>
                            </li>
                            <li>
                                <a href="{{ route('year.expense') }}">Year Expense</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarExpages" data-bs-toggle="collapse">
                        <i class="mdi mdi-text-box-multiple-outline"></i>
                        <span> Extra Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarExpages">
                        <ul class="nav-second-level">
                            <li>
                                <a href="pages-starter.html">Starter</a>
                            </li>
                            <li>
                                <a href="pages-timeline.html">Timeline</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        </li>
        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
