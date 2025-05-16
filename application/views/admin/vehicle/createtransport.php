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
                            <?php echo "Create Transport" ?>
                        </h3>
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
                            <form id="form1" action="<?php echo site_url('admin/vehicle/createnewtransport') ?>"
                                id="employeeform" name="employeeform" method="post" accept-charset="utf-8">

                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Date"; ?>
                                    </label><small class="req"> *</small>
                                    <input autofocus="" id="date" name="date" placeholder="" type="text"
                                        class="form-control" value="<?php echo date('d-m-Y') ?>"
                                        autocomplete="off" />
                                    <span class="text-danger">
                                        <?php echo form_error('date'); ?>
                                    </span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Title"; ?>
                                    </label>
                                    <input autofocus="" id="group_name" name="group_name" placeholder="" type="text"
                                        class="form-control" value=""
                                        autocomplete="off" />
                                    <span class="text-danger">
                                        <?php echo form_error('group_name'); ?>
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Type"; ?>
                                    </label><small class="req"> *</small>
                                    <select autofocus="" id="type" name="type" placeholder="" type="text"
                                        autocomplete="off" class="form-control" >
                                        <option value="">Select</option>
                                        <option value="Clinical Rotation">Clinical Rotation</option>
                                        <option value="Special Duty">Special Duty</option>
                                        <option value="On Call Duty">On Call Duty</option>
                                       
                                    </select>

                                    <span class="text-danger">
                                        <?php echo form_error('type'); ?>
                                    </span>
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Time"; ?>
                                    </label><small class="req"> *</small>
                                    <input type="text" name="time" class="form-control timepicker" id="time"
                                        value="<?php echo $data->time ?>">
                                    <span class="text-danger">
                                        <?php echo form_error('Time'); ?>
                                    </span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Count Of Passengers"; ?>
                                    </label>
                                    <input autofocus="" id="total_students" name="total_students" placeholder=""
                                        type="number" class="form-control" value="<?php echo $row->total_students ?>"
                                        autocomplete="off" />
                                    <span class="text-danger">
                                        <?php echo form_error('total_students'); ?>
                                    </span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Start From"; ?>
                                    </label>
                                    <input autofocus="" id="from" name="from" placeholder="" type="text"
                                        class="form-control" value="<?php echo $row->from ?>" autocomplete="off" />
                                    <span class="text-danger">
                                        <?php echo form_error('from'); ?>
                                    </span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "End To"; ?>
                                    </label>
                                    <input autofocus="" id="location" name="location" placeholder="" type="text"
                                        class="form-control" value="<?php echo $row->location ?>" autocomplete="off" />
                                    <span class="text-danger">
                                        <?php echo form_error('location'); ?>
                                    </span>
                                </div>
                               
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Driver"; ?>
                                    </label><small class="req"> *</small>
                                    <select autofocus="" id="date" name="driver_id" placeholder="" type="text"
                                        autocomplete="off" class="form-control" >
                                        <option value="">Select</option>
                                        <?php foreach ($drivers as $driver) {
                                            ?>
                                            <option value="<?php echo $driver['id'] ?>" <?php echo ($row->driver_id == $driver['id'] ? "selected" : "") ?>>
                                                <?php echo $driver["driver_name"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>

                                    <span class="text-danger">
                                        <?php echo form_error('driver_id'); ?>
                                    </span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Vehicle"; ?>
                                    </label>
                                    <select autofocus="" id="date" name="vehicle_id" placeholder="" type="text"
                                        autocomplete="off" class="form-control" >
                                        <option value="">Select</option>
                                        <?php foreach ($vehicles as $vehicle) {
                                            ?>
                                            <option value="<?php echo $vehicle['id'] ?>" <?php echo ($row->vehicle_id == $vehicle['id'] ? "selected" : "") ?>>
                                                <?php echo $vehicle["vehicle_no"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>

                                    <span class="text-danger">
                                        <?php echo form_error('vehicle_id'); ?>
                                    </span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Remarks"; ?>
                                    </label>
                                    <input autofocus="" id="remarks" name="remarks" placeholder="" type="text"
                                        class="form-control" value="<?php echo $row->remarks ?>" autocomplete="off" />
                                    <span class="text-danger">
                                        <?php echo form_error('remarks'); ?>
                                    </span>
                                </div>

                                <input type="hidden" value="<?php echo $row->class_section ?>" name="class_section">

                        </div>
                        <button class="btn btn-info pull-right" name="search" value="search_filter"
                            type="submit">Add</button>

                        </form>
                    </div>



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