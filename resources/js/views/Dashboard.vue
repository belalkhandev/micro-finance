<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <div class="widget widget-primary">
                    <div class="widget-header">
                        <h5 class="title">Members</h5>
                        <span>
                        <i class="bx bx-group"></i>
                    </span>
                    </div>
                    <div class="widget-body">
                        <h3>15012</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-success">
                    <div class="widget-header">
                        <h5 class="title">Admins</h5>
                        <span>
                        <i class="bx bx-group"></i>
                    </span>
                    </div>
                    <div class="widget-body">
                        <h3>15012</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-warning">
                    <div class="widget-header">
                        <h5 class="title">DPS Applications</h5>
                        <span>
                        <i class="bx bx-group"></i>
                    </span>
                    </div>
                    <div class="widget-body">
                        <h3>15012</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-danger">
                    <div class="widget-header">
                        <h5 class="title">Loand Applications</h5>
                        <span>
                        <i class="bx bx-group"></i>
                    </span>
                    </div>
                    <div class="widget-body">
                        <h3>15012</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="widget widget-success">
                    <div class="widget-header">
                        <h5 class="title">Total Collections</h5>
                        <span>
                            <i class="bx bx-group"></i>
                        </span>
                    </div>
                    <div class="widget-body">
                        <h3>15012</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-warning">
                    <div class="widget-header">
                        <h5 class="title">Total Dues</h5>
                        <span>
                            <i class="bx bx-group"></i>
                        </span>
                    </div>
                    <div class="widget-body">
                        <h3>15012</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-primary">
                    <div class="widget-header">
                        <h5 class="title">Full Paid</h5>
                        <span>
                            <i class="bx bx-group"></i>
                        </span>
                    </div>
                    <div class="widget-body">
                        <h3>15012</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-danger">
                    <div class="widget-header">
                        <h5 class="title">No Paid</h5>
                        <span>
                            <i class="bx bx-group"></i>
                        </span>
                    </div>
                    <div class="widget-body">
                        <h3>15012</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <h5>Recent Transaction</h5>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Member</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="box-footer"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <h5>Search Members & Transaction</h5>
                        </div>
                    </div>
                    <div class="box-body">
                        <input type="text" name="" placeholder="Account No / Name" class="form-control">
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
import Navigation from "../components/Navigation";
export default {
    name: 'Dashboard',
    components: {
        Navigation
    }

}
</script>
