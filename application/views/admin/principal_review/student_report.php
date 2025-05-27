<style type="text/css">
    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }
        .table-wrapper {
            margin: 20mm auto !important; /* Adds margin around the table */
            width: 90% !important; /* Adjusts table width to fit within margins */
        }
    }

    .download_label {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        padding: 10px;
    }
    
    
</style>
<style>
    .table th, .table td {
        padding: 10px; /* Increase padding for better spacing */
        text-align: center;
    }
    .table {
        width: 100%;
        table-layout: fixed;
        border-spacing: 5px; /* Adds space between table cells */
        border-collapse: separate; /* Ensures spacing works */
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-sitemap"></i> <?php echo "Staff Attendance Report By Period" ?></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <form id='form1' action="<?php echo site_url('admin/principal_review/principal_view_student_review_report') ?>" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo "Teacher List" ?></label>
                                        <select id="staff" name="staff" class="form-control">
                                            <option value="select"><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($staff_list as $staff_list => $value) {
                                            ?>
                                                <option value="<?php echo $value["id"] ?>" <?php
                                                                                                    if ($staff_id == $value["employee_id"]) {
                                                                                                        echo "selected =selected";
                                                                                                    }
                                                                                                    ?>><?php echo $value["name"]; ?></option>
                                            <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('role'); ?></span>
                                    </div>
                                </div>
                                

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                        </div>
                    </form>
                </div>

                <?php

                if (isset($staffDetails)) {
                    //var_dump($resultlist);
                ?>
                    <div class="nav-tabs-custom">
                    <button type="button" style="margin-right: 10px; margin-top: 10px;" name="search"
                            id="collection_print" 
                            data-class="collection_report" 
                            class="btn btn-sm btn-primary login-submit-cs fa fa-print pull-right">
                        Print View
                    </button>
                       
 


                            <div id='collection_report'>
                        <div  id="printcontent">
                            
                            <div class="tab-pane active table-responsive no-padding" id="tab_1">
                                <h3 style="text-align:center">
                                    <br>
                                    <?php echo "Student Review Report of " . $staffDetails[0]['name']  ?>
                                    <br><br>
                                </h3>
                                <div class="table-wrapper">
                                    <table class="table table-striped table-bordered table-hover  text-center" style="width:80%;margin:0 auto;" border="1">
                                    <thead>
                                        <tr>
                                            <th><?php echo "Criteria" ?></th>
                                            <th><?php echo "Score" ?></th>
                                            <th><?php echo "Average Score" ?></th>


                                        </tr>
                                    </thead>
                                   <tbody>
    <?php
    if (empty($staffDetails)) {
        // You can show a "No Record Found" row here if needed
    } else {
        $count = 1;
        foreach ($staffDetails as $index => $stafflist) {
            ?>
            <tr>
                <td style="text-align:center">
                    <?php
                    if ($stafflist['criteria_index'] == 0) {
                        echo "Teacher prepares and organizes the class well";
                    } elseif ($stafflist['criteria_index'] == 1) {
                        echo "Teacher knows the subject well";
                    } elseif ($stafflist['criteria_index'] == 2) {
                        echo "Teacher is flexible in accommodating for individual student needs";
                    } 
                     elseif ($stafflist['criteria_index'] == 3) {
                        echo "Teacher allows the student to ask questions and encourage active participation in the class";
                    } 
                       elseif ($stafflist['criteria_index'] == 4) {
                        echo "Teacher uses various teaching methods and appropriate AV aids";
                    }  
                     elseif ($stafflist['criteria_index'] == 5) {
                        echo "Teacher delivers lectures at the level of students understanding with examples";
                    } 
                      elseif ($stafflist['criteria_index'] == 6) {
                        echo "Teacher prepares the students for both theory and practical examinations";
                    } 
                    elseif ($stafflist['criteria_index'] == 7) {
                        echo "Teacher treats students impartially";
                    } 
                       elseif ($stafflist['criteria_index'] == 8) {
                        echo "Teacher listens and understands students problems";
                    } 
                       elseif ($stafflist['criteria_index'] == 9) {
                        echo "Teacher is approachable for corrections and guidance";
                    } 
                     elseif ($stafflist['criteria_index'] == 10) {
                        echo "Teacher encourages and appreciates students creativity";
                    } 
                      elseif ($stafflist['criteria_index'] == 11) {
                        echo "Teacher encourages and motivates the students for new learning";
                    } 
                      elseif ($stafflist['criteria_index'] == 12) {
                        echo "Teacher is punctual";
                    } 
                     elseif ($stafflist['criteria_index'] == 13) {
                        echo "Completes the allotted portions on time";
                    } 
                       elseif ($stafflist['criteria_index'] == 14) {
                        echo "Teacher’s communication skills";
                    } 
                       
                    else {
                        echo "Unknown Criteria";
                    }
                    ?>
                </td>
                <td style="text-align:center"><?php echo $stafflist['total_score']; ?></td>
                <td style="text-align:center"><?php echo $stafflist['avg_score']; ?></td>

            </tr>
            <?php
            $count++;
        }
    }
    ?>
</tbody>
                                </table>
                                </div>
                            </div>

                        </div>
                        </div>
                    </div>
                <?php
                }
                ?>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('.date').datepicker({
            format: date_format,
            autoclose: true
        });

        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function() {
                return $(this).closest('th').find('.fee_detail_popover').html();
            }
        });
    });
</script>
<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';

    function printDiv(elem) {
        Popup(jQuery(elem).html());
    }

    function Popup(data) {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({
            "position": "absolute",
            "top": "-1000000px"
        });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');


        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function() {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);


        return true;
    }
</script>
<script type="text/javascript">
$(document).on('click', '#collection_print', function () {
    let content = $('#printcontent').html();

    // Encode content as base64 safely
    let encodedContent = btoa(unescape(encodeURIComponent(content)));

    $.ajax({
        url: '<?php echo base_url('admin/weeklycalendarnew/printwithheaderandfooter'); ?>',
        method: 'POST',
        data: {
            data: encodedContent  // Send encoded content
        },
        success: function (data) {
            console.log(data);
            data = data.replace(/['"]+/g, '');
            window.open("<?php echo base_url(); ?>" + data, '_blank');
        },
        error: function (xhr, status, error) {
            console.error('xhr:', xhr);
            console.error('status:', status);
            console.error('error:', error);
        }
    });
});
</script>
