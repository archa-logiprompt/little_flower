<style>
    .multiselect {
        width: 340px !important;
    }

    .bySection {
        position: relative;
    }

    .btn1 {
        position: absolute;
        top: 150%
    }

    .toSection {
        padding-left: 30px;
    }

    .bySection {
        padding-left: 30px;
    }
</style>


<!--<link rel="stylesheet" href="<?php //echo base_url(); 
                                    ?>backend/bootstrap/bootstrap-select.min.css"/>
 <script src="<?php //echo base_url(); 
                ?>backend/bootstrap/bootstrap-select.min.js"></script>
 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap-multiselect.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap-multiselect.js"></script>


<!--<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/select2/select2.min.css"/>
<script type="text/javascript"  src="<?php echo base_url(); ?>backend/plugins/select2/select2.min.js"></script>
-->
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i>
            <?php echo "Journal"; ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i>
                    <?php echo "Add Entry"; ?>
                </h3>
            </div>
            <form id="assign_teacher_form" action="<?php echo base_url(); ?>accounts/journal/insert" method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                        </div>
                        <div class="bySection col-md-12">
                            <div class="row" style="text-align:center">
                                <!-- <label class="radio-inline">
                                    <input type="radio" value="Journal" name="radio-btn" id="journal" checked><?php echo ('Journal'); ?>
                                </label> -->
                                <!-- <label class="radio-inline">
                                    <input type="radio" name="radio-btn" value="Purchase" id="purchase"><?php echo ('Purchase'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="radio-btn" value="Sales" id="sales"><?php echo ('Sales'); ?>
                                </label> -->
                            </div>
                            <h3 id="selected-value">Journal Entry</h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>
                                            <?php echo "Date"; ?>
                                        </label><small class="req"> *</small>
                                        <input type="text" id="date" name="date" class="form-control" autocomplete="off" value="<?php echo date('d-m-Y') ?>" />
                                        <span class="text-danger">
                                            <?php echo form_error('byamount'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">

                                        <label>
                                            <?php echo "By"; ?>
                                        </label><small class="req"> *</small>
                                        <select autofocus="" id="by" name="by[]" class="form-control">
                                            <option value="">
                                                <?php echo $this->lang->line('select'); ?>
                                            </option>
                                            <?php
                                            foreach ($ledgers as $class) {
                                            ?>
                                                <option value="<?php echo $class['lid'] ?>"><?php echo $class['ledger'] ?>
                                                </option>
                                            <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger">
                                            <?php echo form_error('by'); ?>
                                        </span>
                                        <select autofocus="" id="byFiltered" name="byFiltered[]" class="form-control" style="display:none">
                                            <option value="">
                                                <?php echo $this->lang->line('select'); ?>
                                            </option>
                                            <?php
                                            foreach ($filtered as $class) {
                                            ?>
                                                <option value="<?php echo $class['lid'] ?>"><?php echo $class['ledger'] ?>
                                                </option>
                                            <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger">
                                            <?php echo form_error('byFiltered'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>
                                            <?php echo "Amount"; ?>
                                        </label><small class="req"> *</small>
                                        <input type="number" id="byamount" name="byamount[]" class="form-control" placeholder="Enter Amount" />
                                        <span class="text-danger">
                                            <?php echo form_error('byamount'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">

                                        <button type="button" id="add_by_button" class="btn1 btn-success btn-sm">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="toSection col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>
                                            <?php echo "To"; ?>
                                        </label><small class="req"> *</small>
                                        <select autofocus="" id="to" name="to[]" class="form-control">
                                            <option value="">
                                                <?php echo $this->lang->line('select'); ?>
                                            </option>
                                            <?php
                                            foreach ($ledgers as $class) {
                                            ?>
                                                <option value="<?php echo $class['lid'] ?>"><?php echo $class['ledger'] ?>
                                                </option>
                                            <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger">
                                            <?php echo form_error('to[]'); ?>
                                        </span>
                                        <select autofocus="" id="toFiltered" name="toFiltered[]" class="form-control" style="display:none">
                                            <option value="">
                                                <?php echo $this->lang->line('select'); ?>
                                            </option>
                                            <?php
                                            foreach ($filtered as $class) {
                                            ?>
                                                <option value="<?php echo $class['lid'] ?>"><?php echo $class['ledger'] ?>
                                                </option>
                                            <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger">
                                            <?php echo form_error('toFiltered[]'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>
                                            <?php echo "Amount"; ?>
                                        </label><small class="req"> *</small>
                                        <input type="number" id="toamount" name="toamount[]" class="form-control" placeholder="Enter Amount" />
                                        <span class="text-danger">
                                            <?php echo form_error('toamount'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">

                                        <button type="button" id="add_to_button" class="btn1 btn-success btn-sm">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12" id="stock" style="display:none">
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('item_category'); ?></label><small class="req"> *</small>

                                <select autofocus="" id="item_category_id" name="item_category_id" class="form-control ">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($itemcatlist as $item_category) {
                                    ?>
                                        <option value="<?php echo $item_category['id'] ?>" <?php
                                                                                            if (set_value('item_category_id') == $item_category['id']) {
                                                                                                echo "selected = selected";
                                                                                            }
                                                                                            ?>><?php echo $item_category['item_category'] ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('item_category_id'); ?></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('item'); ?></label><small class="req"> *</small>

                                <select id="item_id" name="item_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>

                                </select>
                                <span class="text-danger"><?php echo form_error('item_id'); ?></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('supplier'); ?></label>

                                <select id="supplier_id" name="supplier_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($itemsupplier as $itemsup) {
                                    ?>
                                        <option value="<?php echo $itemsup['id'] ?>" <?php
                                                                                        if (set_value('supplier_id') == $itemsup['id']) {
                                                                                            echo "selected = selected";
                                                                                        }
                                                                                        ?>><?php echo $itemsup['item_supplier'] ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('supplier_id'); ?></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('store'); ?></label>

                                <select id="store_id" name="store_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($itemstore as $itemstore) {
                                    ?>
                                        <option value="<?php echo $itemstore['id'] ?>" <?php
                                                                                        if (set_value('store_id') == $itemstore['id']) {
                                                                                            echo "selected = selected";
                                                                                        }
                                                                                        ?>><?php echo $itemstore['item_store'] ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('store_id'); ?></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('quantity'); ?></label><small class="req"> *</small>
                                <div class="">
                                    <span class="miplus">
                                        <select class="form-control" name="symbol">
                                            <option value="+">+</option>
                                            <option value="-">-</option>
                                        </select>
                                    </span>
                                    <input id="quantity" name="quantity" placeholder="" type="text" class="form-control miplusinput" value="<?php echo set_value('quantity'); ?>" />
                                </div>

                                <span class="text-danger"><?php echo form_error('quantity'); ?></span>
                            </div>

                            <!-- <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label>
                                <input id="date" name="date" placeholder="" type="text" class="form-control" value="<?php echo set_value('date'); ?>" readonly="readonly" />
                                <span class="text-danger"><?php echo form_error('date'); ?></span>
                            </div> -->
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                                <input id="item_photo" name="item_photo" placeholder="" type="file" class="filestyle form-control" data-height="40" value="<?php echo set_value('item_photo'); ?>" />
                                <span class="text-danger"><?php echo form_error('item_photo'); ?></span>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="exampleInputEmail1"><?php echo "Stock Description"; ?></label>
                                <textarea class="form-control" id="description" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description'); ?></textarea>
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-md-12" id="issue" style="display:none">
                            <div class="form-group col-md-4 col-sm-4">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('user_type'); ?></label><small class="req"> *</small>

                                <select name="account_type" onchange="getIssueUser(this.value)" id="input-type-student" class="form-control ac_type">

                                    <?php
                                    foreach ($roles as $role_key => $role_value) {
                                    ?>


                                        <!--input autofocus="" name="account_type" class="ac_type" id="input-type-student" value="<?php echo $role_value['id']; ?>" type="radio" /-->
                                        <option value="<?php echo $role_value['id']; ?>"><?php echo $role_value['name'] ?></option>

                                        <?php echo $role_value['name']; ?>


                                    <?php
                                    }
                                    ?>

                                </select>

                                <span class="text-danger"><?php echo form_error('Items'); ?></span>

                            </div>

                            <div class="form-group col-md-4 col-sm-4">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('issue_to'); ?></label><small class="req"> *</small>

                                <select id="issue_to" name="issue_to" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="text-danger"><?php echo form_error('Items'); ?></span>

                            </div>
                            <!-- <div class="clearfix"></div> -->
                            <div class="form-group col-md-4 col-sm-4">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('issue_by'); ?></label><small class="req"> *</small>
                                <input id="issue_by" name="issue_by" placeholder="" type="text" class="form-control" value="<?php echo set_value('issue_by'); ?>" />
                                <span class="text-danger"><?php echo form_error('issue_by'); ?></span>

                            </div>



                            <div class="form-group col-md-4 col-sm-4">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('issue_date'); ?></label><small class="req"> *</small>
                                <input id="issue_date" name="issue_date" placeholder="" type="text" class="form-control date" value="<?php echo set_value('issue_date'); ?>" readonly />
                                <span class="text-danger"><?php echo form_error('issue_date'); ?></span>
                            </div>
                            <!-- <div class="clearfix"></div> -->

                            <div class="form-group col-md-4 col-sm-4">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('note'); ?></label>
                                <textarea name="note" class="form-control" id="note"><?php echo set_value('note'); ?></textarea>
                                <span class="text-danger"><?php echo form_error('note'); ?></span>
                            </div>
                            <div class="clearfix"></div>



                            <hr>

                            <div class="col-md-12">
                                <div class="row">



                                    <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('item_category'); ?></label><small class="req"> *</small>

                                        <select autofocus="" id="item_category_id_issue" name="item_category_id_issue" class="form-control ">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($itemcatlist as $item_category) {
                                            ?>
                                                <option value="<?php echo $item_category['id'] ?>" <?php
                                                                                                    if (set_value('item_category_id_issue') == $item_category['id']) {
                                                                                                        echo "selected = selected";
                                                                                                    }
                                                                                                    ?>><?php echo $item_category['item_category'] ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('item_category_id_issue'); ?></span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('item'); ?></label><small class="req"> *</small>

                                        <select id="item_id_issue" name="item_id_issue" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>

                                        </select>
                                        <span class="text-danger"><?php echo form_error('item_id_issue'); ?></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1"><?php echo "Quantity"; ?></label><small class="req"> *</small>
                                        <input class="form-control" name="quantity_issue" />
                                        <div id="div_avail">
                                            <span>Available Quantity : </span>
                                            <span id="item_available_quantity">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group col-md-8">
                            <label>
                                <?php echo "Narration"; ?>
                            </label>
                            <textarea type="text" id="narration" name="narration" class="narration form-control" placeholder="Enter Narration" rows="4"></textarea>


                        </div>
                    </div>

                    <button type="submit" id="search_filter" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right">
                        <?php echo "Submit"; ?>
                    </button>

                </div>


        </div>
        </form>
</div>
<div class="box box-info" id="box_display" style="display:none">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-users"> </i>
            <?php echo $this->lang->line('assign_subject'); ?>
        </h3>

        <div class="box-tools pull-right">
            <button id="btnAdd" class="btn btn-primary btn-sm checkbox-toggle pull-right" type="button"><i class="fa fa-plus"></i>
                <?php echo $this->lang->line('add'); ?>
            </button>
        </div>
    </div>
    <form action="<?php echo base_url() ?>admin/teacher/viewassignteacher" method="POST" id="formSubjectTeacher">
        <?php echo $this->customlib->getCSRF(); ?>

        <input type="hidden" value="0" id="post_class_id" name="class_id">
        <input type="hidden" value="0" id="post_section_id" name="section_id">
        <div class="form-horizontal" id="TextBoxContainer" role="form">
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-sm btn pull-right save_button" style="display: none;">
                <?php echo $this->lang->line('save'); ?>
            </button>
        </div>
    </form>
</div>
</section>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // Function to calculate the sum of an array
        function calculateSum(arr) {
            return arr.reduce(function(a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0);
        }

        // Function to validate the form before submission
        function validateForm() {
            var toamountValues = $('input[name="toamount[]"]').map(function() {
                return $(this).val();
            }).get();

            var byamountValues = $('input[name="byamount[]"]').map(function() {
                return $(this).val();
            }).get();

            var sumToamount = calculateSum(toamountValues);
            var sumByamount = calculateSum(byamountValues);

            if (sumToamount === sumByamount) {
                return true; // Form can be submitted
            } else {
                alert("Amount does not Tally.");
                return false; // Form submission prevented
            }
        }

        // Bind the form submission to the validateForm function
        $('#assign_teacher_form').submit(function() {
            return validateForm();
        });
    });


    $(document).ready(function() {
        var bySectionCount = 1;
        var toSectionCount = 1;

        // Add By Section
        $("#add_by_button").click(function() {


            var newdiv = `
            <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                <label><?php echo "By"; ?></label><small class="req"> *</small>
                <select type="text" id="bysection_` + bySectionCount + `" name="by[]" class="form-control" placeholder="By Section" >
                <option value="">
                                            <?php echo $this->lang->line('select'); ?>
                                        </option>
                                        <?php
                                        foreach ($ledgers as $class) {
                                        ?>
                                            <option value="<?php echo $class['lid'] ?>"><?php echo $class['ledger'] ?>
                                            </option>
                                            <?php
                                            $count++;
                                        }
                                            ?>
                
                </select>
                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group">
                <label><?php echo "Amount"; ?></label><small class="req"> *</small>
                <input type="number" id="byamount_` + bySectionCount + `" name="byamount[]" class="form-control" placeholder="Enter Amount" />
                </div>
                </div>
                </div>
                
                
                `
            $(".bySection").append(newdiv);
            bySectionCount++;
        });
    });


    $(document).ready(function() {
        var toSectionCount = 1;
        var toSectionCount = 1;

        // Add to Section
        $("#add_to_button").click(function() {


            var newdiv = `
            <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                <label><?php echo "To"; ?></label><small class="req"> *</small>
                <select type="text" id="tosection_` + toSectionCount + `" name="to[]" class="form-control" placeholder="To Section" >
                
                <option value="">
                                            <?php echo $this->lang->line('select'); ?>
                                        </option>
                                        <?php


                                        foreach ($ledgers as $class) {
                                        ?>
                                            <option value="<?php echo $class['lid'] ?>"><?php echo $class['ledger'] ?>
                                            </option>
                                            <?php
                                            $count++;
                                        }
                                            ?>
                </select>
                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group">
                <label><?php echo "Amount"; ?></label><small class="req"> *</small>
                <input type="number" id="toamount_` + toSectionCount + `" name="toamount[]" class="form-control" placeholder="Enter Amount" />
                </div>
                </div>
                </div>
                
                
                `
            $(".toSection").append(newdiv);
            toSectionCount++;
        });
    });


    $(function() {
        $(document).on("click", "#btnAdd", function() {
            var lenght_div = $('#TextBoxContainer .app').length;
            var div = GetDynamicTextBox(lenght_div);
            $("#TextBoxContainer").append(div);
        });
        $(document).on("click", "#btnGet", function() {
            var values = "";
            $("input[name=DynamicTextBox]").each(function() {
                values += $(this).val() + "\n";
            });
        });
        $("body").on("click", ".remove", function() {
            $(this).closest("div").remove();
        });
    });

    function GetDynamicTextBox(value) {
        //$('.selectpicker').selectpicker({});
        $('.selectpicker').multiselect();


        var row = "";
        row += '<div class="form-group app">';
        row += '<input type="hidden" name="i[]" value="' + value + '"/>';
        row += '<input type="hidden" name="row_id_' + value + '" value="0"/>';
        row += '<div class="col-md-12">';
        row += '<div class="form-group row">';
        row += '<label for="inputValue" class="col-md-1 control-label">Subject</label>';
        row += '<div class="col-md-4" >';
        row += '<select  id="subject_id_' + value + '" name="subject_id_' + value + '" class="form-control" >';
        row += '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        <?php
        foreach ($subjectlist as $subject) {
        ?>
            row += '<option value="<?php echo $subject['id'] ?>"><?php echo $subject['name'] . " (" . $subject['type'] . ")" ?></option>';
        <?php
            $count++;
        }
        ?>
        row += '</select>';
        row += '</div>';

        row += '<label for="inputKey" class="col-md-1 control-label">Teacher</label>';
        row += '<div class="col-md-4">';
        row += '<select data-container="body" multiple="multiple"  id="teacher_id_' + value + '" name="teacher_id_' + value + '[]" no="' + value + '" class="form-control selectpicker " >';
        row += '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        <?php
        foreach ($teacherlist as $teacher) {
        ?>
            row += '<option value="<?php echo $teacher['id'] ?>"><?php echo str_replace("'", "\\'", $teacher['name'] . "(" . $teacher["department"] . "," . $teacher['employee_id'] . ")") ?></option>';
        <?php
            $count++;
        }
        ?> row += '</select>';
        row += '</div>';
        row += '<div class="col-md-2"><button id="btnRemove" style="" class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></button></div>';
        row += '</div>';
        row += '</div>';
        row += '</div>';



        return row;
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        //$('.selectpicker').multiselect();
        //$('.selectpicker').selectpicker({});


        $('#btnAdd').hide();
        $(".assign_teacher_form").submit(function(e) {

            $("#TextBoxContainer").html("");
            $("input[class$='_error']").html("");
            var class_id = $('#class_id').val();
            var section_id = $('#section_id').val();
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            $.ajax({
                url: formURL,
                type: "POST",
                data: postData,
                dataType: 'json',
                success: function(data, textStatus, jqXHR) {
                    console.log(data);
                    if (data.st === 1) {
                        $.each(data.msg, function(key, value) {
                            $('.' + key + "_error").html(value);
                        });
                    } else {
                        var response = data.msg;
                        if (response && response.length > 0) {
                            for (i = 0; i < response.length; ++i) {
                                var subject_id = response[i].subject_id;
                                var teacher_id = response[i].teacher_id;
                                var row_id = response[i].id;
                                appendRow(subject_id, teacher_id, row_id);
                            }
                        } else {

                            appendRow(0, 0, 0);
                        }
                        $('#post_class_id').val(class_id);
                        $('#post_section_id').val(section_id);
                        $('#btnAdd').show();
                        $('#box_display').show();
                        $('.save_button').show();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {}
            });

            e.preventDefault();

        });

        $(document).on('change', '#class_id', function(e) {
            $('#section_id').html("");
            resetForm();
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {
                    'class_id': class_id
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(i, obj) {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        });
    });

    function appendRow(subject_id, teacher_id, row_id) {
        //$('.selectpicker').selectpicker({});
        $('.selectpicker').multiselect();

        /*$(".selectpicker").select2({
         tags: true,
         
           placeholder: "Select Fee Head"  
       });
           */
        var value = $('#TextBoxContainer .app').length;
        var row = "";
        row += '<div class="form-group app">';
        row += '<input type="hidden" name="i[]" value="' + value + '"/>';
        row += '<input type="hidden" name="row_id_' + value + '" value="' + row_id + '"/>';
        row += '<div class="col-md-12">';
        row += '<div class="form-group row">';
        row += '<label for="inputValue" class="col-md-1 control-label">Subject</label>';
        row += '<div class="col-md-4">';

        row += '<select  id="subject_id_' + value + '" name="subject_id_' + value + '" class="form-control" >';
        row += '<option value=""><?php echo $this->lang->line('select'); ?></option>';



        <?php
        foreach ($subjectlist as $subject) {
        ?>



            var selected = "";
            if (subject_id === '<?php echo $subject['id'] ?>') {
                selected = "selected";
            }
            row += '<option value="<?php echo $subject['id'] ?>" ' + selected + '><?php echo $subject['name'] . " (" . $subject['type'] . ")" ?></option>';

        <?php
            $count++;
        }
        ?>
        row += '</select>';
        row += '</div>';
        row += '<label for="inputKey" class="col-md-1 control-label">Teacher</label>';
        row += '<div class="col-md-4">';
        row += '<select multiple="multiple"  id="teacher_id_' + value + '" name="teacher_id_' + value + '[]" no="' + value + '" class="form-control selectpicker " >';

        row += '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        if (teacher_id != 0) {
            var t = teacher_id;
            var teacher = t.split(",");
        } else {
            var teacher = 0;

        }


        <?php

        foreach ($teacherlist as $teacher) {

        ?>


            var selected = "";
            if (jQuery.inArray('<?php echo $teacher['id'] ?>', teacher) !== -1) {
                selected = "selected";
            }


            row += '<option value="<?php echo $teacher['id'] ?>" ' + selected + '><?php echo str_replace("'", "\\'", $teacher['name'] . " " . $teacher['surname'] . "(" . $teacher["department"] . "," . $teacher['employee_id'] . ")") ?></option>';



        <?php
            $count++;
        }
        ?>
        row += '</select>';
        row += '</div>';
        row += '<div class="col-md-2"><button id="btnRemove" style="" class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></button></div>';
        row += '</div>';
        row += '</div>';
        row += '</div>';
        $("#TextBoxContainer").append(row);
    }

    $(document).on('change', '#section_id', function(e) {
        resetForm();
    });

    function resetForm() {
        $('#TextBoxContainer').html("");
        $('#btnAdd').hide();
        $('.save_button').hide();
    }

    $(document).on('click', '#btnRemove', function() {
        $(this).parents('.form-group').remove();
    });


    $(document).ready(function() {
        $("input[name=radio-btn]").change(function() {
            if ($(this).val() == "Purchase") {
                $("#toFiltered").show();
                $("#to").hide();
                $("#by").show();
                $("#byFiltered").hide();
                $("#issue").hide();
                $("#stock").show(); // Enable Stock field
            } else if ($(this).val() == "Journal") {
                $("#toFiltered").hide();
                $("#to").show();
                $("#by").show();
                $("#byFiltered").hide();
                $("#issue").hide();
                $("#stock").hide(); // Hide Stock field
            } else if ($(this).val() == "Sales") {
                $("#toFiltered").hide();
                $("#to").show();
                $("#by").hide();
                $("#byFiltered").show();
                $("#issue").show();
                $("#stock").hide(); // Hide Stock field
            }
        });
    });


    $(document).ready(function() {
        $("input[name=radio-btn]").change(function() {
            var selectedValue = $("input[name=radio-btn]:checked").val();
            $("#selected-value").text(selectedValue + " Entry");
        });
    });

    $(document).ready(function() {

        var item_id_post = '<?php echo set_value('item_id_issue') ?>';
        item_id_post = (item_id_post != "") ? item_id_post : 0;
        var item_category_id_post = '<?php echo set_value('item_category_id_issue'); ?>';
        item_category_id_post = (item_category_id_post != "") ? item_category_id_post : 0;
        populateItemIssue(item_id_post, item_category_id_post);

        function populateItemIssue(item_id_post, item_category_id_post) {
            if (item_category_id_post != "") {
                $('#item_id_issue').html("");

                var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                $.ajax({
                    type: "GET",
                    url: base_url + "admin/itemstock/getItemByCategory",
                    data: {
                        'item_category_id': item_category_id_post
                    },
                    dataType: "json",
                    success: function(data) {
                        $.each(data, function(i, obj) {
                            var select = "";
                            if (item_id_post == obj.id) {
                                var select = "selected=selected";
                            }
                            div_data += "<option value=" + obj.id + " " + select + ">" + obj.name + "</option>";
                        });
                        $('#item_id_issue').append(div_data);
                    }

                });
            }
        }



        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $('#date').datepicker({
            //  format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });

        $("#btnreset").click(function() {
            $("#form1")[0].reset();
        });


        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function() {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });

        $(document).on('change', '#item_category_id', function(e) {
            $('#item_id').html("");
            var item_category_id = $(this).val();
            populateItemIssue(0, item_category_id);
        });

        $(document).on('change', '#item_category_id_issue', function(e) {
            $('#item_id_issue').html("");
            var item_category_id = $(this).val();
            populateItemIssue(0, item_category_id);
        });

    });


    $(document).ready(function() {

        var item_id_post = '<?php echo set_value('item_id') ?>';
        item_id_post = (item_id_post != "") ? item_id_post : 0;
        var item_category_id_post = '<?php echo set_value('item_category_id'); ?>';
        item_category_id_post = (item_category_id_post != "") ? item_category_id_post : 0;
        populateItem(item_id_post, item_category_id_post);

        function populateItem(item_id_post, item_category_id_post) {
            if (item_category_id_post != "") {
                $('#item_id').html("");

                var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                $.ajax({
                    type: "GET",
                    url: base_url + "admin/itemstock/getItemByCategory",
                    data: {
                        'item_category_id': item_category_id_post
                    },
                    dataType: "json",
                    success: function(data) {
                        $.each(data, function(i, obj) {
                            var select = "";
                            if (item_id_post == obj.id) {
                                var select = "selected=selected";
                            }
                            div_data += "<option value=" + obj.id + " " + select + ">" + obj.name + "</option>";
                        });
                        $('#item_id').append(div_data);
                    }

                });
            }
        }



        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $('#date').datepicker({
            //  format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });

        $("#btnreset").click(function() {
            $("#form1")[0].reset();
        });


        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function() {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });

        $(document).on('change', '#item_category_id', function(e) {
            $('#item_id').html("");
            var item_category_id = $(this).val();
            populateItem(0, item_category_id);
        });

        $(document).on('change', '#item_category_id_issue', function(e) {
            $('#item_id_issue').html("");
            var item_category_id = $(this).val();
            populateItem(0, item_category_id);
        });

    });
    $("input[name=account_type]:radio").change(function() {
        var user = $('input[name=account_type]:checked').val();
        getIssueUser(user);



    });

    function getIssueUser(usertype) {
        $('#issue_to').html("");
        var div_data = "";
        $.ajax({
            type: "POST",
            url: base_url + "admin/issueitem/getUser",
            data: {
                'usertype': usertype
            },
            dataType: "json",
            success: function(data) {

                $.each(data.result, function(i, obj) {
                    if (data.usertype == "admin") {
                        name = obj.username;
                    } else {
                        name = obj.name;

                    }
                    div_data += "<option value=" + obj.id + ">" + name + "</option>";
                });
                $('#issue_to').append(div_data);
            }

        });
    }


    $(document).ready(function() {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';


        $('.date').datepicker({
            format: date_format,
            autoclose: true
        });
    });

    $(document).on('change', '#item_id_issue', function(e) {
        $('#div_avail').hide();
        var item_id = $(this).val();
        availableQuantity(item_id);

    });

    function availableQuantity(item_id_issue) {
        if (item_id_issue != "") {
            $('#item_available_quantity').html("");
            var div_data = '';
            console.log(item_id_issue)
            $.ajax({
                type: "GET",
                url: base_url + "admin/item/getAvailQuantity",
                data: {
                    'item_id': item_id_issue
                },
                dataType: "json",
                success: function(data) {

                    $('#item_available_quantity').html(data.available);
                    $('#div_avail').show();
                }


            });
        }
    }

    $("input[name=account_type]:radio").change(function() {
        var user = $('input[name=account_type]:checked').val();
        getIssueUser(user);



    });
</script>