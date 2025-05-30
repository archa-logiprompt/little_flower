<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-sitemap"></i> <?php echo $this->lang->line('human_resource'); ?>
            <?php if ($this->rbac->hasPrivilege('apply_leave', 'can_add')) { ?>
                <small class="pull-right"><a href="#addleave" onclick="addLeave()" role="button" class="btn btn-primary btn-sm checkbox-toggle pull-right edit_setting" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"><?php echo $this->lang->line('apply_leave'); ?></a></small>
            <?php } ?>
        </h1>


    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('leaves'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tab-pane active table-responsive no-padding">
                                    <div class="download_label"><?php echo $this->lang->line('leaves'); ?></div>
                                    <table class="table table-striped table-bordered table-hover example">
                                        <thead>

                                            <th><?php echo $this->lang->line('staff'); ?></th>
                                            <th><?php echo 'leave_type(method)'; ?></th>

                                            <th><?php echo $this->lang->line('leave'); ?> <?php echo $this->lang->line('date'); ?></th>
                                            <th><?php echo $this->lang->line('days'); ?></th>
                                            <th><?php echo $this->lang->line('apply'); ?> <?php echo $this->lang->line('date'); ?></th>
                                            <th><?php echo "File" ?></th>
                                            <th><?php echo "Assigned Staff Name" ?></th>

                                            <th><?php echo $this->lang->line('status'); ?></th>
                                            <th class="text-right no-print"><?php echo $this->lang->line('action'); ?></th>

                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($leave_request as $key => $value) {
                                            ?>
                                                <tr>

                                                    <td><span data-toggle="popover" class="detail_popover" data-original-title="" title=""><?php echo $value['name'] . " " . $value['surname']; ?></span>
                                                        <div class="fee_detail_popover" style="display: none"><?php echo $this->lang->line('staff_id'); ?>: <?php echo $value['employee_id']; ?></div>
                                                    </td>
                                                    <td><?php echo $value["type"] ?> (<?php echo $value["leave_method"] ?>)</td>

                                                    <td><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($value["leave_from"])) ?> - <?php echo date($this->customlib->getSchoolDateFormat(), strtotime($value["leave_to"])) ?></td>

                                                    <td><?php echo $value["leave_days"]; ?></td>
                                                    <td><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($value["date"])); ?></td>
                                                    <td>
                        <?php if (!empty($value["document_file"])): ?>
                            <a href="<?php echo base_url('uploads/staff_documents/' . $value["staff_id"] . '/' . $value["document_file"]); ?>" 
                            download 
                            class="btn btn-link" 
                            title="Download">
                            <?php echo $value["document_file"]; ?>
                            </a>
                        <?php else: ?>
                            No file available
                        <?php endif; ?>
                    </td>

                                                    <td><?php echo $value["assigned_staff_name"]." ".$value["assigned_staff_surname"] ?></td>
                                                    
                                                                    <td>
                                                                        <?php if( $value["status"]=="0"){echo "Pending";}elseif($value["status"]=="approve"){echo "Approved";}elseif($value["status"]=="4"){echo "Rejected";} ?>
                                                                    </td>

                                                    <td class="pull-right no-print">
                                                        <?php if ($value["status"] == "0" || $value["status"] == "1" || $value["status"] == "2" || $value["status"] == "3") { ?>
                                                            <a href="<?php echo base_url("admin/staff/deleteLeave/" . $value["id"]) ?>" class="btn btn-default btn-xs"><i class='fa fa-trash'></i></a>
                                                        <?php } ?>
                                                        <a href="#leavedetails" onclick="getRecord('<?php echo $value["id"] ?>')" role="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('view'); ?>" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"><i class="fa fa-reorder"></i></a>
                                                    </td>

                                                </tr>
                                            <?php
                                                $i++;
                                            }
                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<div id="leavedetails" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog2 modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('details'); ?></h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <form role="form" id="leavedetails_form" action="">
                        <div class="col-md-12 table-responsive">
                            <table class="table mb0 table-striped table-bordered ">
                                <tr>
                                    <th width="15%"><?php echo $this->lang->line('name'); ?></th>
                                    <td width="35%"><span id='name'></span></td>
                                    <th width="15%"><?php echo $this->lang->line('staff_id'); ?></th>
                                    <td width="35%"><span id="employee_id"></span>
                                        <span class="text-danger"><?php echo form_error('leave_request_id'); ?></span>
                                    </td>

                                </tr>
                                <tr>

                                    <th><?php echo $this->lang->line('submitted_by'); ?></th>
                                    <td><span id="appliedby"></span></td>
                                    <th><?php echo $this->lang->line('leave_type'); ?></th>
                                    <td><span id="leave_type"></span>
                                        <input id="leave_request_id" name="leave_request_id" placeholder="" type="hidden" class="form-control" />
                                        <span class="text-danger"><?php echo form_error('leave_request_id'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('leave'); ?></th>
                                    <td><span id='leave_from'></span> - <label> </label><span id='leave_to'> </span> (<span id='days'></span>)
                                        <span class="text-danger"><?php echo form_error('leave_from'); ?></span>
                                    </td>
                                    <th><?php echo $this->lang->line('apply'); ?> <?php echo $this->lang->line('date'); ?></th>
                                    <td><span id="applied_date"></span></td>
                                </tr>
                                <tr>


                                    <th><?php echo $this->lang->line('reason'); ?></th>
                                    <td><span id="remark"> </span></td>
                                 
                                </tr>
                                <tr>
                                    <th>Director Staus: </th>
                                    <td><span id='drstatus'></span>
                                    </td>
                                    <th>Director note</th>
                                    <td><span id="drnote"></span></td>
                                </tr>
                                <tr>
                                    <th>Principal Staus: </th>
                                    <td><span id='prstatus'></span>
                                    </td>
                                    <th>Principal Note</th>
                                    <td><span id="prnote"></span></td>
                                </tr>
                                <tr>
                                    <th>HOD Staus: </th>
                                    <td><span id='hodstatus'></span>
                                    </td>
                                    <th>HOD Note</th>
                                    <td><span id="hodnote"></span></td>
                                </tr>
                                <tr>
                                    <th>Leave Method </th>
                                    <td><span id="method"></span>
                                    </td>

                                </tr>


                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="addleave" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog2 modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('add'); ?>&nbsp;<?php echo $this->lang->line('details'); ?></h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <form role="form" id="addleave_form" method="post" enctype="multipart/form-data" action="">



                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label><?php echo $this->lang->line('apply'); ?> <?php echo $this->lang->line('date'); ?></label>
                            <input type="text" id="applieddate" name="applieddate" value="<?php echo date("m/d/Y") ?>" class="form-control">

                        </div>

                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6 ">
                            <label>
                                <?php echo $this->lang->line('leave_type'); ?></label><small class="req"> *</small>
                            <div id="leavetypeddl">
                                <select name="leave_type" id="leave_type" class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                   
                                    foreach ($leavetype as $leave_key => $leave_value) {
                                        if (!empty($leave_value["alloted_leave"])) {
                                    ?>
                                            <option value="<?php echo $leave_value["typeid"] ?>"><?php echo $leave_value["type"] . "(" . $leave_value["alloted_leave"] . ")" ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <span class="text-danger"><?php echo form_error('leave_type'); ?></span>
                        </div>
                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6 ">
                            <label>
                                <?php echo "Assign duty to" ?></label><small class="req"> *</small>
                            <div id="leavetypeddl">
                                <select name="assigned_staff" id="assigned_staff" class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                    foreach ($stafflist as $leave_key => $list) {
                                        if (!empty($list["name"])) {
                                    ?>
                                            <option value="<?php echo $list["id"] ?>"><?php echo $list['name']." ".$list['surname']?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <span class="text-danger"><?php echo form_error('leave_type'); ?></span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label><?php echo $this->lang->line('leave'); ?> <?php echo $this->lang->line('date'); ?></label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" readonly name="leavedates" class="form-control pull-right" id="reservation">
                            </div>

                            <!-- /.input group -->
                        </div>
                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label><?php echo 'Leave method' ?> <?php echo $this->lang->line(''); ?></label>
                            <div id="leavetypeddl">
                                <select id="method" name="method" class="form-control">
                                    <option value="">select</option>
                                    <option value="full day">Full day</option>
                                    <option value="half day">Half day</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label><?php echo $this->lang->line('reason'); ?></label><br />
                            <textarea name="reason" id="reason" style="resize: none;" rows="4" class="form-control"></textarea>
                            <input type="hidden" name="leaverequestid" id="leaverequestid">


                        </div>



                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label><?php echo $this->lang->line('attach_document'); ?></label>
                            <input type="file" id="file" name="userfile" class="filestyle form-control">
                            <input type="hidden" id="filename" name="filename">
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <button type="submit" class="btn btn-primary submit_addLeave pull-right" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $this->lang->line('save'); ?></button>
                            <input type="reset" name="resetbutton" id="resetbutton" style="display:none">
                            <button type="button" style="display: none;" id="clearform" onclick="clearForm(this.form)" class="btn btn-primary submit_addLeave pull-right" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $this->lang->line('clear'); ?></button>

                        </div>




                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /*--dropify--*/
    $(document).ready(function() {
        // Basic
        $('.filestyle').dropify();
    });
    /*--end dropify--*/
</script>

<script type="text/javascript">
    $(document).ready(function() {
        getLeaveTypeDDL('<?php echo $staff_id ?>', '');
        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function() {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });

        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $('#applieddate,#leavefrom,#leaveto').datepicker({
            format: date_format,
            autoclose: true
        });
        $('#reservation').daterangepicker();
    });

    function addLeave() {

        $('input[type=text]').val('');
        $('textarea[name="reason"]').text('');

        $("#resetbutton").click();
        $("#clearform").click();


        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $('#applieddate').datepicker({
            format: date_format,
            autoclose: true
        });
        $('#reservation').daterangepicker();
        var date = '<?php echo date("Y-m-d") ?>';
        $('input[type=text][name=applieddate]').val(new Date(date).toString("MM/dd/yyyy"));

        $('#addleave').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
    }


    function getRecord(id) {
        $("#download_file").html('');
        $('input:radio[name=status]').attr('checked', false);
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            url: base_url + 'admin/leaverequest/leaveRecord',
            type: 'POST',
            data: {
                id: id
            },
            dataType: "json",
            success: function(result) {


                $('input[name="leave_request_id"]').val(result.id);
                $('#employee_id').html(result.employee_id);
                $('#name').html(result.name);
                $('#leave_from').html(new Date(result.leave_from).toString("MM/dd/yyyy"));
                $('#leave_to').html(new Date(result.leave_to).toString("MM/dd/yyyy"));
                $('#leave_type').html(result.type);
                $('#days').html(result.leave_days + ' Days');
                $('#remark').html(result.employee_remark);
                $('#applied_date').html(new Date(result.date).toString("MM/dd/yyyy"));
                $('#appliedby').html(result.applied_by);
                $("#detailremark").text(result.admin_remark);
                if (result.document_file != "") {
                    var cl = "<i class='fa fa-download'></i>";
                    $("#download_file").html('<a href=' + base_url + 'admin/staff/download/' + result.staff_id + '/' + result.document_file + ' class=btn btn-default btn-xs  data-toggle=tooltip >' + cl + '</a>');
                }
                $('#prstatus').html(result.pstatus);
                $('#prnote').html(result.principal_remark);
                $('#drstatus').html(result.dstatus);
                $("#drnote").text(result.director_remark);
                $("#status").text(result.status);
                $('#hodstatus').html(result.hod);
                $('#method').html(result.leave_method);
                $("#hodnote").text(result.hod_remark);
                // if(result.status == 'approve'){

                // $('input:radio[name=status]')[1].checked = true;

                // }else if(result.status == 'pending'){
                // $('input:radio[name=status]')[0].checked = true;

                // }
                // else if(result.status == 'disapprove'){
                // $('input:radio[name=status]')[2].checked = true;

                // }


            }
        });

        $('#leavedetails').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
    };



    $(document).on('click', '.submit_schsetting', function(e) {
        var $this = $(this);
        $this.button('loading');
        $.ajax({
            url: '<?php echo site_url("admin/leaverequest/leaveStatus") ?>',
            type: 'post',
            data: $('#leavedetails_form').serialize(),
            dataType: 'json',
            success: function(data) {

                if (data.status == "fail") {

                    var message = "";
                    $.each(data.error, function(index, value) {

                        message += value;
                    });
                    errorMsg(message);
                } else {

                    successMsg(data.message);
                    window.location.reload(true);
                }

                $this.button('reset');
            }
        });
    });

    function checkStatus(status) {


        if (status == 'approve') {

            $("#reason").hide();
        } else if (status == 'pending') {

            $("#reason").hide();
        } else if (status == 'disapprove') {

            $("#reason").show();
        }

    }


    $(document).ready(function(e) {
        $("#addleave_form").on('submit', (function(e) {

            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url("admin/leaverequest/add_staff_leave") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {

                    if (data.status == "fail") {

                        var message = "";
                        $.each(data.error, function(index, value) {

                            message += value;
                        });
                        errorMsg(message);
                    } else {

                        successMsg(data.message);
                        window.location.reload(true);
                    }
                }
            });
        }));


    });


    function getEmployeeName(role) {
        var ne = "";
        var base_url = '<?php echo base_url() ?>';
        $("#empname").html("<option value=''>Select</option>");
        var div_data = "";
        $.ajax({
            type: "POST",
            url: base_url + "admin/staff/getEmployeeByRole",
            data: {
                'role': role
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {


                    div_data += "<option value='" + obj.id + "' >" + obj.name + " " + obj.surname + " " + "(" + obj.employee_id + ")</option>";
                });

                $('#empname').append(div_data);
            }
        });
    }

    function setEmployeeName(role, id = '') {
        var ne = "";
        var base_url = '<?php echo base_url() ?>';
        $("#empname").html("<option value=''>Select</option>");
        var div_data = "";
        $.ajax({
            type: "POST",
            url: base_url + "admin/staff/getEmployeeByRole",
            data: {
                'role': role
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    if (obj.employee_id == id) {
                        ne = 'selected';
                    } else {
                        ne = "";
                    }

                    div_data += "<option value='" + obj.id + "' " + ne + " >" + obj.name + " " + obj.surname + " " + "(" + obj.employee_id + ")</option>";
                });

                $('#empname').append(div_data);

            }
        });

    }

    function getLeaveTypeDDL(id, lid = '') {
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            url: base_url + 'admin/leaverequest/countLeave/' + id,
            type: 'POST',
            data: {
                lid: lid
            },
            //dataType: "json",
            success: function(result) {

                $("#leavetypeddl").html(result);

            }

        });
    }

    function editRecord(id) {

        var leave_from = '05/01/2018';
        var leave_to = '05/10/2018';
        $("#resetbutton").click();
        $('textarea[name="reason"]').text('');

        $('textarea[name="remark"]').text('');
        $('input:radio[name=addstatus]').attr('checked', false);

        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            url: base_url + 'admin/leaverequest/leaveRecord',
            type: 'POST',
            data: {
                id: id
            },
            dataType: "json",
            success: function(result) {


                leave_from = result.leavefrom;
                leave_to = result.leaveto;


                setEmployeeName(result.user_type, result.employee_id);
                getLeaveTypeDDL(result.staff_id, result.lid);
                $('select[name="role"] option[value="' + result.user_type + '"]').attr("selected", "selected");
                $('input[name="applieddate"]').val(new Date(result.date).toString("MM/dd/yyyy"));
                $('input[name="leavefrom"]').val(new Date(result.leave_from).toString("MM/dd/yyyy"));
                $('input[name="filename"]').val(result.document_file);
                $('input[name="leavedates"]').val(result.leavefrom + '-' + result.leaveto);

                $('input[name="leaverequestid"]').val(id);
                $('textarea[name="reason"]').text(result.employee_remark);
                $('textarea[name="remark"]').text(result.admin_remark);

                if (result.status == 'approve') {

                    $('input:radio[name=addstatus]')[1].checked = true;

                } else if (result.status == 'pending') {
                    $('input:radio[name=addstatus]')[0].checked = true;

                } else if (result.status == 'disapprove') {
                    $('input:radio[name=addstatus]')[2].checked = true;

                }

                $('#reservation').daterangepicker({
                    startDate: leave_from,
                    endDate: leave_to
                });
            }
        });
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['m' => 'mm', 'd' => 'dd', 'Y' => 'yyyy',]) ?>';

        $('#applieddate').datepicker({
            format: date_format,
            autoclose: true
        });


        $('#addleave').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
    };

    function clearForm(oForm) {

        var elements = oForm.elements;



        for (i = 0; i < elements.length; i++) {

            field_type = elements[i].type.toLowerCase();

            switch (field_type) {

                case "text":
                case "password":

                case "hidden":

                    elements[i].value = "";
                    break;

                case "select-one":
                case "select-multi":
                    elements[i].selectedIndex = "";
                    break;

                default:
                    break;
            }
        }
    }
</script>