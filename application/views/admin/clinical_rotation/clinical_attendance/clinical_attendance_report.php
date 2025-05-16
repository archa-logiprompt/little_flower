<style type="text/css">
    .radio {
        padding-left: 20px;
    }

    .radio label {
        display: inline-block;
        vertical-align: middle;
        position: relative;
        padding-left: 5px;
    }
    @media print {
        table{
            border: 1px solid #000 !important;
        }
    }

    .radio label::before {
        content: "";
        display: inline-block;
        position: absolute;
        width: 17px;
        height: 17px;
        left: 0;
        margin-left: -20px;
        border: 1px solid #cccccc;
        border-radius: 50%;
        background-color: #fff;
        -webkit-transition: border 0.15s ease-in-out;
        -o-transition: border 0.15s ease-in-out;
        transition: border 0.15s ease-in-out;
    }

    .radio label::after {
        display: inline-block;
        position: absolute;
        content: " ";
        width: 11px;
        height: 11px;
        left: 3px;
        top: 3px;
        margin-left: -20px;
        border-radius: 50%;
        background-color: #555555;
        -webkit-transform: scale(0, 0);
        -ms-transform: scale(0, 0);
        -o-transform: scale(0, 0);
        transform: scale(0, 0);
        -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
    }

    .radio input[type="radio"] {
        opacity: 0;
        z-index: 1;
    }

    .radio input[type="radio"]:focus+label::before {
        outline: thin dotted;
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }

    .radio input[type="radio"]:checked+label::after {
        -webkit-transform: scale(1, 1);
        -ms-transform: scale(1, 1);
        -o-transform: scale(1, 1);
        transform: scale(1, 1);
    }

    .radio input[type="radio"]:disabled+label {
        opacity: 0.65;
    }

    .radio input[type="radio"]:disabled+label::before {
        cursor: not-allowed;
    }

    .radio.radio-inline {
        margin-top: 0;
    }

    .radio-primary input[type="radio"]+label::after {
        background-color: #337ab7;
    }

    .radio-primary input[type="radio"]:checked+label::before {
        border-color: #337ab7;
    }

    .radio-primary input[type="radio"]:checked+label::after {
        background-color: #337ab7;
    }

    .radio-danger input[type="radio"]+label::after {
        background-color: #d9534f;
    }

    .radio-danger input[type="radio"]:checked+label::before {
        border-color: #d9534f;
    }

    .radio-danger input[type="radio"]:checked+label::after {
        background-color: #d9534f;
    }

    .radio-info input[type="radio"]+label::after {
        background-color: #5bc0de;
    }

    .radio-info input[type="radio"]:checked+label::before {
        border-color: #5bc0de;
    }

    .radio-info input[type="radio"]:checked+label::after {
        background-color: #5bc0de;
    }

    @media (max-width:767px) {
        .radio.radio-inline {
            display: inherit;
        }
    }
</style>

