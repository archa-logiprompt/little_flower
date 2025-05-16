<style type="text/css">
    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }
    }
</style>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">

<!-- JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
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
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">
                                <?php echo $this->Setting_model->getCurrentSchoolName(); ?></br>
                                <?php echo $this->lang->line('vehicle_list'); ?>
                            </div>
                            <form id="form1" action="<?php echo site_url('admin/vehicle/reportedit/' . $row->id) ?>"
                                id="employeeform" name="employeeform" method="post" accept-charset="utf-8">

                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Date"; ?>
                                    </label><small class="req"> *</small>
                                    <input autofocus="" id="date" name="date" placeholder="" type="text"
                                        class="form-control" value="<?php echo date('d-m-Y', strtotime($row->date)) ?>"
                                        autocomplete="off" />
                                    <span class="text-danger">
                                        <?php echo form_error('type'); ?>
                                    </span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Duty Type"; ?>
                                    </label><small class="req"> *</small>
                                    <input autofocus="" id="type" name="type" placeholder="" type="text"
                                        class="form-control" value="<?php echo $row->type . " - " . $row->group_name ?>"
                                        autocomplete="off" />
                                    <span class="text-danger">
                                        <?php echo form_error('type'); ?>
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Time"; ?>
                                    </label><small class="req"> *</small>
                                    <input type="text" name="time" class="form-control timepicker" id="time"
                                        value="<?php echo $row->time ?>">

                                    <span class="text-danger">
                                        <?php echo form_error('time'); ?>
                                    </span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Count"; ?>
                                    </label>
                                    <input autofocus="" id="total_students" name="total_students" placeholder=""
                                        type="number" class="form-control" value="<?php echo $row->total_students ?>"
                                        autocomplete="off" />
                                    <span class="text-danger">
                                        <?php echo form_error('type'); ?>
                                    </span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "From"; ?>
                                    </label>
                                    <input autofocus="" id="from" name="from" placeholder="" type="text"
                                        class="form-control" value="<?php echo $row->from ?>" autocomplete="off" />
                                    <span class="text-danger">
                                        <?php echo form_error('type'); ?>
                                    </span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "To"; ?>
                                    </label>
                                    <input autofocus="" id="location" name="location" placeholder="" type="text"
                                        class="form-control" value="<?php echo $row->location ?>" autocomplete="off" />
                                    <span class="text-danger">
                                        <?php echo form_error('type'); ?>
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Driver"; ?>
                                    </label><small class="req"> *</small>
                                    <select autofocus="" id="date" name="driver_id" placeholder="" type="text"
                                        autocomplete="off" class="form-control" required>
                                        <option value="">Select</option>
                                        <?php foreach ($drivers as $driver) {
                                            ?>
                                            <option value="<?php echo $driver['id'] ?>" <?php echo ($row->driver_id == $driver['id'] ? "selected" : "") ?>>
                                                <?php echo $driver["driver_name"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>

                                    <span class="text-danger">
                                        <?php echo form_error('driver'); ?>
                                    </span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Vehicle"; ?>
                                    </label>
                                    <select autofocus="" id="date" name="vehicle_id" placeholder="" type="text"
                                        autocomplete="off" class="form-control" required>
                                        <option value="">Select</option>
                                        <?php foreach ($vehicles as $vehicle) {
                                            ?>
                                            <option value="<?php echo $vehicle['id'] ?>" <?php echo ($row->vehicle_id == $vehicle['id'] ? "selected" : "") ?>>
                                                <?php echo $vehicle["vehicle_no"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>

                                    <span class="text-danger">
                                        <?php echo form_error('driver'); ?>
                                    </span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">
                                        <?php echo "Remarks"; ?>
                                    </label>
                                    <input autofocus="" id="remarks" name="remarks" placeholder="" type="text"
                                        class="form-control" value="<?php echo $row->remarks ?>" autocomplete="off" />
                                    <span class="text-danger">
                                        <?php echo form_error('type'); ?>
                                    </span>
                                </div>

                                <input type="hidden" value="<?php echo $row->class_section ?>" name="class_section">

                        </div>
                        <button class="btn btn-info pull-right" name="search" value="search_filter"
                            type="submit">Update</button>

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
            dateFormat: 'Y-mm-dd' // Format for the date with full year
        });
    });
    $(function () {
        // Initialize timepicker
        $('.timepicker').datetimepicker({
            controlType: 'select', // Allows you to use a dropdown for time selection
            timeFormat: 'HH:mm',   // The format of the time displayed
            // Add any additional options you need
        });
    });





</script>