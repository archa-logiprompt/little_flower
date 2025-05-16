<style>
    .table {
        text-align: center;
        border: #dddada solid 1px;
    }

    .table thead {
        text-align: center;
        border: #dddada solid 1px;
        background-color: #ddd;
    }

    .table tr {
        border: #dddada solid 1px;

    }


    .box-header {
        text-align: center;
    }

    #collection_print {
        z-index: 999;
    }

    .pull-center {
        text-align: center;
    }
</style>


<!--<link rel="stylesheet" href="<?php //echo base_url(); 
?>backend/bootstrap/bootstrap-select.min.css"/>
 <script src="<?php //echo base_url(); 
 ?>backend/bootstrap/bootstrap-select.min.js"></script>
 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap-multiselect.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap-multiselect.js"></script>


<!--<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/select2/select2.min.css"/>
<script type="text/javascript"  src="<?php echo base_url(); ?>backend/plugins/select2/select2.min.js"></script>
-->
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i>
            <?php echo "Balance Sheet"; ?>

        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3>
                            <?php echo "Balance Sheet"; ?>
                        </h3>

                    </div>

                    <form action="<?php echo base_url(); ?>accounts/balancesheet/search" id="employeeform"
                        name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">
                                    <?php echo "Select Year"; ?>
                                </label>
                                <div class="input-group col-md-5">
                                    <select id='year' name='year' class="form-control ">
                                        <option value="">Select</option>
                                        <?php foreach ($financial_year as $yr) {
                                            ?>
                                            <option value="<?php echo $yr['value']; ?>">
                                                <?php echo $yr['financial_year']; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <span class="text-danger">
                                    <?php echo form_error('year'); ?>
                                </span>
                            </div>

                        </div>
                        <div class="box-footer">

                            <button type="submit" class="btn btn-info pull-right">
                                <?php echo $this->lang->line('search'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php if ($type) { ?>
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <button type="button" style="margin-right: 10px;margin-top: 10px;" name="search" id="collection_print"
                        value="" class="btn btn-sm btn-primary login-submit-cs fa fa-print pull-right">
                        <?php echo $this->lang->line('print'); ?>
                    </button>
                    <div class="box box-primary" id="collection_report">
                        <div class="box-header with-border">
                            <h3>
                                <?php echo $this->setting_model->getCurrentSchoolName() . " <br>Balance Sheet <br> For the Year Ending " . $year->financial_year; ?>
                            </h3>



                            <table class="table table-striped table-bordered table-hover ">

                                <?php if ($type == "current") { ?>
                                    <thead>
                                        <tr>
                                            <td colspan="3"><strong>Liability</strong></td>
                                        </tr>
                                        <tr>
                                            <td>#</td>
                                            <td>Particulars</td>
                                            <td>Amount</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1;
                                        
                                        $assetTotal = 0;
                                        $liabilityTotal = 0;
                                        foreach ($capital as $ledger) {
                                            $total = abs($ledger['previousBalance']) + ($ledger['credit'] - $ledger['debit']);
                                            if ($total != 0) { ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $count++ ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $ledger['ledger'] ?>
                                                    </td>
                                                    <?php
                                                    if ($total > 0) {

                                                        ?>
                                                        <td>
                                                            <?php echo abs($total);
                                                            $liabilityTotal = $liabilityTotal + abs($total); ?>
                                                        </td>
                                                    <?php } else {
                                                        ?>
                                                        <td>
                                                            <?php echo "(" . abs($total) . ")";
                                                            $credit = $credit + abs($total); ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php }
                                        }

                                        if ($reserveAndSurplus > 0) { ?>
                                            <td>
                                                <?php echo $count++ ?>
                                            </td>
                                            <td>
                                                <?php echo "Reserves and Surplus" ?>
                                            </td>
                                            <td>
                                                <?php echo abs($reserveAndSurplus);
                                                $liabilityTotal = $liabilityTotal + abs($reserveAndSurplus); ?>
                                            </td>
                                        <?php } else if ($reserveAndSurplus < 0) {
                                            ?>
                                                <td>
                                                <?php echo $count++ ?>
                                                </td>
                                                <td>
                                                <?php echo "Reserves and Surplus" ?>
                                                </td>
                                                <td>
                                                <?php echo "(" . abs($total) . ")";
                                                $liabilityTotal = $liabilityTotal - abs($reserveAndSurplus); ?>
                                                </td>
                                            <?php 
                                        }
                                        if ($profitAndLoss > 0) { ?>
                                            <td>
                                                <?php echo $count++ ?>
                                            </td>
                                            <td>
                                                <?php echo "Net Profit" ?>
                                            </td>
                                            <td>
                                                <?php echo abs($profitAndLoss);
                                                $liabilityTotal = $liabilityTotal + abs($profitAndLoss); ?>
                                            </td>
                                        <?php } else if ($profitAndLoss < 0) {
                                            ?>
                                                <td>
                                                <?php echo $count++ ?>
                                                </td>
                                                <td>
                                                <?php echo "Net Loss" ?>
                                                </td>
                                                <td>
                                                <?php echo "(" . abs($total) . ")";
                                                $liabilityTotal = $liabilityTotal - abs($profitAndLoss); ?>
                                                </td>
                                            <?php
                                        }

                                        foreach ($liability as $ledger) {
                                            $total = abs($ledger['previousBalance']) + ($ledger['credit'] - $ledger['debit']);
                                            if ($total != 0) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $count++ ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $ledger['ledger'] ?>
                                                    </td>
                                                    <?php
                                                    if ($total > 0) {

                                                        ?>
                                                        <td>
                                                            <?php echo abs($total);
                                                            $liabilityTotal = $liabilityTotal + abs($total) ?>

                                                        </td>
                                                    <?php } else {
                                                        ?>
                                                        <td>
                                                            <?php echo "(" . abs($total) . ")";
                                                            $liabilityTotal = $liabilityTotal + abs($total); ?>

                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php
                                            }
                                        }

                                        ?>



                                        <tr style="background-color: #f4f4f4;">
                                            <td></td>
                                            <td>Balance</td>
                                            <td>
                                                <?php echo $liabilityTotal ?>
                                            </td>
                                        </tr>
                                        <thead>
                                            <tr>
                                                <td colspan="3"><strong>Assets</strong></td>
                                            </tr>
                                            <tr>
                                                <td>#</td>
                                                <td>Particulars</td>
                                                <td>Amount</td>
                                            </tr>
                                        </thead>
                                        <?php $count = 1;
                                        foreach ($assets as $ledger) {
                                            $total = abs($ledger['previousBalance']) + ($ledger['debit'] - $ledger['credit']);
                                            if ($total != 0) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $count++ ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $ledger['ledger'] ?>
                                                    </td>
                                                    <?php
                                                    if ($total > 0) {

                                                        ?>
                                                        <td>
                                                            <?php echo abs($total);
                                                            $assetTotal = $assetTotal + abs($total) ?>

                                                        </td>
                                                    <?php } else if ($total < 0) {
                                                        ?>
                                                            <td>
                                                            <?php echo "(" . abs($total) . ")";
                                                            $assetTotal = $assetTotal + abs($total); ?>

                                                            </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <tr style="background-color: #f4f4f4;">
                                            <td></td>
                                            <td>Balance</td>
                                            <td>
                                                <?php echo $assetTotal ?>
                                            </td>
                                        </tr>



                                    </tbody>

                                <?php } else if ($type == "previous") { ?>
                                        <thead>
                                            <tr>
                                                <td colspan="3"><strong>Liability</strong></td>
                                            </tr>
                                            <tr>
                                                <td>#</td>
                                                <td>Particulars</td>
                                                <td>Amount</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $count = 1;
                                        $assetTotal = 0;
                                        $liabilityTotal = 0;
                                        foreach ($capital as $ledger) {
                                            $total = abs($ledger['previousBalance']) + ($ledger['credit'] - $ledger['debit']);
                                            if ($total != 0) { ?>
                                                    <tr>
                                                        <td>
                                                        <?php echo $count++ ?>
                                                        </td>
                                                        <td>
                                                        <?php echo $ledger['ledger'] ?>
                                                        </td>
                                                        <?php
                                                        if ($total > 0) {

                                                            ?>
                                                            <td>
                                                            <?php echo abs($total);
                                                            $liabilityTotal = $liabilityTotal + abs($total); ?>
                                                            </td>
                                                    <?php } else {
                                                            ?>
                                                            <td>
                                                            <?php echo "(" . abs($total) . ")";
                                                            $credit = $credit + abs($total); ?>
                                                            </td>
                                                    <?php } ?>
                                                    </tr>
                                            <?php }
                                        }
                                        if ($reserveAndSurplus > 0) { ?>
                                                <td>
                                                <?php echo $count++ ?>
                                                </td>
                                                <td>
                                                <?php echo "Reserves and Surplus" ?>
                                                </td>
                                                <td>
                                                <?php echo abs($reserveAndSurplus);
                                                $liabilityTotal = $liabilityTotal + abs($reserveAndSurplus); ?>
                                                </td>
                                        <?php } else if ($reserveAndSurplus < 0) {
                                            ?>
                                                    <td>
                                                <?php echo $count++ ?>
                                                    </td>
                                                    <td>
                                                <?php echo "Reserves and Surplus" ?>
                                                    </td>
                                                    <td>
                                                <?php echo "(" . abs($total) . ")";
                                                $liabilityTotal = $liabilityTotal - abs($reserveAndSurplus); ?>
                                                    </td>
                                            <?php
                                        }


                                        if ($profitAndLoss > 0) { ?>
                                                <td>
                                                <?php echo $count++ ?>
                                                </td>
                                                <td>
                                                <?php echo "Net Profit" ?>
                                                </td>
                                                <td>
                                                <?php echo abs($profitAndLoss);
                                                $liabilityTotal = $liabilityTotal + abs($profitAndLoss); ?>
                                                </td>
                                        <?php } else if ($profit_loss < 0) {
                                            ?>
                                                    <td>
                                                <?php echo $count++ ?>
                                                    </td>
                                                    <td>
                                                <?php echo "Net Loss" ?>
                                                    </td>
                                                    <td>
                                                <?php echo "(" . abs($total) . ")";
                                                $liabilityTotal = $liabilityTotal - abs($profit_loss); ?>
                                                    </td>
                                            <?php
                                        }

                                        foreach ($liability as $ledger) {
                                            $total = abs($ledger['previousBalance']);
                                            if ($total != 0) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                        <?php echo $count++ ?>
                                                        </td>
                                                        <td>
                                                        <?php echo $ledger['ledger'] ?>
                                                        </td>
                                                        <?php
                                                        if ($total > 0) {

                                                            ?>
                                                            <td>
                                                            <?php echo abs($total);
                                                            $liabilityTotal = $liabilityTotal + abs($total) ?>

                                                            </td>
                                                    <?php } else {
                                                            ?>
                                                            <td>
                                                            <?php echo "(" . abs($total) . ")";
                                                            $liabilityTotal = $liabilityTotal + abs($total); ?>

                                                            </td>
                                                    <?php } ?>
                                                    </tr>
                                                <?php
                                            }
                                        }

                                        ?>



                                            <tr style="background-color: #f4f4f4;">
                                                <td></td>
                                                <td>Balance</td>
                                                <td>
                                                <?php echo $liabilityTotal ?>
                                                </td>
                                            </tr>
                                            <thead>
                                                <tr>
                                                    <td colspan="3"><strong>Assets</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>#</td>
                                                    <td>Particulars</td>
                                                    <td>Amount</td>
                                                </tr>
                                            </thead>
                                        <?php $count = 1;
                                        foreach ($assets as $ledger) {
                                            $total = abs($ledger['previousBalance']);
                                            if ($total != 0) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                        <?php echo $count++ ?>
                                                        </td>
                                                        <td>
                                                        <?php echo $ledger['ledger'] ?>
                                                        </td>
                                                        <?php
                                                        if ($total > 0) {

                                                            ?>
                                                            <td>
                                                            <?php echo abs($total);
                                                            $assetTotal = $assetTotal + abs($total) ?>

                                                            </td>
                                                    <?php } else if ($total < 0) {
                                                            ?>
                                                                <td>
                                                            <?php echo "(" . abs($total) . ")";
                                                            $assetTotal = $assetTotal + abs($total); ?>

                                                                </td>
                                                    <?php } ?>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                            <tr style="background-color: #f4f4f4;">
                                                <td></td>
                                                <td>Balance</td>
                                                <td>
                                                <?php echo $assetTotal ?>
                                                </td>
                                            </tr>



                                        </tbody>
                                    <?php
                                    } ?>
                            </table>
                        </div>



                    </div>
                </div>
            </div>
        </section>
        <?php
    }
    ?>



</div>

</section>
</div>



<script type="text/javascript">
 $(document).on('click', '#collection_print', function() {


var printContents = document.getElementById('collection_report').innerHTML;
var originalContents = document.body.innerHTML;

document.body.innerHTML = printContents;

window.print();

document.body.innerHTML = originalContents;


});
</script>