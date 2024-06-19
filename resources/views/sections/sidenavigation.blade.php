<div class="left-sidebar fixed-sidebar small-nav bg-black-300 box-shadow">
    <div class="sidebar-content">
        {{-- <div class="user-info closed">
            <img src="http://placehold.it/90/c2c2c2?text=User" alt="John Doe" class="img-circle profile-img">
            <h6 class="title">John Doe</h6>
            <small class="info">PHP Developer</small>
        </div> --}}
        <!-- /.user-info -->

        <div class="sidebar-nav">
            <ul class="side-nav color-gray">
                <li class="nav-header">
                    <span class="">Hasil Medical Check UP</span>
                </li>
                <li class="has-children">
                    <a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-right arrow"></i></a>
                    <ul class="child-nav">
                        @if(\App\Http\Controllers\AuthController::can('pdfgen'))
                        <li><a href="/pdflist"><i class="fa fa-bolt"></i> <span>Create PDF MCU</span></a></li> 
                        @endif
                        <li><a href="/pdfreportlist"><i class="fa fa-bolt"></i> <span>Report PDF MCU</span></a></li> 
                        @if(\App\Http\Controllers\AuthController::can('sds.report'))
                        <li><a href="/rekapsds"><i class="fa fa-bolt"></i> <span>Rekap Assesment SDS</span></a></li> 
                        @endif
                        @if(\App\Http\Controllers\AuthController::can('report.graph'))
                        <li><a href="/rekapgrafik"><i class="fa fa-bolt"></i> <span>Info Grafik</span></a></li> 
                        @endif
                    </ul>
                </li> 
            </ul>
            <!-- /.side-nav -->
           
        </div>
        <!-- /.sidebar-nav -->
    </div>
    <!-- /.sidebar-content -->
</div>