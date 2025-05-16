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

            <div class="col-md-12">

                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">
                            <?php echo ('Issue Report'); ?>
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
                                            <?php echo "Accession No" ?>
                                        </th>
                                        <th>
                                            <?php echo $this->lang->line('book_title'); ?>
                                        </th>
                                        <th>
                                            <?php echo ('Author'); ?>
                                        </th>
                                        <th>
                                            <?php echo $this->lang->line('book_no'); ?>
                                        </th> <th>
                                            <?php echo "Issued To"; ?>
                                        </th>
                                        <th>
                                            <?php echo $this->lang->line('issue_date'); ?>
                                        </th>
                                        <th>
                                            <?php echo $this->lang->line('return_date'); ?>
                                        </th>
                                        <th>
                                            <?php echo $this->lang->line('status'); ?>
                                        </th>
                                        <!-- <th class="text-right">
                                            <?php echo $this->lang->line('action'); ?>
                                        </th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($issued_books)) {
                                        ?>
                                        <?php
                                    } else {
                                        $count = 1;
                                        $currentDate = date('Y-m-d');

                                        foreach ($issued_books as $book) {

                                            ?>

                                            <tr style="<?php if ($book['return_date'] < $currentDate && $book['is_returned'] == 0) {
                                                echo "background-color:#ebcccc";
                                            } ?>">
                                                 <td class="mailbox-name">
                                                    <?php echo $book['barcode'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $book['title'] ?>
                                                </td>
                                                 <td class="mailbox-name">
                                                    <?php echo $book['author'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $book['book_no'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $book['firstname'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($book['issue_date'])) ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($book['return_date'])) ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // var_dump($book['return_date']." ".$currentDate);exit;
                                                    if ($book['is_returned'] == 0) {
                                                        if (($book['return_date']) < ($currentDate)) {
                                                            echo "Overdue";
                                                        } else if (($book['return_date']) == ($currentDate)) {
                                                            echo "Today";
                                                        } else {
                                                            echo "Not Returned";
                                                        }
                                                    } else {
                                                        echo "Returned";
                                                    }

                                                    ?>

                                                </td>
                                                <!-- <td class="mailbox-date pull-right">
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
                                                </td> -->
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

        var book_id = $(this).val();
        // $('#div_avail').hide();
        availableQuantity(book_id);

    });

    function availableQuantity(book_id) {


        $('.ava_quantity').html(0);
        if (book_id != "") {

            $.ajax({
                type: "POST",
                url: base_url + "admin/book/getAvailQuantity",
                data: { 'book_id': book_id },
                dataType: "json",
                beforeSend: function () {
                    $('.qty_error').show();
                    $('.ava_quantity').empty().html('Loading...');
                },
                success: function (data) {
                    $('.ava_quantity').html(data.qty);
                },
                complete: function () {
                }

            });
        } else {
            $('.qty_error').hide();
        }
    }


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