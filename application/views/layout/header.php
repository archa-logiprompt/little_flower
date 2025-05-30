<!DOCTYPE html>
<html <?php echo $this->customlib->getRTL(); ?>>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php echo $this->customlib->getAppName(); ?>
    </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="theme-color" content="#424242" />
    <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/style-main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/hamburger-slider-menu.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/jquery.mCustomScrollbar.min.css">
    <?php
    $this->load->view('layout/theme');
    ?>
    <?php
    if ($this->customlib->getRTL() != "") {
    ?>
        <!-- Bootstrap 3.3.5 RTL -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/bootstrap-rtl/css/bootstrap-rtl.min.css" />
        <!-- Theme RTL style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/AdminLTE-rtl.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/ss-rtlmain.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/skins/_all-skins-rtl.min.css" />
    <?php
    }
    ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/ionicons.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/colorpicker/bootstrap-colorpicker.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/custom_style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/datepicker/css/bootstrap-datetimepicker.css">
    <!--file dropify-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/dropify.min.css">
    <!--file nprogress-->
    <link href="<?php echo base_url(); ?>backend/dist/css/nprogress.css" rel="stylesheet">

    <!--print table-->
    <link href="<?php echo base_url(); ?>backend/dist/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend/dist/datatables/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend/dist/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <!--print table mobile support-->
    <link href="<?php echo base_url(); ?>backend/dist/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend/dist/datatables/css/rowReorder.dataTables.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>backend/custom/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/dist/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/datepicker/js/bootstrap-datetimepicker.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/colorpicker/bootstrap-colorpicker.js"></script>
    <script src="<?php echo base_url(); ?>backend/datepicker/date.js"></script>
    <script src="<?php echo base_url(); ?>backend/dist/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/js/school-custom.js"></script>
    <script src="<?php echo base_url(); ?>backend/js/sstoast.js"></script>
    <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>
    <!-- fullCalendar -->
    <link rel="stylesheet" href="<?php echo base_url() ?>backend/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>backend/fullcalendar/dist/fullcalendar.print.min.css" media="print">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>backend/dist/css/print.css" media="print">



    <script type="text/javascript">
        var baseurl = "<?php echo base_url(); ?>";
        var chk_validate = "<?php echo $this->config->item('SSLK') ?>";
    </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and me/
        [if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

</head>

<body class="hold-transition skin-blue fixed sidebar-mini">
    <?php
    $admin = $this->session->userdata('admin');
    $keys = array_keys($admin['roles']);
    // var_dump($keys);exit;


    ?>
    <div class="wrapper">
        <header class="main-header" id="alert">
            <!-- <a href="<?php //echo base_url();     
                            ?>admin/admin/dashboard" class="logo">
                <span class="logo-mini">S S</span>
                <span class="logo-lg">
                    <img src="<?php //echo base_url();     
                                ?>backend/images/s_logo.svg" alt="<?php //echo $this->customlib->getAppName()     
                                                                    ?>" /></span>
            </a> -->

            <nav class="navbar navbar-static-top" role="navigation">

                <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a> -->

                <div class="col-xs-6 col-sm-2 col-md-2 col-lg-2">
                    <a href="javascript:void(0);" class="hamburger-menu" id="hamburger-menu" data-toggle="modal" data-target=".hamburgerModal">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </a>

                    <a href="<?php echo base_url(); ?>admin/admin/dashboard" class="logo">
                        <span class="logo-mini">S S</span>
                        <span class="logo-lg">
                            <img src="<?php echo base_url(); ?>backend/images/s_logo.svg" alt="<?php echo $this->customlib->getAppName() ?>" />
                        </span>
                    </a>
                </div>

                <div class="sidebar-menu-overlay" id="sidebar-menu-overlay"></div>

                <div class="sidebar-menu-panel" id="sidebar-menu-panel">
                    <a class="sidebar-menu-close" id="sidebar-menu-close" href="javascript:void(0);">
                        <i class="fa fa-close"></i>
                    </a>
                    <style>
                        @media screen and (min-width:768px) {
                            .change_date_menu {
                                display: none;
                            }
                        }

                        .change_date_menu {
                            position: absolute;
                            right: 60px;
                            top: 10px;
                        }

                        .change_date_menu .search-form {
                            box-shadow: 0px 4px 10px #00000029;
                            border-radius: 22px !important;
                        }
                    </style>
                    <div class="change_date_menu">
                        <form class="navbar-left session-from" role="search" id="msession-from" action="<?php echo site_url('schsettings/header_session'); ?>" method="POST">
                            <?php $session_result = $this->session_model->get();
                            // var_dump($session_result);exit;
                            ?>
                            <?php $current_sess = $this->setting_model->getCurrentSession(); ?>
                            <input type="hidden" name="currentid" id="currentid" value="<?php echo $this->setting_model->getcurrentid(); ?>" />
                            <div class="input-group" style="width:102px;">
                                <select autofocus id="msession" name="session" class="form-control search-form search-form3 session">
                                    <option value="">
                                        <?php echo $this->lang->line('select'); ?>
                                    </option>
                                    <?php foreach ($session_result as $key => $sess) {

                                    ?>
                                        <option <?php if ($current_sess == $sess['id']) {
                                                    echo "selected=selected";
                                                } ?> value="<?php echo $sess['id'] ?>">
                                            <?php echo $sess['session'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 sidebar-menu-container">
                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="input-group searchBox">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn"
                                            style="padding: 3px 12px !important;background: #fff;"
                                            class="btn btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                    <input type="text" name="search_text" class="form-control search-form search-form3"
                                        placeholder="Search Menu">
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-md-12">
                                <h5><strong>RECENT MENUS</strong></h5>
                            </div>
                        </div>
                        <div class="menu-card-row">

                            <?php


                            if ($this->module_lib->hasActive('academics')) {
                                if (
                                    ($this->rbac->hasPrivilege('class_timetable', 'can_view') ||
                                        $this->rbac->hasPrivilege('assign_class_teacher', 'can_view') ||
                                        $this->rbac->hasPrivilege('timetable_new', 'can_view') ||
                                        $this->rbac->hasPrivilege('subject', 'can_view') ||
                                        $this->rbac->hasPrivilege('assign_class_teacher', 'can_view') ||
                                        $this->rbac->hasPrivilege('class', 'can_view') ||
                                        $this->rbac->hasPrivilege('passed_out', 'can_view') ||
                                    $this->rbac->hasPrivilege('monthly_academic_report', 'can_view') ||
                                        $this->rbac->hasPrivilege('section', 'can_view'))
                                ) {
                            ?>

                                    <div class="menu-card-col <?php echo set_Topmenu('Academics'); ?>">
                                        <i class="fa fa-mortar-board" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Academics
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('class_timetable', 'can_view')) { ?>
                                                    <li style="display:none" class="<?php echo set_Submenu('timetable/index'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/timetable"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('class_timetable'); ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('assign_class_teacher', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/teacher/assign_class_teacher'); ?>"><a href="<?php echo base_url(); ?>admin/teacher/assign_class_teacher"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('assign_class_teacher'); ?>
                                                        </a></li>
                                                         <?php
                                                }
                                                if ($this->rbac->hasPrivilege('topicexcel', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu(''); ?>"><a href="<?php echo base_url(); ?>admin/subject/topicexcel"><i class="fa fa-angle-double-right"></i>
                                                              <?php echo 'Topic Excel'; ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('weekly_calendar', 'can_view')) {
                                                ?>
                                                    <?php
                                                    if (in_array('Teacher', $keys)) {
                                                    ?>
                                                        <li class="<?php echo set_Submenu('admin/weeklycalendarteacher/index'); ?>"><a href="<?php echo base_url(); ?>admin/weeklycalendarteacher/index"><i class="fa fa-angle-double-right"></i> Weekly Timetable</a></li>
                                                    <?php }
                                                    ?>
                                                <?php
                                                }


                                                if ($this->rbac->hasPrivilege('timetable_new', 'can_view')) { ?>
                                                    <li style="display:none" class="<?php echo set_Submenu('timetablenew/index'); ?>"><a href="<?php echo base_url(); ?>admin/timetablenew"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Timetable New"; ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('assign_subject', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/teacher/viewassignteacher'); ?>"><a href="<?php echo base_url(); ?>admin/teacher/viewassignteacher"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('assign_subjects'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('promote_student', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('stdtransfer/index'); ?>"><a href="<?php echo base_url(); ?>admin/stdtransfer"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('promote_students'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('subject', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('subject/index'); ?>"><a href="<?php echo base_url(); ?>admin/subject"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('subjects'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('subject', 'can_view')) {
                                                    ?>
                                                        <li class="<?php echo set_Submenu('subject/index'); ?>"><a href="<?php echo base_url(); ?>admin/subject/import_subject"><i class="fa fa-angle-double-right"></i>
                                                                <?php echo "Excel Subjects" ?>
                                                            </a></li>
                                                    <?php
                                                    }
                                                if ($this->rbac->hasPrivilege('subject', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('subject/subjecthours'); ?>"><a href="<?php echo base_url(); ?>admin/subject/subjecthours"><i class="fa fa-angle-double-right"></i>
                                                            Subject Hours</a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('subject', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('subject/combinedsubject'); ?>"><a href="<?php echo base_url(); ?>admin/subject/combinedSubject"><i class="fa fa-angle-double-right"></i>
                                                            Combined Subjects</a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('class', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('classes/index'); ?>"><a href="<?php echo base_url(); ?>classes"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('class'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('section', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('sections/index'); ?>"><a href="<?php echo base_url(); ?>sections"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('sections'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('weekly_calendar', 'can_view')) {
                                                ?>
                                                    <li style="display:none" class="<?php echo set_Submenu('weeklycalendar/index'); ?>"><a href="<?php echo base_url(); ?>admin/Weeklycalendar"><i class="fa fa-angle-double-right"></i> Weekly Calendar</a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('period_timing', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('weeklycalendarnew/periodtiming'); ?>"><a href="<?php echo base_url(); ?>admin/weeklycalendarnew/periodtiming"><i class="fa fa-angle-double-right"></i> Period Timing</a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('weekly_calendar', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('weeklycalendarnew/index'); ?>"><a href="<?php echo base_url(); ?>admin/weeklycalendarnew"><i class="fa fa-angle-double-right"></i> Weekly Calendar </a></li>
                                                    <?php
                                                    // }
                                                    //                     if ($this->rbac->hasPrivilege('work_log', 'can_view')) {
                                                    //                             
                                                    ?>
                                                    <!-- <li class="<?php //echo set_Submenu('worklog/index');     
                                                                    ?>"><a
                           href="<?php //echo base_url();     
                                    ?>admin/worklog"><i class="fa fa-angle-double-right"></i> Work
                            Log</a></li> -->
                                                <?php
                                                }


                                                if ($this->rbac->hasPrivilege('work_log', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('worklog_report/index'); ?>"><a href="<?php echo base_url(); ?>admin/worklogreport"><i class="fa fa-angle-double-right"></i>
                                                            Work Log Report</a></li>
                                                <?php }

                                                if (
                                                    $this->rbac->hasPrivilege('	
                                        monthly_academic_report', 'can_view')
                                                ) {
                                                ?>
                                                    <!-- <li class="<?php echo set_Submenu('monthly_academic_report/index'); ?>"><a
                            href="<?php echo base_url(); ?>admin/monthlyacademicreport"><i class="fa fa-angle-double-right"></i>
                            Monthly Report- Theory</a></li> -->
                                                <?php }
                                                ?>
                                                <?php if ($this->rbac->hasPrivilege('monthly_academic_report', 'can_view')) {
                                                ?>
                                                    <!-- <li class="<?php echo set_Submenu('monthly_academic_report/fullindex'); ?>"><a
                            href="<?php echo base_url(); ?>admin/monthlyacademicreport/fullreport"><i class="fa fa-angle-double-right"></i>
                            Monthly Report</a></li> -->
                                                <?php }
                                                ?>
                                                <?php if ($this->rbac->hasPrivilege('master_rotation_plan', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('master_rotation_plan/itemindex'); ?>"><a href="<?php echo base_url(); ?>admin/masterrotation/itemindex"><i class="fa fa-angle-double-right"></i>
                                                            Master Rotation Items</a></li>
                                                <?php } ?>
                                                <?php if ($this->rbac->hasPrivilege('master_rotation_plan', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('masterrotation/index'); ?>"><a href="<?php echo base_url(); ?>admin/masterrotation/index"><i class="fa fa-angle-double-right"></i>
                                                            Master Rotation Plan</a></li>
                                                <?php }
                                                ?>
                                                <?php /* if ($this->rbac->hasPrivilege('monthly_academic_report', 'can_view')) {
                                                       ?>
                                                       <li
                                                           class="<?php echo set_Submenu('monthly_academic_report/attendancereport'); ?>">
                                                           <a
                                                               href="<?php echo base_url(); ?>admin/monthlyacademicreport/attendancereport"><i
                                                                   class="fa fa-angle-double-right"></i>
                                                               Attendance Report</a>
                                                       </li>
                                                   <?php }*/
                                                ?>

                                                
                                                    <li class="<?php echo set_Submenu('monthly_academic_report/monthlyperiodreport'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/monthlyacademicreport/monthlyattendancereport"><i class="fa fa-angle-double-right"></i>
                                                            Monthly Attendance Report</a>
                                                    </li>
                                                
                                                <?php if ($this->rbac->hasPrivilege('monthly_academic_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('subject/academicDate'); ?>"><a href="<?php echo base_url(); ?>admin/subject/academicDate"><i class="fa fa-angle-double-right"></i>
                                                            Academic Date</a></li>
                                                <?php }
                                                ?>
                                                <?php if ($this->rbac->hasPrivilege('passed_out', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('subject/passed_out'); ?>"><a href="<?php echo base_url(); ?>student/passedout"><i class="fa fa-angle-double-right"></i>
                                                            Passed Out</a></li>
                                                <?php }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }

                            if ($this->module_lib->hasActive('examination')) {
                                if (
                                    ($this->rbac->hasPrivilege('exam', 'can_view') ||
                                        $this->rbac->hasPrivilege('exam_schedule', 'can_view') ||
                                        $this->rbac->hasPrivilege('marks_register', 'can_view') ||
                                        $this->rbac->hasPrivilege('marks_earned', 'can_view') ||
                                        $this->rbac->hasPrivilege('transcript', 'can_view') ||
                                        $this->rbac->hasPrivilege('internal_marks', 'can_view') ||
                                        $this->rbac->hasPrivilege('university_marks', 'can_view') ||
                                        $this->rbac->hasPrivilege('supplementry_exam', 'can_view') ||
                                        $this->rbac->hasPrivilege('marks_grade', 'can_view'))
                                ) {
                                ?>

                                    <div class="menu-card-col <?php echo set_Topmenu('Examinations'); ?>">
                                        <i class="fa fa-book" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Examination
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('exam', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('exam/index'); ?>"><a href="<?php echo base_url(); ?>admin/exam"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('exam_list'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('exam_schedule', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('examschedule/index'); ?>"><a href="<?php echo base_url(); ?>admin/examschedule"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('exam_schedule'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('marks_register', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('mark/index'); ?>"><a href="<?php echo base_url(); ?>admin/mark"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('marks_register'); ?>
                                                        </a></li>
                                                <?php
                                                }


                                                if ($this->rbac->hasPrivilege('marks_earned', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('mark/earnedmark'); ?>"><a href="<?php echo base_url(); ?>admin/mark/earnedmark"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Marks Earned'; ?>
                                                        </a></li>
                                                <?php
                                                }





                                                if ($this->rbac->hasPrivilege('internal_marks', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('mark/internalmarks'); ?>"><a href="<?php echo base_url(); ?>admin/mark/internalmarks"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('internal_marks'); ?>
                                                        </a></li>
                                                <?php
                                                }



                                                //if ($this->rbac->hasPrivilege('university_marks', 'can_view')) {
                                                ?>
                                                <!--<li class="<?php //echo set_Submenu('mark/universitymarks');     
                                                                ?>"><a href="<?php //echo base_url();     
                                                                                ?>admin/mark/universitymarks"><i class="fa fa-angle-double-right"></i> <?php //echo $this->lang->line('university_marks');     
                                                                                                                                                        ?></a></li>-->
                                                <?php
                                                // }

                                                if ($this->rbac->hasPrivilege('supplementry_exam', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('mark/supplementry'); ?>"><a href="<?php echo base_url(); ?>admin/mark/supplementry_exam"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('supplementry_exam'); ?>
                                                        </a></li>
                                                <?php
                                                }




                                                if ($this->rbac->hasPrivilege('marks_grade', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('grade/index'); ?>"><a href="<?php echo base_url(); ?>admin/grade"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('marks_grade'); ?>
                                                        </a></li>


                                                <?php }
                                                if ($this->rbac->hasPrivilege('transcript', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('transcript/index'); ?>"><a href="<?php echo base_url(); ?>admin/transcript"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('transcript'); ?>
                                                        </a></li>
                                                <?php } ?>




                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }


                            if ($this->module_lib->hasActive('examination')) {
                                if (
                                    $this->rbac->hasPrivilege('internal_mark_type', 'can_view') ||
                                    $this->rbac->hasPrivilege('internal_report', 'can_view') || ($this->rbac->hasPrivilege('internal_marks', 'can_delete')) ||
                                    ($this->rbac->hasPrivilege('add_internal_mark', 'can_view'))
                                ) {
                                ?>

                                    <div class="menu-card-col <?php echo set_Topmenu('internal_marks'); ?>">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Internal Mark
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('internal_mark_type', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('internal_marks/internal_mark_types'); ?>"><a
                                                            href="<?php echo base_url(); ?>admin/internal_mark"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Internal Mark Type" ?></a></li>
                                                <?php } ?>

                                                <?php if ($this->rbac->hasPrivilege('add_internal_mark', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('internal_marks/add_internal_mark'); ?>"><a
                                                            href="<?php echo base_url(); ?>admin/internal_mark/add_internal_mark"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Add Internal Mark" ?></a></li><?php } ?>

                                                <?php if ($this->rbac->hasPrivilege('internal_report', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('internal_marks/internal_report'); ?>"><a
                                                            href="<?php echo base_url(); ?>admin/internal_mark/internal_report"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Internal Report" ?></a></li><?php } ?>


                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }




                            if ($this->module_lib->hasActive('clinical_rotation')) {
                                if (
                                    ($this->rbac->hasPrivilege('viewassign_ward', 'can_view') ||
                                        $this->rbac->hasPrivilege('warddetail', 'can_view') ||
                                        $this->rbac->hasPrivilege('clinical_group', 'can_view') ||
                                        $this->rbac->hasPrivilege('clinical_attendance', 'can_view') ||
                                        $this->rbac->hasPrivilege('clinical_report', 'can_view') ||
                                        $this->rbac->hasPrivilege('clinical_locations', 'can_view') ||
                                        /* $this->rbac->hasPrivilege('add_session','can_view')||*/
                                        $this->rbac->hasPrivilege('clinical_reportapprove', 'can_view') ||
                                        $this->rbac->hasPrivilege('hodviewclinical_report', 'can_view') ||

                                        $this->rbac->hasPrivilege('marks_register', 'can_view') ||
                                        $this->rbac->hasPrivilege('clinical_department', 'can_view'))
                                ) { ?>

                                    <div class="menu-card-col <?php echo set_Topmenu('clinical_rotation'); ?>">
                                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Clininal Rotation
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">


                                                <?php if ($this->rbac->hasPrivilege('clinical_locations', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('clinical_rotation/clinical_locations'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/clinical_department/clinical_locations"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Clinical Locations"; ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>


                                                <?php if ($this->rbac->hasPrivilege('viewassign_ward', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('clinical_rotation/clinical_department'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/clinical_department"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('clinical_department'); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>

                                                <?php if ($this->rbac->hasPrivilege('warddetail', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('clinical_rotation/warddetail'); ?>"><a href="<?php echo base_url(); ?>admin/Warddetail"><i class="fa fa-angle-double-right"></i>
                                                            Ward Details</a></li>
                                                <?php } ?>
                                                <?php if ($this->rbac->hasPrivilege('master_rotation_plan', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('masterrotation/clinicalrotation'); ?>"><a href="<?php echo base_url(); ?>admin/masterrotation/clinicalrotation"><i class="fa fa-angle-double-right"></i>
                                                            Clinical Rotation Plan</a></li>
                                                <?php }
                                                ?>
                                                <?php if ($this->rbac->hasPrivilege('clinical_group', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('clinical_rotation/assign_group'); ?>"><a href="<?php echo base_url(); ?>admin/Clinical_group/view_clinicalgroup"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('clinical_group'); ?>
                                                        </a></li>
                                                <?php } ?>

                                                <?php //if ($this->rbac->hasPrivilege('add_session', 'can_view')) {     
                                                ?>
                                                <!--<li class="<?php //echo set_Submenu('clinical_rotation/add_session');     
                                                                ?>"><a href="<?php //echo base_url();     
                                                                                ?>admin/clinical_department/add_session"><i class="fa fa-angle-double-right"></i> <?php //echo $this->lang->line('add_session');     
                                                                                                                                                                    ?></a></li>-->
                                                <?php //}     
                                                ?>



                                                <?php if ($this->rbac->hasPrivilege('viewassign_ward', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('clinical_rotation/assign_ward'); ?>"><a href="<?php echo base_url(); ?>admin/assign_ward/viewassign_ward"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('assign_ward'); ?>
                                                        </a></li>
                                                <?php } ?>



                                                <?php if ($this->rbac->hasPrivilege('clinical_attendance', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('clinical_rotation/clinical_attendance'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/clinical_department/clinical_attendance"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('clinical_attendance'); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ($this->rbac->hasPrivilege('clinical_report', 'can_view')) { ?>
                                                    <li style="display:none" class="<?php echo set_Submenu('clinical_rotation/clinical_report'); ?>"><a href="<?php echo base_url(); ?>admin/clinical_department/attendancereport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'clinical report'; ?>
                                                        </a></li>
                                                <?php } ?>


                                                <?php

                                                if ($this->rbac->hasPrivilege('clinical_reportapprove', 'can_view')) {
                                                ?>

                                                    <li style="display:none" class="<?php echo set_Submenu('admin/staffevaluation/clinicalReportApprove'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/clinicalReportApprove"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Clinical Report Approve"; ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php

                                                if ($this->rbac->hasPrivilege('hodviewclinical_report', 'can_view')) {
                                                ?>
                                                    <li style="display:none" class="<?php echo set_Submenu('admin/staffevaluation/hodclinicalReportview'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/hodclinicalReportview"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "HOD view Clinical Report"; ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ($this->rbac->hasPrivilege('clinical_attendance', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('clinical_rotation/clinical_attendance_report'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/clinical_department/clinical_attendance_report"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Clinical Attendance Report'; ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>







                                                <?php if ($this->rbac->hasPrivilege('marks_register', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('clinical_rotation/marks_register'); ?>"><a href="<?php echo base_url(); ?>admin/clinical_department/clinical_mark_reg"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('marks_register'); ?>
                                                        </a></li>
                                                <?php } ?>


                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }

                            if ($this->module_lib->hasActive('human_resource')) {
                                if (
                                    ($this->rbac->hasPrivilege('staff', 'can_view') ||
                                        $this->rbac->hasPrivilege('staff_attendance', 'can_view') ||
                                        $this->rbac->hasPrivilege('staff_attendance_report', 'can_view') ||
                                        $this->rbac->hasPrivilege('staff_payroll', 'can_view') ||
                                        $this->rbac->hasPrivilege('approve_leave_by_class_coordinator', 'can_view') ||
                                        $this->rbac->hasPrivilege('approve_leave_request_ug/pg', 'can_view') ||
                               $this->rbac->hasPrivilege('assigned_staff', 'can_view') ||
                               $this->rbac->hasPrivilege('principal_review', 'can_view') ||
                               $this->rbac->hasPrivilege('principal_view_student_review', 'can_view') ||
                               $this->rbac->hasPrivilege('principal_review_report', 'can_view') ||




                                        //    $this->rbac->hasPrivilege('hr_report', 'can_view') ||
                                        //    $this->rbac->hasPrivilege('supervisor_leave', 'can_view') ||
                                        //    $this->rbac->hasPrivilege('approve_leave_request', 'can_view') ||
                                        //    $this->rbac->hasPrivilege('superviser_approve', 'can_view') ||
                                        $this->rbac->hasPrivilege('payroll_report', 'can_view')
                                    )
                                ) {
                                ?>

                                    <div class="menu-card-col <?php echo set_Topmenu('HR'); ?>">
                                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Human Resources
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php 
                                                if ($this->rbac->hasPrivilege('staff', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('admin/staff'); ?>"><a href="<?php echo base_url(); ?>admin/staff"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('staff_directory'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                
                                                if ($this->rbac->hasPrivilege('staff_attendance', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/staffattendance'); ?>"><a href="<?php echo base_url(); ?>admin/staffattendance"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('staff_attendance'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('staff_attendance_report', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/staffattendance/attendancereport'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffattendance/attendancereport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('staff_attendance_report'); ?>
                                                        </a>
                                                    </li>
                                                    <li class="<?php echo set_Submenu('admin/staffattendance/attendancereportbyperiod'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffattendance/attendancereportbyperiod"><i class="fa fa-angle-double-right"></i> Attendance Report By
                                                            Period</a>
                                                    </li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('staff_payroll', 'can_view')) {
                                                ?>


                                                    <li class="<?php echo set_Submenu('admin/payroll'); ?>"><a href="<?php echo base_url(); ?>admin/payroll"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('payroll'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('principal_review', 'can_view')) {
                                                ?>


                                                    <li class="<?php echo set_Submenu('admin/principal_review'); ?>"><a href="<?php echo base_url(); ?>admin/principal_review/index"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Principal Review of staff"?>
                                                        </a></li>
                                                <?php
                                                }
                                                  if ($this->rbac->hasPrivilege('principal_review_report', 'can_view')) {
                                                ?>


                                                    <li class="<?php echo set_Submenu('admin/principal_review/principal_review_report'); ?>"><a href="<?php echo base_url(); ?>admin/principal_review/principal_review_report"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Principal Review Report of staff"?>
                                                        </a></li>
                                                <?php
                                                }
                                                   if ($this->rbac->hasPrivilege('principal_view_student_review', 'can_view')) {
                                                ?>


                                                    <li class="<?php echo set_Submenu('admin/principal_review/principal_view_student_review_report'); ?>"><a href="<?php echo base_url(); ?>admin/principal_review/principal_view_student_review_report"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Student review teacher Report"?>
                                                        </a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('payroll_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/payroll/payrollreport'); ?>"><a href="<?php echo base_url(); ?>admin/payroll/payrollreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('payroll_report'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('hr_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/payroll/HrReport'); ?>"><a href="<?php echo base_url(); ?>admin/payroll/HrReport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'HR Report'; ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('supervisor_leave', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/staff/superviserrequest'); ?>"><a href="<?php echo base_url(); ?>admin/staff/superviserrequest"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Supervisor'; ?>
                                                        </a></li>
                                                <?php
                                                }



                                                if ($this->rbac->hasPrivilege('approve_leave_request', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/leaverequest/leaverequest'); ?>"><a href="<?php echo base_url(); ?>admin/leaverequest/leaverequest"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('approve_leave_request'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('assigned_staff', 'can_view')) {
                                            ?>
                    <li class="<?php echo set_Submenu('admin/leaverequest/leaverequest'); ?>"><a
                            href="<?php echo base_url(); ?>admin/leaverequest/leaverequest"><i
                                class="fa fa-angle-double-right"></i>
                            <?php echo "Approve LR" ?></a></li> 
                            <?php
                                        }
										
                                                if ($this->rbac->hasPrivilege('approve_leave_by_class_coordinator', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/leaverequest/leaverequestcc'); ?>"><a href="<?php echo base_url(); ?>admin/leaverequest/leaverequestcc"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('approve_leave_request'); ?> Class
                                                            Coordinator
                                                        </a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('approve_leave_requestpr', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/leaverequest/leaverequestprincipal'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/leaverequest/leaverequestprincipal"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('approve_leave_request'); ?> Principal
                                                        </a>
                                                    </li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('approve_leave_request_ug/pg', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/leaverequest/leaverequestugpg'); ?>"><a href="<?php echo base_url(); ?>admin/leaverequest/leaverequestugpg"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('approve_leave_request'); ?> UG/PG
                                                            Coordinator
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('approve_leave_request_hod', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/leaverequest/leaverequesthod'); ?>"><a href="<?php echo base_url(); ?>admin/leaverequest/leaverequesthod"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('approve_leave_request'); ?> HOD
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('superviser_approve', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/staff/superviserrequestview'); ?>"><a href="<?php echo base_url(); ?>admin/staff/superviserrequestview"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Approve superviser' ?>
                                                        </a></li>
                                                <?php
                                                }


                                                if ($this->rbac->hasPrivilege('apply_leave', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/staff/leaverequest'); ?>"><a href="<?php echo base_url(); ?>admin/staff/leaverequest"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('apply_leave'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('leave_types', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/leavetypes'); ?>"><a href="<?php echo base_url(); ?>admin/leavetypes"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('leave_type'); ?>
                                                        </a></li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('department', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/department/department'); ?>"><a href="<?php echo base_url(); ?>admin/department/department"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('department'); ?>
                                                        </a>
                                                    </li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('designation', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/designation/designation'); ?>"><a href="<?php echo base_url(); ?>admin/designation/designation"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('designation'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('disable_staff', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/staff/disablestafflist'); ?>"><a href="<?php echo base_url(); ?>admin/staff/disablestafflist"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('disabled_staff'); ?>
                                                        </a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }

                            if ($this->module_lib->hasActive('student_information')) {
                                if (
                                    ($this->rbac->hasPrivilege('student', 'can_view') ||
                                        $this->rbac->hasPrivilege('student', 'can_add') ||
                                        $this->rbac->hasPrivilege('parent_feedback', 'can_view') ||
                                        $this->rbac->hasPrivilege('student_history', 'can_view') ||
                                        $this->rbac->hasPrivilege('update_kuhs', 'can_view') ||
                                        $this->rbac->hasPrivilege('student_categories', 'can_view') ||
                                        $this->rbac->hasPrivilege('student_houses', 'can_view') ||
                                        $this->rbac->hasPrivilege('student_leave', 'can_view') ||
                                        $this->rbac->hasPrivilege('disable_student', 'can_view') ||
                                        $this->rbac->hasPrivilege('student_report', 'can_add') ||
                                        $this->rbac->hasPrivilege('guardian_report', 'can_view'))
                                ) {
                                ?>



                                    <div class="menu-card-col <?php echo set_Topmenu('Student Information'); ?>">
                                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Student Information
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('student', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('student/search'); ?>"><a href="<?php echo base_url(); ?>student/search"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('student_details'); ?>
                                                        </a></li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('student', 'can_add')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('student/create'); ?>"><a href="<?php echo base_url(); ?>student/create"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('student_admission'); ?>
                                                        </a></li>


                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('student_leave', 'can_add')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('student/leave'); ?>"><a href="<?php echo base_url(); ?>student/leave"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Student Leave"; ?>
                                                        </a></li>


                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('parent_feedback', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('student/feedreport'); ?>"><a href="<?php echo base_url(); ?>student/feedreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Parent Feedback'; ?>
                                                        </a></li>



                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('update_kuhs', 'can_add')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('student/update_kuhs'); ?>"><a href="<?php echo base_url(); ?>student/kuhs"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('update_kuhs'); ?>
                                                        </a></li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('student_report', 'can_add')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('student/studentreport'); ?>"><a href="<?php echo base_url(); ?>student/studentreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('cumulative_record'); ?>
                                                        </a></li>

                                                <?php }
                                                if ($this->rbac->hasPrivilege('guardian_report', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('student/guardianreport'); ?>"><a href="<?php echo base_url(); ?>student/guardianreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('guardian_report'); ?>
                                                        </a></li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('student_history', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/users/admissionreport'); ?>"><a href="<?php echo base_url(); ?>admin/users/admissionreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('student_history'); ?>
                                                        </a></li>

                                                <?php }
                                                if ($this->rbac->hasPrivilege('student_login_credential', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/users/logindetailreport'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/users/logindetailreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('student'); ?>
                                                            <?php echo $this->lang->line('login_credential'); ?>
                                                        </a>
                                                    </li>




                                                <?php }
                                                /*if ($this->rbac->hasPrivilege('student_categories', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('category/index'); ?>"><a href="<?php echo base_url(); ?>category"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('student_categories'); ?>
                                                        </a></li>

                                                <?php
                                                }*/
                                               /* if ($this->rbac->hasPrivilege('student_houses', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/schoolhouse'); ?>"><a href="<?php echo base_url(); ?>admin/schoolhouse"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('house'); ?>
                                                        </a></li>
                                                <?php
                                                }*/
                                                if ($this->rbac->hasPrivilege('disable_student', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('student/disablestudentslist'); ?>"><a href="<?php echo base_url(); ?>student/disablestudentslist"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('disabled_students'); ?>
                                                        </a></li>
                                                <?php
                                                }

                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php }
                            }

                            if ($this->module_lib->hasActive('fees_collection')) {
                                if (
                                    ($this->rbac->hasPrivilege('collect_fees', 'can_view') ||
                                        $this->rbac->hasPrivilege('search_fees_payment', 'can_view') ||
                                        $this->rbac->hasPrivilege('search_due_fees', 'can_view') ||
                                        $this->rbac->hasPrivilege('fees_statement', 'can_view') ||
                                        $this->rbac->hasPrivilege('balance_fees_report', 'can_view') ||
                                        $this->rbac->hasPrivilege('fee_transaction', 'can_view') ||
                                        $this->rbac->hasPrivilege('fees_carry_forward', 'can_view') ||
                                        $this->rbac->hasPrivilege('fees_master', 'can_view') ||
                                        $this->rbac->hasPrivilege('fees_group', 'can_view') ||
                                        $this->rbac->hasPrivilege('fees_type', 'can_view') ||
                                        $this->rbac->hasPrivilege('fees_year', 'can_view') ||
                                        $this->rbac->hasPrivilege('fees_discount', 'can_view') ||
                                        $this->rbac->hasPrivilege('accountants', 'can_view') ||

                                        $this->rbac->hasPrivilege('virtual_account', 'can_view') ||
                                        $this->rbac->hasPrivilege('upload', 'can_view'))

                                ) {
                                ?>



                                    <div class="menu-card-col <?php echo set_Topmenu('Fees Collection'); ?>">
                                        <i class="fa fa-money"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Fees Collection
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php
                                                if ($this->rbac->hasPrivilege('collect_fees', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('studentfee/index'); ?>"><a href="<?php echo base_url(); ?>studentfee"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('collect_fees'); ?>
                                                        </a></li>

                                                <?php }
                                                if ($this->rbac->hasPrivilege('collectionreport', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('transaction/collectionreport'); ?>"><a href="<?php echo base_url(); ?>admin/collectionreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('fees_collect_rep'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('search_fees_payment', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('studentfee/searchpayment'); ?>"><a href="<?php echo base_url(); ?>studentfee/searchpayment"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('search_fees_payment'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('search_due_fees', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('studentfee/feesearch'); ?>"><a href="<?php echo base_url(); ?>studentfee/feesearch"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('search_due_fees'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('fees_statement', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('studentfee/reportbyname'); ?>"><a href="<?php echo base_url(); ?>studentfee/reportbyname"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('fees_statement'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('balance_fees_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('transaction/studentacademicreport'); ?>"><a href="<?php echo base_url(); ?>admin/transaction/studentacademicreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('balance_fees_report'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('fee_transaction', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('transaction/fee_transaction'); ?>"><a href="<?php echo base_url(); ?>admin/fee_transaction"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('fee_transaction'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('fees_category_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('fees_category_report'); ?>"><a href="<?php echo base_url(); ?>admin/fee_transaction/fees_category_report"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('fees_category_report'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('fees_master', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/feemaster'); ?>"><a href="<?php echo base_url(); ?>admin/feemaster"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('fees_master'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('fees_group', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/feegroup'); ?>"><a href="<?php echo base_url(); ?>admin/feegroup"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('fees_group'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('fees_type', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('feetype/index'); ?>"><a href="<?php echo base_url(); ?>admin/feetype"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('fees_type'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('fees_discount', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/feediscount'); ?>"><a href="<?php echo base_url(); ?>admin/feediscount"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('fees_discount'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('fees_year', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('feeyear/index'); ?>"><a href="<?php echo base_url(); ?>admin/feeyear"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('fees_year'); ?>
                                                        </a></li>
                                                <?php

                                                }
                                                if ($this->rbac->hasPrivilege('fees_carry_forward', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('feesforward/index'); ?>"><a href="<?php echo base_url('admin/feesforward'); ?>"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('fees_carry_forward'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('virtual_account', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('virtual_account/index'); ?>"><a href="<?php echo base_url(); ?>virtualaccount"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('virtual_account'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('upload', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('upload'); ?>"><a href="<?php echo base_url(); ?>admin/upload"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('fees') ?>
                                                            <?php echo $this->lang->line('upload'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('file_reader', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('file_reader'); ?>"><a href="<?php echo base_url(); ?>admin/file_reader"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('file_reader'); ?>
                                                        </a></li>
                                                <?php
                                                }

                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                            <?php }
                            }

                            ?>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="margin-top: 2rem;"><strong>ALL MENUS</strong></h5>
                            </div>
                        </div>


                        <div class="menu-card-row">

                            <?php


                            if ($this->module_lib->hasActive('front_office')) {
                                if (
                                    ($this->rbac->hasPrivilege('admission_enquiry', 'can_view') ||
                                        $this->rbac->hasPrivilege('visitor_book', 'can_view') ||
                                        $this->rbac->hasPrivilege('device_type', 'can_view') ||
                                        $this->rbac->hasPrivilege('assigned', 'can_view') ||
                                        // $this->rbc->hasPrivilege('parts_change','can_view')||
                                        $this->rbac->hasPrivilege('phon_call_log', 'can_view') ||
                                        $this->rbac->hasPrivilege('postal_dispatch', 'can_view') ||
                                        $this->rbac->hasPrivilege('postal_receive', 'can_view') ||
                                        $this->rbac->hasPrivilege('complaint', 'can_view') ||
                                        $this->rbac->hasPrivilege('setup_font_office', 'can_view'))
                                ) {
                            ?>
                                    <div class="menu-card-col <?php echo set_Topmenu('front_office'); ?>">
                                        <i class="fa fa-ioxhost" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="streached-link">
                                                Front Office
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('admission_enquiry', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('admin/enquiry'); ?>"><a href="<?php echo base_url(); ?>admin/enquiry"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('admission_enquiry'); ?>
                                                        </a></li>

                                                <?php
                                                } ?>
                                                <?php
                                                if ($this->rbac->hasPrivilege('visitor_book', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/visitors'); ?>"><a href="<?php echo base_url(); ?>admin/visitors"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('visitor_book'); ?>
                                                        </a></li>

                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('device_type', 'can_view')) {
                                                ?>
                                                    <li style="display:none" class="<?php echo set_Submenu('admin/devicetype'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/devicetype"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Device Type'; ?>
                                                        </a>
                                                    </li>

                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('assigned', 'can_view')) {
                                                ?>
                                                    <li style="display:none" class="<?php echo set_Submenu('admin/assigned'); ?>"><a href="<?php echo base_url(); ?>admin/devicetype/assigned"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Assigned'; ?>
                                                        </a></li>

                                                <?php
                                                }


                                                if ($this->rbac->hasPrivilege('parts_change', 'can_view')) {
                                                ?>
                                                    <li style="display:none" class="<?php echo set_Submenu('admin/partchange'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/partchange"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Parts Change'; ?>
                                                        </a>
                                                    </li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('phone_call_log', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/generalcall'); ?>"><a href="<?php echo base_url(); ?>admin/generalcall"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('phone_call_log'); ?>
                                                        </a></li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('postal_dispatch', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/dispatch'); ?>"><a href="<?php echo base_url(); ?>admin/dispatch"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('postal_dispatch'); ?>
                                                        </a></li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('postal_receive', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/receive'); ?>"><a href="<?php echo base_url(); ?>admin/receive"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('postal_receive'); ?>
                                                        </a></li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('complaint', 'can_view')) {
                                                ?>

                                                    <li style="display:none" class="<?php echo set_Submenu('admin/complaint'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/complaint"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('complain'); ?>
                                                        </a>
                                                    </li>

                                                <?php }
                                                if ($this->rbac->hasPrivilege('setup_font_office', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/visitorspurpose'); ?>"><a href="<?php echo base_url(); ?>admin/visitorspurpose"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('setup_front_office'); ?>
                                                        </a></li>

                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>


                                <?php }
                            }

                            if ($this->module_lib->hasActive('minutes')) {
                                if (
                                    ($this->rbac->hasPrivilege('minutes_detail', 'can_view')
                                    )
                                ) {




                                ?>

                                    <div class="menu-card-col <?php echo set_Topmenu('minutes'); ?>">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Minutes
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('minutes_detail', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('minutes/minutes_details'); ?>"><a href="<?php echo base_url(); ?>admin/minutes"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('minutes_detail'); ?>
                                                        </a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }

                            if ($this->module_lib->hasActive('centre')) {
                                if (
                                    ($this->rbac->hasPrivilege('centre', 'can_view')
                                    )
                                ) {
                                ?>

                                    <div class="menu-card-col <?php echo set_Topmenu('centre'); ?>">
                                        <i class="fa fa-university" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Centre
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('centre', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('centre/centre_detail'); ?>"><a href="<?php echo base_url(); ?>admin/centre"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('centre'); ?>
                                                            <?php echo $this->lang->line('details') ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php }
                            }

                            if ($this->module_lib->hasActive('scholarship')) {
                                if (
                                    ($this->rbac->hasPrivilege('scholarship_detail', 'can_view') ||
                                        ($this->rbac->hasPrivilege('apply_scholarship', 'can_view')))
                                ) {
                                ?>



                                    <!--                            <div class="menu-card-col <?php echo set_Topmenu('Scholarship'); ?>">-->
                                    <!--                                <i class="fa fa-book" aria-hidden="true"></i>-->
                                    <!--                                <div class="dropdown">-->
                                    <!--                                    <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button"-->
                                    <!--                                        aria-haspopup="true" aria-expanded="false">-->
                                    <!--                                       Scholarship-->
                                    <!--                                        <span class="caret"></span>-->
                                    <!--                                    </a>-->
                                    <!--                                    <ul class="dropdown-menu" aria-labelledby="dLabel">-->
                                    <!--                                    <?php if ($this->rbac->hasPrivilege('scholarship_detail', 'can_view')) { ?>-->

                                    <!--                <li class="<?php echo set_Submenu('scholarship/scholarship_details'); ?>"><a-->
                                    <!--                        href="<?php echo base_url(); ?>admin/scholarship"><i class="fa fa-angle-double-right"></i>-->
                                    <!--                        <?php echo $this->lang->line('scholarship_detail'); ?></a></li><?php } ?>-->


                                    <!--<?php if ($this->rbac->hasPrivilege('apply_scholarship', 'can_view')) { ?>-->

                                    <!--                <li class="<?php echo set_Submenu('scholarship/apply_scholarship'); ?>"><a-->
                                    <!--                        href="<?php echo base_url(); ?>admin/scholarship/apply_scholarship"><i-->
                                    <!--                            class="fa fa-angle-double-right"></i>-->
                                    <!--                        <?php echo $this->lang->line('apply_scholarship'); ?></a></li><?php } ?>-->
                                    <!--                                    </ul>-->
                                    <!--                                </div>-->
                                    <!--                            </div>-->
                                <?php }
                            }
                            if ($this->module_lib->hasActive('inventory')) {
                                if (
                                    ($this->rbac->hasPrivilege('issue_item', 'can_view') ||
                                        $this->rbac->hasPrivilege('item_stock', 'can_view') ||
                                        $this->rbac->hasPrivilege('item', 'can_view') ||
                                        $this->rbac->hasPrivilege('item_category', 'can_view') ||
                                        $this->rbac->hasPrivilege('item_category', 'can_view') ||
                                        $this->rbac->hasPrivilege('item_report', 'can_view') ||
                                        $this->rbac->hasPrivilege('store', 'can_view') ||
                                        $this->rbac->hasPrivilege('supplier', 'can_view'))
                                ) {
                                ?>
                                    <div class="menu-card-col <?php echo set_Topmenu('Inventory'); ?>">
                                        <i class="fa fa-object-group" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Inventory
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php
                                                if ($this->rbac->hasPrivilege('item_category', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('itemcategory/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemcategory"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo ('Category'); ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('item', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('Item/index'); ?>"><a href="<?php echo base_url(); ?>admin/item"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('add_item'); ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('supplier', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('itemsupplier/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemsupplier"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('item_supplier'); ?>
                                                        </a>
                                                    </li>

                                                <?php }


                                                if ($this->rbac->hasPrivilege('store', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('itemstore/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemstore"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('item_store'); ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('item_stock', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('Itemstock/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemstock"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('add_item_stock'); ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }


                                                if ($this->rbac->hasPrivilege('item_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('itemreport/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('item_report'); ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }






                                                if ($this->rbac->hasPrivilege('issue_item', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('issueitem/index'); ?>"><a href="<?php echo base_url(); ?>admin/issueitem"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('issue_item'); ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }

                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }


                            if ($this->module_lib->hasActive('mess_fee')) {
                                if (
                                    ($this->rbac->hasPrivilege('income_head', 'can_view') ||
                                        ($this->rbac->hasPrivilege('mess_fee_group', 'can_view') ||
                                            $this->rbac->hasPrivilege('fees_master', 'can_view') ||
                                            $this->rbac->hasPrivilege('collection_report', 'can_view') ||
                                            $this->rbac->hasPrivilege('balance_fees_report', 'can_view') ||
                                            $this->rbac->hasPrivilege('search_due_fees', 'can_view') ||
                                            $this->rbac->hasPrivilege('collect_fees', 'can_view') ||
                                            $this->rbac->hasPrivilege('fees_statement', 'can_view') ||
                                            $this->rbac->hasPrivilege('fees_carry_forward', 'can_view') ||
                                            $this->rbac->hasPrivilege('income', 'can_view') ||
                                            $this->rbac->hasPrivilege('fee_transaction', 'can_view')


                                        ))
                                ) {
                                ?>
                                    <div class="menu-card-col <?php echo set_Topmenu('mess fee'); ?>">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Mess Fee
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('collect_fees', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('mess fee/collect fee'); ?>"><a href="<?php echo base_url(); ?>studentmessfee"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('collect_fees'); ?>
                                                        </a></li>


                                                <?php }
                                                if ($this->rbac->hasPrivilege('fees_master', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('mess fee/mess fee master'); ?>"><a href="<?php echo base_url(); ?>admin/messfeemaster"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('fees_master'); ?>
                                                        </a></li>
                                                <?php } ?>



                                                <?php if ($this->rbac->hasPrivilege('income', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('mess fee/income'); ?>"><a href="<?php echo base_url(); ?>admin/mess_income"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('income'); ?>
                                                        </a></li>
                                                <?php } ?>



                                                <?php if ($this->rbac->hasPrivilege('income_head', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('mess fee/mess income head'); ?>"><a href="<?php echo base_url(); ?>admin/mess_income/mess_income_head"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('income_head'); ?>
                                                        </a></li>
                                                <?php } ?>





                                                <?php if ($this->rbac->hasPrivilege('collection_report', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('mess fee/collection report'); ?>"><a href="<?php echo base_url(); ?>admin/collectionreport/mess_collection_report"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('collection_report'); ?>
                                                        </a></li>
                                                <?php } ?>


                                                <?php if ($this->rbac->hasPrivilege('balance_fees_report', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('mess fee/balance fees report'); ?>"><a href="<?php echo base_url(); ?>admin/transaction/balancemessfeereport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('balance_fees_report'); ?>
                                                        </a></li>
                                                <?php } ?>



                                                <?php //if($this->rbac->hasPrivilege('search_due_fees', 'can_view')) {     
                                                ?>

                                                <!-- <li class="<?php //echo set_Submenu('mess fee/search due fee');     
                                                                ?>"><a href="<?php //echo base_url();     
                                                                                ?>studentmessfee/feesearch"><i class="fa fa-angle-double-right"></i> <?php //echo $this->lang->line('search_due_fees');     
                                                                                                                                                        ?></a></li>-->
                                                <?php //}     
                                                ?>

                                                <?php    //if ($this->rbac->hasPrivilege('fee_transaction', 'can_view')) {
                                                ?>
                                                <!--<li class="<?php //echo set_Submenu('mess fee/fee transaction ');     
                                                                ?>"><a href="<?php //echo base_url();     
                                                                                ?>admin/fee_transaction/messFeeTransaction"><i class="fa fa-angle-double-right"></i>
                                    <?php //echo $this->lang->line('fee_transaction');     
                                    ?></a></li>-->
                                                <?php
                                                //}
                                                ?>


                                                <?php    //if ($this->rbac->hasPrivilege('fees_statement', 'can_view')) {
                                                ?>
                                                <!-- <li class="<?php //echo set_Submenu('mess fee/fee statement ');     
                                                                ?>"><a href="<?php //echo base_url();     
                                                                                ?>studentmessfee/reportbyname"><i class="fa fa-angle-double-right"></i>
                                                    <?php //echo $this->lang->line('fees_statement');     
                                                    ?></a></li>-->
                                                <?php
                                                //}
                                                ?>

                                                <?php    //if ($this->rbac->hasPrivilege('fees_carry_forward', 'can_view')) {
                                                ?>
                                                <!-- <li class="<?php //echo set_Submenu('mess fee/fee cary forward ');     
                                                                ?>"><a href="<?php //echo base_url();     
                                                                                ?>admin/feesforward/messfeeforward"><i class="fa fa-angle-double-right"></i>
                                                    <?php //echo $this->lang->line('fees_carry_forward');     
                                                    ?></a></li>-->
                                                <?php
                                                //}
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }

                            if ($this->module_lib->hasActive('accounts')) {
                                if (
                                    ($this->rbac->hasPrivilege('ledger', 'can_view') ||
                                        $this->rbac->hasPrivilege('journal', 'can_view') ||
                                        // $this->rbac->hasPrivilege('stock', 'can_view') ||
                                        $this->rbac->hasPrivilege('trial', 'can_view') ||
                                        $this->rbac->hasPrivilege('p&l_account', 'can_view') ||
                                        $this->rbac->hasPrivilege('balance_sheet', 'can_view') ||
                                        $this->rbac->hasPrivilege('logs', 'can_view'))
                                ) {
                                ?>
                                    <div class="menu-card-col <?php echo set_Topmenu('accounts'); ?>">
                                        <i class="fa fa-ioxhost" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Accounts
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('ledger', 'can_view')) { ?>

                                                    <li class="<?php echo set_Submenu('admin/ledger'); ?>"><a href="<?php echo base_url(); ?>accounts/ledger"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Ledger'; ?>
                                                        </a></li>

                                                <?php
                                                } ?>
                                                <?php
                                                if ($this->rbac->hasPrivilege('journal', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/journal'); ?>"><a href="<?php echo base_url(); ?>accounts/journal"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Journal" ?>
                                                        </a></li>

                                                <?php
                                                }



                                                /*

                                                if ($this->rbac->hasPrivilege('stock', 'can_view')) {
                                                ?>

                                                <li class="<?php echo set_Submenu('admin/stock'); ?>"><a href="<?php echo base_url(); ?>accounts/stock"><i class="fa fa-angle-double-right"></i>
                                                        <?php echo "Stock" ?></a></li>

                                                <?php
                                                }
                                                */





                                                if ($this->rbac->hasPrivilege('trial', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/trial'); ?>"><a href="<?php echo base_url(); ?>accounts/trial"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Trial Balance"; ?>
                                                        </a></li>

                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('p&l_account', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/p&l_account'); ?>"><a href="<?php echo base_url(); ?>accounts/profitandloss"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Profit & Loss Account"; ?>
                                                        </a></li>

                                                <?php
                                                }


                                                if ($this->rbac->hasPrivilege('balance_sheet', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/balance_sheet'); ?>"><a href="<?php echo base_url(); ?>accounts/balancesheet"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Balance Sheet"; ?>
                                                        </a></li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('logs', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/logs'); ?>"><a href="<?php echo base_url(); ?>accounts/accountlogs"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Log/History"; ?>
                                                        </a></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }




                            if ($this->module_lib->hasActive('income')) {
                                if (
                                    ($this->rbac->hasPrivilege('income', 'can_view') ||
                                        $this->rbac->hasPrivilege('search_income', 'can_view') ||
                                        $this->rbac->hasPrivilege('income_head', 'can_view'))
                                ) {
                                ?>
                                    <div class="menu-card-col <?php echo set_Topmenu('Income'); ?>">
                                        <i class="fa fa-usd" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Income
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('income', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('income/index'); ?>"><a href="<?php echo base_url(); ?>admin/income"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('add_income'); ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('search_income', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('income/incomesearch'); ?>"><a href="<?php echo base_url(); ?>admin/income/incomesearch"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('collection'); ?>
                                                            <?php echo $this->lang->line('report'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('income_head', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('incomeshead/index'); ?>"><a href="<?php echo base_url(); ?>admin/incomehead"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('income_head'); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }

                            if ($this->module_lib->hasActive('expense')) {
                                if (
                                    ($this->rbac->hasPrivilege('expense', 'can_view') ||
                                        $this->rbac->hasPrivilege('search_expense', 'can_view') ||
                                        $this->rbac->hasPrivilege('expense_head', 'can_view'))
                                ) {
                                ?>


                                    <div class="menu-card-col <?php echo set_Topmenu('Expenses'); ?>">
                                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Expenses
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('expense', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('expense/index'); ?>"><a href="<?php echo base_url(); ?>admin/expense"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('add_expense'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('search_expense', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('expense/expensesearch'); ?>"><a href="<?php echo base_url(); ?>admin/expense/expensesearch"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('search_expense'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('expense_head', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('expenseshead/index'); ?>"><a href="<?php echo base_url(); ?>admin/expensehead"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('expense_head'); ?>
                                                        </a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }

                            if ($this->module_lib->hasActive('student_attendance')) {
                                if (
                                    ($this->rbac->hasPrivilege('student_attendance', 'can_view') ||
                                        $this->rbac->hasPrivilege('student_attendance_report', 'can_view') ||

                                        $this->rbac->hasPrivilege('report_byday', 'can_view') ||
                                        $this->rbac->hasPrivilege('attendance_report', 'can_view'))
                                ) {
                                ?>
                                    <?php /*
                                                <div class="menu-card-col <?php echo set_Topmenu('Attendance'); ?>">
                                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                    <div class="dropdown">
                                                        <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            Student Attendence
                                                            <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                        <?php if ($this->rbac->hasPrivilege('student_attendance', 'can_view')) { ?>
                                                        <li class="<?php echo set_Submenu('stuattendence/index'); ?>"><a
                                                                href="<?php echo base_url(); ?>admin/stuattendence"><i class="fa fa-angle-double-right"></i>
                                                                <?php echo 'Attendance By Subject'; ?></a></li>
                                                        <?php ?>
                                                        <?php
                                                        //     }
                                                        //   if ($this->rbac->hasPrivilege('attendance_by_date', 'can_view')) {
                                                        ?>
                                                                                    <!--<li class="<?php echo set_Submenu('stuattendence/attendenceReport'); ?>"><a href="<?php echo base_url(); ?>admin/stuattendence/attendencereport"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('attendance_by_date'); ?></a></li>-->
                                                                                <?php ?>
                                                    <?php
                                                        }




                                                        if ($this->rbac->hasPrivilege('student_attendance_report', 'can_view')) { ?>
                                                        <li class="<?php echo set_Submenu('admin/attendencebyday'); ?>"><a
                                                                href="<?php echo base_url(); ?>admin/attendencebyday"><i
                                                                    class="fa fa-angle-double-right"></i> <?php echo 'Attendance'; ?></a></li>

                                                        <li class="<?php echo set_Submenu('attendenceReportByday/classattendencereport'); ?>"><a
                                                                href="<?php echo base_url(); ?>admin/stuattendence/classattendencereportbyday"
                                                                style=" font-size: 9pt !important;"><i class="fa fa-angle-double-right"></i>
                                                                <?php echo 'Attendence Report ' ?></a></li>



                                                        <li class="<?php echo set_Submenu('stuattendence/classattendencereportbyperiod'); ?>"><a
                                                                href="<?php echo base_url(); ?>admin/stuattendence/classattendencereportbyperiod"
                                                                style=" font-size: 9pt !important;"><i class="fa fa-angle-double-right"></i>
                                                                <?php echo 'Attendence Report By Subject' ?></a></li>
                                                <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                
                                              */ ?>

                                <?php }
                            }






                            if ($this->module_lib->hasActive('live_class')) {
                                if (
                                    ($this->rbac->hasPrivilege('live_class', 'can_view') ||
                                        $this->rbac->hasPrivilege('live_class_attendance', 'can_view'))
                                ) {
                                ?>

                                    <div class="menu-card-col <?php echo set_Topmenu('live_class'); ?>">
                                        <i class="fa fa-book" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Live Class
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('live_class', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('live_class/live_class'); ?>"><a href="<?php echo base_url() ?>admin/live_class"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('live_class'); ?>
                                                        </a></li>
                                                <?php } ?>
                                                <?php if ($this->rbac->hasPrivilege('live_class_attendance', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('live_class/live_class_attendance'); ?>"><a href="<?php echo base_url() ?>admin/live_class/live_class_attendance"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('live_class'); ?>
                                                            <?php echo $this->lang->line('attendance') ?>
                                                        </a></li>
                                                <?php } ?>

                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }

                            if ($this->module_lib->hasActive('groupwise_attendance')) {
                                if (
                                    ($this->rbac->hasPrivilege('add_group', 'can_view') ||
                                        $this->rbac->hasPrivilege('mark_attendance', 'can_view') ||
                                        $this->rbac->hasPrivilege('batchwise_report', 'can_view'))
                                ) {
                                ?>
                                    <div class="menu-card-col <?php echo set_Topmenu('groupwise_attendance'); ?>">
                                        <i class="fa fa-book" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Group Attendance
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('add_group', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('groupwise_attendance/add_group'); ?>"><a href="<?php echo base_url() ?>admin/Clinical_group/view_addedgroups"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Add Group'; ?>
                                                        </a></li>
                                                <?php } ?>


                                                <?php if ($this->rbac->hasPrivilege('mark_attendance', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('groupwise_attendance/mark_attendance'); ?>">
                                                        <a href="<?php echo base_url() ?>admin/clinical_department/mark_attendance"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Mark Attendance' ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>

                                                <?php if ($this->rbac->hasPrivilege('batchwise_report', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('groupwise_attendance/batchwise_report'); ?>">
                                                        <a href="<?php echo base_url() ?>admin/clinical_department/batchwiseattendancereport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Bachwise Report' ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }


                            if ($this->module_lib->hasActive('staff_evaluation')) {
                                if (
                                    ($this->rbac->hasPrivilege('classroom_teaching ', 'can_view') ||
                                        $this->rbac->hasPrivilege('classroom_teaching_scores', 'can_view') ||
                                        $this->rbac->hasPrivilege('classroom_teaching_lectures', 'can_view') ||
                                        $this->rbac->hasPrivilege('classroom_teaching_lectures_scores', 'can_view') ||
                                        $this->rbac->hasPrivilege('Dental_clinic_based', 'can_view') ||
                                        $this->rbac->hasPrivilege('Dental_clinic_based_scores', 'can_view') ||
                                        $this->rbac->hasPrivilege('patient_care ', 'can_view') ||
                                        $this->rbac->hasPrivilege('patient_care_scores', 'can_view') ||
                                        $this->rbac->hasPrivilege('departmental_schedule_development', 'can_view') ||
                                        $this->rbac->hasPrivilege('Departmental_schedule_scores', 'can_view') ||
                                        $this->rbac->hasPrivilege('research_supervision', 'can_view') ||
                                        $this->rbac->hasPrivilege('research_supervision_scores', 'can_view') ||
                                        $this->rbac->hasPrivilege('staff_report', 'can_view') ||
                                        $this->rbac->hasPrivilege('my_report', 'can_view') ||

                                        $this->rbac->hasPrivilege('hodview_report', 'can_view') ||

                                        $this->rbac->hasPrivilege('staff_reportapprove', 'can_view') ||
                                        $this->rbac->hasPrivilege('participation_in_faculty', 'can_view') ||
                                        $this->rbac->hasPrivilege('participation_in_faculty_scores', 'can_view'))
                                ) {
                                ?>
                                    <div class="menu-card-col <?php echo set_Topmenu('HR'); ?>">
                                        <i class="fa fa-sitemap" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <?php echo "Staff Evaluation" ?>
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('classroom_teaching', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('admin/Staffevaluation'); ?>"><a href="<?php echo base_url(); ?>admin/staffevaluation"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Classroom Teaching" ?>
                                                        </a></li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('classroom_teaching_scores', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/teachinglectures'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/teachinglectures"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Classroom teaching scores"; ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('classroom_teaching_lectures', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/teachinglectures'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/teachinglectures"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Classroom Teaching Lectures"; ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('classroom_teaching_lectures_scores', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/teachinglecturesscore'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/teachinglecturesscore"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Classroom teaching scores"; ?>
                                                        </a>
                                                    </li>
                                                <?php

                                                }


                                                if ($this->rbac->hasPrivilege('Dental_clinic_based', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/dentalclinicbased'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/dentalclinicbased"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Dental clinic based"; ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('Dental_clinic_based_scores', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/dentalclinicbasedscore'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/dentalclinicbasedscore"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Dental clinic based scores"; ?>
                                                        </a>
                                                    </li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('patient_care ', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/patientcare'); ?>"><a href="<?php echo base_url(); ?>admin/staffevaluation/patientcare"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Patient Care"; ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('patient_care_scores ', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/patientcarescore'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/patientcarescore"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Patient care scores"; ?>
                                                        </a>
                                                    </li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('departmental_schedule_development', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/scheduledevelopment'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/scheduledevelopment"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Department Schedule Development"; ?>
                                                        </a>
                                                    </li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('Departmental_schedule_scores', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/scheduledevelopmentscore'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/scheduledevelopmentscore"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Department Schedule Development Scores"; ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('research_supervision', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/researchsupervision'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/researchsupervision"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Research Supervision"; ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>

                                                <?php

                                                if ($this->rbac->hasPrivilege('research_supervision_scores ', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/researchsupervisionscore'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/researchsupervisionscore"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Research Supervision scores"; ?>
                                                        </a>
                                                    </li>

                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('staff_report', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/staffReport'); ?>"><a href="<?php echo base_url(); ?>admin/staffevaluation/staffReport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Staff Report"; ?>
                                                        </a></li>
                                                <?php } ?>
                                                <?php

                                                if ($this->rbac->hasPrivilege('staff_reportapprove', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/staffReportApprove'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/staffReportApprove"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Staff Report Approve"; ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>

                                                <?php

                                                if ($this->rbac->hasPrivilege('my_report', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/MyReport'); ?>"><a href="<?php echo base_url(); ?>admin/staffevaluation/MyReport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "My Report"; ?>
                                                        </a></li>
                                                <?php } ?>

                                                <?php

                                                if ($this->rbac->hasPrivilege('hodview_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/hodReportview'); ?>"><a href="<?php echo base_url(); ?>admin/staffevaluation/hodReportview"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "HOD view Report"; ?>
                                                        </a></li>
                                                <?php } ?>


                                                <?php

                                                if ($this->rbac->hasPrivilege('participation_in_faculty ', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/participationfaculty'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/participationfaculty"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Participation in faculty"; ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>

                                                <?php

                                                if ($this->rbac->hasPrivilege('participation_in_faculty_scores ', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/staffevaluation/participationfacultyscore'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffevaluation/participationfacultyscore"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Participation faculty scores"; ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }

                            if ($this->module_lib->hasActive('communicate')) {
                                if (
                                    ($this->rbac->hasPrivilege('notice_board', 'can_view') ||
                                        $this->rbac->hasPrivilege('email_sms', 'can_view') ||
                                        $this->rbac->hasPrivilege('email_sms_log', 'can_view'))
                                ) {
                                ?>
                                    <div class="menu-card-col <?php echo set_Topmenu('Communicate'); ?>">
                                        <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Communicate
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php
                                                if ($this->rbac->hasPrivilege('notice_board', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('notification/index'); ?>"><a href="<?php echo base_url(); ?>admin/notification"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('notice_board'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('email_sms', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('notification/add'); ?>"><a href="<?php echo base_url(); ?>admin/notification/add"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('send_message'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('email_sms', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('mailsms/compose'); ?>"><a href="<?php echo base_url(); ?>admin/mailsms/compose"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('send_email_/_sms'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('email_sms_log', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('mailsms/index'); ?>"><a href="<?php echo base_url(); ?>admin/mailsms/index"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('email_/_sms_log'); ?>
                                                        </a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }

                            if ($this->module_lib->hasActive('download_center')) {
                                if (($this->rbac->hasPrivilege('upload_content', 'can_view'))) {
                                ?>

                                    <div class="menu-card-col ?php echo set_Topmenu('Download Center'); ?>">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Download
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('upload_content', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('admin/content'); ?>"><a href="<?php echo base_url(); ?>admin/content"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('upload_content'); ?>
                                                        </a></li>
                                                <?php } ?>
                                                <li class="<?php echo set_Submenu('content/assignment'); ?>"><a href="<?php echo base_url(); ?>admin/content/assignment"><i class="fa fa-angle-double-right"></i>
                                                        <?php echo $this->lang->line('assignments'); ?>
                                                    </a></li>
                                                <li class="<?php echo set_Submenu('content/studymaterial'); ?>"><a href="<?php echo base_url(); ?>admin/content/studymaterial"><i class="fa fa-angle-double-right"></i>
                                                        <?php echo $this->lang->line('study_material'); ?>
                                                    </a></li>
                                                <li class="<?php echo set_Submenu('content/syllabus'); ?>"><a href="<?php echo base_url(); ?>admin/content/syllabus"><i class="fa fa-angle-double-right"></i>
                                                        <?php echo $this->lang->line('syllabus'); ?>
                                                    </a>
                                                </li>


                                                <li class="<?php echo set_Submenu('content/questionpaper'); ?>"><a href="<?php echo base_url(); ?>admin/content/questionpaper"><i class="fa fa-angle-double-right"></i>
                                                        <?php echo 'Question Paper'; ?>
                                                    </a></li>

                                                <li class="<?php echo set_Submenu('content/questionbank'); ?>"><a href="<?php echo base_url(); ?>admin/content/questionbank"><i class="fa fa-angle-double-right"></i>
                                                        <?php echo 'Question Bank'; ?>
                                                    </a></li>



                                                <li class="<?php echo set_Submenu('content/other'); ?>"><a href="<?php echo base_url(); ?>admin/content/other"><i class="fa fa-angle-double-right"></i>
                                                        <?php echo $this->lang->line('other_downloads'); ?>
                                                    </a></li>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }

                            /*if ($this->module_lib->hasActive('homework')) {
                                if (
                                    ($this->rbac->hasPrivilege('homework', 'can_view') ||
                                        $this->rbac->hasPrivilege('homework_report', 'can_view'))
                                ) {
                                ?>
                                    <div class="menu-card-col <?php echo set_Topmenu('Homework'); ?>">
                                        <i class="fa fa-flask" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Home Work
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('homework', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('homework'); ?>"><a href="<?php echo base_url(); ?>homework"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('add_homework'); ?>
                                                        </a></li>
                                                <?php }
                                                if ($this->rbac->hasPrivilege('homework_report', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('homework/evaluation_report'); ?>"><a href="<?php echo base_url(); ?>homework/evaluation_report"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('evaluation_report'); ?>
                                                        </a></li>
                                                <?php } ?>

                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }*/

                            if ($this->module_lib->hasActive('library')) {
                                if (
                                    ($this->rbac->hasPrivilege('books', 'can_view') ||
                                        $this->rbac->hasPrivilege('books', 'can_add') ||
                                        $this->rbac->hasPrivilege('issue_return_student', 'can_view') ||
                                        $this->rbac->hasPrivilege('add_staff_member', 'can_view') ||
                                          $this->rbac->hasPrivilege('issue_report', 'can_view') ||
                                        $this->rbac->hasPrivilege('add_student', 'can_view')
                                    )
                                ) {
                                ?>

                                    <div class="menu-card-col <?php echo set_Topmenu('Library'); ?>">
                                        <i class="fa fa-book" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Library
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('books', 'can_add')) { ?>
                                                    <li class="<?php echo set_Submenu('book/index'); ?>"><a href="<?php echo base_url(); ?>admin/book"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('add_book'); ?>
                                                        </a>
                                                    </li>

                                                <?php }
                                                if ($this->rbac->hasPrivilege('books', 'can_add')) { ?>
                                                    <li class="<?php echo set_Submenu('book/index'); ?>"><a href="<?php echo base_url(); ?>admin/book/file_import"><i class="fa fa-angle-double-right"></i>import book</a></li>

                                                <?php }
                                                if ($this->rbac->hasPrivilege('books', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('book/getall'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/book/getall"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('book_list'); ?>
                                                        </a>
                                                    </li>
                                                <?php }
                                                if ($this->rbac->hasPrivilege('issue_return_student', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('member/index'); ?>"><a href="<?php echo base_url(); ?>admin/member"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('issue_return'); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>

                                                <?php if ($this->rbac->hasPrivilege('add_student', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('member/student'); ?>"><a href="<?php echo base_url(); ?>admin/member/student"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('add_student'); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                
                                                <?php if ($this->rbac->hasPrivilege('issue_report', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('member/issue_report'); ?>"><a
                                                                    href="<?php echo base_url(); ?>admin/member/issue_report"><i
                                                                        class="fa fa-angle-double-right"></i><?php echo ('Issue Report'); ?></a>
                                                            </li>
                                                <?php } ?>
                                                

                                                
                                                <?php if ($this->rbac->hasPrivilege('add_staff_member', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('member/teacher'); ?>"><a href="<?php echo base_url(); ?>admin/member/teacher"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('add_staff_member'); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>

                                                <?php if ($this->rbac->hasPrivilege('pdf_drive', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('library/pdf_drive'); ?>"><a href="https://www.pdfdrive.com/dental-book-books.html"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'PDF Drive'; ?>
                                                        </a></li>
                                                <?php } ?>


                                                <?php if ($this->rbac->hasPrivilege('library_web', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('library/Library_web'); ?>"><a href="https://pcd.libsoft.org/"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'LIBRARY WEB OPAC'; ?>
                                                        </a></li>
                                                <?php } ?>

                                                <?php if ($this->rbac->hasPrivilege('ebsco_host', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('library/ebsco_host'); ?>"><a href="http://search.ebscohost.com"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'EBSCO HOST'; ?>
                                                        </a></li>
                                                <?php } ?>
                                                <?php if ($this->rbac->hasPrivilege('viewattendence', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('member/viewattendence'); ?>"><a href="<?php echo base_url(); ?>admin/teacher/viewattendence"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Library Attendence'; ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }



                            if ($this->module_lib->hasActive('transport')) {
                                if (
                                    ($this->rbac->hasPrivilege('routes', 'can_view') ||
                                        $this->rbac->hasPrivilege('vehicle', 'can_view') ||
                                        $this->rbac->hasPrivilege('assign_vehicle', 'can_view') ||
                                        $this->rbac->hasPrivilege('assign_students', 'can_view') ||
                                        $this->rbac->hasPrivilege('transport_report', 'can_view') ||
                                        $this->rbac->hasPrivilege('assign_vehicle', 'can_view'))
                                ) {
                                ?>
                                    <div class="menu-card-col <?php echo set_Topmenu('Transport'); ?>">
                                        <i class="fa fa-bus" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Transport
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php
                                                if ($this->rbac->hasPrivilege('routes', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('route/index'); ?>"><a href="<?php echo base_url(); ?>admin/route"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('routes'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('vehicle', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('vehicle/index'); ?>"><a href="<?php echo base_url(); ?>admin/vehicle"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('vehicles'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('vehicle', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('vehicle/driver'); ?>"><a href="<?php echo base_url(); ?>admin/vehicle/driver"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Driver"; ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('assign_vehicle', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('vehroute/index'); ?>"><a href="<?php echo base_url(); ?>admin/vehroute"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('assign_vehicle'); ?>
                                                        </a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('assign_student', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('vehroute/assign_students'); ?>"><a href="<?php echo base_url(); ?>admin/vehicle/assign_students"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Assign Transport"; ?>
                                                        </a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('transport_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('vehroute/transport_report'); ?>"><a href="<?php echo base_url(); ?>admin/vehicle/transport_report"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo "Transport Report "; ?>
                                                        </a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('student_transport_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/route/studenttransportdetails'); ?>"><a href="<?php echo base_url(); ?>admin/route/studenttransportdetails"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('student_transport_report'); ?>
                                                        </a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }

                            if ($this->module_lib->hasActive('hostel')) {
                                if (
                                    ($this->rbac->hasPrivilege('hostel_rooms', 'can_view') ||
                                        $this->rbac->hasPrivilege('room_type', 'can_view') ||
                                        $this->rbac->hasPrivilege('hostel', 'can_view'))
                                ) {
                                ?>

                                    <div class="menu-card-col <?php echo set_Topmenu('Hostel'); ?>">
                                        <i class="fa fa-building-o" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Hostel
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php
                                                if ($this->rbac->hasPrivilege('hostel_rooms', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('hostelroom/index'); ?>"><a href="<?php echo base_url(); ?>admin/hostelroom"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('hostel_rooms'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('room_type', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('roomtype/index'); ?>"><a href="<?php echo base_url(); ?>admin/roomtype"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('room_type'); ?>
                                                        </a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('hostel', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('hostel/index'); ?>"><a href="<?php echo base_url(); ?>admin/hostel"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('hostel'); ?>
                                                        </a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('student_hostel_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/hostelroom/studenthosteldetails'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/hostelroom/studenthosteldetails"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('student') . " " . $this->lang->line('hostel') . " " . $this->lang->line('report'); ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php }
                            }

                            if ($this->module_lib->hasActive('certificate')) {
                                if (
                                    ($this->rbac->hasPrivilege('student_certificate', 'can_view') ||
                                        $this->rbac->hasPrivilege('generate_certificate', 'can_view') ||
                                        $this->rbac->hasPrivilege('student_id_card', 'can_view') ||
                                        $this->rbac->hasPrivilege('generate_id_card', 'can_view'))
                                ) {
                                ?>

                                    <div class="menu-card-col <?php echo set_Topmenu('Certificate'); ?>">
                                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Certificate
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php
                                                if ($this->rbac->hasPrivilege('student_certificate', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/certificate'); ?>"><a href="<?php echo base_url(); ?>admin/certificate/"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('student'); ?>
                                                            <?php echo $this->lang->line('certificate'); ?>
                                                        </a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('generate_certificate', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/generatecertificate'); ?>"><a href="<?php echo base_url(); ?>admin/generatecertificate/"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('generate'); ?>
                                                            <?php echo $this->lang->line('certificate'); ?>
                                                        </a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('student_id_card', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/studentidcard'); ?>"><a href="<?php echo base_url('admin/studentidcard/'); ?>"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('student'); ?>
                                                            <?php echo $this->lang->line('icard'); ?>
                                                        </a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('generate_id_card', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/generateidcard'); ?>"><a href="<?php echo base_url('admin/generateidcard/'); ?>"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('generate'); ?>
                                                            <?php echo $this->lang->line('icard'); ?>
                                                        </a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }
                            }


                            if ($this->module_lib->hasActive('front_cms')) {
                                if (
                                    ($this->rbac->hasPrivilege('event', 'can_view') ||
                                        $this->rbac->hasPrivilege('gallery', 'can_view') ||
                                        $this->rbac->hasPrivilege('notice', 'can_view') ||
                                        $this->rbac->hasPrivilege('media_manager', 'can_view') ||
                                        $this->rbac->hasPrivilege('pages', 'can_view') ||
                                        $this->rbac->hasPrivilege('menus', 'can_view') ||
                                        $this->rbac->hasPrivilege('banner_images', 'can_view'))
                                ) {
                                ?>
                                    <div class="menu-card-col">
                                        <i class="fa fa-empire" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <?php echo $this->lang->line('front_cms'); ?>
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('event', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('admin/front/events'); ?>"><a href="<?php echo base_url(); ?>admin/front/events"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('event'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('gallery', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/front/gallery'); ?>"><a href="<?php echo base_url(); ?>admin/front/gallery"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('gallery'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('notice', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/front/notice'); ?>"><a href="<?php echo base_url(); ?>admin/front/notice"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('notice'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('media_manager', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/front/media'); ?>"><a href="<?php echo base_url(); ?>admin/front/media"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('media_manager'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('pages', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/front/page'); ?>"><a href="<?php echo base_url(); ?>admin/front/page"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('page'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('menus', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/front/menus'); ?>"><a href="<?php echo base_url(); ?>admin/front/menus"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('menus'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('banner_images', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/front/banner'); ?>"><a href="<?php echo base_url(); ?>admin/front/banner"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('banner_images'); ?>
                                                        </a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php }
                            }

                            if ($this->module_lib->hasActive('reports')) {
                                if (
                                    ($this->rbac->hasPrivilege('transaction_report', 'can_view') ||
                                        $this->rbac->hasPrivilege('fees_report', 'can_view') ||
                                        $this->rbac->hasPrivilege('stafftheory_attendance_report', 'can_view') ||
                                        $this->rbac->hasPrivilege('staffclini_attendance_report', 'can_view') ||

                                        $this->rbac->hasPrivilege('mess_fees_report', 'can_view') ||
                                        $this->rbac->hasPrivilege('work_log_report', 'can_view') ||
                                        $this->rbac->hasPrivilege('user_log', 'can_view'))
                                ) {
                                ?>
                                    <div class="menu-card-col <?php echo set_Topmenu('Reports'); ?>">
                                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Report
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php if ($this->rbac->hasPrivilege('fees_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('Reports/feesreport'); ?>"><a href="<?php echo base_url(); ?>admin/fees_report"><i class="fa fa-angle-double-right"></i>

                                                            <?php echo $this->lang->line('fees'); ?>
                                                            <?php echo $this->lang->line('report'); ?>
                                                        </a>
                                                    </li>

                                                <?php }
                                                if ($this->rbac->hasPrivilege('mess_fees_report', 'can_view')) {
                                                ?>
                                                    <!-- <li class="<?php echo set_Submenu('Reports/messreport'); ?>"><a href="<?php echo base_url(); ?>admin/fees_report/mess_fee_report"><i class="fa fa-angle-double-right"></i>
                <?php //echo $this->lang->line('mess');     
                ?> <?php //echo $this->lang->line('report');     
                    ?> </a></li>-->



                                                <?php }
                                                if ($this->rbac->hasPrivilege('student_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('student/studentreport'); ?>"><a href="<?php echo base_url(); ?>student/studentreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('student_report'); ?>
                                                        </a></li>

                                                <?php }
                                                if ($this->rbac->hasPrivilege('guardian_report', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('student/guardianreport'); ?>"><a href="<?php echo base_url(); ?>student/guardianreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('guardian_report'); ?>
                                                        </a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('stafftheory_attendance_report', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('student/staff_tpreport'); ?>"><a href="<?php echo base_url(); ?>student/staff_tpreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Staff T/P Report'; ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('staffclini_attendance_report', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('student/staff_clireport'); ?>"><a href="<?php echo base_url(); ?>student/staff_clireport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo 'Staff Clinical Report'; ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('student_history', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/users/admissionreport'); ?>"><a href="<?php echo base_url(); ?>admin/users/admissionreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('student_history'); ?>
                                                        </a></li>
                                                <?php
                                                }


                                                if ($this->rbac->hasPrivilege('student_login_credential', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/users/logindetailreport'); ?>"><a href="<?php echo base_url(); ?>admin/users/logindetailreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('student'); ?>
                                                            <?php echo $this->lang->line('login_credential'); ?>
                                                        </a></li>

                                                <?php
                                                }


                                                if ($this->rbac->hasPrivilege('fees_statement', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('reportbyname/index'); ?>"><a href="<?php echo base_url(); ?>studentfee/reportbyname"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('fees_statement'); ?>
                                                        </a></li>
                                                <?php
                                                }


                                                if ($this->rbac->hasPrivilege('balance_fees_report', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('transaction/studentacademicreport'); ?>"><a href="<?php echo base_url(); ?>admin/transaction/studentacademicreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('balance_fees_report'); ?>
                                                        </a></li>
                                                <?php }
                                                if ($this->rbac->hasPrivilege('transaction_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('transaction/searchtransaction'); ?>"> <a href="<?php echo base_url(); ?>admin/transaction/searchtransaction"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('transaction_report'); ?>
                                                        </a></li>
                                                <?php }
                                                if ($this->rbac->hasPrivilege('attendance_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('stuattendence/classattendencereport'); ?>"><a href="<?php echo base_url(); ?>admin/stuattendence/classattendencereport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('attendance_report'); ?>
                                                        </a></li>
                                                <?php }
                                                if ($this->rbac->hasPrivilege('exam_marks_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('mark/index'); ?>"><a href="<?php echo base_url(); ?>admin/mark"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('exam_marks_report'); ?>
                                                        </a></li>

                                                <?php }
                                                if ($this->rbac->hasPrivilege('payroll_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/payroll/payrollreport'); ?>"><a href="<?php echo base_url(); ?>admin/payroll/payrollreport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('payroll_report'); ?>
                                                        </a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('staff_attendance_report', 'can_view')) {
                                                ?>

                                                    <li class="<?php echo set_Submenu('admin/staffattendance/attendancereport'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffattendance/attendancereport"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('staff_attendance_report'); ?>
                                                        </a>
                                                    </li>
                                                    <li class="<?php echo set_Submenu('admin/staffattendance/attendancereportbyperiod'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/staffattendance/attendancereportbyperiod"><i class="fa fa-angle-double-right"></i> Attendance Report By
                                                            Period</a>
                                                    </li>
                                                <?php
                                                }




                                                if ($this->rbac->hasPrivilege('homework_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('homework/evaluation_report'); ?>"><a href="<?php echo base_url(); ?>homework/evaluation_report"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('evaluation_report'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('student_transport_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/route/studenttransportdetails'); ?>"><a href="<?php echo base_url(); ?>admin/route/studenttransportdetails"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('student_transport_report'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('student_hostel_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/hostelroom/studenthosteldetails'); ?>">
                                                        <a href="<?php echo base_url(); ?>admin/hostelroom/studenthosteldetails"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('student') . " " . $this->lang->line('hostel') . " " . $this->lang->line('report'); ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('user_log', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('userlog/index'); ?>"><a href="<?php echo base_url(); ?>admin/userlog"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('user_log'); ?>
                                                        </a></li>
                                                <?php }

                                                if ($this->rbac->hasPrivilege('work_log_report', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('worklog_report/index'); ?>"><a href="<?php echo base_url(); ?>admin/worklogreport"><i class="fa fa-angle-double-right"></i>
                                                            Work Log Report</a></li>
                                                <?php }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php
                                }
                            }
                            if ($this->module_lib->hasActive('system_settings')) {
                                if (
                                    ($this->rbac->hasPrivilege('general_setting', 'can_edit') ||
                                        $this->rbac->hasPrivilege('session_setting', 'can_view') ||
                                        $this->rbac->hasPrivilege('financial_year', 'can_view') ||
                                        $this->rbac->hasPrivilege('notification_setting', 'can_edit') ||
                                        $this->rbac->hasPrivilege('sms_setting', 'can_edit') ||
                                        $this->rbac->hasPrivilege('starting_invoice', 'can_view') ||
                                        $this->rbac->hasPrivilege('mess_invoice', 'can_view') ||
                                        $this->rbac->hasPrivilege('email_setting', 'can_edit') ||
                                        $this->rbac->hasPrivilege('payment_methods', 'can_edit') ||
                                        $this->rbac->hasPrivilege('roles_permissions', 'can_view') ||
                                        $this->rbac->hasPrivilege('languages', 'can_view') ||
                                        $this->rbac->hasPrivilege('languages', 'can_add') ||
                                        $this->rbac->hasPrivilege('backup_restore', 'can_view') ||
                                        $this->rbac->hasPrivilege('front_cms_setting', 'can_edit'))
                                ) {
                                ?>
                                    <div class="menu-card-col <?php echo set_Topmenu('System Settings'); ?>">
                                        <i class="fa fa-book" aria-hidden="true"></i>
                                        <div class="dropdown">
                                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                System Settings
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <?php
                                                if ($this->rbac->hasPrivilege('general_setting', 'can_edit')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('schsettings/index'); ?>"><a href="<?php echo base_url(); ?>schsettings"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('general_settings'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('session_setting', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('sessions/index'); ?>"><a href="<?php echo base_url(); ?>sessions"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('session_setting'); ?>
                                                        </a></li>
                                                <?php
                                                }


                                                if ($this->rbac->hasPrivilege('financial_year', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('financial_year'); ?>"><a href="<?php echo base_url(); ?>financial_year"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('financial_year'); ?>
                                                        </a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('starting_invoice', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('starting_invoice'); ?>"><a href="<?php echo base_url(); ?>invoice"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('invoice'); ?>
                                                        </a></li>
                                                <?php
                                                }



                                                if ($this->rbac->hasPrivilege('mess_invoice', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('mess invoice'); ?>"><a href="<?php echo base_url(); ?>invoice/mess_invoice"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('mess'); ?>
                                                            <?php echo $this->lang->line('invoice'); ?>
                                                        </a></li>
                                                <?php
                                                }




                                                if ($this->rbac->hasPrivilege('notification_setting', 'can_edit')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('notification/setting'); ?>"><a href="<?php echo base_url(); ?>admin/notification/setting"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('notification_setting'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('sms_setting', 'can_edit')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('smsconfig/index'); ?>"><a href="<?php echo base_url(); ?>smsconfig"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('sms_setting'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('email_setting', 'can_edit')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('emailconfig/index'); ?>"><a href="<?php echo base_url(); ?>emailconfig"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('email_setting'); ?>
                                                        </a></li>
                                                <?php
                                                }

                                                if ($this->rbac->hasPrivilege('payment_methods', 'can_edit')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/paymentsettings'); ?>"><a href="<?php echo base_url(); ?>admin/paymentsettings"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('payment_methods'); ?>
                                                        </a></li>
                                                    <?php
                                                }
                                                if ($this->module_lib->hasActive('front_cms')) {
                                                    if ($this->rbac->hasPrivilege('front_cms_setting', 'can_edit')) {
                                                    ?>
                                                        <li class="<?php echo set_Submenu('admin/frontcms/index'); ?>"><a href="<?php echo base_url(); ?>admin/frontcms"><i class="fa fa-angle-double-right"></i>
                                                                <?php echo $this->lang->line('front_cms_setting'); ?>
                                                            </a></li>
                                                <?php }
                                                }
                                                ?>
                                                <?php if ($this->rbac->hasPrivilege('roles_permissions', 'can_view')) { ?>
                                                    <li class="<?php echo set_Submenu('admin/roles'); ?>"><a href="<?php echo base_url(); ?>admin/roles"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('roles_permissions'); ?>
                                                        </a></li>
                                                <?php } ?>
                                                <?php
                                                if ($this->rbac->hasPrivilege('backup', 'can_view')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('admin/backup'); ?>"><a href="<?php echo base_url(); ?>admin/admin/backup"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('backup / restore'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('languages', 'can_add')) {
                                                ?>
                                                    <li class="<?php echo set_Submenu('language/index'); ?>"><a href="<?php echo base_url(); ?>admin/language"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('languages'); ?>
                                                        </a></li>
                                                <?php
                                                }
                                                ?>
                                                <?php if ($this->rbac->hasPrivilege('user_status')) { ?>
                                                    <li class="<?php echo set_Submenu('users/index'); ?>"><a href="<?php echo base_url(); ?>admin/users"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('users'); ?>
                                                        </a></li>
                                                <?php }
                                                if ($this->rbac->hasPrivilege('superadmin')) { ?>
                                                    <li class="<?php echo set_Submenu('admin/module'); ?>"><a href="<?php echo base_url(); ?>admin/module"><i class="fa fa-angle-double-right"></i>
                                                            <?php echo $this->lang->line('modules'); ?>
                                                        </a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                            <?php }
                            } ?>
                            <!-- <div class="menu-card-col">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                <div class="dropdown">
                                    <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false">
                                        Dropdown trigger
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                        <li><a href="#"><i class="fa fa-angle-right"></i>Student Details</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Student Admission</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Parent Feedback</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Update KUHS Reg.No</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Student Login Credential</a>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->



                            <!-- <div class="menu-card-col">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                <div class="dropdown">
                                    <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false">
                                        Dropdown trigger
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                        <li><a href="#"><i class="fa fa-angle-right"></i>Student Details</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Student Admission</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Parent Feedback</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Update KUHS Reg.No</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Student Login Credential</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="menu-card-col">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                <div class="dropdown">
                                    <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false">
                                        Dropdown trigger
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                        <li><a href="#"><i class="fa fa-angle-right"></i>Student Details</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Student Admission</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Parent Feedback</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Update KUHS Reg.No</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Student Login Credential</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="menu-card-col">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                <div class="dropdown">
                                    <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false">
                                        Dropdown trigger
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                        <li><a href="#"><i class="fa fa-angle-right"></i>Student Details</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Student Admission</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Parent Feedback</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Update KUHS Reg.No</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Student Login Credential</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="menu-card-col">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                <div class="dropdown">
                                    <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false">
                                        Dropdown trigger
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                        <li><a href="#"><i class="fa fa-angle-right"></i>Student Details</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Student Admission</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Parent Feedback</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Update KUHS Reg.No</a></li>
                                        <li><a href=""><i class="fa fa-angle-right"></i>Student Login Credential</a>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>

                <div class="col-md-1 col-sm-3 col-lg-2 d-md-none">
                    <span href="#" class="sidebar-session">
                        <?php echo $this->setting_model->getCurrentSchoolName(); ?>
                    </span>
                </div>

                <div class="col-md-9 col-sm-10 col-xs-6 col-lg-8 pull-right">

                    <div class="pull-right">

                        <form class="navbar-form navbar-left search-form" role="search" id="institution-form" action="<?php echo site_url('schsettings/set_session'); ?>" method="POST">

                            <?php $institution = $this->setting_model->getall_institution();

                            $admin = $this->session->userdata('admin');
                            $centre_id = $admin['centre_id'];

                            ?>

                            <div class="input-group" style="padding-top:3px;width: 191px;">
                                <select autofocus id="institution" name="institution" class="form-control search-form search-form3" style="border-radius: 13px;">
                                    <option value="">
                                        <?php echo $this->lang->line('select'); ?>
                                    </option>
                                    <?php foreach ($institution as $key => $centre) {
                                    ?>
                                        <option <?php if ($centre_id == $centre['id']) {
                                                    echo "selected=selected";
                                                } ?> value="<?php echo $centre['id'] ?>">
                                            <?php echo $centre['centre_name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </form>







                        <form class="navbar-form navbar-left search-form session-from" role="search" id="session-from" action="<?php echo site_url('schsettings/header_session'); ?>" method="POST">
                            <?php $session_result = $this->session_model->get();
                            // var_dump($session_result);exit;
                            ?>
                            <?php $current_sess = $this->setting_model->getCurrentSession(); ?>
                            <input type="hidden" name="currentid" id="currentid" value="<?php echo $this->setting_model->getcurrentid(); ?>" />
                            <div class="input-group" style="padding-top:3px;width:102px;">
                                <select autofocus id="session" name="session" class="form-control search-form search-form3 session">
                                    <option value="">
                                        <?php echo $this->lang->line('select'); ?>
                                    </option>
                                    <?php foreach ($session_result as $key => $sess) {

                                    ?>
                                        <option <?php if ($current_sess == $sess['id']) {
                                                    echo "selected=selected";
                                                } ?> value="<?php echo $sess['id'] ?>">
                                            <?php echo $sess['session'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </form>



                        <?php if ($this->rbac->hasPrivilege('student', 'can_view')) { ?>
                            <form class="navbar-form navbar-left search-form" role="search" action="<?php echo site_url('admin/admin/search'); ?>" method="POST">
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="input-group" style="padding-top:3px;">
                                    <input type="text" name="search_text" class="form-control search-form search-form3" placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" style="padding: 3px 12px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                        <?php } ?>
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav headertopmenu">
                                <?php
                                if ($this->module_lib->hasActive('calendar_to_do_list')) {
                                    if ($this->rbac->hasPrivilege('calendar_to_do_list', 'can_view')) {
                                ?>
                                        <li class="cal15"><a href="<?php echo base_url() ?>admin/calendar/events" title="<?php echo $this->lang->line('calendar') ?>"><i class="fa fa fa-calendar"></i></a></li>
                                <?php
                                    }
                                }
                                ?>
                                <?php
                                if ($this->module_lib->hasActive('calendar_to_do_list')) {
                                    if ($this->rbac->hasPrivilege('calendar_to_do_list', 'can_view')) {
                                ?>
                                        <li class="dropdown">
                                            <a href="#" title="<?php echo $this->lang->line('task') ?>" class="dropdown-toggle todoicon" data-toggle="dropdown">
                                                <i class="fa fa-check-square-o"></i>
                                                <?php
                                                $userdata = $this->customlib->getUserData();
                                                $count = $this->customlib->countincompleteTask($userdata["id"]);
                                                if ($count > 0) {
                                                ?>

                                                    <span class="todo-indicator">
                                                        <?php echo $count ?>
                                                    </span>
                                                <?php } ?>
                                            </a>
                                            <ul class="dropdown-menu menuboxshadow">

                                                <li class="todoview plr10 ssnoti">
                                                    <?php echo $this->lang->line('today_you_have'); ?>
                                                    <?php echo $count; ?>
                                                    <?php echo $this->lang->line('pending_task'); ?><a href="<?php echo base_url() ?>admin/calendar/events" class="pull-right pt0">
                                                        <?php echo $this->lang->line('view'); ?>
                                                        <?php echo $this->lang->line('all'); ?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <ul class="todolist">
                                                        <?php
                                                        $tasklist = $this->customlib->getincompleteTask($userdata["id"]);
                                                        foreach ($tasklist as $key => $value) {
                                                        ?>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label><input type="checkbox" id="newcheck<?php echo $value["id"] ?>" onclick="markc('<?php echo $value["id"] ?>')" name="eventcheck" value="<?php echo $value["id"]; ?>">
                                                                        <?php echo $value["event_title"] ?>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        <?php } ?>

                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                <?php
                                    }
                                }
                                ?>


                                <?php
                                $file = "";
                                $result = $this->customlib->getUserData();

                                $image = $result["image"];
                                $role = $result["user_type"];
                                $id = $result["id"];
                                if (!empty($image)) {

                                    $file = "uploads/staff_images/" . $image;
                                } else {

                                    $file = "uploads/student_images/no_image.png";
                                }
                                ?>
                                <li class="dropdown user-menu">
                                    <a class="dropdown-toggle" style="padding: 15px 13px;" data-toggle="dropdown" href="#" aria-expanded="false">
                                        <img src="<?php echo base_url() . $file; ?>" class="topuser-image" alt="User Image">
                                    </a>
                                    <ul class="dropdown-menu dropdown-user menuboxshadow">
                                        <li>
                                            <div class="sstopuser">
                                                <div class="ssuserleft">
                                                    <a href="<?php echo base_url() . "admin/staff/profile/" . $id ?>"><img src="<?php echo base_url() . $file; ?>" alt="User Image"></a>
                                                </div>

                                                <div class="sstopuser-test">
                                                    <h4 style="text-transform: capitalize;">
                                                        <?php echo $this->customlib->getAdminSessionUserName(); ?>
                                                    </h4>
                                                    <h5>
                                                        <?php echo $role; ?>
                                                    </h5>
                                                    <!-- <div class="sspass pt15"><a class="pull-right" href="<?php //echo base_url()."admin/staff/profile/".$id
                                                                                                                ?>"><i class="fa fa-user"></i> My Profile</a></div>   -->
                                                </div>

                                                <div class="divider"></div>
                                                <div class="sspass">
                                                    <a href="<?php echo base_url() . "admin/staff/profile/" . $id ?>" data-toggle="tooltip" title="" data-original-title="My Profile"><i class="fa fa-user"></i>Profile</a>
                                                    <a class="pl25" href="<?php echo base_url(); ?>admin/admin/changepass" data-toggle="tooltip" title="" data-original-title="Change Password"><i class="fa fa-key"></i>
                                                        <?php echo $this->lang->line('password'); ?>
                                                    </a> <a class="pull-right" href="<?php echo base_url(); ?>site/logout"><i class="fa fa-sign-out fa-fw"></i>
                                                        <?php echo $this->lang->line('logout'); ?>
                                                    </a>
                                                </div>
                                            </div><!--./sstopuser-->
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <?php //$this->load->view('layout/sidebar');
        ?>

        <script>
            $(document).ready(function() {
                $('#session').keydown(function(e) {
                    var arrowKeys = [37, 38, 39, 40];
                    if (arrowKeys.indexOf(e.which) !== -1) {
                        $(this).blur();
                        return false;
                    }
                });

                $(document).on('change', '#session', function(e) {
                    console.log("here");
                    $("form#session-from").submit();
                });

                $(document).on('change', '#msession', function(e) {
                    console.log("here");
                    $("form#msession-from").submit();
                });

                $(document).on('change', '#institution', function(e) {
                    $("form#institution-form").submit();
                });
            });



            document.addEventListener("DOMContentLoaded", function() {
                const menuOverlay = document.getElementById("sidebar-menu-overlay");
                const openButton = document.getElementById("hamburger-menu");
                const slideInDiv = document.getElementById("sidebar-menu-panel");
                const closeButton = document.getElementById("sidebar-menu-close");

                openButton.addEventListener("click", function() {
                    // Add the "open" class to the div
                    slideInDiv.classList.add("open");
                    menuOverlay.classList.add("open");

                });

                closeButton.addEventListener("click", function() {
                    // Remove the "open" class from the div
                    slideInDiv.classList.remove("open");
                    menuOverlay.classList.remove("open");
                });

                menuOverlay.addEventListener("click", function() {
                    // Remove the "open" class from the div
                    slideInDiv.classList.remove("open");
                    menuOverlay.classList.remove("open");
                });
            });

            $(document).ready(function() {
                $('.dropdown').on('shown.bs.dropdown', function() {
                    var $dropdown = $(this);
                    var $menu = $dropdown.find('.dropdown-menu');
                    var windowHeight = $(window).height();
                    var menuHeight = $menu.outerHeight();
                    var menuTop = $menu.offset().top;
                    var buttonBottom = $dropdown.offset().top + $dropdown.outerHeight();

                    if (menuTop + menuHeight > windowHeight) {
                        $menu.css({
                            position: 'absolute',
                            transform: 'translate3d(0, -' + (menuHeight - 1) + 'px, 0)', // Adjust as needed
                            top: 'auto',
                            left: 0,
                            'will-change': 'transform'
                        });
                    } else {
                        $menu.css({
                            position: 'absolute',
                            transform: 'translate3d(0, 0, 0)',
                            top: '100%',
                            left: 'auto',
                            'will-change': 'transform'
                        });
                    }
                });
            });
        </script>