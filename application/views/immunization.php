<div class="container-fluid">
    <div class="page-head">
        <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#create_hospital"><i class="fa fa-plus-square"></i> Add Immunization</a>
    </div>
    <div class="modal fade" id="create_hospital" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelform" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-square"></i> New Immunization</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?php echo site_url('immunization/add'); ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Child: <label class="text-danger">*</label></label>
                                <select class="form-control" name="child_id" id="child_id" required>
                                    <option value="">~~Select Child~~</option>
                                    <?php
                                    $getsubcounty = $this->db->get('tbl_births')->result();
                                    foreach ($getsubcounty as $c) {
                                    ?>
                                        <option value="<?php echo $c->id; ?>"><?php echo $c->surname . ' ' . $c->other_names; ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>Vaccine: <label class="text-danger">*</label></label>
                                <select class="form-control" name="vaccine_id" id="vaccine_id" required>
                                    <option value="">~~Select Vaccine~~</option>
                                    <?php
                                    $getsubcounty = $this->db->get('tbl_vaccines')->result();
                                    foreach ($getsubcounty as $c) {
                                    ?>
                                        <option value="<?php echo $c->id; ?>"><?php echo $c->vaccine_name; ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>Hospital Name: <label class="text-danger">*</label></label>
                                <select class="form-control" name="hospital_id" id="hospital_id" required>
                                    <option value="">~~Select Hospital~~</option>
                                    <?php
                                    $getsubcounty = $this->db->get('tbl_hospital')->result();
                                    foreach ($getsubcounty as $c) {
                                    ?>
                                        <option value="<?php echo $c->id; ?>"><?php echo $c->hospital_name; ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>Date: <label class="text-danger">*</label></label>
                                <input type="date" class="form-control" placeholder="Hospital Name" name="date" id="date">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="submit_btn" name="submit_btn" class="btn btn-primary"><i class="fa fa-save"></i> Save Immunization</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
        </div>
        <div class="col-lg-12 col-sm-12">
            <div class="portlet">
                <div class="portlet-heading bg-primary">
                    <h3 class="portlet-title text-white">
                        Immunization List
                    </h3>
                    <div class="portlet-widgets">
                        <a href="javascript:;" data-toggle="reload"><i class="fa fa-refresh"></i></a>
                        <span class="divider"></span>
                        <a data-toggle="collapse" data-parent="#accordion1" href="#bg-info"><i class="fa fa-minus"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="bg-info" class="panel-collapse collapse in show">
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Child Name</th>
                                                <th>Vaccine</th>
                                                <th>Hospital</th>
                                                <th>Date</th>
                                                <th style="text-align:right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            $getward = $this->db->select('a.*, b.surname,b.other_names,c.vaccine_name,d.hospital_name')->from('tbl_immunization as a')->join('tbl_births as b', 'a.child_id=b.id')->join('tbl_vaccines as c', 'a.vaccine_id=c.id')->join('tbl_hospital as d', 'a.hospital_id=d.id')->get()->result();
                                            foreach ($getward as $w) {
                                            ?>
                                                <tr>
                                                    <td><?php echo ++$count; ?>.</td>
                                                    <td><?php echo $w->surname . '' . $w->other_names; ?></td>
                                                    <td><?php echo $w->vaccine_name; ?></td>
                                                    <td><?php echo $w->hospital_name; ?></td>
                                                    <td><?php echo $w->dated; ?></td>
                                                    <td style="text-align:right">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <button data-toggle="modal" data-target="#view_immunization<?php echo $w->id; ?>" type="button" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></button>
                                                            <button data-toggle="modal" data-target="#view_immunization<?php echo $w->id; ?>" type="button" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></button>
                                                            <button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="view_immunization<?php echo $w->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelform" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> View/Update Immunization</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="post" action="<?php echo site_url('immunization/update'); ?>">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label>Child: <label class="text-danger">*</label></label>
                                                                            <input hidden value="<?php echo $w->id; ?>" name="id">
                                                                            <select class="form-control" name="child_id" id="child_id" required>
                                                                                <option value="">~~Select Child~~</option>
                                                                                <?php
                                                                                $getsubcounty = $this->db->get('tbl_births')->result();
                                                                                foreach ($getsubcounty as $c) {
                                                                                ?>
                                                                                    <option value="<?php echo $c->id; ?>" <?php if ($w->child_id == $c->id) echo 'selected="selected"'; ?>><?php echo $c->surname . ' ' . $c->other_names; ?></option>
                                                                                <?php
                                                                                }
                                                                                ?>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Vaccine: <label class="text-danger">*</label></label>
                                                                            <select class="form-control" name="vaccine_id" id="vaccine_id" required>
                                                                                <option value="">~~Select Vaccine~~</option>
                                                                                <?php
                                                                                $getsubcounty = $this->db->get('tbl_vaccines')->result();
                                                                                foreach ($getsubcounty as $c) {
                                                                                ?>
                                                                                    <option value="<?php echo $c->id; ?>" <?php if ($w->vaccine_id == $c->id) echo 'selected="selected"'; ?>><?php echo $c->vaccine_name; ?></option>
                                                                                <?php
                                                                                }
                                                                                ?>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Hospital Name: <label class="text-danger">*</label></label>
                                                                            <select class="form-control" name="hospital_id" id="hospital_id" required>
                                                                                <option value="">~~Select Hospital~~</option>
                                                                                <?php
                                                                                $getsubcounty = $this->db->get('tbl_hospital')->result();
                                                                                foreach ($getsubcounty as $c) {
                                                                                ?>
                                                                                    <option value="<?php echo $c->id; ?>" <?php if ($w->hospital_id == $c->id) echo 'selected="selected"'; ?>><?php echo $c->hospital_name; ?></option>
                                                                                <?php
                                                                                }
                                                                                ?>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Date: <label class="text-danger">*</label></label>
                                                                            <input type="date" value="<?php echo $w->dated; ?>" class="form-control" placeholder="Hospital Name" name="date" id="date">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" id="submit_btn" name="submit_btn" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!--end container-->