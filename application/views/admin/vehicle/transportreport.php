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
                            <?php echo "Transport Report" ?>
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
                        <div class="">
                            
                            <form id="form1" action="<?php echo site_url('admin/vehicle/transport_report') ?>"
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
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Driver"; ?>
                                    </label>
                                    <select autofocus="" id="driver" name="driver" placeholder="" type="text"
                                        class="form-control" value="<?php echo $driver ?>" autocomplete="off">
                                        <option value="">Select</option>
                                        <?php foreach ($drivers as $driver) {
                                            ?>
                                            <option value="<?php echo $driver['id'] ?>" <?php echo $driver['id'] == $driver_id ? "Selected" : "" ?><?php  $driver['id'] == $driver_id ? $driverName=$driver['driver_name']: "" ?>>
                                                <?php echo $driver['driver_name'] ?>
                                            </option>
                                            <?php
                                        } ?>
                                    </select>
                                    <span class="text-danger">
                                        <?php echo form_error('driver'); ?>
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

                                <?php if ($driverName) {
                                    
                                    echo $driverName . "'s Duty List of " . date('d-m-Y',strtotime($date));

                                } else {

                                    echo "Drivers Duty List of " . date('d-m-Y',strtotime($date));
                                }
                                ?>
                                </div>

                                <table class="table table-striped table-bordered table-hover example">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo "Date" ?>
                                            </th>
                                            <th>
                                                <?php echo "Type" ?>
                                            </th>
                                            <th>
                                                <?php echo "Time" ?>
                                            </th>
                                            <th>
                                                <?php echo "From"; ?>
                                            </th>
                                            <th>
                                                <?php echo "Location" ?>
                                            </th>
                                            <th>
                                                <?php echo "Count" ?>
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
                                            <th>
                                                <?php echo "Action"; ?>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty ($result)) {
                                            ?>

                                            <?php
                                        } else {

                                            $count = 1;
                                            foreach ($result as $data) {
                                                ?>
                                                <tr>
                                                    <td class="mailbox-name">
                                                        <?php echo date('d-m-Y', strtotime($data['date'])) ?>
                                                    </td>
                                                    <td class="mailbox-name">
                                                        <?php echo $data['type'] . " - " . $data['group_name'] ?>
                                                    </td>
                                                    <td class="mailbox-name">
                                                        <?php echo $data['time'] ?>
                                                    </td>
                                                    <td class="mailbox-name">
                                                        <?php echo $data['from'] ?>
                                                    </td>
                                                    <td class="mailbox-name">
                                                        <?php echo $data['location'] ?>
                                                    </td>
                                                    <td class="mailbox-name">
                                                        <?php echo $data['total_students'] ?>
                                                    </td>
                                                    <td class="mailbox-name">
                                                        <?php echo $data['driver_name'] ?>
                                                    </td>
                                                    <td class="mailbox-name">
                                                        <?php echo $data['vehicle_no'] ?>
                                                    </td>
                                                    <td class="mailbox-name">
                                                        <?php echo $data['remarks'] ?>
                                                    </td>
                                                    <td class="mailbox-date  no-print">
                                                        <?php if ($this->rbac->hasPrivilege('vehicle', 'can_edit')) { ?>
                                                            <a href="<?php echo base_url(); ?>admin/vehicle/reportedit/<?php echo $data['tid'] ?>"
                                                                class="btn btn-default btn-xs" data-toggle="tooltip"
                                                                title="<?php echo $this->lang->line('edit'); ?>">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                        <?php }
                                                        if ($this->rbac->hasPrivilege('vehicle', 'can_delete')) { ?>
                                                            <a href="<?php echo base_url(); ?>admin/vehicle/reportdelete/<?php echo $data['tid'] ?>"
                                                                class="btn btn-default btn-xs" data-toggle="tooltip"
                                                                title="<?php echo $this->lang->line('delete'); ?>"
                                                                onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                                <i class="fa fa-remove"></i>
                                                            </a>
                                                        <?php } ?>
                                                    </td>


                                                </tr>
                                                <?php
                                            }
                                            $count++;
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>


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