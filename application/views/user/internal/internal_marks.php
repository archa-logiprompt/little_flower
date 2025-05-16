<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-download"></i> <?php echo "Internal Marks" ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('assignment_list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('assignment_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Subject Type</th>
                                        <th>Subject Name</th>
                                        <th>Name</th>
                                        <th>Marks</th>
                                    </tr>
                                </thead>
                             
                                <tbody>
                                    <?php foreach ($list as $data) { ?>
                                        
                                        <tr>
                                            <td class="mailbox-name"><?php echo $data['sub_type']; ?></td>
                                            <td class="mailbox-name"><?php echo $data['sname']; ?></td>
                                            <td class="mailbox-name"><?php echo $data['name']; ?></td>
                                            <td class="mailbox-name"><?php echo $data['marks']?></td>
                                            
                                        </tr>
                                    <?php } ?>
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

<!-- Datepicker script -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#upload_date').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>

<!-- Assignment Upload Script -->
<script>
    $(document).ready(function () {
        // Trigger file input on "Upload" button click
        $('.assignment-button').on('click', function() {
            $(this).closest('td').find('.assignment-file').click();
        });

        // Submit the form when a file is selected
        $('.assignment-file').on('change', function() {

            $(this).closest('form').submit();
        });
    });
</script>
