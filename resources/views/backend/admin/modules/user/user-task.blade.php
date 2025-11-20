@extends('backend.admin.layouts.main')

@section('title', 'Custom Field')
@section('extra-css')
<style>
    .task-block {
        /* display: flex; */
        position: relative;
        /* overflow: hidden; */
        width: 100%;
        /* justify-content: space-between;
		align-items: center; */
        border: 1px solid var(--brand-color);
        margin-bottom: 15px;
        padding: 15px 10px 15px 0;
        background: #fbfbfb;
    }

    .task-block>* {
        max-width: 200px;
    }

    .task-block:hover {
        background: var(--light);
    }

    .task-action {
        position: absolute;
        right: -200px;
        top: calc(50% - 16px);
        transition: right 500ms ease;
    }

    .task-block.overlay .task-action {
        right: 10px;
        z-index: 10;
    }

    .task-block.overlay:before {
        content: '';
        position: absolute;
        z-index: 9;
        width: 100%;
        background: #ffffffdd;
        height: 100%;
    }

    .task-type {

        color: #fff;
        padding: 5px 15px;
        line-height: 1;
        border-radius: 0px 20px 20px 0px !important;
    }

    .task-details {
        width: 100%;
    }

    .task-details .task-title {
        font-weight: 600;
        display: block;
    }

    .task-details .task-desc {
        font-weight: 300;
        display: block;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    .task-desc.is-expanded {
        white-space: initial;
        overflow: visible;
    }

    .task-details .task-title:first-letter,
    .task-details .task-desc:first-letter {
        text-transform: capitalize;
    }

    .task-duration small {
        display: block;
    }

    .task-status {
        width: 100%;
    }

    .task-priority {
        width: 100%;
    }

    .task-assigned .d-flex div {
        margin-left: -0.25rem;
        margin-right: -0.25rem;
        border: 2px solid var(--white);
        width: 36px;
        height: 36px;
        line-height: 32px;
        padding: 0;
    }

    .width-120 {
        width: 120px !important;
    }

    .width-90 {
        width: 90px;
    }

    .btn.focus,
    .btn:focus {
        box-shadow: none;
    }

    .dropdown-menu .dropdown-item:hover {
        background: #f8f9fa;
    }

    .stacked-images .badge {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
        overflow: hidden;
        margin-right: -20px;
        border: 3px solid #ffffff;
        /* background: #ffffff; */
        letter-spacing: .03rem;
    }

    .stacked-images .sm {
        width: 36px;
        height: 36px;
    }

    .stacked-images {
        display: flex;
    }

    .stacked-images img {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
        overflow: hidden;
        margin-right: -20px;
        border: 3px solid #ffffff;
        background: #ffffff;
        letter-spacing: .03rem;
    }

    .stacked-images img.sm {
        width: 36px;
        height: 36px;
    }

    .stacked-images .plus {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
        overflow: hidden;
       
        margin-right: -20px;
        border: 3px solid #ffffff;
        background: #791116;
        letter-spacing: .03rem;
        font-weight: 700;
        font-size: .8rem;
    }

    .stacked-images .plus.sm {
        width: 36px;
        height: 36px;
        color: #ffffff;
    }

    .task-assigned ul.header-notifications li a {
        padding: .3rem 1rem;
    }

    .task-assigned ul.header-notifications li a .details {
        margin-left: 5px;
    }

    .task-assigned ul.header-notifications li a>.user-img:after,
    .attachment-file ul.header-notifications li a>.user-img:after {
        opacity: 0;
    }

    .task-more .dropdown-menu.dropdown-menu-right {
        top: 7px !important;
        left: 5px !important;
    }

    .mfp-arrow-left,
    .mfp-arrow-right,
    .mfp-counter {
        opacity: 0;
    }

    .task-status .btn-bs-select,
    .task-priority .btn-bs-select {
        border: 0px solid #c4c9da !important;
        background: transparent !important;
    }

    .task-status .btn-bs-select,
    .task-priority .btn-bs-select {
        padding: .375rem 0 !important;
    }

    .task-status .dropdown-toggle::after,
    .task-priority .dropdown-toggle::after {
        display: none;
    }

    .task-status .form-control:hover,
    .task-priority .form-control:hover {
        background: transparent !important;
    }

    .task-status.form-control,
    .task-priority.form-control {
        background: transparent !important;
    }

    .task-status .dropdown-menu .dropdown-item,
    .task-priority .dropdown-menu .dropdown-item {
        padding: 0.2rem;
    }

    .bootstrap-select.task-status .dropdown-menu.inner,
    .bootstrap-select.task-priority .dropdown-menu.inner {
        width: 182px;
    }

    .bootstrap-select.task-status .dropdown-menu.inner .badge,
    .bootstrap-select.task-priority .dropdown-menu.inner .badge {
        width: 178px;
        text-align: left;
    }

    .bootstrap-select.task-status .dropdown-menu,
    .bootstrap-select.task-priority .dropdown-menu {
        width: 190px;
    }

    .task-status .dropdown-menu {
        left: -100px !important;
    }

    .text-avatar.circle {
    border-radius: 100% !important;
}
.text-avatar.sm {
    width: 36px;
    height: 36px;
    font-size: 14px;
}
.text-avatar, .avatar {
    margin: 0.4rem;
    margin-left: 0;
    min-width: 36px;
}
.text-avatar {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: .5rem;
    background: #791116;
    color: #ffffff;
    font-weight: 700;
    border-radius: 4px;
    position: relative;
}
    .border-primary {
        border-color: #791116 !important;
    }

    .custom-select:focus {
        border-color: #791116;
        box-shadow: none !important;
    }


    .cards {
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding: 5px 5px;
    }

    .cards .red {
        background-color: #f43f5e;
    }

    .cards .blue {
        background-color: #3b82f6;
    }

    .cards .green {
        background-color: #22c55e;
    }

    .cards .card {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        border-radius: 10px;
        color: white;
        cursor: pointer;
        transition: 400ms;
        margin-bottom: 4px;
    }

    .cards .card p.tip {
        font-size: 1em;
        font-weight: 700;
    }

    .cards .card p.second-text {
        font-size: .7em;
    }

    .cards .card:hover {
        /* transform: scale(1.1, 1.1); */
    }

    /* .cards:hover > .card:not(:hover) {
  filter: blur(1px);
  transform: scale(1, 1);
} */
    .search-title {
        padding: 0 !important;
        font-size: 14px;
        margin-bottom: 5px;
        padding-bottom: 3px !important;
    }

    .autocom-box p {
        margin-bottom: 0;
    }

    .item {
        transition: filter 0.3s ease;
    }

    .item.blurred {
        filter: blur(1px);
    }

    /* .autocom-box p:last-child {
    margin-bottom: 3px !important;
} */

    .autocom-box .text-clip {
        width: 200px;
    }

    .avatar img.circle {
        border-radius: 100% !important;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar.sm {
        width: 36px;
        height: 36px;
    }

    .avatar-group .avatar {
        display: inline-block;
    }

    .text-avatar,
    .avatar {
        margin: 0.4rem;
        margin-left: 0;
        min-width: 36px;
    }

    .avatar {
        width: 48px;
        height: 48px;
        position: relative;
        margin: .5rem;
    }

</style>
@endsection

@section('main-container')
<!-- Main container start -->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row align-items-center">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Task</h3>

                </div>
            </div>
        </div>
        <div class="row d-none d-lg-block">
            @foreach ($task_created as $task)
                
          
            <div class="col-12">
                <div class="task-block d-flex justify-content-between align-items-center" style="border: 1px solid #07a654">

                    <div>
                        <div class="task-type" style="background:#07a654;">{{ $task->task_type }}</div>
                        <p class="ms-1">
                            <span class="task-days-left badge rounded-pill mt-1" style="background:#cf0f0f; color:#fff;">{{ $task->label }}</span>
                        </p>
                    </div>

                    <div>
                        <div>
                            <div class="task-details">
                                <span class="task-title strong">test</span>
                                <span id="ellipsis-ex" class="task-desc" onclick="toggleEllipsis()">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </span>
                            </div>

                            <div class="d-flex">
                                <select class="form-select task-priority" data-bs-width="fit">
                                    <option value="CRITICAL" {{ $task->priority == 'CRITICAL' ? 'selected':'' }}>CRITICAL</option>
                                    <option value="HIGH" {{ $task->priority == 'HIGH' ? 'selected':'' }}>HIGH</option>
                                    <option value="MEDIUM" {{ $task->priority == 'MEDIUM' ? 'selected':'' }}>MEDIUM</option>
                                    <option value="LOW" {{ $task->priority == 'LOW' ? 'selected':'' }}>LOW</option>
                                    <option value="NO PRIORITY" {{ $task->priority == 'NO PRIORITY' ? 'selected':'' }}>NO PRIORITY</option>
                                </select>

                                <select class="form-select ms-2 task-status" data-bs-width="fit">
                                    <option value="TODO" {{ $task->badge == 'TODO' ? 'selected':'' }}>TODO</option>
                                    <option value="DOING" {{ $task->badge == 'DOING' ? 'selected':'' }}>DOING</option>
                                    <option value="DONE" {{ $task->badge == 'DONE' ? 'selected':'' }}>DONE</option>
                                    <option value="HOLD" {{ $task->badge == 'HOLD' ? 'selected':'' }}>HOLD</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="task-duration">
                        <small>Sunday, April 28, 2024</small>
                        <span class="task-days-left badge rounded-pill mt-1" style="background:#07a654; color:#fff;">5 days left</span>
                    </div>

                    <div class="d-flex">
                        <div class="popup-attachment avatar-group ps-2 d-flex">
                            <div class="avatar sm mb-0">
                                <a href="http://farm9.staticflickr.com/8242/8558295633_f34a55c1c6_b.jpg">
                                    <img src="http://farm9.staticflickr.com/8242/8558295633_f34a55c1c6_s.jpg" class="circle">
                                </a>
                            </div>
                            <div class="avatar sm mb-0">
                                <a href="http://farm9.staticflickr.com/8382/8558295631_0f56c1284f_b.jpg">
                                    <img src="http://farm9.staticflickr.com/8382/8558295631_0f56c1284f_s.jpg" class="circle">
                                </a>
                            </div>
                        </div>

                        <div class="d-flex attachment-file">
                            <div class="text-avatar circle sm mb-0 bg-white">
                                <a href="arterio.pdf" download="file-download">
                                    <span><i class="ri-attachment-2"></i></span>
                                </a>
                            </div>

                            <div class="text-avatar circle sm mb-0 bg-white text-primary" id="notifications" data-bs-toggle="dropdown">
                                +5
                            </div>

                            <div class="dropdown-menu">
                                <div class="dropdown-menu-header"> Attachment (4) </div>
                                <ul class="header-notifications">
                                    <li>
                                        <a href="#">
                                            <div class="user-img"><img src="img/user21.png"></div>
                                            <div class="details">
                                                <div class="user-title mb-0">Abbott</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user-img"><img src="img/user10.png"></div>
                                            <div class="details">
                                                <div class="user-title mb-0">Braxten</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user-img"><img src="img/user6.png"></div>
                                            <div class="details">
                                                <div class="user-title mb-0">Larkyn</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="task-assigned">
                        <div class="stacked-images mt-1">
                            <div class="sm badge rounded-pill badge-primary cursor-pointer" data-bs-toggle="tooltip" title="Nisha Kumari">NK</div>
                            <div class="sm badge rounded-pill badge-primary cursor-pointer" data-bs-toggle="tooltip" title="Nisha Kumari">NK</div>
                            <div class="sm badge rounded-pill badge-primary cursor-pointer" data-bs-toggle="tooltip" title="Nisha Kumari">NK</div>

                            <span class="plus sm" id="notifications" data-bs-toggle="dropdown">+7</span>

                            <div class="dropdown-menu dropdown-menu-end">
                                <div class="dropdown-menu-header"> Task Assigned (4) </div>
                                <ul class="header-notifications">
                                    <li>
                                        <a href="#">
                                            <div class="user-img"><img src="img/user21.png"></div>
                                            <div class="details">
                                                <div class="user-title mb-0">Abbott</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="task-more h5 m-0">
                        <button type="button" class="btn btn-sm" style="border:1px solid #07a654; background:#fff; color:#07a654" data-bs-toggle="dropdown">
                            <span><i class="ri-more-2-line"></i></span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end p-0">
                            <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#vCenterModal">
                                <i class="icon-trash-2"></i> Delete
                            </a>
                            <a class="dropdown-item text-warning" onclick="del_report(35,'Pending')">
                                <i class="icon-x-circle"></i> Decline
                            </a>
                        </div>
                    </div>

                </div>
            </div>
              @endforeach
        </div>
    </div>
</div>
<!-- Main container end -->
@endsection

@section('extra-js')
<script>
    $(document).ready(function() {
        $('.popup-attachment').magnificPopup({
            delegate: 'a'
            , type: 'image'
            , tLoading: 'Loading image #%curr%...'
            , mainClass: 'mfp-img-mobile'
            , gallery: {
                enabled: true
                , navigateByImgClick: true
                , preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            }
            , image: {
                // tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    return item.el.attr('title');
                }
            }
        });
    });

</script>
<!-- *************
    ************ Vendor Js Files *************
************* -->
<!-- Slimscroll JS
<script src="vendor/slimscroll/slimscroll.min.js"></script>
<script src="vendor/slimscroll/custom-scrollbar.js"></script>

Daterange
<script src="vendor/daterange/daterange.js"></script>
<script src="vendor/daterange/custom-daterange.js"></script>

Polyfill JS 
<script src="vendor/polyfill/polyfill.min.js"></script> -->

<!-- Apex Charts
<script src="vendor/apex/apexcharts.min.js"></script>
<script src="vendor/apex/admin/visitors.js"></script>
<script src="vendor/apex/admin/deals.js"></script>
<script src="vendor/apex/admin/income.js"></script>
<script src="vendor/apex/admin/customers.js"></script> -->

<!-- Main JS -->
<script src="js/main.js"></script>
<script>
    var element = document.querySelector("#ellipsis-ex");

    function toggleEllipsis() {
        element.classList.toggle("task-desc");
    }
    var element2 = document.querySelector("#ellipsis-ex2");

    function toggleEllipsis2() {
        element2.classList.toggle("task-desc");
    }

</script>

<script>
    document.querySelectorAll('.item').forEach(item => {
        item.addEventListener('mouseover', () => {

            document.querySelectorAll('.item').forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.add('blurred');
                }
            });
        });

        item.addEventListener('mouseout', () => {
            document.querySelectorAll('.item').forEach(otherItem => {
                otherItem.classList.remove('blurred');
            });
        });
    });

</script>
@endsection
