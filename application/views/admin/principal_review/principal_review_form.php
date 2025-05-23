<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?>
        </h1>
    </section>

    <!-- Main content -->

    <div id="errorModal" class="modal fade in bs-example-modal-lg" aria-hidden="true" role="dialog" <?php if (validation_errors() != '') {
        echo 'style="display:block;"';
    } ?>>
        <div class="modal-dialog modal-sm400">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close clsmodal" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title_logindetail">Please fill about fields</h4>
                </div>
                <div class="modal-body_logindetail">
                    <div id="timeline_hide_show" class=" col-md-12">
                        <?php echo validation_errors(); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default clsmodal"
                        data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php /*?><?php if(validation_errors()!=''){ ?>     
                <div class="alert alert-info" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <?php echo validation_errors(); ?>
                  </div>
            <?php } ?><?php */ ?>
                <div class="box box-primary">
                    <div class="pull-right box-tools impbtn">
                        <button type="button" style="margin-right: 10px;margin-top: 10px;" name="search"
                            id="collection_print" value=""
                            class="btn btn-sm btn-primary login-submit-cs fa fa-print pull-right">
                            <?php echo $this->lang->line('print'); ?></button>
                    </div>
                    <div id="printcontent">

                        <h3 class="text-center">Staff Performance Review</h3>

                        <form method="post" action="<?php echo base_url('admin/principal_review/save_review'); ?>">
                            <input type="hidden" name="staff_id" value="<?php echo $staff_list['id']; ?>">
                            <table class="table table-bordered">


                                <tr>
                                    <th>Name of the Employee</th>
                                    <td><?php echo $staff_list['name']; ?></td>
                                    <th>Employee Code</th>
                                    <td><?php echo $staff_list['employee_id']; ?></td>
                                </tr>
                                <tr>
                                    <th>Designation</th>
                                    <td><?php echo $staff_list['designation']; ?></td>
                                    <th>Department</th>
                                    <td><?php echo $staff_list['department']; ?></td>
                                </tr>

                            </table>

                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Criteria</th>
                                        <th>Excellent (10)</th>
                                        <th>Very Good (8)</th>
                                        <th>Good (6)</th>
                                        <th>Average (4)</th>
                                        <th>Below Average (2)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $criteria = [
                                        "Attendance (No Loss of Pay)",
                                        "Duty Timing (No Late Coming)",
                                        "Vigilant/ Active in Duty (Cautious)",
                                        "Helping Mentality",
                                        "Knowledge in Profession",
                                        "Dedication/ Loyalty",
                                        "Cooperation (Relationship with Colleagues)",
                                        "Work Load (Effort)",
                                        "Politeness (Attitude)",
                                        "Intelligent",
                                        "Activeness in Duty",
                                        "Quality of Student Care",
                                        "Behaviour with Co-workers",
                                        "Computer Knowledge",
                                        "Leadership Quality/Responsibility",
                                        "Obedient to Superiors",
                                        "Dress code/ Neatness",
                                        "Institutions’ rules following level",
                                        "Flexibility (Cooperation in difficult situations)",
                                        "Character"
                                    ];

                                    foreach ($criteria as $index => $criterion) {
                                        echo '<tr>';
                                        echo '<td>' . ($index + 1) . '</td>';
                                        echo '<td>' . $criterion . '</td>';
                                        foreach ([10, 8, 6, 4, 2] as $score) {
                                            echo '<td><input type="radio" name="criteria[' . $index . ']" value="' . $score . '" required></td>';
                                        }
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <div class="text-center mb-5">
                                <button type="submit" class="btn btn-success">Submit Review</button>
                            </div>
                        </form>

                    </div>
                    <hr>

                </div>


            </div>
        </div>
</div>
</div>
</section>
</div>







<script type="text/javascript">
    $(document).on('click', '#collection_print', function () {
        // Get the class value from the data attribute of the button
        let content = $('#printcontent').html();
        
        content = btoa(content);
        // Make an AJAX request to the 'printwithheaderandfooter' method
        $.ajax({
            url: '<?php echo base_url('admin/weeklycalendarnew/printwithheaderandfooter'); ?>',
            method: 'post',
            data: {
                data: content
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Content-Encoding', 'gzip');
            },

            success: function (data) {
                console.log(data)
                data = data.replace(/['"]+/g, '')
                // Redirect to the generated PDF URL
                window.location.href = "<?php echo base_url() ?>" + data;
            },
            error: function (xhr, status, error) {
                console.error('xhr:', xhr);
                console.error('status:', status);
                console.error('error:', error);
            }
        });
    });

    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id', 0) ?>';
        var hostel_id = $('#hostel_id').val();
        var hostel_room_id = '<?php echo set_value('hostel_room_id', 0) ?>';
        getHostel(hostel_id, hostel_room_id);
        getSectionByClass(class_id, section_id);

        $(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            getSectionByClass(class_id, 0);
        });

        $('#dob,#admission_date,#measure_date').datepicker({
            format: date_format,
            autoclose: true
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });


        $(document).on('change', '#hostel_id', function (e) {
            var hostel_id = $(this).val();
            getHostel(hostel_id, 0);

        });

        function getSectionByClass(class_id, section_id) {

            if (class_id != "") {
                $('#section_id').html("");
                var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                var url = "<?php $userdata = $this->customlib->getUserData();
                if (($userdata["role_id"] == 2)) {
                    echo "getClassTeacherSection";
                } else {
                    echo "getByClass";
                } ?>";

                $.ajax({
                    type: "GET",
                    url: base_url + "sections/" + url,
                    data: { 'class_id': class_id },
                    dataType: "json",
                    beforeSend: function () {
                        $('#section_id').addClass('dropdownloading');
                    },
                    success: function (data) {
                        $.each(data, function (i, obj) {
                            var sel = "";
                            if (section_id == obj.section_id) {
                                sel = "selected";
                            }
                            div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                        });
                        $('#section_id').append(div_data);
                    },
                    complete: function () {
                        $('#section_id').removeClass('dropdownloading');
                    }
                });
            }
        }


        function getHostel(hostel_id, hostel_room_id) {
            if (hostel_room_id == "") {
                hostel_room_id = 0;
            }

            if (hostel_id != "") {

                $('#hostel_room_id').html("");


                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                $.ajax({
                    type: "GET",
                    url: baseurl + "admin/hostelroom/getRoom",
                    data: { 'hostel_id': hostel_id },
                    dataType: "json",
                    beforeSend: function () {
                        $('#hostel_room_id').addClass('dropdownloading');
                    },
                    success: function (data) {
                        $.each(data, function (i, obj) {
                            var sel = "";
                            if (hostel_room_id == obj.id) {
                                sel = "selected";
                            }

                            div_data += "<option value=" + obj.id + " " + sel + ">" + obj.room_no + " (" + obj.room_type + ")" + "</option>";

                        });
                        $('#hostel_room_id').append(div_data);
                    },
                    complete: function () {
                        $('#hostel_room_id').removeClass('dropdownloading');
                    }
                });
            }
        }

    });
    function auto_fill_guardian_address() {
        if ($("#autofill_current_address").is(':checked')) {
            $('#current_address').val($('#guardian_address').val());
        }
    }
    function auto_fill_address() {
        if ($("#autofill_address").is(':checked')) {
            $('#permanent_address').val($('#current_address').val());
        }
    }
    $('input:radio[name="guardian_is"]').change(
        function () {
            if ($(this).is(':checked')) {
                var value = $(this).val();
                if (value == "father") {
                    $('#guardian_name').val($('#father_name').val());
                    $('#guardian_phone').val($('#father_phone').val());
                    $('#guardian_occupation').val($('#father_occupation').val());
                    $('#guardian_relation').val("Father")
                } else if (value == "mother") {
                    $('#guardian_name').val($('#mother_name').val());
                    $('#guardian_phone').val($('#mother_phone').val());
                    $('#guardian_occupation').val($('#mother_occupation').val());
                    $('#guardian_relation').val("Mother")
                } else {
                    $('#guardian_name').val("");
                    $('#guardian_phone').val("");
                    $('#guardian_occupation').val("");
                    $('#guardian_relation').val("")
                }
            }
        });


