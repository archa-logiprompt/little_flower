<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small>  </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
<form action="<?php echo site_url('admin/mark/create')?>" method="post" accept-charset="utf-8" id="schedule-form">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <div class="row">
                                <input type="hidden" name="save_exam" value="search" >                               
                                <?php echo $this->customlib->getCSRF(); ?>
                                <!-- /.col -->
                                
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>
                                        <select  id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>" <?php
                                                if ($class_id == $class['id']) {
                                                    echo "selected =selected";
                                                }
                                                ?>><?php echo $class['class'] ?></option>

                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                </div><!-- /.col -->
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>
                                
                                
                                <!--<div class="col-md-2">    -->
                                <!--<div class="form-group">-->
                                <!--    <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?><small class="req"> *</small></label>-->
                                <!--    <input id="date" name="date" placeholder="" type="text" class="form-control"  value="<?php echo set_value('date'); ?>" readonly="readonly" />-->
                                <!--    <span class="text-danger"><?php echo form_error('date'); ?></span>-->
                                <!--</div></div>-->
                                
                                
                                
                                
                               <div class="col-md-2">
                                    <div class="form-group">
             <input type="hidden" name="exam_type" id="exam_type" value="search" >
            <label for="exampleInputEmail1"><?php echo $this->lang->line('exam_name');?></label>
              <select autofocus="" id="exam_id" name="exam_id" class="form-control" >
                 <option value=""><?php echo $this->lang->line('select'); ?></option>
                        
                                        </select>
                                        <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('subject'); ?>  <?php echo $this->lang->line('type'); ?> </label>

                               <select autofocus=""  id="sub_type" name="sub_type" class="form-control" >
                               <option value=""><?php echo $this->lang->line('select'); ?></option>
                                <option <?php if($sub_type=='Theory') { echo 'selected';} ?> value="Theory">Theory</option>
                                 <option <?php if($sub_type=='Practical') { echo  'selected';} ?> value="Practical">Practical</option>
                                 <option <?php if($sub_type=='Viva') { echo 'selected';} ?> value="Viva">Viva</option>            
                                        </select>
                                        <span class="text-danger"><?php echo form_error('sub_type'); ?></span>
                                    </div>

                                </div>
                                
                                
                                
                                
                                <!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </form>
                </div>
                <?php
                if (isset($examSchedule)) {
                    ?>


                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('fill_mark'); ?></h3>
                        </div>
                        <div class="box-body">
                            <?php
                            if (!empty($examSchedule)) {
                                ?>
                                <form role="form" id=""  class="addmarks-form"  method="post" action="<?php echo site_url('admin/mark/create') ?>">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                    <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
                                    <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
                                    <input type="hidden" name="date" value="<?php echo $date ; ?>" />
                                    <input type="hidden" name="sub_type" value="<?php echo $sub_type ?>" />
                                    
                                    
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <?php echo $this->lang->line('admission_no'); ?>
                                                    </th>
                                                    <th><?php echo $this->lang->line('roll_no'); ?></th>
                                                    <th>
                                                        <?php echo $this->lang->line('student'); ?>
                                                    </th>
                                                    <?php
                                                    $s = 0;
                                                    foreach ($examSchedule as $key => $student) {
                                                        if (!empty($student['exam_array'])) {
                                                            if ($s == 0) {
                                                                foreach ($student['exam_array'] as $key => $exam_schedule) {
                                                                    ?>
                                                                    <th>
                                                                        <?php
                                                                        echo $exam_schedule['exam_name'] . " (" . substr($exam_schedule['exam_type'], 0, 2) . ": " . $exam_schedule['passing_marks'] . "/" . $exam_schedule['full_marks'] . ") ";
                                                                        ?>
                                                                    </th>
                                                                    <?php
                                                                }
                                                            }
                                                        } else {
                                                            ?>

                                                            <?php
                                                        }
                                                        $s++;
                                                    }
                                                    ?>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $s = 0;
                                                foreach ($examSchedule as $key => $student) {
													
                                                    ?>
                                                <input type="hidden" name="student[]" value="<?php echo $student['student_id'] ?>">

                                                <?php
                                                if (!empty($student['exam_array'])) {
                                                    if ($s == 0) {
                                                        foreach ($student['exam_array'] as $key => $exam_schedule) {
                                                            ?>
                                                            
                                                            <input type="hidden" name="exam_schedule[]" value="<?php echo $exam_schedule['exam_schedule_id'] ?>" >
                                                            <?php
                                                        }
                                                    }
                                                } else {
                                                    ?>

                                                    <?php
                                                }
                                                $s++;
                                            }
                                            ?>
                                              
                                            <?php  foreach ($examSchedule as $key => $student) {
                                                ?>

                                                <tr>
                                                    <td>     <?php echo $student['admission_no'] ?></td>
                                                    <td>     <?php echo $student['roll_no'] ?></td>
                                                    <td>        <?php echo $student['firstname'] . " " . $student['lastname']; ?> </td>
                                                    <?php
                                                    if (!empty($student['exam_array'])) {
                                                        $n = 0;
                                                        $class = "";
                                                        $check = "";
                                                        foreach ($student['exam_array'] as $key => $exam_schedule) {
                                                             //var_dump($exam_schedule);       
                                                            if (!empty($teacher_subjects) && (array_key_exists($n, $teacher_subjects))) {
                                                                $class = "readonly";
                                                                $check = "disabled";
                                                                if ($teacher_subjects[$n]["subject_id"] == $exam_schedule["subject_id"]) {

                                                                    $class = "";
                                                                    $check = "";
                                                                    $n++;
                                                                }
                                                            }
                                                            ?>
                                                            <td>
                                                                <div class="form-group">
                                                                    <div class="checkbox">
                                                                        <label><input type="checkbox" <?php echo $check; ?> name="student_absent<?php echo $student['student_id'] . "_" . $exam_schedule['exam_schedule_id']; ?>" value="ABS" <?php if ($exam_schedule['attendence'] == "ABS") echo "checked"; ?>>Abs</label>
                                                                    </div>
                                                                    <input type="hidden" name="subject_id<?php echo $student['student_id']."_".$exam_schedule['exam_schedule_id'];?>" value="<?php echo $exam_schedule["subject_id"] ?>">
                                                                    
                                                                    <input type="text" <?php echo $class; ?> name="student_number<?php echo $student['student_id'] . "_" . $exam_schedule['exam_schedule_id']; ?>" class="form-control input-sm" id="subject_<?php echo $student['student_id'] . "_" . $exam_schedule['exam_schedule_id']; ?>" value="<?php echo $exam_schedule['get_marks'] ?>" placeholder="Enter Marks" max="<?php echo $student['exam_array'][$key]['full_marks'] ?>">
                                                                </div>
                                                            </td>
                                                            <?php
                                                        }
                                                    }else {
                                                        ?>

                                                        <?php
                                                    }
                                                    ?>

                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right" name="save_exam" value="save_exam"><?php echo $this->lang->line('save'); ?></button>
                                </form>
                                <?php
                            } else {
                                ?>

                                <div class="alert alert-info">
                                    <?php echo $this->lang->line('no_record_found'); ?>
                                </div>


                                <?php
                            }
                            ?>
                        </div><!---./end box-body--->
                    </div>
                </div>            

            </div>   <!-- /.row -->
            <?php
        } else {
            
        }
        ?>

    </section><!-- /.content -->
</div>
<script type="text/javascript">



    $(document).ready(function () {
		
			
		$("#date").datepicker( {
    format: "MM-yyyy",
     startView: "year", 
    minViewMode: "months",
    autoclose: true
	
	
});
	  $(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            var url = "<?php
        $userdata = $this->customlib->getUserData();
        if (($userdata["role_id"] == 2)) {
            echo "getClassTeacherSection";
        } else {
            echo "getByClass";
        }
        ?>";
            $.ajax({
                type: "GET",
                url: base_url + "sections/" + url,
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    });

                    $('#section_id').append(div_data);
                }
            });
        });
        $(document).on('change', '#feecategory_id', function (e) {
            $('#feetype_id').html("");
            var feecategory_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "feemaster/getByFeecategory",
                data: {'feecategory_id': feecategory_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id + ">" + obj.type + "</option>";
                    });

                    $('#feetype_id').append(div_data);
                }
            });
        });
		
		
		
		 $(document).on('change', '#section_id', function (e) {
           $('#exam_id').html("");
           var class_id=$('#class_id').val();
			var section_id=$('#section_id').val();
			
			 var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/exam/get_examtype",
                data: {'class_id':class_id,'section_id':section_id},
                dataType: "json",
                success: function (data) {

                      console.log(data);

                    $.each(data, function (i, obj)
                    {

                        div_data += "<option value=" + obj.id + ">" + obj.name + "</option>";

                    });

                    $('#exam_id').append(div_data);
                   }
                 });
                 });
		
		
		
		
		
    });
     $(document).on('change', '#date', function (e) {
        var date=$(this).val();
    });
    $(document).on('change', '#sub_type', function (e) {
        $("form#schedule-form").submit();
    });
