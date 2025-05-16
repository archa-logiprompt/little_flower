!DOCTYPE html>
<<html>

    <head>
        <title>Ledger Report</title>
        <!-- Include necessary CSS and other libraries -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap-multiselect.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap-multiselect.js"></script>

        <!-- Include jsPDF library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>

        <!-- Your custom CSS styles -->
        <style>
            .table {
                border: solid 1px black;
            }



            .box-header {
                text-align: center;
            }

            @media print {
                #collection_print {
                    display: none;
                }
            }

            #collection_print {
                z-index: 999;
            }

            .table-debit {
                width: 49%;
                display: inline-block;
            }

            .table-credit {
                width: 50%;
                display: inline-block;
            }

            .amount {
                text-align: right;
            }
        </style>
    </head>

    <body>
        <!-- Your custom CSS styles -->


        <!--<link rel="stylesheet" href="<?php //echo base_url(); 
                                            ?>backend/bootstrap/bootstrap-select.min.css"/>
 <script src="<?php //echo base_url(); 
                ?>backend/bootstrap/bootstrap-select.min.js"></script>
 -->
        <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap-multiselect.css" /> -->
        <!-- <script type="text/javascript" src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap-multiselect.js"></script> -->


        <!--<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/select2/select2.min.css"/>
<script type="text/javascript"  src="<?php echo base_url(); ?>backend/plugins/select2/select2.min.js"></script>
-->

        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script> -->

        <div class="content-wrapper" style="min-height: 946px;">
            <section class="content-header">
                <h1>
                    <i class="fa fa-mortar-board"></i>
                    <?php echo "Ledger"; ?>
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="box box-primary" id="pdf">
                    <button type="button" style="margin-right: 10px;margin-top: 10px;" name="search" id="collection_print" value="" class="btn btn-sm btn-primary login-submit-cs fa fa-print pull-right">
                        <?php echo $this->lang->line('print'); ?></button>
                    <div class="box-header with-border">
                        <h4><?php echo $ledgerName." Account" ?></h4>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Particulars</th>
                                <th class="amount">Debit</th>
                                <th class="amount">Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $debit = 0;
                            $credit = 0;
                            ?>

                            <?php $ledgers = (array_merge($ledger['creditdata'], $ledger['debitdata'])); ?>
                            <?php
                            // var_dump($ledgers);exit;


                            foreach ($ledgers as $key => $value) {
                                

                                foreach (json_decode($value['debit']) as $debitkey => $debitvalue) {

                                    if ($debitvalue != $id) {

                                        $ledgers[$key]['particular'][] = (getLedgerName($debitvalue));
                                        $debitamounts = json_decode($value['debit_amount']);

                                        $ledgers[$key]['debitamount'][] = $debitamounts[$debitkey];
                                        $ledgers[$key]['creditamount'] = [];
                                    } else {
                                        foreach (json_decode($value['credit']) as $creditkey => $creditvalue) {


                                            $creditamounts = json_decode($value['credit_amount']);

                                            $ledgers[$key]['creditamount'][] = $creditamounts[$creditkey];
                                            $ledgers[$key]['debitamount'] = [];
                                            $ledgers[$key]['particular'][] = (getLedgerName($creditvalue));
                                        }
                                    }
                                }
                            }


                            ?>
                            <?php
                            function sortByDate($a, $b)
                            {
                                return strtotime($a['date']) - strtotime($b['date']);
                            }

                            // Sort the data array by date
                            usort($ledgers, 'sortByDate');



                            ?>

                            <?php foreach ($ledgers as $key => $value) {

                            ?>
                                <tr>
                                    <td>
                                        <?php echo (date('d-m-Y', strtotime($value['date']))) ?>
                                    </td>
                                    <td>


                                        <?php
                                        foreach ($value['particular'] as $particularkey => $particularvalue) {
                                            # code...

                                            echo $particularvalue;
                                            echo '<br/>';
                                        }
                                        ?>
                                    </td>
                                    <td class="amount">
                                        <?php
                                        foreach ($value['debitamount'] as $debitamountkey => $debitamountvalue) {
                                            # code...

                                            echo $debitamountvalue;
                                            $debit = $debit + $debitamountvalue;
                                            $total = $total + $debitamountvalue;
                                            echo '<br/>';
                                        }
                                        ?>
                                    </td>
                                    <td class="amount">

                                        <?php
                                        foreach ($value['creditamount'] as $creditamountkey => $creditamountvalue) {

                                            echo $creditamountvalue;
                                            $credit = $credit + $creditamountvalue;
                                            $total = $total + $creditamountvalue;
                                            echo '<br/>';
                                        }
                                        ?>
                                    </td>

                                    <td></td>
                                </tr>


                            <?php } ?>
                            <tr>
                                <td></td>
                                <td>Closing Balance</td>
                                <?php if (($debit - $credit) < 0) { ?>
                                    <td class="amount"><?php echo abs($debit - $credit) ?></td>
                                    <td></td>
                                <?php } else if (($debit - $credit) > 0) { ?>
                                    <td></td>
                                    <td class="amount"><?php echo ($debit - $credit) ?></td>
                                <?php } ?>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td class="amount">
                                    <?php echo $total ?>
                                </td>
                                <td class="amount">
                                    <?php echo $total ?>
                                </td>

                            </tr>
                        </tbody>
                    </table>

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
    </BODY>

    </html>
    <script type="text/javascript">
        $(document).on('click', '#collection_print', function() {

            var printContents = document.getElementById('pdf').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            // console.log('Printing Content:', printContents); 
            $('#collection_print').hide();
            window.print();
            document.body.innerHTML = originalContents;

        });
    </script>
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
        // $('#downloadPdfBtn').on('click', function () {
        //             const pdf = new jsPDF();
        //             const contentWrapper = document.querySelector('.content-wrapper');

        //             html2canvas(contentWrapper, {
        //                 scrollX: 0,
        //                 scrollY: -window.scrollY,
        //                 scale: 1,
        //             }).then(function (canvas) {
        //                 const imgData = canvas.toDataURL('image/png');
        //                 const imgWidth = 210;
        //                 const pageHeight = 295;
        //                 const imgHeight = (canvas.height * imgWidth) / canvas.width;
        //                 const heightLeft = imgHeight;
        //                 let position = 0;

        //                 pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
        //                 heightLeft -= pageHeight;

        //                 while (heightLeft >= 0) {
        //                     position = heightLeft - imgHeight;
        //                     pdf.addPage();
        //                     pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
        //                     heightLeft -= pageHeight;
        //                 }

        //                 pdf.save('ledger.pdf');
        //             });
        //         });



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
    </script>