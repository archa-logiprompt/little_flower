<style>
    .table {
        border: solid 1px black;
    }

    .box-header {
        text-align: center;
    }

    #collection_print {
        z-index: 999;
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
            <?php echo "Trial Balance"; ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $title; ?></h3>

                    </div>

                    <form action="<?php echo base_url(); ?>accounts/Trial/search" id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>


                            <div class="col-md-6">
                                <label for="exampleInputEmail1"><?php echo "Year"; ?></label>
                                <div class="input-group col-md-5">
                                    <select id='year' name='year' class="form-control ">
                                        <option>Select</option>
                                        <option>2023-2024</option>
                                        <?php
                                        /*
                                        foreach ($financial_year as $year) { ?>
                                            <option value="<?php echo $year['value'] ?>"><?php echo $year['financial_year'] ?></option>
                                        <?php }*/ ?>
                                    </select>
                                </div>
                                <span class="text-danger"><?php echo form_error('year'); ?></span>
                            </div>

                        </div>
                        <div class="box-footer">

                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('search'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php if (isset($ledgers)) { ?>


        <section class="content">
            <div class="box box-primary">
                <button type="button" style="margin-right: 10px;margin-top: 10px;" name="search" id="collection_print" value="" class="btn btn-sm btn-primary login-submit-cs fa fa-print pull-right">
                    <?php echo $this->lang->line('print'); ?></button>

                <div class="box-header with-border" id="pdf">

                    <table class="table">
                        <h2>Caritas College of Nursing</h2>
                        <h3>Trial Balance</h3>
                        <h4>as on </h4>
                </div>
                <?php if ($type == 0) { ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Particulars</th>
                                <th>Debit</th>
                                <th>Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $debit = 0;
                            $credit = 0;
                            ?>
                            <tr>
                <!--                <td><?php echo $count;-->
                <!--                    $count++ ?></td>-->
                <!--                <td><?php echo $capital->ledger; ?></td>-->
                <!--                <td></td>-->
                <!--                <td><?php echo $capital->credit + abs($pcapital->balance);-->
                <!--                    $credit = $capital->credit + abs($pcapital->balance) + $credit ?></td>-->
                <!--                <?php-->
                <!--                if ($capital->credit + abs($pcapital->balance) < $capital->debit) { ?>-->
                <!--                    <td></td>-->
                <!--                    <td><?php ($capital->credit - $capital->debit + $pcapital->balance);-->
                <!--                        $credit = $credit + abs($pcapital->balance) + ($capital->credit - $capital->debit); ?></td>-->
                <!--                <?php } else if ($capital->credit < $capital->debit) { ?>-->
                <!--                    <td><?php echo abs($capital->debit - $capital->credit + $pcapital->balance);-->
                <!--                        $debit = $debit + $pcapital->balance + abs($capital->debit - $capital->credit); ?></td>-->
                <!--                    <td></td>-->
                <!--                <?php } else { ?>-->
                <!--                    <td></td>-->
                <!--                    <td></td>-->
                <!--                <?php } ?>-->
                <!--            </tr>-->

                <!--            <tr>-->
                <!--                <td><?php echo $count;-->
                <!--                    $count++ ?></td>-->
                <!--                <td><?php echo "Purchases" ?></td>-->
                <!--                <td><?php echo $purchaseValue ?></td>-->
                <!--            </tr>-->
                            <?php                      // var_dump($ledgers);exit;
                <!--            foreach ($ledgers as $row) {-->
                <!--                $total = ($row['debit'] - $row['credit'])-->
                <!--            ?>-->
                <!--                <tr>-->
                <!--                    <td>-->
                <!--                        <?php echo $count;-->
                <!--                        $count++ ?>-->
                <!--                    </td>-->
                <!--                    <td>-->
                <!--                        <?php echo $row['ledger'] ?>-->
                <!--                    </td>-->
                <!--                    <?php if ($row['action'] == 0) {-->
                <!--                        if ($total > 0) {-->
                <!--                    ?>-->
                <!--                            <td>-->
                <!--                                <?php echo abs($total);-->
                <!--                                $debit = $debit + abs($total);-->
                <!--                                ?>-->
                <!--                            </td>-->
                <!--                            <td>-->
                <!--                            </td>-->
                <!--                        <?php } else { ?>-->
                <!--                            <td></td>-->
                <!--                            <td>-->
                <!--                                <?php echo abs($total);-->
                <!--                                $credit = $credit + abs($total);-->
                <!--                                ?>-->
                <!--                            </td>-->
                <!--                        <?php  }-->
                <!--                    } else if ($row['action'] == 1) {-->
                <!--                        if ($total < 0) { ?>-->
                <!--                            <td>-->
                <!--                            </td>-->
                <!--                            <td>-->
                <!--                                <?php echo abs($total);-->
                <!--                                $credit = $credit + abs($total);-->
                <!--                                ?>-->
                <!--                            </td>-->
                <!--                        <?php } else { ?>-->
                <!--                            <td>-->
                <!--                                <?php echo abs($total);-->
                <!--                                $debit = $debit + abs($total);-->
                <!--                                ?>-->
                <!--                            </td>-->
                <!--                            <td>-->
                <!--                            </td>-->
                <!--                    <?php }-->
                <!--                    } ?>-->
                <!--                </tr>-->



                <!--            <?php-->
                <!--            }-->
                <!--            ?>-->
                <!--            <tr>-->
                <!--                <td><?php echo $count;-->
                <!--                    $count++ ?></td>-->
                <!--                <td><?php echo $cash->ledger; ?></td>-->
                <!--                <td><?php echo $cash->debit - $cash->credit + abs($pcash->balance);-->
                <!--                    $debit = $cash->debit - $cash->credit + abs($pcash->balance) + $debit; ?></td>-->
                <!--                <td></td>-->

                <!--            </tr>-->
                <!--            <?php if ($closingStock != 0) { ?>-->
                <!--                <tr>-->
                <!--                    <td><?php echo $count;-->
                <!--                        $count++ ?></td>-->
                <!--                    <td>Closing Stock</td>-->
                <!--                    <td><?php echo $closingStock;-->
                <!--                        $debit = $debit + $closingStock ?></td>-->

                <!--                </tr>-->

                <!--            <?php } ?>-->
                <!--            <?php-->
                <!--            if ($profit_and_loss->profit_loss != null) { ?>-->

                <!--                <?php if ($profit_and_loss->profit_loss > "0") { ?>-->
                <!--                    <tr>-->
                <!--                        <td><?php echo $count;-->
                <!--                            $count++ ?></td>-->
                <!--                        <td>P&L Account</td>-->
                <!--                        <td></td>-->
                <!--                        <td>-->
                <!--                            <?php echo $profit_and_loss->profit_loss;-->
                <!--                            $credit = $credit + $profit_and_loss->profit_loss-->
                <!--                            ?></php>-->
                <!--                        </td>-->
                <!--                    </tr>-->
                <!--                <?php } else if ($profit_and_loss->profit_loss < "0") { ?>-->
                <!--                    <tr>-->
                <!--                        <td><?php echo $count;-->
                <!--                            $count++ ?></td>-->
                <!--                        <td>P&L Account</td>-->
                <!--                        <td>-->
                <!--                            <?php echo $profit_and_loss->profit_loss;-->

                <!--                            $debit = $debit + $profit_and_loss->profit_loss;-->

                <!--                            ?></php>-->
                <!--                        </td>-->
                <!--                        <td></td>-->
                <!--                    </tr>-->
                <!--                <?php } ?>-->

                <!--            <?php  } ?>-->
                            <!-- <tr>
                <!--                <td><?php echo $count;-->
                <!--                    $count++ ?></td>-->

                <!--                <?php if ($debit > $credit) { ?>-->
                <!--                    <td><?php echo "Net Loss" ?></td>-->
                <!--                    <td></td>-->
                <!--                    <td><?php echo $debit - $credit;-->
                <!--                        $credit = $debit - $credit - $debit ?></td>-->

                <!--                <?php     } else {-->
                <!--                ?>-->
                <!--                    <td><?php echo "Net Profit" ?></td>-->
                <!--                    <td><?php echo $credit - $debit;-->
                <!--                        $debit = $debit + $credit - $debit ?></td>-->
                <!--                    <td></td>-->

                <!--                <?php } ?>-->
                <!--            </tr> -->-->
                <!--        </tbody>-->
                <!--        <tbody>-->
                <!--            <tr>-->
                <!--                <td>Balance</td>-->
                <!--                <td></td>-->
                <!--                <td>-->
                <!--                    <?php echo abs($debit) ?>-->
                <!--                </td>-->
                <!--                <td>-->
                <!--                    <?php echo abs($credit) ?>-->
                <!--                </td>-->

                <!--            </tr>-->
                <!--        </tbody>-->
                <!--    </table>-->
                <!--<?php } else if ($type == 1) { ?>-->

                <!--    <table class="table">-->
                <!--        <thead>-->
                <!--            <tr>-->
                <!--                <th>No.</th>-->
                <!--                <th>Particulars</th>-->
                <!--                <th>Debit</th>-->
                <!--                <th>Credit</th>-->
                <!--            </tr>-->
                <!--        </thead>-->
                <!--        <tbody>-->
                <!--            <?php-->
                <!--            $count = 1;-->
                <!--            $debit = 0;-->
                <!--            $credit = 0;-->
                <!--            ?>-->
                <!--            <tr>-->
                <!--                <td>-->
                <!--                    <?php echo $count;-->
                <!--                    $count++ ?>-->
                <!--                </td>-->
                <!--                <td>-->
                <!--                    <?php echo "Capital" ?>-->
                <!--                </td>-->
                <!--                <td></td>-->
                <!--                <td><?php echo $capital ;-->
                <!--                $credit=$credit+$capital?></td>-->
                <!--            </tr>-->



                <!--            <?php -->
                <!--            foreach ($ledgers as $row) {-->
                <!--            ?>-->
                <!--                <tr>-->
                <!--                    <td>-->
                <!--                        <?php echo $count;-->
                <!--                        $count++ ?>-->
                <!--                    </td>-->
                <!--                    <td><?php echo $row['ledger']; ?></td>-->
                <!--                    <?php if ($row['balance'] > 0) { ?>-->
                <!--                        <td><?php $amount = $row['balance'];-->
                <!--                            echo $amount;-->
                <!--                            $debit = $debit + $amount; ?></td>-->
                <!--                        <td></td>-->
                <!--                    <?php } else if ($row['balance'] < 0) { ?>-->
                <!--                        <td></td>-->
                <!--                        <td><?php echo abs($row['balance']);-->

                <!--                            $credit = $credit + abs((int)($row['balance'])); ?></td>-->
                <!--                    <?php } ?>-->
                <!--                </tr>-->
                               
                <!--            <?php-->
                <!--            }-->
                <!--            ?>-->
                <!--            <?php if ($profit_and_loss->profit_loss != 0) { ?>-->
                <!--                <tr>-->
                <!--                    <td><?php echo $count;-->
                <!--                        $count++ ?></td>-->
                <!--                    <?php if ($profit_and_loss->profit_loss > 0) { ?>-->
                <!--                        <td></td>-->
                <!--                        <td>-->
                <!--                            <?php echo $profit_and_loss->profit_loss;-->
                <!--                            $credit = $credit + $profit_and_loss->profit_loss ?></php>-->
                <!--                        </td>-->
                <!--                    <?php } else if ($profit_and_loss < 0) { ?>-->
                <!--                        <td>-->
                <!--                            <?php echo $profit_and_loss->profit_loss;-->
                <!--                            $debit = $debit + $profit_and_loss->profit_loss ?></php>-->
                <!--                        </td>-->
                <!--                        <td></td>-->
                <!--                    <?php } ?>-->
                <!--                </tr>-->
                <!--            <?php  } ?>-->


                <!--        </tbody>-->
                <!--        <tbody>-->
                <!--            <tr>-->
                <!--                <td>Balance</td>-->
                <!--                <td></td>-->
                <!--                <td>-->
                <!--                    <?php echo $debit ?>-->
                <!--                </td>-->
                <!--                <td>-->
                <!--                    <?php echo $credit ?>-->
                <!--                </td>-->



<td><?php echo "Hai"?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                }
                ?>


            <?php } ?>

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
    $(document).on('click', '#collection_print', function() {

        var printContents = document.getElementById('pdf').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        // console.log('Printing Content:', printContents); 
        $('#collection_print').hide();
        window.print();
        document.body.innerHTML = originalContents;


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
    var date_format =
        '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
    $('body').on('focus', ".date", function() {
        $(this).datepicker({
            format: date_format,
            autoclose: true
        });
    });
</script>