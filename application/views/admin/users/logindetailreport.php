<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">
/*REQUIRED*/
.carousel-row {
    margin-bottom: 10px;
}

.slide-row {
    padding: 0;
    background-color: #ffffff;
    min-height: 150px;
    border: 1px solid #e7e7e7;
    overflow: hidden;
    height: auto;
    position: relative;
}

.slide-carousel {
    width: 20%;
    float: left;
    display: inline-block;
}

.slide-carousel .carousel-indicators {
    margin-bottom: 0;
    bottom: 0;
    background: rgba(0, 0, 0, .5);
}

.slide-carousel .carousel-indicators li {
    border-radius: 0;
    width: 20px;
    height: 6px;
}

.slide-carousel .carousel-indicators .active {
    margin: 1px;
}

.slide-content {
    position: absolute;
    top: 0;
    left: 20%;
    display: block;
    float: left;
    width: 80%;
    max-height: 76%;
    padding: 1.5% 2% 2% 2%;
    overflow-y: auto;
}

.slide-content h4 {
    margin-bottom: 3px;
    margin-top: 0;
}

.slide-footer {
    position: absolute;
    bottom: 0;
    left: 20%;
    width: 78%;
    height: 20%;
    margin: 1%;
}

/* Scrollbars */
.slide-content::-webkit-scrollbar {
    width: 5px;
}

.slide-content::-webkit-scrollbar-thumb:vertical {
    margin: 5px;
    background-color: #999;
    -webkit-border-radius: 5px;
}

.slide-content::-webkit-scrollbar-button:start:decrement,
.slide-content::-webkit-scrollbar-button:end:increment {
    height: 5px;
    display: block;
}
</style>

<div class="content-wrapper" style="min-height: 946px;">

    <section class="content-header">
        <h1>
            <i class="fa fa-line-chart"></i> <?php echo $this->lang->line('reports'); ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i>
                            <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>

                    <form role="form" action="<?php echo site_url('admin/users/logindetailreport') ?>" method="post"
                        class="">
                        <div class="box-body row">

                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('class'); ?></label>
                                    <select autofocus="" id="class_id" name="class_id" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($classlist as $class) {
                                            ?>
                                        <option value="<?php echo $class['id'] ?>"
                                            <?php if (set_value('class_id') == $class['id']) echo "selected=selected" ?>>
                                            <?php echo $class['class'] ?></option>
                                        <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('section'); ?></label>
                                    <select autofocus="" id="section_id" name="section_id" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>

                                    </select>
                                    <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="search" value="search_filter"
                                        class="btn btn-primary btn-sm checkbox-toggle pull-right"><i
                                            class="fa fa-search"></i>
                                        <?php echo $this->lang->line('search'); ?></button>
                                </div>
                            </div>

                    </form>
                </div>
            </div>

            <div class="box box-info" style="padding:5px;">
                <div class="box-header ptbnull">
                    <h3 class="box-title titlefix"><i class="fa fa-users"></i>
                        <?php echo $this->lang->line('login_credential'); ?> <?php echo $this->lang->line('report'); ?>
                    </h3>
                </div>
                <div class="box-body table-responsive">
                    <div class="download_label"> <?php echo $this->Setting_model->getCurrentSchoolName();?></br>
                        <?php echo $this->lang->line('login_credential'); ?> <?php echo $this->lang->line('report'); ?>
                    </div>
                    <table class="table table-striped table-bordered table-hover example">
                        <thead>
                            <tr>
                                <!--<th><?php echo $this->lang->line('admission_no'); ?></th>-->
                                <th><?php echo $this->lang->line('student_name'); ?></th>
                                <th><?php echo $this->lang->line('username'); ?></th>
                                <th><?php echo $this->lang->line('password'); ?></th>
                                <th>Parent Username</th>
                                <th>Parent Password</th>
                                <th></th>




                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (empty($resultlist)) {
                                ?>

                            <?php
                            } else {
                                $count = 1;
                                $i = 0;
                                foreach ($resultlist as $student) {
                                    ?>
                            <tr <?php
                                    if ($student["is_active"] == "no") {
                                        echo "class='danger'";
                                    }
                                    ?>>
                                <!--<td><?php echo $student['admission_no']; ?></td>-->

                                <td>
                                    <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>"><?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                    </a>
                                </td>


                                <td><?php
                                    if (isset($student['student_username'])) {
                                        echo $student['student_username'];
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                            if (isset($student['student_password'])) {
                                                echo $student['student_password'];
                                            }
                                            ?>
                                </td>
                                <td>
                                    <?php
                                            if (isset($student['parent_username'])) {
                                                echo $student['parent_username'];
                                            }
                                            ?>
                                </td>

                                <td>
                                    <?php
                                    if (isset($student['parent_password'])) {
                                        echo $student['parent_password'];
                                    }
                                    ?>
                                </td>
                                <td></td>


                            </tr>
                            <?php
        $i++;
        $count++;
    }
}
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
</section>
</div>


<script type="text/javascript">
function getSectionByClass(class_id, section_id) {
    if (class_id != "" && section_id != "") {
        $('#section_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {
                'class_id': class_id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    var sel = "";
                    if (section_id == obj.section_id) {
                        sel = "selected";
                    }
                    div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section +
                        "</option>";
                });
                $('#section_id').append(div_data);
            }
        });
    }
}

$(document).ready(function() {
    var class_id = $('#class_id').val();
    var section_id = '<?php echo set_value('section_id') ?>';
    getSectionByClass(class_id, section_id);
    $(document).on('change', '#class_id', function(e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {
                'class_id': class_id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    div_data += "<option value=" + obj.section_id + ">" + obj
                        .section + "</option>";
                });
                $('#section_id').append(div_data);
            }
        });
    });
});
</script>