<style type="text/css">
    .qty_error {
        display: none;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-book"></i>
            <?php echo $this->lang->line('library'); ?>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <?php
                if ($memberList->member_type == "student") {
                    $this->load->view('admin/librarian/_student');
                } else {
                    $this->load->view('admin/librarian/_teacher');
                }
                ?>
            </div>
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?php echo $this->lang->line('issue_book'); ?>
                        </h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form id="form1" action="<?php echo site_url('admin/member/issue/' . $memberList->lib_member_id) ?>"
                        id="employeeform" name="employeeform" method="post" accept-charset="utf-8">

                        <div class="box-body">
                            <?php
                            if ($this->session->flashdata('msg')) {
                                echo $this->session->flashdata('msg');
                            }
                            ?>

                            <?php echo $this->customlib->getCSRF(); ?>

                            <input id="member_id" name="member_id" type="hidden" class="form-control "
                                value="<?php echo $memberList->lib_member_id; ?>" />

                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    <?php echo $this->lang->line('books'); ?>
                                </label>



                                <select id="book_id" name="book_id" class="form-control">
                                    <?php // exit;
                                    

                                    foreach ($bookList as $book) {
                                        if ($bookList == "") {

                                        } else { ?>
                                            <option value="<?php echo $book['id'] . "-" . $book['barcode'] ?> " <?php
                                                    if (set_value('book_id') == $book['id']) {
                                                        echo "selected='selected'";
                                                    }
                                                    ?>>
                                                <?php echo $book['title'] . " - " . $book['barcode'] ?>
                                            </option>
                                        <?php }
                                    } ?>
                                </select>



                                <span class=" text-danger">
                                    <?php echo form_error('book_id'); ?>
                                </span>

                            </div>
                            
                            <div class="form-group">
                                <label>
                                    <?php echo ('Issue Date'); ?>
                                </label>
                                <input id="issue_date" name="issue_date" type="text" class="form-control date"
                                    value="<?php echo set_value('return_date', date($this->customlib->getSchoolDateFormat())); ?>" />
                                <span class="text-danger">
                                    <?php echo form_error('issue_date'); ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label>
                                    <?php echo $this->lang->line('return_date'); ?>
                                </label>
                                <input id="return_date" name="return_date" type="text" class="form-control date"
                                    value="<?php echo set_value('return_date', date($this->customlib->getSchoolDateFormat())); ?>" />
                                <span class="text-danger">
                                    <?php echo form_error('return_date'); ?>
                                </span>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">
                                <?php echo $this->lang->line('save'); ?>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">
                            <?php echo $this->lang->line('book_issued'); ?>
                        </h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">
                                <?php echo $this->lang->line('book_issued'); ?>
                            </div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>

                                        <th>
                                            <?php echo $this->lang->line('book_title'); ?>
                                        </th>
                                        <th>
                                            <?php echo ('Accession No'); ?>
                                        </th>
                                        <th>
                                            <?php echo ('Author'); ?>
                                        </th>
                                        <th>
                                            <?php echo $this->lang->line('book_no'); ?>
                                        </th>
                                        <th>
                                            <?php echo $this->lang->line('issue_date'); ?>
                                        </th>
                                        <th>
                                            <?php echo $this->lang->line('return_date'); ?>
                                        </th>
                                        <th class="text-right">
                                            <?php echo $this->lang->line('action'); ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($issued_books)) {
                                        ?>
                                        <?php
                                    } else {
                                        $count = 1;

                                        foreach ($issued_books as $book) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <?php echo $book['title'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $book['barcode'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $book['author'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $book['book_no'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($book['issue_date'])) ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($book['return_date'])) ?>
                                                </td>
                                                <td class="mailbox-date pull-right">
                                                    <?php if ($book['is_returned'] == 0) {
                                                        ?>

                                                        <a href="#" class="btn btn-default btn-xs"
                                                            data-record-id="<?php echo $book['id'] ?>"
                                                            data-record-member_id="<?php echo $memberList->lib_member_id; ?>"
                                                            data-record-title="<?php echo $book['book_title'] ?>"
                                                            data-toggle="modal" data-target="#confirm-return">
                                                            <i class="fa fa-mail-reply"></i>
                                                        </a>

                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->

                    </div><!-- /.box-body -->

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="confirm-return" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo $this->lang->line('confirm_return'); ?>
                </h4>
            </div>
            <form action="<?php echo site_url('admin/member/bookreturn') ?>" method="POST" id="return_book">
                <div class="modal-body issue_retrun_modal-body">

                    <input type="hidden" name="id" id="return_model_id" value="0">
                    <input type="hidden" name="member_id" id="return_model_member_id" value="0">
                    <div class="form-group">
                        <label for="exampleInputEmail1">
                            <?php echo $this->lang->line('return_date'); ?>
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control date" id="input-date" name="date" placeholder="Date"
                                value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>">
                        </div>
                        <?php
                        $currentDate = date('Y-m-d');
                        if (($returnDate) < ($currentDate)) {
                            ?>
                            <div class="input-group" style="margin-top:5px">
                                <label for="exampleInputEmail1">
                                    <?php echo ('Fine'); ?>
                                </label>
                                <input type="number" class="form-control " name="fine" placeholder="Fine Amount">
                            </div>
                            <?php
                        } ?>

                        <div id="error" class="text text-danger"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <?php echo $this->lang->line('cancel'); ?>
                    </button>
                    <button type="submit" class="btn btn-success"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving...">
                        <?php echo $this->lang->line('save'); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('#confirm-return').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        })

        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
        $(".date").datepicker({

            format: date_format,
            autoclose: true,
            todayHighlight: true

        });
    });




    $(document).on('change', '#book_id', function (e) {
        $('#accession').html("");

        var book_id = $(this).val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        console.log(book_id)
        $.ajax({
            type: "post",
            url: base_url + "admin/member/getaccession",
            data: { 'book_id': book_id },
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj) {
                    div_data += "<option value=" + obj.accession_no + ">" + obj.accession_no + "</option>";
                });
                $('#accession').append(div_data);
            }
        });
    });






    $('#confirm-return').on('show.bs.modal', function (e) {

        var data = $(e.relatedTarget).data();
        $('#return_model_member_id').val(data.recordMember_id);
        $('#return_model_id').val(data.recordId);
    });


    $("form#return_book").submit(function (e) {

        var form = $(this);
        var url = form.attr('action');
        console.log(form);
        var $this = $(this);
        var $btn = $this.find("button[type=submit]");
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            dataType: 'JSON',
            beforeSend: function () {

                $btn.button('loading');
            },
            success: function (response, textStatus, xhr) {

                if (response.status == 'fail') {
                    $.each(response.error, function (key, value) {
                        $('#input-' + key).parents('.form-group').find('#error').html(value);
                    });
                }
                if (response.status == 'success') {
                    successMsg(response.message);
                    location.reload();
                }


            },
            error: function (xhr, status, error) {
                $btn.button('reset');

            },
            complete: function () {
                $btn.button('reset');
            },
        });
        e.preventDefault();
    });






</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function () {
        $("#book_id").select2();
    }); 
    
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#return_date').datepicker({
            //   format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });

    });
     $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#issue_date').datepicker({
            //   format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });

    });
    
</script>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-FsMQQqaecd0zazlAJ5DzNe9p0ViW3cRwbdOFDTg8tbo56W6C6GB+Z7heOEZj5ElNu6fyf3Iu8eFp2cTvCp8kJQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Include jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-99tNeyzrX7j5U3je9G7/BkdE7ZYDT8F6jSDBlYSopE/3lFkCVFHvoRtXPiqrEjKInkw+U7H+uU8t1cT6ohzcLg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>