</script>

<script type="text/javascript">
    $(".mysiblings").click(function () {
        $('.sibling_msg').html("");
        $('.modal_title').html('<b>' + "<?php echo $this->lang->line('sibling'); ?>" + '</b>');
        $('#mySiblingModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    });
</script>

<script type="text/javascript">
    $(document).on('click', '.clsmodal', function (e) {
        $('#errorModal').hide();
    });

    $(document).on('change', '#sibiling_class_id', function (e) {
        $('#sibiling_section_id').html("");
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
                $('#sibiling_section_id').append(div_data);
            }
        });
    });

    $(document).on('change', '#sibiling_section_id', function (e) {
        getStudentsByClassAndSection();
    });

    function getStudentsByClassAndSection() {
        $('#sibiling_student_id').html("");
        var class_id = $('#sibiling_class_id').val();
        var section_id = $('#sibiling_section_id').val();
        var student_id = '<?php echo set_value('student_id') ?>';
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "student/getByClassAndSection",
            data: { 'class_id': class_id, 'section_id': section_id },
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj) {
                    var sel = "";
                    if (section_id == obj.section_id) {
                        sel = "selected=selected";
                    }
                    div_data += "<option value=" + obj.id + ">" + obj.firstname + " " + obj.lastname + "</option>";
                });
                $('#sibiling_student_id').append(div_data);
            }
        });
    }

    $(document).on('click', '.add_sibling', function () {
        var student_id = $('#sibiling_student_id').val();
        var base_url = '<?php echo base_url() ?>';
        if (student_id.length > 0) {
            $.ajax({
                type: "GET",
                url: base_url + "student/getStudentRecordByID",
                data: { 'student_id': student_id },
                dataType: "json",
                success: function (data) {
                    $('#sibling_name').text("Sibling: " + data.firstname + " " + data.lastname);
                    $('#sibling_name_next').val(data.firstname + " " + data.lastname);
                    $('#sibling_id').val(student_id);
                    $('#father_name').val(data.father_name);
                    $('#father_phone').val(data.father_phone);
                    $('#father_occupation').val(data.father_occupation);
                    $('#mother_name').val(data.mother_name);
                    $('#mother_phone').val(data.mother_phone);
                    $('#mother_occupation').val(data.mother_occupation);
                    $('#guardian_name').val(data.guardian_name);
                    $('#guardian_relation').val(data.guardian_relation);
                    $('#guardian_address').val(data.guardian_address);
                    $('#guardian_phone').val(data.guardian_phone);
                    $('#state').val(data.state);
                    $('#city').val(data.city);
                    $('#pincode').val(data.pincode);
                    $('#current_address').val(data.current_address);
                    $('#permanent_address').val(data.permanent_address);
                    $('#guardian_occupation').val(data.guardian_occupation);
                    $("input[name=guardian_is][value='" + data.guardian_is + "']").prop("checked", true);
                    $('#mySiblingModal').modal('hide');
                }
            });
        } else {
            $('.sibling_msg').html("<div class='alert alert-danger'>No Student Selected</div>");
        }

    });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script>