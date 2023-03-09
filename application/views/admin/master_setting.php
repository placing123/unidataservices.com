<div class="main-content">

    <section class="section">

        <div class="section-body">

            <div class="row">

                <div class="col-12 col-md-12 col-lg-12">

                    <?php if ($this->session->flashdata('success')) { ?>

                        <div class="alert alert-success alert-dismissible fade show" role="alert">

                            <strong>Success!</strong> <?= $this->session->flashdata('success'); ?>.

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                        </div>

                    <?php } ?>

                    <?php if ($this->session->flashdata('error')) { ?>

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">

                            <strong>Error!</strong> <?= $this->session->flashdata('error'); ?>.

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                        </div>

                    <?php } ?>

                    <div class="card">

                        <div class="card-header">
                            <h4><?php echo $title; ?></h4>
                        </div>

                        <style>
                            .error {
                                color: red
                            }
                        </style>

                        <?= validation_errors(); ?>

                        <?=form_open_multipart($action);?>

                      
                        <!-- <form action="<?php echo base_url().'master-edit';?>" enctype="multipart/form-data" method="post" > -->

                        <input id="id" type="hidden" class="form-control" name="id" value="<?php echo $rec[0]->id; ?>">


                        <div class="card-body">

                            <div class="row">


                                <div class="form-group col-5">

                                    <label for="plan_no">Name</label>

                                    <input required id="name" type="text" class="form-control" name="name" value="<?php echo $rec[0]->name; ?>">

                                </div>

                                <div class="form-group col-5">
                                    <label for="plan_name">Address:</label>
                                    <input required id="address" type="text" class="form-control" name="address" value="<?php echo $rec[0]->address; ?>">
                                </div>
                                <div class="form-group col-5">
                                    <label for="plan_name">State:</label>
                                    <input required id="state" type="text" class="form-control" name="state" value="<?php echo $rec[0]->state; ?>">
                                </div>
                                <div class="form-group col-5">
                                    <label for="forms">Customer Care No1:</label>
                                    <input required id="care_no" type="number" class="form-control" name="care_no" value="<?php echo $rec[0]->care_no; ?>">
                                </div>
                                <div class="form-group col-5">
                                    <label for="forms">Customer Care No2:</label>
                                    <input required id="care_no2" type="number" class="form-control" name="care_no2" value="<?php echo $rec[0]->care_no2; ?>">
                                </div>

                                <div class="form-group col-5">
                                    <label for="forms"> Customer Care Email id </label>
                                    <input required id="care_eml" type="text" class="form-control" name="care_eml" value="<?php echo $rec[0]->care_eml; ?>">
                                </div>

                                <div class="form-group col-5">

                                    <label for="days">Seal</label>

                                    <input type="file" class="form-control" name="seal">
                                 
                                    <img alt="image" src="<?= base_url($rec[0]->seal); ?>" class="user-img" style="width: 100px;">

                                </div>

                                <div class="form-group col-5">
                                    <label for="days">Logo</label>
                                    <input type="file" class="form-control" name="logo">
                                    <img alt="image" src="<?= base_url($rec[0]->logo); ?>" class="user-img" style="width: 100px;">

                                </div>
                              
                                <div class="form-group col-5">
                                    <label for="days">Company Sign</label>
                                    <input type="file" class="form-control" name="company_sign">
                                    <img alt="image" src="<?= base_url($rec[0]->company_sign); ?>" class="user-img" style="width: 100px;">

                                </div>

                                <div class="form-group col-5">
                                    <label for="days">Agreement </label>
                                    <input type="file" class="form-control" name="agreement_img">
                                    <img alt="image" src="<?= base_url($rec[0]->agreement_img); ?>" class="user-img" style="width: 100px;">

                                </div>
                                    <input type="hidden" class="form-control" name="seal_old"   value="<?php echo $rec[0]->seal; ?>"  >
                                    <input type="hidden" class="form-control" name="logo_old"   value="<?php echo $rec[0]->logo; ?>"  >
                                    <input type="hidden" class="form-control" name="oldcompany_sign"   value="<?php echo $rec[0]->company_sign; ?>"  >
                                    <input type="hidden" class="form-control" name="oldagreement_img"   value="<?php echo $rec[0]->agreement_img; ?>"  >


                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">

                        </div>

                        <?= form_close(); ?>



                    </div>

                </div>

            </div>

        </div>

    </section>



</div>