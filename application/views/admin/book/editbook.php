<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-book"></i> <?php echo $this->lang->line('library'); ?> </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('edit_book'); ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form id="form1" action="<?php echo site_url('admin/book/edit/' . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <?php
                            if (isset($error_message)) {
                                echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                            }
                            ?>   
                            <?php echo $this->customlib->getCSRF(); ?>                         
                            <input  type="hidden" name="id" value="<?php echo set_value('id', $editbook['id']); ?>" >
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo "Barcode" ?></label>
                                <input autofocus="" id="barcode" name="barcode" placeholder="" type="text" class="form-control"  value="<?php echo set_value('barcode', $editbook['barcode']); ?>" />
                                <span class="text-danger"><?php echo form_error('barcode'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo "Book Title" ?></label>
                                <input id="title" name="title" placeholder="" type="text" class="form-control"  value="<?php echo set_value('title', $editbook['title']); ?>" />
                                <span class="text-danger"><?php echo form_error('title'); ?></span>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo "Author"?></label>
                                <input id="author" name="author" placeholder="" type="text" class="form-control"  value="<?php echo set_value('author', $editbook['author']); ?>" />
                                <span class="text-danger"><?php echo form_error('author'); ?></span>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo "Class No" ?></label>
                                <input id="class_no" name="class_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('class_no', $editbook['class_no']); ?>" />
                                <span class="text-danger"><?php echo form_error('class_no'); ?></span>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo "Book No" ?></label>
                                <input id="book_no" name="book_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('book_no', $editbook['book_no']); ?>" />
                                <span class="text-danger"><?php echo form_error('book_no'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo "Item Call Number" ?></label>
                                <input id="item_call_number" name="item_call_number" placeholder="" type="text" class="form-control"  value="<?php echo set_value('item_call_number', $editbook['item_call_number']); ?>" />
                                <span class="text-danger"><?php echo form_error('item_call_number'); ?></span>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo "ISBN Number" ?></label>
                                <input id="isbn" name="isbn" placeholder="" type="text" class="form-control"  value="<?php echo set_value('isbn', $editbook['isbn']); ?>" />
                                <span class="text-danger"><?php echo form_error('isbn'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo "Pages" ?></label>
                                <input id="pages" name="pages" placeholder="" type="text" class="form-control"  value="<?php echo set_value('pages', $editbook['pages']); ?>" />
                                <span class="text-danger"><?php echo form_error('pages'); ?></span>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo "Publisher" ?></label>
                                <input id="publisher" name="publisher" placeholder="" type="text" class="form-control"  value="<?php echo set_value('publisher', $editbook['publisher']); ?>" />
                                <span class="text-danger"><?php echo form_error('publisher'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo "Place" ?></label>


                                <input id="place" name="place"  placeholder="" type="text" class="form-control"  value="<?php echo set_value('place',$editbook['place']); ?>" />
                                <span class="text-danger"><?php echo form_error('place'); ?></span>
                            </div>
                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo "Copyright Year" ?></label>
                                <input id="copyright_year" name="copyright_year"  placeholder="" type="text" class="form-control"  value="<?php echo set_value('copyright_year',$editbook['copyright_year']); ?>" />
                                <span class="text-danger"><?php echo form_error('copyright_year'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo "Quantity" ?></label>
                                <input id="qty" name="qty"  placeholder="" type="text" class="form-control"  value="<?php echo set_value('qty',$editbook['qty']); ?>" />
                                <span class="text-danger"><?php echo form_error('qty'); ?></span>
                            </div>
                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo "Category Code" ?></label>
                                <input id="category_code" name="category_code"  placeholder="" type="text" class="form-control"  value="<?php echo set_value('category_code',$editbook['category_code']); ?>" />
                                <span class="text-danger"><?php echo form_error('category_code'); ?></span>
                            </div>
                            
                        </div><!-- /.box-body -->

                        <div class="box-footer">

                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>

            </div><!--/.col (right) -->


        </div>
        <div class="row">
            <!-- left column -->
            <!-- right column -->
            <div class="col-md-12">
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#postdate').datepicker({
            //   format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>