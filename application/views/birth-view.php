<div class="container-fluid">
    <div class="page-head">
        <!-- <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#create_hospital"><i class="fa fa-plus-square"></i> Add Hospital</a> -->
    </div>

    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="portlet">
                <div class="portlet-heading bg-primary">
                    <h3 class="portlet-title text-white">
                        Birth Records
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
                                <?php
                                if (isset($_SESSION['message'])) {
                                    echo $_SESSION['message'];
                                }
                                ?>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Child Name</th>
                                                <th>Date of Birth</th>
                                                <th>Place of Birth</th>
                                                <th>Parent Names</th>
                                                <th>Hospital</th>
                                                <th style="text-align:right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            $getdata = $this->db->select('a.*,b.hospital_name')->from('tbl_births as a')->join('tbl_hospital as b', 'a.hospital_id=b.id')->get()->result();
                                            foreach ($getdata as $d) {
                                            ?>
                                                <tr>
                                                    <td><?php echo ++$count; ?>.</td>
                                                    <td><?php echo $d->surname . ' ' . $d->other_names; ?></td>
                                                    <td><?php echo $d->dob; ?></td>
                                                    <td><?php echo $d->place_of_birth; ?></td>
                                                    <td><?php echo $d->parent_name; ?></td>
                                                    <td><?php echo $d->hospital_name; ?></td>
                                                    <td style="text-align:right">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <button data-toggle="modal" data-target="#view_births<?php echo $d->id; ?>" type="button" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></button>
                                                            <button data-toggle="modal" data-target="#view_births<?php echo $d->id; ?>" type="button" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></button>
                                                            <button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="view_births<?php echo $d->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelform" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-square"></i> View/ Update Birth Records</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="<?php echo site_url('births/update'); ?>">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label>Hospital: <label class="text-danger">*</label></label>
                                                                            <input hidden value="<?php echo $d->id; ?>" name="id">
                                                                            <select class="form-control" name="hospital_id" id="hospital_id" required>
                                                                                <option value="">~~Select Hospital~~</option>
                                                                                <?php
                                                                                $getsubcounty = $this->db->get('tbl_hospital')->result();
                                                                                foreach ($getsubcounty as $c) {
                                                                                ?>
                                                                                    <option value="<?php echo $c->id; ?>" <?php if ($d->hospital_id == $c->id) echo 'selected="selected"' ?>><?php echo $c->hospital_name; ?></option>
                                                                                <?php
                                                                                }
                                                                                ?>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Surname: <label class="text-danger">*</label></label>
                                                                            <input value="<?php echo $d->surname; ?>" class="form-control" placeholder="Surname" name="surname" id="surname" required>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Other Names: <label class="text-danger">*</label></label>
                                                                            <input value="<?php echo $d->other_names; ?>" class="form-control" placeholder="Other names" name="other_names" id="other_names">
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Date of Birth: <label class="text-danger">*</label></label>
                                                                            <input value="<?php echo $d->dob; ?>" type="date" class="form-control" placeholder="Date of birth" name="dob" id="dob" required>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Place of Birth: <label class="text-danger">*</label></label>
                                                                            <input value="<?php echo $d->place_of_birth; ?>" class="form-control" placeholder="Place of Birth" name="place_of_birth" id="place_of_birth">
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Parent Names: <label class="text-danger">*</label></label>
                                                                            <input value="<?php echo $d->parent_name; ?>" class="form-control" placeholder="Parent Name" name="parent_name" id="parent_name" required>
                                                                        </div>
                                                                    </div>
                                                                    <br />
                                                                    <div class="modal-footer" style="text-align: left;">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" id="submit_btn" name="submit_btn" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
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