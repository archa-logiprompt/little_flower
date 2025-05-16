<style type="text/css">
    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }
    }
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-bus"></i>
            <?php echo $this->lang->line('transport'); ?>
        </h1>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary" id="vehicle">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">
                            <?php echo "Assign Transport" ?>
                        </h3>
                        <a href="<?php echo base_url() ?>admin/vehicle/createnewtransport" class="pull-right btn btn-info">
                       Create
                        </a>
                    </div>
                    <div class="box-body">
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <?php echo $this->session->flashdata('msg') ?>
                        <?php } ?>
                        <div class="mailbox-controls">
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">
                                <?php echo $this->Setting_model->getCurrentSchoolName(); ?></br>
                                <?php echo $this->lang->line('vehicle_list'); ?>
                            </div>
                            <form id="form1" action="<?php echo site_url('admin/vehicle/assign_students') ?>"
                                id="employeeform" name="employeeform" method="post" accept-charset="utf-8">

                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Date"; ?>
                                    </label><small class="req"> *</small>
                                    <input autofocus="" id="date" name="date" placeholder="" type="text"
                                        class="form-control" value="<?php echo $date ?>" autocomplete="off" />
                                    <span class="text-danger">
                                        <?php echo form_error('date'); ?>
                                    </span>
                                </div>
                        </div>
                        <button class="btn btn-info pull-right" name="search" value="search_filter"
                            type="submit">Search</button>

                        </form>
                    </div>



                </div>

                <div class="box box-info">
                    <?php if ($search) { ?>

                        <div class="box-body">
                            <div class="mailbox-controls">
                                <div class="pull-right">
                                </div>
                            </div>
                            <div class="table-responsive mailbox-messages" style="overflow-y:visible;">
                                <div class="download_label">
                                    <?php echo $this->Setting_model->getCurrentSchoolName(); ?></br>
                                    <?php echo $this->lang->line('vehicle_list'); ?>
                                </div>
                                <form id="form1" action="<?php echo site_url('admin/vehicle/createTransportation') ?>"
                                    id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <?php echo "Group Name" ?>
                                                </th>
                                                <th>
                                                    <?php echo "Class Section" ?>
                                                </th>
                                                <th>
                                                    <?php echo "Number of students"; ?>
                                                </th>
                                                <th>
                                                    <?php echo "From" ?>
                                                </th>
                                                <th>
                                                    <?php echo "To" ?>
                                                </th>
                                                <th>
                                                    <?php echo "Time"; ?>
                                                </th>
                                                <th>
                                                    <?php echo "Driver"; ?>
                                                </th>
                                                <th>
                                                    <?php echo "Vehicle"; ?>
                                                </th>
                                                <th>
                                                    <?php echo "Remarks"; ?>
                                                </th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if (empty ($clinicalList)) {
                                                ?>

                                                <?php
                                            } else {


                                                $count = 1;
                                                foreach ($clinicalList as $data) {
                                                    ?>
                                                    <tr>
                                                        <input type="hidden" name="type[]" value="Clinical Rotation">
                                                        
                                                        <input type="hidden" name="id[]" value="<?php echo $data['update']? $data['update']->id:"0" ?>">
                                                        <input type="hidden" name="date" value="<?php echo $date ?>">
                                                        <td class="mailbox-name">
                                                            <a href="#" data-toggle="popover" class="detail_popover">
                                                                <?php echo $data['group_name'] ?>
                                                                <input type="hidden" name="group_name[]"
                                                                    value="<?php echo $data['group_name'] ?>">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <?php echo $data['class'] . "-" . $data['section'] ?>
                                                            <input type="hidden" name="class_section[]"
                                                                value="<?php echo $data['class'] . "-" . $data['section'] ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo $data['total_students'] ?>
                                                            <input type="hidden" name="total_students[]"
                                                                value="<?php echo $data['total_students'] ?>">
                                                        </td>
                                                        <td><input class="form-control" type="text" name="from[]"
                                                                value="<?php echo  $data['update']->from ?>"> </td>
                                                        
                                                        <td>
                                                            <?php echo $data['location'] ?>
                                                            <input type="hidden" name="location[]"
                                                                value="<?php echo $data['location'] ?>">
                                                        </td>
                                                        <td style="width:200px;">
                                                            <div class="bootstrap-timepicker">
                                                                <div class="form-group">

                                                                    <div class="input-group">
                                                                        <input type="text" name="time[]"
                                                                            class="form-control timepicker" id="time"
                                                                            value="<?php echo $data['update']->time ?>">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-clock-o"></i>
                                                                        </div>
                                                                    </div><!-- /.input group -->
                                                                </div><!-- /.form group -->
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <select autofocus="" id="date" name="driver_id[]" placeholder=""
                                                                type="text" autocomplete="off" class="form-control" required>
                                                                <option value="">Select</option>
                                                                <?php foreach ($drivers as $driver) {
                                                                    ?>
                                                                    <option value="<?php echo $driver['id'] ?>" <?php echo ($data['update']->driver_id == $driver['id'] ? "selected" : "") ?>>
                                                                        <?php echo $driver["driver_name"] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <span class="text-danger">
                                                                <?php echo form_error('date'); ?>
                                                            </span>

                                                        </td>
                                                        <td>
                                                            <select autofocus="" id="vehicles" name="vehicle_id[]" placeholder=""
                                                                type="text" autocomplete="off" class="form-control" required>
                                                                <option value="">Select</option>
                                                                <?php foreach ($vehicles as $vehicle) {
                                                                    ?>
                                                                    <option value="<?php echo $vehicle['id'] ?>" <?php echo ($data['update']->vehicle_id == $vehicle['id'] ? "selected" : "") ?>>
                                                                        <?php echo $vehicle["vehicle_no"] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <span class="text-danger">
                                                                <?php echo form_error('date'); ?>
                                                            </span>

                                                        </td>
                                                        <td><input class="form-control" type="text" name="remark[]"
                                                                value="<?php echo  $data['update']->remarks ?>"> </td>
                                                    </tr>
                                                    <?php
                                                }
                                                $count++;
                                            }
                                            ?>
                                        </tbody>

                                    </table>
                            </div>
                            <button class="pull-right btn btn-info" type="submit">Save</button>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        $('#postdate').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });

    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {
        Popup(jQuery(elem).html());
    }

    function Popup(data) {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
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
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);


        return true;
    }



    $(document).ready(function () {

        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.vehicle_detail_popover').html();
            }
        });


    });

    $(function () {
        // Initialize Datepicker
        $("#date").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

    $(function () {

        $(".timepicker").timepicker({
            showInputs: false,

        });
    });



</script>