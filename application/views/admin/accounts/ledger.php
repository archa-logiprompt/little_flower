<style type="text/css">
    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }

        .a {
            color: black;
        }
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-book"></i>
            <?php echo "Ledgers"; ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('subject', 'can_add')) {
            ?>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <?php echo "Add Ledger"; ?>
                            </h3>
                        </div>
                        <form action="<?php echo site_url('accounts/ledger/insert') ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Ledger Name"; ?>
                                    </label><small class="req"> *</small>
                                    <input autofocus="" id="subname" name="name" placeholder="" type="text" class="form-control" value="<?php echo set_value('name'); ?>" />
                                    <?php if (isset($validation_message)) : ?>
                                        <div class="validation-message">
                                            <?php echo $validation_message; ?>
                                        </div>
                                    <?php endif; ?>

                                    <span class="text-danger">
                                        <?php echo form_error('name'); ?>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Account Type"; ?>
                                    </label><small class="req"> *</small>
                                    <select autofocus="" id="subname" name="type" placeholder="" type="text" class="form-control" value="<?php echo set_value('name'); ?>">
                                        <option value="">
                                            <?php echo $this->lang->line('select'); ?>
                                        </option>
                                        <?php
                                        foreach ($type as $row) {
                                        ?>
                                            <option value="<?php echo $row['id'] ?>" <?php if (set_value('class_id') == $row['id'])
                                                                                            echo "selected=selected" ?>><?php echo $row['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger">
                                        <?php echo form_error('type'); ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Debit Balance"; ?>
                                    </label>
                                    <input autofocus="" id="debit" name="debit" placeholder="" type="text" class="form-control" value="<?php echo set_value('name'); ?>" />
                                    <?php if (isset($validation_message)) : ?>
                                        <div class="validation-message">
                                            <?php echo $validation_message; ?>
                                        </div>
                                    <?php endif; ?>

                                    <span class="text-danger">
                                        <?php echo form_error('debit'); ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Credit Balance"; ?>
                                    </label>
                                    <input autofocus="" id="credit" name="credit" placeholder="" type="text" class="form-control" value="<?php echo set_value('name'); ?>" />
                                    <?php if (isset($validation_message)) : ?>
                                        <div class="validation-message">
                                            <?php echo $validation_message; ?>
                                        </div>
                                    <?php endif; ?>

                                    <span class="text-danger">
                                        <?php echo form_error('credit'); ?>
                                    </span>
                                </div>

                                <!--  <label class="radio-inline">
                                    <input type="radio" value="Theory" name="type"  <?php //if (set_value('type') == "Theory") echo "checked"; 
                                                                                    ?> checked><?php echo $this->lang->line('theory'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" <?php //if (set_value('type') == "Practical") echo "checked"; 
                                                                    ?> value="Practical"><?php echo $this->lang->line('practical'); ?>
                                </label>-->


                                <!-- <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="practical" <?php if (set_value('practical') == "practical")
                                                                                            echo "checked"; ?> value="practical" id='practical' > <?php echo 'Practical'; ?> 
                                            </label>
                                            
                                             <label>
                                                <input type="checkbox" name="theory" <?php if (set_value('theory') == "theory")
                                                                                            echo "checked"; ?> value="theory"  id='theory'> <?php echo 'Theory'; ?> 
                                            </label>
                                             <label>
                                                <input type="checkbox" name="viva" <?php if (set_value('viva') == "viva")
                                                                                        echo "checked"; ?> value="viva"  id='viva'> <?php echo 'Viva'; ?> 
                                            </label>
                                       </div> -->
                                <!-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label
                                                    for="exampleInputFile"><?php //echo $this->lang->line('photo'); 
                                                                            ?></label>
                                                <div><input class="filestyle form-control" type='file' name='filedemo'
                                                        id="filecsv" size='20' />
                                                </div>
                                                <span class="text-danger"><?php //echo form_error('file'); 
                                                                            ?></span>
                                            </div>
                                        </div>
                                 -->

                                
                                </span>



                                <!--<div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php //echo $this->lang->line('subject_code_practical'); 
                                                                    ?></label>
                                    <input id="category" name="code1" placeholder="" type="text" class="form-control"  value="<?php //echo set_value('code1'); 
                                                                                                                                ?>" />
                                    <span class="text-danger"><?php //echo form_error('code1'); 
                                                                ?></span>
                                </div>-->





                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right">
                                    <?php echo $this->lang->line('save'); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-<?php
                                if ($this->rbac->hasPrivilege('subject', 'can_add')) {
                                    echo "8";
                                } else {
                                    echo "12";
                                }
                                ?>">



                <div class="box box-primary" id="sublist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">
                            <?php echo "Ledger List"; ?>
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">
                                <?php echo $this->Setting_model->getCurrentSchoolName(); ?>
                                <?php echo "Ledgers"; ?>
                            </div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>
                                            <?php echo "No." ?>
                                        </th>
                                        <th>
                                            <?php echo "Name" ?>
                                        </th>
                                        <th>
                                            <?php echo "Type" ?>
                                        </th>
                                        <th>
                                            <?php echo "Balance" ?>
                                        </th>
                                        <?php ?> 
                                        <th class="text-right no-print">
                                            <?php echo $this->lang->line('action'); ?>
                                        </th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($ledgers as $row) {


                                        //   var_dump($row);
                                    ?>

                                        <tr>
                                            <td class="mailbox-name">
                                                <?php echo $count;
                                                $count++; ?>
                                            </td>
                                            <td class="mailbox-name">
                                                <a href="<?php echo base_url(); ?>accounts/ledger/view/<?php echo $row['lid'] ?>" class="name">
                                                    <span style="color:black"><?php echo $row['ledger'] ?></span>
                                                </a>
                                            </td>
                                            <td class="mailbox-name">
                                                <?php echo $row['name'] ?>
                                            </td>
                                            <td class="mailbox-name">
                                                <?php echo abs($row['debit']-$row['credit']) ?>
                                            </td>
                                            <!-- <td class="mailbox-name"><?php
                                                                            if (!empty($row['theory']) && !empty($row['practical'])) {
                                                                                echo $row['theory'] . '&' . $row['practical'] . $row['viva'];
                                                                            } elseif (!empty($row['theory'])) {
                                                                                echo $row['theory'] . $row['viva'];
                                                                            } elseif (!empty($row['practical'])) {
                                                                                echo $row['practical'] . $row['viva'];
                                                                            } else {
                                                                                echo '';
                                                                            }
                                                                            ?>
                                            </td> -->

                                            <td class="mailbox-date pull-right no-print">
                                                <?php
                                                // var_dump($row);exit;
                                                if ($this->rbac->hasPrivilege('subject', 'can_edit')) {
                                                ?>
                                                    <a href="<?php echo base_url(); ?>accounts/ledger/edit/<?php echo $row['lid'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                <?php
                                                }
                                                if ($this->rbac->hasPrivilege('subject', 'can_delete')) {
                                                ?>
                                                    <a href="<?php echo base_url(); ?>accounts/ledger/delete/<?php echo $row['lid'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#btnreset").click(function() {
            $("#form1")[0].reset();
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




<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.js" integrity="sha512-M0cjXJTonbWEdLI3HJIoJSQBb9980RWmOCk+tvWkhgFrAZqSSIg1+1Db/vDu7Qk9W3L90gBynve17PYvarjfQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const input = document.querySelector('input[id="filecsv"]');

    input.addEventListener('change', function() {
        const file = input.files[0];
        const reader = new FileReader();

        reader.addEventListener('load', function() {
            const csv = reader.result;
            const results = Papa.parse(csv);
            results.data.forEach(row => {



                $('#subname').val(row[1])
                $('#subcode').val(row[0])


                if (row[5] == 'Theory') {
                    $('#theory').prop('checked', true)
                    $('#practical').prop('checked', false)
                }
                if (row[5] == 'Practical') {
                    $('#theory').prop('checked', false)
                    $('#practical').prop('checked', true)
                }
                if (row[5] == 'Theory/ Practical') {

                    $('#theory').prop('checked', true)
                    $('#practical').prop('checked', true)
                }

                // auth()






                // Wrap the AJAX request in an async function
                async function sendFormData() {
                    var form = $('#employeeform');
                    var formData = form.serialize(); // get form data
                    try {
                        const response = await $.ajax({
                            type: form.attr('method'),
                            url: form.attr('action'),
                            data: formData
                        });
                        // console.log(response);
                    } catch (error) {
                        // console.log(error);
                    }
                }

                sendFormData(); // Call the async function to send the AJAX request
                return false; // prevent default form submission

            });
        });

        reader.readAsText(file);
    });
</script>