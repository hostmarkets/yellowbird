<!--Start Visa Assessment Area-->
<section class="visa-assessment-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="visa-assessment-box">
                    <div class="img-holder">
                        <img src="images/visa-assessment.jpg" alt="Awesome Image">
                    </div>
                    <div class="text-holder">
                        <div class="sec-title">
                            <h3>Get Free</h3>
                            <h2>Online Visa <span>Assessment</span></h2>
                        </div>
                        <div class="inner-content">
                            <p>Contact us today by fill up free online visa assessment and we will contact you
                            </p>
                            <div class="btns-box">
                                <a class="btn-one style2" href="#applyNowModal" data-toggle="modal"><span
                                        class="txt">Apply Now<i class="fa fa-angle-double-right"
                                            aria-hidden="true"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Visa Assessment Area-->

<!-- Modal -->
<div class="modal fade" id="applyNowModal" tabindex="-1" role="dialog" aria-labelledby="applyNowModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyNowModalLabel">Apply Now</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="apply-now-form-box">
                    <form id="visa-form" name="visa_form" class="default-form2" action="form-action.php" method="post">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="form_name" value="" placeholder="Name"
                                        required="">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="form_country" required="">
                                        <option value="" selected="selected">Choose Country</option>
                                        <?php
                                        $selectQuery = $db->query("SELECT `name` FROM `countries`");
                                        if (is_array($selectQuery) || is_object($selectQuery)) {
                                            foreach ($selectQuery as $key => $selectRow) {
                                                ?>
                                                <option value="<?php echo $selectRow['name']; ?>">
                                                    <?php echo $selectRow['name']; ?>
                                                </option>
                                            <?php }
                                        } ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="form_phone" value=""
                                        placeholder="Phone" required="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="email" name="form_email" value=""
                                        placeholder="Email" required="">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="form_visa" required="">
                                        <option value="" selected="selected">Choose Visa</option>
                                        <option>PR Visa</option>
                                        <option>Student Visa</option>
                                        <option>Tourist / Visit Visa</option>
                                        <option>Job Seeker Visa</option>
                                        <option>Spouse Visa</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xl-12">
                                <div class="button-box">
                                    <button class="btn btn-primary btn-sm btn-block" type="submit">
                                        <span class="txt">Apply Now</span>
                                    </button>
                                    <input type="hidden" name="ApplyNow">
                                    <input type="hidden" name="urlAddress" value="<?php echo $REQUEST_URI; ?>">
                                    <input type="hidden" name="utmSource" value="<?php echo $utmSource; ?>">
                                    <input type="hidden" name="utmMedium" value="<?php echo $utmMedium; ?>">
                                    <input type="hidden" name="utmCampaign" value="<?php echo $utmCampaign; ?>">
                                    <input type="hidden" name="gclid" value="<?php echo $gclid; ?>">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>