<?php
function showAttendanceType($type)
{

    if ($type == 1) {
        return '<p style="border-radius:4px;background-color:#55a630;width:auto;color:white;padding:4px;display: inline-block;">Present</p>';
    } else if ($type == 4) {

        return '<p style="border-radius:4px;background-color:#bc4749;width:auto;color:white;padding:4px;display: inline-block;">Absent</p>';

    } else if ($type == 5) {
        return '<p style="background-color:#55a630;width:auto;color:white;padding:4px;display: inline-block;">Holiday</p>';

    } else if ($type == 6) {
        return '<p style="background-color:#bc4749;width:auto;color:white;padding:4px;display: inline-block;">Half Day</p>';

    }
}
?>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar-check-o"></i>
            <?php echo $this->lang->line('attendance'); ?> <small>
                <?php echo $this->lang->line('by_date1'); ?>
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i>
                            <?php echo $this->lang->line('select_criteria'); ?>
                        </h3>
                    </div>
                    <form id='form1'
                        action="<?php echo site_url('admin/clinical_department/clinical_attendance_report') ?>"
                        method="post" accept-charset="utf-8">
                        <div class="box-body">


                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <?php echo $this->lang->line('class'); ?>
                                        </label><small class="req"> *</small>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control">
                                            <option value="">
                                                <?php echo $this->lang->line('select'); ?>
                                            </option>
                                            <?php
                                            foreach ($classlist as $class) {


                                                ?>
                                                <option value="<?php echo $class['id'] ?>" <?php
                                                   if ($class_id == $class['id']) {
                                                       echo "selected =selected";
                                                   }
                                                   ?>>
                                                    <?php echo $class['class'] ?>
                                                </option>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger">
                                            <?php echo form_error('class_id'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <?php echo $this->lang->line('section'); ?>
                                        </label><small class="req"> *</small>
                                        <select id="section_id" name="section_id" class="form-control">
                                            <option value="">
                                                <?php echo $this->lang->line('select'); ?>
                                            </option>
                                        </select>
                                        <span class="text-danger">
                                            <?php echo form_error('section_id'); ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <?php echo $this->lang->line('subject'); ?>
                                        </label><small class="req"> *</small>
                                        <select id="subject" name="subject" class="form-control">
                                            <option value="">
                                                <?php echo $this->lang->line('select'); ?>
                                            </option>
                                        </select>
                                        <span class="text-danger">
                                            <?php echo form_error('subject'); ?>
                                        </span>
                                    </div>
                                </div>




                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <?php echo $this->lang->line('attendance'); ?>
                                            <?php echo $this->lang->line('date'); ?>
                                        </label>
                                        <input id="date" name="date" placeholder="" type="text" class="form-control"
                                            value="" readonly="readonly" />
                                        <span class="text-danger">
                                            <?php echo form_error('date'); ?>
                                        </span>
                                    </div>
                                </div>




                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="search" value="search"
                                class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i>
                                <?php echo $this->lang->line('search'); ?>
                            </button>
                        </div>
                    </form>
                </div>
                <?php


                if (isset($resultlist)) {


                    ?>
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i>
                                <?php echo $this->lang->line('student'); ?>
                                <?php echo $this->lang->line('list'); ?>
                            </h3>
                            <div class="box-tools pull-right">
                                P: Present  H: Half-Day  A:Absent
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive ptt10">
                            <button class="btn btn-info pull-right" id="print-btn"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
<div id="print-div">
    <div style="text-align:center"> 
        <h3 >Clinical Report of <?php echo $subjectName ?> for the month of <?php echo $monthName?> </h3> 
    </div>

    <table class="table table-striped table-bordered" style="border: 1px solid #000 ;">
        <thead>
            <tr >
                <th style="border: 1px solid #000 ;">Date</th>
                <th style="border: 1px solid #000 ;">T.hr</th>
                <?php foreach($fullDates as $date): ?>
                    <th style="border: 1px solid #000 ;"><?php echo $date?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($resultlist as $index => $student): ?>
                <tr>
                    <td style="border: 1px solid #000 ;"><?php echo $student['firstname']." ".$student['lastname']?></td>
                    <td style="border: 1px solid #000 ;"><?php echo $attendance[$index]['hours']?></td>
                    <?php foreach($fullDates as $key => $day): ?>
                        <td style="border: 1px solid #000 ;"><?php echo $attendance[$index][$key] == 1 ? 'P' : ($attendance[$index][$key] == 6 ? 'H' : ($attendance[$index][$key] == 4 ? 'A' : '-')); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
    $(document).ready(function () {


        $('#section_id').on('change', function () {
            const classId = $('#class_id').val();
            const sectionId = $(this).val();
            const hiddenSectionIds = [25, 26, 27, 28];


            if (classId == 1 && hiddenSectionIds.includes(parseInt(sectionId))) {
                $('.group-col').hide();
            } else {
                $('.group-col').show();
            }
        });

        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('th').find('.fee_detail_popover').html();
            }
        });
        var group_id = '<?php echo $group_id; ?>';
        var section_id_post = '<?php echo $section_id; ?>';
        var class_id_post = '<?php echo $class_id; ?>';
        var subject_id = '<?php echo $subject_id ?>';

        populateSection(section_id_post, class_id_post);
        getgroupByClassandSection(class_id_post, section_id_post, group_id);
        <?php /*?>get_total_min(class_id_post,section_id_post,group_id);<?php */ ?>
        populatesubject(class_id_post, section_id_post, subject_id);


        function populateSection(section_id_post, class_id_post) {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: { 'class_id': class_id_post },
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj) {
                        var select = "";
                        if (section_id_post == obj.section_id) {
                            var select = "selected=selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + select + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        }



        function getgroupByClassandSection(class_id_post, section_id_post, group_id) {
            console.log("rrrr1");
            if (class_id_post != "" && section_id_post != "") {
                var class_id = $('#class_id').val();
                var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                //console.log(div_data);
                $.ajax({
                    type: "POST",
                    url: base_url + "admin/clinical_department/getGroupByClassandSection",
                    data: { 'class_id': class_id, 'section_id': section_id_post },
                    dataType: "json",
                    success: function (data) {

                        $.each(data, function (i, obj) {

                            var sel = "";
                            if (group_id == obj.id) {
                                sel = "selected";
                            }
                            div_data += "<option value=" + obj.id + " " + sel + ">" + obj.group_name + "</option>";

                        });

                    }
                });
            }
        }



        function populatesubject(class_id_post, section_id_post, subject_id) {
            console.log("rrrr1");
            if (class_id_post != "" && section_id_post != "") {
                $('#subject').html("");

                var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

                $.ajax({
                    type: "POST",
                    url: base_url + "admin/teacher/getSubjctByClassandSectionNew",
                    data: { 'class_id': class_id_post, 'section_id': section_id_post },
                    dataType: "json",
                    success: function (data) {

                        $.each(data, function (i, obj) {

                            var sel = "";
                            if (subject_id == obj.id) {
                                sel = "selected";
                            }
                            div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name + "(" + obj.type + ")</option>";

                        });

                        $('#subject').append(div_data);
                    }
                });
            }
        }














        <?php /*?>function get_total_min(class_id_post,section_id_post,group_id)
   {
       
       $('#total_min').html("");
        if (class_id_post != "" && section_id_post != "" && group_id !="") {
       
         var base_url = '<?php echo base_url() ?>';
           $.ajax({
           type: "POST",
           url: base_url + "admin/clinical_department/get_total_min",
           data: {'class_id': class_id_post, 'section_id': section_id_post,'group_id':group_id},
           dataType: "json",
           success: function (data) {
           console.log(data);
            
                $('#total_min').val(data.total_hours);
            
              
           }
       });
        }
       
       }
   <?php */ ?>



        $(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: { 'class_id': class_id },
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj) {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        });



        $(document).on('change', '#section_id', function (e) {

            var section_id = $(this).val();
            var class_id = $('#class_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/clinical_department/getGroupByClassandSection",
                data: { 'class_id': class_id, 'section_id': section_id },
                dataType: "json",
                success: function (data) {

                    $.each(data, function (i, obj) {
                        div_data += "<option value=" + obj.id + ">" + obj.group_name + "</option>";
                    });

                }
            });
        });







        $('#date').datepicker({
            format: 'mm/yyyy',
            minViewMode: 1, // Show only months and years
            autoclose: true
        });

    });



    $(document).on('change', '#section_id', function (e) {
        $('#subject').html("");
        var section_id = $(this).val();
        var class_id = $('#class_id').val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "POST",
            url: base_url + "admin/teacher/getSubjctByClassandSectionNew",
            data: { 'class_id': class_id, 'section_id': section_id },
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj) {
                    console.log(obj)
                    div_data += "<option value=" + obj.id + ">" + obj.name + " (" + obj.code + ")" + "</option>";
                });

                $('#subject').append(div_data);
            }
        });
    });



