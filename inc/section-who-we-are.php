<!--Start WhoWe Are Area-->
<section class="whowe-are-area">
    <div class="layer-outer" style="background-image: url(images/shape-2.png)"></div>
    <div class="container">
        <div class="sec-title text-center">
            <h3>WHO WE ARE</h3>
            <h2>What Makes Us Different From Other Immigration <br> Consultants <span>Since 1990</span></h2>
        </div>
        <div class="row">
            <!--Start Single Featured Box-->
            <div class="col-xl-4 col-lg-4">
                <div class="single-featured-box text-center">
                    <div class="count-box">01</div>
                    <div class="inner-box">
                        <h3><a href="#applyOnlineVisa" data-toggle="modal">Apply Online Visa</a></h3>
                        <div class="border-box"></div>
                        <div class="text">
                            <p>We are reliable immigration consultants to handle your immigration case.</p>
                        </div>
                    </div>
                    <div class="icon-holder">
                        <span class="flaticon-technology"></span>
                    </div>
                </div>
            </div>
            <!--End Single Featured Box-->
            <!--Start Single Featured Box-->
            <div class="col-xl-4 col-lg-4">
                <div class="single-featured-box bg2 text-center">
                    <div class="count-box">02</div>
                    <div class="inner-box">
                        <h3><a href="#BookAnAppointment" data-toggle="modal">Book an Appointment</a></h3>
                        <div class="border-box"></div>
                        <div class="text">
                            <p>To process your visa application with our experienced registered agents.</p>
                        </div>
                    </div>
                    <div class="icon-holder">
                        <span class="flaticon-checking"></span>
                    </div>
                </div>
            </div>
            <!--End Single Featured Box-->
            <!--Start Single Featured Box-->
            <div class="col-xl-4 col-lg-4">
                <div class="single-featured-box bg3 text-center">
                    <div class="count-box">03</div>
                    <div class="inner-box">
                        <h3><a href="<?php echo ROOT; ?>/contact-us">Immigration Experts</a></h3>
                        <div class="border-box"></div>
                        <div class="text">
                            <p>Our goal has been provide immigration in all over country and universities.</p>
                        </div>
                    </div>
                    <div class="icon-holder">
                        <span class="flaticon-people-1"></span>
                    </div>
                </div>
            </div>
            <!--End Single Featured Box-->
        </div>
    </div>
</section>
<!--End WhoWe Are Area-->

<!-- Modal -->
<div class="modal fade" id="applyOnlineVisa" tabindex="-1" role="dialog" aria-labelledby="applyOnlineVisaLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyOnlineVisaLabel">Apply Online Visa</h5>
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
                                    <input type="hidden" name="ApplyOnlineVisa">
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

<!-- Modal -->
<div class="modal fade" id="BookAnAppointment" tabindex="-1" role="dialog" aria-labelledby="BookAnAppointmentLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="BookAnAppointmentLabel">Book An Appointment</h5>
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
                                    <input type="hidden" name="BookAnAppointment">
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