</script>
<script src="<?php echo base_url(); ?>backend/custom/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/custom/bootstrap-datepicker.js"></script>
<script>
    $('.sandbox-container').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
    $(function () {
        $('.addmarks-form').validate({

            submitHandler: function (form) {
                form.submit();
            }
        });

        $('input[id^="subject_"]').each(function () {
            $(this).rules('add', {
                required: true,
                messages: {
                    required: "Required"
                }
            });
        });
    });
    var class_id = $('#class_id').val();
    var section_id = '<?php echo set_value('section_id') ?>';
	var exam_id='<?php echo $exam_id ?>';
    getSectionByClass(class_id, section_id);
	getexamtype(exam_id,class_id,section_id);
	
	
    function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            var url = "<?php
        $userdata = $this->customlib->getUserData();
        if (($userdata["role_id"] == 2)) {
            echo "getClassTeacherSection";
        } else {
            echo "getByClass";
        }
        ?>";
            $.ajax({
                type: "GET",
                url: base_url + "sections/" + url,
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";

                    });

                    $('#section_id').append(div_data);
                }
            });
        }
    }
	
	
	
	
	
	function getexamtype(exam_id,class_id,section_id) {
            if (exam_id!="") {
                $('#exam_id').html("");
             
              var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                
                $.ajax({
                    type: "POST",
                    url: base_url + "admin/exam/get_examtype",
                     data: {'class_id':class_id,'section_id':section_id},
                    dataType: "json",
                    success: function (data) {
                       
                        
                    $.each(data, function (i, obj)
                    {
						 var sel = "";
                            if (exam_id == obj.id) {
                                sel = "selected";
                            }

                        div_data += "<option value=" + obj.id + " " +sel+ ">" + obj.name + "</option>";

                    });

                    $('#exam_id').append(div_data);
                    }
                });
            }
        }
	
	
	
	
	
	
	
	
</script>
