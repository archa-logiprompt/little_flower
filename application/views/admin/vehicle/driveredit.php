<style type="text/css">
    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }
    }
</style>
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
            <?php if ($this->rbac->hasPrivilege('driver', 'can_add')) { ?>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <?php echo "Add Driver"; ?>
                            </h3>
                        </div>
                        <form id="form1" action="<?php echo site_url('admin/vehicle/driveredit/').$driver->id ?>" id="employeeform"
                            name="employeeform" method="post" accept-charset="utf-8">

                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset ($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Driver Name"; ?>
                                    </label><small class="req"> *</small>
                                    <input autofocus="" id="driver_name" name="driver_name" placeholder="" type="text"
                                        class="form-control" value="<?php echo $driver->driver_name ?>" />
                                    <span class="text-danger">
                                        <?php echo form_error('driver_name'); ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Age"; ?>
                                    </label><small class="req"> *</small>
                                    <input autofocus="" id="age" name="age" placeholder="" type="number" class="form-control"
                                        value="<?php echo $driver->age; ?>" />
                                    <span class="text-danger">
                                        <?php echo form_error('age'); ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Licence Number"; ?>
                                    </label><small class="req"> *</small>
                                    <input id="licence_no" name="licence_no" placeholder="" type="text" class="form-control"
                                        value="<?php echo $driver->licence_no; ?>" />
                                    <span class="text-danger">
                                        <?php echo form_error('licence_no'); ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Contact Number"; ?>
                                    </label><small class="req"> *</small>
                                    <input id="contact" name="contact" placeholder="" type="number" class="form-control"
                                        value="<?php echo $driver->contact; ?>" />
                                    <span class="text-danger">
                                        <?php echo form_error('contact'); ?>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Blood Group"; ?>
                                    </label><small class="req"> *</small>
                                    <select id="blood_group" name="blood_group" placeholder="" type="text"
                                        class="form-control" value="<?php echo set_value('blood_group'); ?>">
                                        <option value="">Select</option>
                                        <option value="A+" <?php echo $driver->blood_group == "A+" ? "Selected" : '' ?>>A+
                                        </option>
                                        <option value="B+" <?php echo $driver->blood_group == "O+" ? "Selected" : '' ?>>B+
                                        </option>
                                        <option value="AB+" <?php echo $driver->blood_group == "AB+" ? "Selected" : '' ?>>AB+
                                        </option>
                                        <option value="O+" <?php echo $driver->blood_group == "O+" ? "Selected" : '' ?>>O+
                                        </option>
                                        <option value="A-" <?php echo $driver->blood_group == "A-" ? "Selected" : '' ?>>A-
                                        </option>
                                        <option value="B-" <?php echo $driver->blood_group == "B-" ? "Selected" : '' ?>>B-
                                        </option>
                                        <option value="AB-" <?php echo $driver->blood_group == "AB-" ? "Selected" : '' ?>>AB-
                                        </option>
                                        <option value="O-" <?php echo $driver->blood_group == "O-" ? "Selected" : '' ?>>O-
                                        </option>
                                    </select>
                                    <span class="text-danger">
                                        <?php echo form_error('blood_group'); ?>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        <?php echo $this->lang->line('address'); ?>
                                    </label><small class="req"> *</small>
                                    <textarea class="form-control" id="address" name="address" placeholder="" rows="3"
                                        placeholder="Enter ..."><?php echo $driver->address; ?></textarea>
                                    <span class="text-danger">
                                        <?php echo form_error('address'); ?>
                                    </span>
                                </div>
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
            if ($this->rbac->hasPrivilege('driver', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <div class="box box-primary" id="vehicle">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">
                            <?php echo "Driver List"; ?>
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">
                                <?php echo $this->Setting_model->getCurrentSchoolName(); ?></br>
                                <?php echo $this->lang->line('vehicle_list'); ?>
                            </div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>
                                            <?php echo "Driver"; ?>
                                        </th>
                                        <th>
                                            <?php echo "Age"; ?>
                                        </th>
                                        <th>
                                            <?php echo "Address"; ?>
                                        </th>
                                        <th>
                                            <?php echo "Licence Number"; ?>
                                        </th>
                                        <th>
                                            <?php echo "Blood Group"; ?>
                                        </th>
                                        <th>
                                            <?php echo "Contact"; ?>
                                        </th>

                                        <th class="text-right no-print">
                                            <?php echo $this->lang->line('action'); ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty ($driverList)) {
                                        ?>

                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ($driverList as $data) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <a href="#" data-toggle="popover" class="detail_popover">
                                                        <?php echo $data['driver_name'] ?>
                                                    </a>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $data['age'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $data['address'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $data['licence_no'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $data['driver_name'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $data['blood_group'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $data['contact'] ?>
                                                </td>

                                                <td class="mailbox-date pull-right no-print">
                                                    <?php if ($this->rbac->hasPrivilege('vehicle', 'can_edit')) { ?>
                                                        <a href="<?php echo base_url(); ?>admin/vehicle/driveredit/<?php echo $data['id'] ?>"
                                                            class="btn btn-default btn-xs" data-toggle="tooltip"
                                                            title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    <?php }
                                                    if ($this->rbac->hasPrivilege('vehicle', 'can_delete')) { ?>
                                                        <a href="<?php echo base_url(); ?>admin/vehicle/driverdelete/<?php echo $data['id'] ?>"
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



</script>