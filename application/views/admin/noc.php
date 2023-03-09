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

                            <h4><?php echo $title;?></h4>

                            <a href="<?=base_url('noclist');?>" class="btn btn-warning" style="position:absolute;right:10px">List</a>



                        </div>

                        <style>
                            .error {
                                color: red
                            }
                        </style>

                        <?= validation_errors(); ?>

                        <?= form_open_multipart($action); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-5">

                                    <label for="plan_no">customerID </label>
                                    <input type="text" class="form-control" name="customer_id" id="customer_id" value="">
                                </div>
                                <div class="form-group col-5">
                                    <label for="forms">Amount</label>
                                    <input required id="amount" type="number" class="form-control" name="amount" value="">
                                </div>
                                <div class="form-group col-5">  
                                    <input type="submit" name="btn" class="btn btn-primary" value="Submit" >

                                </div>
                              
                            </div>

                        </div>
                        <?= form_close(); ?>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>