</script>



<script type="text/javascript">
    $(function () {
        $('.button-checkbox').each(function () {
            var $widget = $(this),
                $button = $widget.find('button'),
                $checkbox = $widget.find('input:checkbox'),
                color = $button.data('color'),
                settings = {
                    on: {
                        icon: 'glyphicon glyphicon-check'
                    },
                    off: {
                        icon: 'glyphicon glyphicon-unchecked'
                    }
                };
            $button.on('click', function () {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
                $checkbox.triggerHandler('change');
                updateDisplay();
            });
            $checkbox.on('change', function () {
                updateDisplay();
            });

            function updateDisplay() {
                var isChecked = $checkbox.is(':checked');
                $button.data('state', (isChecked) ? "on" : "off");
                $button.find('.state-icon')
                    .removeClass()
                    .addClass('state-icon ' + settings[$button.data('state')].icon);
                if (isChecked) {
                    $button
                        .removeClass('btn-success')
                        .addClass('btn-' + color + ' active');
                } else {
                    $button
                        .removeClass('btn-' + color + ' active')
                        .addClass('btn-primary');
                }
            }

            function init() {
                updateDisplay();
                if ($button.find('.state-icon').length == 0) {
                    $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                }
            }
            init();
        });
    });

    $('#checkbox1').change(function () {

        if (this.checked) {
            var returnVal = confirm("Are you sure?");
            $(this).prop("checked", returnVal);

            $("input[type=radio]").attr('disabled', true);


        } else {
            $("input[type=radio]").attr('disabled', false);
            $("input[type=radio][value='1']").attr("checked", "checked");

        }

    });

    document.getElementById('print-btn').addEventListener('click', function() {
    var content = document.getElementById('print-div').outerHTML;
    var printWindow = window.open('', '_blank');
    printWindow.document.write(content);
    printWindow.print();
});
</script>