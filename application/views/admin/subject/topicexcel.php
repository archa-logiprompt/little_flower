<?php if ($this->session->flashdata('msg')) { ?>
    <?php echo $this->session->flashdata('msg') ?>
<?php } ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> 
            <small><?php echo $this->lang->line('student_fees1'); ?></small> 
        </h1>
    </section>
    <section class="content">
        <div class="row">        
            <div class="col-md-4">             
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Topic Excel</h3>
                    </div>                  
                    <form id="form1" action="" name="topicform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                             <a href="<?php echo base_url('uploads/sample_topic_format.csv'); ?>" class="btn btn-sm btn-success" style="margin-bottom: 10px;" download>
                                                          <i class="fa fa-download"></i> Download Sample File
                                                      </a>
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                            <?php echo validation_errors(); ?>

                            <div class="form-group">
                                <label for="subject"><?php echo $this->lang->line('subject_name'); ?></label>
                                <select id="subject" name="subject" class="form-control">
                                    <option value="">Select Subject</option>
                                    <?php foreach ($subjects as $subject): ?>
                                        <option value="<?php echo $subject->id; ?>" <?php echo set_select('subject', $subject->id); ?>>
                                            <?php echo htmlspecialchars($subject->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('subject'); ?></span>
                            </div>

                          <div class="form-group">
    <label for="topic_file">Upload File</label>
<input id="documents" name="documents" placeholder="" type="file" class="filestyle form-control" data-height="40" value="">
    <span class="text-danger"><?php echo form_error('topic_file'); ?></span>
</div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>   
            </div>
        </div> 
    </section>
</div>
