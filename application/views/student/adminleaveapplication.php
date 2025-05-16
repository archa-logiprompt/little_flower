<style type="text/css">
    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-sign-out"></i> <?php echo "Student Leave Applications" ?>

        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

                <!-- general form elements -->
                <div class="box box-primary" id="assign">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo "Leaves"; ?></h3>

                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <div class="pull-right">
                            </div><!-- /.pull-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->Setting_model->getCurrentSchoolName(); ?></br>
                                <?php echo $this->lang->line('assignment_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo 'Student'; ?>
                                        </th>
                                        <th><?php echo 'Leave Date'; ?>
                                        </th>
                                        <th><?php echo 'No.of days '; ?>
                                        </th>
                                        <th><?php echo 'Applied Date'; ?>
                                        </th>
                                        <th><?php echo 'Reason'; ?>
                                        </th>
                                        <th><?php echo 'File'; ?>
                                        </th>
                                        <th class="text-right no-print"><?php echo $this->lang->line('status'); ?>
                                        </th>
                                        <th class="text-left no-print"><?php echo $this->lang->line('action'); ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($leavelist as $data) {
                                    ?>

                                        <tr>
                                            <td class="mailbox-name"><?php echo $data['firstname'] . " " . $data['lastname'] ?></td>
                                            <td class="mailbox-name"><?php echo $data['leave_from'] . "-" . $data['leave_to'] ?></td>
                                            <td class="mailbox-name"><?php echo $data['leave_days'] ?></td>
                                            <td class="mailbox-name"><?php echo date('d/m/Y', strtotime($data['created_at']))  ?></td>
                                            <td class="mailbox-name"><?php echo $data['reason'] ?></td>
                                            <td class="mailbox-name"><?php if ($data['file']) { ?><a href="<?php echo base_url('uploads/' . $data['file']) ?>"><i class="fa fa-download"></i></a> <?php } ?></td>
                                            <td class="mailbox-name"><?php if ($data['status'] == 0) echo "Pending";
                                                                        else if ($data['status'] == 1) echo "Approved";
                                                                        else if ($data['status'] == 1) echo "Declined" ?></td>
                                            <td class="mailbox-name"><?php if ($data['status'] == 0) { ?><a href="<?php echo base_url("student/updateleave/" . $data['id'] . "/1") ?>" class="btn btn-success btn-xs">Approve</a><a href="<?php echo base_url("student/updateleave/" . $data['id'] . "/2") ?>" class="btn btn-xs btn-danger" style="margin:5px">Reject</a><?php } else if ($data['status'] == 1) echo "Approved";
                                                                                                                                                                                                                                                                                                                                                                        else if ($data['status'] == 2) echo "Declined" ?></td>

                                        </tr>
                                    <?php
                                        $count++;
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->
        </div>
        <div class="row">
            <!-- left column -->
            <!-- right column -->
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <!-- general form elements disabled -->
            </div><!--/.col (right) -->
        </div> <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $("#leave_from,#leave_to", ).datepicker({
        dateFormat: 'dd-mm-yy',

    });
</script>